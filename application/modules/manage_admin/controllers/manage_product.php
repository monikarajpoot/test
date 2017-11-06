<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_product extends MX_Controller {
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


    public function products_list() {
        no_cache();
        $data = array();
        $data['title']='View All Products';
        $data['title_tab']='View All Products';
        $data['view_file'] = "manage_admin/products_list";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function get_product_type_list() {
        $res_array2 =  $this->manage_admin->get_product_with_menu();
        echo json_encode($res_array2);
        exit();
    }

    public function view_single_product($p_id) {
        no_cache();
        $data = array();
        $get_product =  $this->manage_admin->get_product_with_menu($p_id);
        $data['product_detail']= $get_product[0];
        $data['title']= 'Products : '.$get_product[0]['title'] ;
        $data['title_tab']='View Products';
        $data['view_file'] = "manage_admin/single_products_view";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
    
    public function add_product_view($p_id = null) {
        no_cache();
        $data = array();
        $data['title']='Products';
        $data['title_tab']='Add Products';
        if($p_id != null){
            $get_product =  $this->manage_admin->get_product_with_menu($p_id);
            $data['pt_detail']= $get_product[0];
        }
        $data['get_menu']= $this->manage_admin->get_menus();               
        $data['view_file'] = "manage_admin/manage_product";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }



    public function add_product_type(){
        if ( !empty( $_FILES ) ) {
            $upload_d = './uploads/product_image/'.date('Y');
            $file_name =  uploadtypeFile('pt_image',$upload_d);
            $image_path = 'uploads/product_image/'.date('Y').'/'.$file_name;
            $pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'imagepath'     => $image_path,
                'description'   => $this->input->post('pt_description'),
                'menu_parantId' => $this->input->post('pt_parent_id'),
                'menu_child_id' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'created_date'  => date('Y-m-d')
            );
           $result_id = insertData_with_lastid($pt_data,PRODUCT_TYPE);
            if($result_id){
                $pt_child_id = $this->input->post('pt_child_id');               
                $prdct_data = array(
                    'pm_product_type_id'=>$result_id ,
                    'pm_menu_id'     => $pt_child_id,                            
                    'pm_create_date_time'     => date('Y-m-d h:i:s')                            
                 );
                insertData_with_lastid($prdct_data,PRODUCTS);
                $json = json_encode( $pt_data );
                echo $json;
            }else{
                echo 'No files.';
            }
        } else {
            echo 'No files';
        }
    }

    public function update_product_type(){

       $pt_id = $this->input->post('pt_hidden_id') ;
        if ( isset($pt_id) && $pt_id != '') {


        if ( !empty( $_FILES ) ) {
            $upload_d = './uploads/product_image/'.date('Y');
            $file_name =  uploadtypeFile('pt_image',$upload_d);
            $image_path = 'uploads/product_image/'.date('Y').'/'.$file_name;
        }else{
            $image_path = '';
        }

        $pt_data = array(
                'title'         => $this->input->post('pt_title') ,
                'description'   => $this->input->post('pt_description'),
                'menu_parantId' => $this->input->post('pt_parent_id'),
                'menu_child_id' => $this->input->post('pt_child_id'),
                'status'        => $this->input->post('pt_status'),
                'created_date'  => date('Y-m-d')
            );
            if($image_path != ''){
                $pt_data['imagepath'] = $image_path;
            }
            $response = updateData(PRODUCT_TYPE, $pt_data, array('id' => $pt_id));            
            $pt_child_id = $this->input->post('pt_child_id');
            $response = updateData(PRODUCTS,array('pm_product_type_id'=>$pt_child_id,'pm_menu_id'=>$pt_id),array('pm_product_type_id'=>$pt_child_id,'pm_menu_id'=>$pt_id));
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

    public function delete_product_type() {
        $id =   $this->input->post('id');
        $img_path = '/'.$this->input->post('img_path');
		$newstr= str_replace("/","\\",$img_path);
		$image_path=realpath(APPPATH . '../');		
		$fullpath = $image_path.$newstr;
		if(isset($id) && $id != '' && $id != null) {
           $date_delete = delete_data(PRODUCT_TYPE, array('id' => $id));
            if ($date_delete) {
				delete_data(PRODUCTS, array('pm_product_type_id' => $id));				
                unlink($fullpath);
             echo   'ok';
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

    public function area_delete_id($area_id) {
        if(isset($area_id) && $area_id != '' && $area_id != null) {
            $date_delete = delete_data(AREA, array('area_id' => $area_id));
            if ($date_delete) {
                $this->session->set_flashdata('delete', "Data delete successfully..!!");
                redirect('admin/manage_areas');
            };
        }
    }


    public function location_delete_id($location_id) {
        if(isset($location_id) && $location_id != '' && $location_id != null) {
            $date_delete = delete_data(LOCATION, array('location_id' => $location_id));
            if ($date_delete) {
                $this->session->set_flashdata('delete', "Data delete successfully..!!");
                redirect('admin/manage_location');
            };
        }
    }

    public function area_update_id() {
        $area_id = $this->input->post('a_id');
        $update_area = $this->input->post('update_area');
        if(isset($area_id) && $area_id != '' && $update_area == 'update_area') {
            $ci_area_update = array(
                'area_name' => $this->input->post('a_name'),
                'area_city_id' => $this->input->post('a_cityid'),
            );
            $response = updateData(AREA, $ci_area_update, array('area_id' => $area_id));
            if($response){
                $this->session->set_flashdata('update', "Update successfully..!!");
                redirect('admin/manage_areas');
            }
        }
    }
    public function area_location_id() {
        $location_id = $this->input->post('l_id');
        $location_area = $this->input->post('update_location');
        if(isset($location_id) && $location_id != '' && $location_area == 'update_location') {
            $ci_location_update = array(
                'location_name' => $this->input->post('l_name'),
                'location_area_id' => $this->input->post('l_area'),
            );
            $response = updateData(LOCATION, $ci_location_update, array('location_id' => $location_id));
            if($response){
                $this->session->set_flashdata('update', "Update successfully..!!");
                redirect('admin/manage_location');
            }
        }
    }

    public function add_area() {
        $submit_update = $this->input->post('submit_add');
        if(isset($submit_update) && $submit_update == 'add_area'){
            $this->form_validation->set_rules('a_name', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('a_cityid', 'title', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            { $area_data = array(
                'area_name' => $this->input->post('a_name'),
                'area_city_id' => $this->input->post('a_cityid'),
            );
                $result_id = insertData_with_lastid($area_data,AREA);
                if($result_id){
                    $this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/manage_areas');
                }
            }else{
                redirect('admin/manage_areas');
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function add_location() {
        $submit_update = $this->input->post('submit_add');
        if(isset($submit_update) && $submit_update == 'add_location'){
            $this->form_validation->set_rules('l_name', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('l_area', 'title', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            { $area_data = array(
                'location_name' => $this->input->post('l_name'),
                'location_area_id' => $this->input->post('l_area'),
            );
                $result_id = insertData_with_lastid($area_data,LOCATION);
                if($result_id){
                    $this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/manage_location');
                }
            }else{
                redirect('admin/manage_location');
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
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
