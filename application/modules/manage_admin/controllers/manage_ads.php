<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_ads extends MX_Controller {
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
        $data['title']='View All Ads';
        $data['title_tab']='View All Ads';
        $data['view_file'] = "manage_admin/ads_list";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }  
	
	public function get_ads_list() {
        $res_array2 =  get_rows("select * from pm_advertisment order by id desc");
        echo json_encode($res_array2);
        exit();
    }
    public function add_ads_view($p_id = null) {
        no_cache();
        $data = array();
        $data['title']='Advertisement';
        		
        if($p_id != null){
			$data['title_tab']='Edit Advertisement';
            $get_product =  get_rows("select * from pm_advertisment where id=$p_id ");			
            $data['pt_detail']= $get_product[0];
			//pre($data['pt_detail']);
        }else{
			$data['title_tab']='Add Advertisement';
		}
        $data['get_position']= array('header'=>'Head Position','footer'=>'Footer Position','right_top'=>'Right Position Top' ,'right_middle'=>'Right Position Middle' ,'right_bottom'=>'Right Position Bottom');               		
		//pr($data['get_position']);
        $data['view_file'] = "manage_admin/manage_ads";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }



    //public function add_product_type(){
    public function add_ads(){
        if ( !empty( $_FILES ) ) {
            $upload_d = './uploads/advertisment/'.date('Y');
            $file_name =  uploadtypeFile('pt_image',$upload_d);
            $image_path = 'uploads/advertisment/'.date('Y').'/'.$file_name;
            $pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'imagepath'     => $image_path,
                'ads_position' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'created_date'  => date('Y-m-d h:i:s'),
                'updated_date'  => date('Y-m-d h:i:s')
            );
           $result_id = insertData_with_lastid($pt_data,'pm_advertisment');
            if($result_id){           
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
    public function update_ads(){
       $pt_id = $this->input->post('pt_hidden_id') ;
        if ( isset($pt_id) && $pt_id != '') {
			if ( !empty( $_FILES ) ) {
				$upload_d = './uploads/advertisment/'.date('Y');
				$file_name =  uploadtypeFile('pt_image',$upload_d);
				$image_path = 'uploads/advertisment/'.date('Y').'/'.$file_name;
			}else{
				$image_path = '';
			}
			$pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'ads_position' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'updated_date'  => date('Y-m-d h:i:s')
            );
            if($image_path != ''){
                $pt_data['imagepath'] = $image_path;
            }			
            $response = updateData('pm_advertisment', $pt_data, array('id' => $pt_id));                                    
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

    public function delete_ads() {
        $id =   $this->input->post('id');
        $img_path = '/'.$this->input->post('img_path');
		$newstr= str_replace("/","\\",$img_path);
		$image_path=realpath(APPPATH . '../');		
		$fullpath = $image_path.$newstr;
		if(isset($id) && $id != '' && $id != null) {
           $date_delete = delete_data('pm_advertisment',array('id' => $id));
            if ($date_delete) {				
                echo'ok';
            }else{
                null;
            }
        }
    }
}
