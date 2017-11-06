<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_admin extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('cookie'));
        $this->load->model('manage_admin_model','manage_admin');
        $this->load->module('template');
    }

    /* public function isLoggedIn() {
         if ($this->session->userdata('admin_logged_in') === TRUE) {
             redirect("admin_dashboard");
         }
     }*/

    public function index() {
        no_cache();
        $data = array();
        $data['title']='Admin Dashboard';
        $data['view_file'] = "admin/admin_dashboard";
        $data['module_name'] = "admin";
        $this->template->admin($data);
    }
	public function list_user_role($roleid) {
        no_cache();
        $data = array();
        $data['title']='LIST';
        $data['title_tab']='Listing Of User';
       // $data['get_user']= get_list(USERS);
	   $tbl1 = USERS;
        $data['get_user']= $this->manage_admin->user_data_list(array("$tbl1.puser_role_id"=>$roleid,"$tbl1.puser_role_id !="=>7,"$tbl1.puser_role_id != "=>8));
        $data['view_file'] = "manage_admin/view_list_user";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function list_user() {
        no_cache();
        $data = array();
        $data['title']='LIST';
        $data['title_tab']='Listing Of User';
       // $data['get_user']= get_list(USERS);
	   $tbl1 = USERS;
        $data['get_user']= $this->manage_admin->user_data_list(array("$tbl1.puser_role_id !="=>7));
        $data['view_file'] = "manage_admin/view_list_user";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
    public function manage_user($roleid=null,$id = null) {
        no_cache();
		// for update date		
        $submit_update = $this->input->post('submit_update');
		$this->form_validation->set_rules('users[puser_fullname]', 'Fill Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('users[puser_email]', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('users[puser_mobile1]', 'Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('users[puser_password]', 'Password', 'trim|required|xss_clean');		
		if(isset($submit_update) && $submit_update == 'update_data' && $id == $this->input->post('u_id'))
		{
            if ($this->form_validation->run($this) === TRUE)
            {				
                if (isset($_FILES['product_upload']['name']) && !empty($_FILES['product_upload']) && $_FILES['product_upload']['name'] != '') {
					$file_upload = upload_array_files('./uploads/users/' . date('Y'), $_FILES['product_upload']);
					
				}
				$ci_pm_users = $this->input->post('users');
				if(empty($this->input->post('users[puser_password]'))){
					unset($ci_pm_users['puser_password']);
				}else{					
					$ci_pm_users['puser_password']=md5($ci_pm_users['puser_password']);
				}
				$ci_pm_users['puser_dob']=date("Y-m-d", strtotime($ci_pm_users['puser_dob']));				
				$ci_pm_users_profile = $this->input->post('users_profile');				
                $response = updateData(USERS, $ci_pm_users, array('puser_id' => $id));
                if($response){
					$old_img=$this->input->post('users_profile');
					unlink(base_url().$old_img);
					$ci_pm_users_profile['puser_pro_image']=$file_upload;	
					$ci_pm_users_profile['puser_pro_update_date']=date('Y-m-d H:i:s');					
									
					updateData(USERS_PROFILE, $ci_pm_users_profile, array('puser_id' => $id));
                    $this->session->set_flashdata('update', "Update successfully..!!");
                    redirect('admin/user_list');
                }

            }
        }
        // for insert date
        $submit_insert = $this->input->post('submit_insert');
        if(isset($submit_insert) && $submit_insert == 'insert_data'){
            if ($this->form_validation->run($this) === TRUE)
            {
			    if (isset($_FILES['product_upload']['name']) && !empty($_FILES['product_upload']) && $_FILES['product_upload']['name'] != '') {
					$file_upload = upload_array_files('./uploads/users/' . date('Y'), $_FILES['product_upload']);					
				}else{ $file_upload='';}
				
				$ci_pm_users = $this->input->post('users');
				$ci_pm_users['puser_register_date']=date('Y-m-d H:i:s');
				$ci_pm_users['puser_password']=md5($ci_pm_users['puser_password']);								
				$last_insert_user_id = insertData_with_lastid($ci_pm_users,USERS); /*Insert User Table*/
				if($last_insert_user_id){
					$ci_pm_users_profile['puser_id']=$last_insert_user_id;
					$ci_pm_users_profile['puser_pro_image']=$file_upload;						
					$user_profile_id = insertData_with_lastid($ci_pm_users_profile,USERS_PROFILE);/*Insert User Profile Table*/                    
					$this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/user_list');
                }
            }
        }
        $data = array();
        if($id != null){
            $get_user= get_user_detail($id,null);
			$data['get_user']=$get_user;
        }
        $data['title']='Manage User';       
        $data['add_user_role']=$roleid;        
		$user_role_list= get_user_roles(array($roleid));
		 $data['title_tab'] = 'Add/Edit '.$user_role_list[0]['puser_role_name'];        
		 $data['user_role_tab'] = $user_role_list[0]['puser_role_name'];        
        $data['view_file'] = "manage_admin/manage_user";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

 
    public function user_delete_id($empid) {
        if(isset($empid) && $empid != '' && $empid != null) {
            $date_delete = delete_data(USERS, array('id' => $empid, 'user_type !=' => '1'));
            if ($date_delete) {
                $this->session->set_flashdata('error', "Data delete successfully..!!");
                redirect('admin/user_list');
            };
        }
    }
	
	public function show_in_frontend($empid,$is_show_hide){
        if(isset($empid) && $empid != '' && $empid != null) {
            $res_dt = updateData(USERS,array('puser_show_frontend'=>$is_show_hide),array('puser_id' =>$empid));
            if ($res_dt) {
                $this->session->set_flashdata('error', "Record updated successfully..!!");
                redirect('admin/user_list');
            };
        }
    }

    public function user_change_password(){
         no_cache();
        $data = array();
        $data['title']='CHANGE PASSWORD';
        $data['title_tab']='Change Password';
        $data['view_file'] = "manage_admin/user_change_password";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function change_password() {
        no_cache();
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'required');
        if ($this->form_validation->run($this) === TRUE) {
            if($this->input->post('new_password') != $this->input->post('con_password')){
                $this->session->set_flashdata('error', 'Password not match..!!');
                redirect('admin/change_password');
            }
            $oldpssword = md5($this->input->post('old_password'));
            $match = $this->manage_admin->match_oldpwd($oldpssword);
            if ($match > 0) {
                $responce = $this->manage_admin->change_pwd($this->input->post('new_password'));
                if ($responce) {
                    $this->session->set_flashdata('update', 'Your password updated successfully..!!');
                    redirect('admin/change_password');
                }
            } else {

                $this->session->set_flashdata('error', 'Old password not match..!!');
                redirect('admin/change_password');
            }
        }
    }
	
	  public function get_menulabel() {
        $res_array2 =  get_list(PRODUCTS_MENULABEL,'menu_id',null,'DESC');
        echo json_encode($res_array2);
        exit();
    }
	
	  public function manage_category() {
        no_cache();
        $data = array();
        $data['title']='Category';
        $data['title_tab']='Add/Edit Category';
        $data['sub_title_tab']='Category List';
        $data['get_menu']= $this->manage_admin->get_category();
        $data['view_file'] = "manage_admin/manage_category";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
	
	    public function add_menus() {
        $submit_update = $this->input->post('submit_add');
        if(isset($submit_update) && $submit_update == 'add_menu'){
            $this->form_validation->set_rules('menu_name', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_parent_id', 'title', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            {   
                $parent_link_grouping="";
                $menu_category="";
                $menu_name= strtolower($this->input->post('menu_name'));                
                $m_parent_id=$this->input->post('m_parent_id');
                if($m_parent_id==0){
                    $link=  preg_replace('/\s+/','_', $menu_name);
                }else{
                    $parent_menus = get_row("select link,link_of_menu_id,menu_category from pm_news_category where menu_id=$m_parent_id");
                    $parent_link = $parent_menus['link'];    
                    $parent_link_grouping = $parent_menus['link_of_menu_id'];    
                    $menu_category = $parent_menus['menu_category'];    
                    $new_link = preg_replace('/\s+/','_', $menu_name);
                    $link=$parent_link.'/'.$new_link;
                   

                }
                $menu_data = array(
                'menu_name' => $menu_name,
                'parent_id' => $m_parent_id,
                'link' => $link,
                'link_of_menu_id' => '',
                'menu_category' => '',
                'status' => '1',
            );
                $result_id = insertData_with_lastid($menu_data,PRODUCTS_MENULABEL);
                if($result_id){
                    if($parent_link_grouping!=''){
                        $new_groupig_link=$parent_link_grouping.'/'.$result_id;
                    }else{ $new_groupig_link=$result_id; } 
					
					if($menu_category!=''){
                        $new_menu_category=$menu_category.','.$result_id;
                    }else{ $new_menu_category=$result_id; } 
                    $response = updateData(PRODUCTS_MENULABEL,array('link_of_menu_id'=>$new_groupig_link,'menu_category'=>$new_menu_category), array('menu_id' =>$result_id));
                    $this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/news/category');
                }
            }else{
                redirect('admin/news/category');
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
	
	    public function update_menus() {
        $menu_id = $this->input->post('menu_id');
        $update_menu = $this->input->post('update_menu');
        if(isset($menu_id) && $menu_id != '' && $update_menu == 'update_menu') {
			
			$parent_link_grouping="";
			$menu_category="";
			$menu_name= strtolower($this->input->post('menu_name'));                
			$m_parent_id=$this->input->post('m_parent_id');
			if($m_parent_id==0){
				$link=  preg_replace('/\s+/','_', $menu_name);
			}else{
				$parent_menus = get_row("select link,link_of_menu_id,menu_category from pm_news_category where menu_id=$m_parent_id");
				$parent_link = $parent_menus['link'];    
				$parent_link_grouping = $parent_menus['link_of_menu_id'].'/'.$menu_id;    
				$menu_category = $parent_menus['menu_category'].','.$menu_id;    
				$new_link = preg_replace('/\s+/','_', $menu_name);
				$link=$parent_link.'/'.$new_link;
			}
            $menu_data = array(
                'menu_name' => $menu_name,
                'parent_id' => $m_parent_id,
                'link' => $link,
                'link_of_menu_id' => $parent_link_grouping,
                'menu_category' =>$menu_category,
                'status' => '1',
            );
            $response = updateData(PRODUCTS_MENULABEL, $menu_data, array('menu_id' => $menu_id));
            if($response){
                $this->session->set_flashdata('update', "Update successfully..!!");
                redirect('admin/news/category');
            }
        }
    }

	public function menu_delete_id($menu_id) {
        if(isset($menu_id) && $menu_id != '' && $menu_id != null) {
            $date_delete = delete_data(PRODUCTS_MENULABEL, array('menu_id' => $menu_id));
            if ($date_delete) {
                $this->session->set_flashdata('delete', "Data delete successfully..!!");
                redirect('admin/news/category');
            };
        }
    }

    public function show_404() {
        $this->load->view('404');
    }   
}
