<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_news extends MX_Controller {
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


    public function news_list() {
        no_cache();
        $data = array();
        $data['title']='View All News';
        $data['title_tab']='View All News';
        $data['view_file'] = "manage_admin/news_list";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function get_news_list() {
        $res_array2 =  $this->manage_admin->get_news_with_category();
        echo json_encode($res_array2);
        exit();
    }

    public function view_single_news($p_id) {
        no_cache();
        $data = array();
        $get_product =  $this->manage_admin->get_news_with_category($p_id);
        $data['product_detail']= $get_product[0];
        $data['title']= 'News : '.$get_product[0]['title'] ;
        $data['title_tab']='View News';
        $data['view_file'] = "manage_admin/single_news_view";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
    
    public function add_news_view($p_id = null) {
        no_cache();
        $data = array();
        $data['title']='News';
        		
        if($p_id != null){
			$data['title_tab']='Edit News';
            $get_product =  $this->manage_admin->get_news_with_category($p_id);			
            $data['pt_detail']= $get_product[0];
			//pre($data['pt_detail']);
        }else{
			$data['title_tab']='Add News';
		}
        $data['get_menu']= $this->manage_admin->get_category();               		
		//pr($data['get_menu']);
        $data['view_file'] = "manage_admin/manage_news";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }



    //public function add_product_type(){
    public function add_news(){
        if ( !empty( $_FILES ) ) {
            $upload_d = './uploads/news_menu/'.date('Y');
            $file_name =  uploadtypeFile('pt_image',$upload_d);
            $image_path = 'uploads/news_menu/'.date('Y').'/'.$file_name;
            $pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'imagepath'     => $image_path,
                'description'   => $this->input->post('pt_description'),
                'menu_parantId' => $this->input->post('pt_parent_id'),
                'menu_child_id' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'created_date'  => date('Y-m-d')
            );
           $result_id = insertData_with_lastid($pt_data,PRODUCTS);
            if($result_id){
                $pt_child_id = $this->input->post('pt_child_id');               
                $prdct_data = array(
                    'pm_master_id'=>$result_id ,
                    'pm_category_menu_id'     => $pt_child_id,                            
                    'pm_create_date_time'     => date('Y-m-d h:i:s')                            
                 );
                insertData_with_lastid($prdct_data,NEWS_INDEX);
                $json = json_encode( $pt_data );
                echo $json;
            }else{
                echo 'No files.';
            }
        } else {
            echo 'No files';
        }
    }

    //public function update_product_type(){
    public function update_news(){
       $pt_id = $this->input->post('pt_hidden_id') ;
        if ( isset($pt_id) && $pt_id != '') {
			if ( !empty( $_FILES ) ) {
				$upload_d = './uploads/news_menu/'.date('Y');
				$file_name =  uploadtypeFile('pt_image',$upload_d);
				$image_path = 'uploads/news_menu/'.date('Y').'/'.$file_name;
			}else{
				$image_path = '';
			}
			$pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'description'   => $this->input->post('pt_description'),
                'menu_parantId' => $this->input->post('pt_parent_id'),
                'menu_child_id' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'updated_date'  => date('Y-m-d h:i:s')
            );
            if($image_path != ''){
                $pt_data['imagepath'] = $image_path;
            }			
            $response = updateData(PRODUCTS, $pt_data, array('id' => $pt_id));            
            $pt_child_id = $this->input->post('pt_child_id');
            $response = updateData(NEWS_INDEX,array('pm_category_menu_id'=>$pt_child_id,'pm_master_id'=>$pt_id),array('pm_master_id'=>$pt_id));
            if($response){
                $json = json_encode( $pt_data );
                echo $json;
            }else{
                echo 'No files.';
            }
        } else {
            echo 'No files';
        }
    }

    public function delete_news() {
        $id =   $this->input->post('id');
        $img_path = '/'.$this->input->post('img_path');
		$newstr= str_replace("/","\\",$img_path);
		$image_path=realpath(APPPATH . '../');		
		$fullpath = $image_path.$newstr;
		if(isset($id) && $id != '' && $id != null) {
           $date_delete = delete_data(PRODUCTS,array('id' => $id));
            if ($date_delete) {
				delete_data(NEWS_INDEX, array('pm_master_id'=>$id));				
                @unlink($fullpath);
                echo'ok';
            }else{
                null;
            }
        }
    }

    public function country_list() {
        no_cache();
        $data = array();
        $data['title']='Country';
        $data['title_tab']='Add Country';
        $data['get_city']= get_list(COUNTRY,'pcounty_id',null,'DESC');
        $data['view_file'] = "manage_admin/view_list_country";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function state_list() {
        no_cache();
        $data = array();
        $data['title']='State';
        $data['title_tab']='Add State';
        $data['get_state']= $this->manage_admin->get_state_with_country();
        $data['view_file'] = "manage_admin/view_list_state";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function district_list() {
        no_cache();
        $data = array();
        $data['title']='LOCATION';
        $data['title_tab']='Add Location';
        $data['get_district']= $this->manage_admin->get_district_with_state();
        $data['view_file'] = "manage_admin/view_list_district";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
    public function add_country() {
        $submit_update = $this->input->post('submit_add');
        if(isset($submit_update) && $submit_update == 'add_country'){
            $this->form_validation->set_rules('c_name', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_s_nm', 'title', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            { $country_data = array(
                'pcounty_name' => $this->input->post('c_name'),
                'pcounty_sortname' => $this->input->post('c_s_nm'),
            );
                $result_id = insertData_with_lastid($country_data,COUNTRY);
                if($result_id){
                    $this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/manage_country');
                }
            }else{
                redirect('admin/manage_country');
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function country_update_id() {
        $c_id = $this->input->post('c_id');
        $update_country = $this->input->post('update_country');
        if(isset($c_id) && $c_id != '' && $update_country == 'update_country') {
            $ci_country_update = array(
                'pcounty_name' => $this->input->post('c_name'),
                'pcounty_sortname' => $this->input->post('c_s_nm'),
            );
            $response = updateData(COUNTRY, $ci_country_update, array('pcounty_id' => $c_id));
            if($response){
                $this->session->set_flashdata('update', "Update successfully..!!");
                redirect('admin/manage_country');
            }
        }
    }

    public function country_delete_id($c_id) {
        if(isset($c_id) && $c_id != '' && $c_id != null) {
            $date_delete = delete_data(COUNTRY, array('city_id' => $c_id));
            if ($date_delete) {
                $this->session->set_flashdata('delete', "Data delete successfully..!!");
                redirect('admin/manage_country');
            };
        }
    }
}
