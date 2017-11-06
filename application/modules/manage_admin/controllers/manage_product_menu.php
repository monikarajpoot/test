<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_product_menu extends MX_Controller {
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
        $data['title']='LIST';
        $data['title_tab']='Listing Of Menu';
        //   $data['get_menu']= get_list(PRODUCT_MENU);
        $data['get_menu']= $this->manage_admin->get_product_menu();
        $data['view_file'] = "manage_admin/view_list_menu";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function permission_of_product() {
        no_cache();
        $data = array();
        $data['title']='LIST';
        $data['title_tab']='Listing Of Menu';
        $data['get_manage_menu']= get_list(MANAGE_PRODUCT_MENU);
        $data['view_file'] = "manage_admin/permission_of_product";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function manage_menu_data($id = null) {
        no_cache();
        error_reporting(0);
        // for update date
        $submit_update = $this->input->post('submit_update');
        if(isset($submit_update) && $submit_update == 'update_data' && $id == $this->input->post('m_id')){
            $this->form_validation->set_rules('m_cate', 'Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_name', 'm_name', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            {
                $m_city =  $this->input->post('m_city');
                $m_area =  $this->input->post('m_area');
                $m_types =  $this->input->post('m_types');
                $m_location =  explode(',',$this->input->post('m_location_hidden'));
                $m_types_str =  implode(',',$this->input->post('m_types'));
                $ci_mp_data_up = array(
                    'menu_name' => $this->input->post('m_name'),
                    'menu_discription' => $this->input->post('m_discription'),
                    'menu_category' => $this->input->post('m_cate'),
                    'menu_status' => $this->input->post('m_status'),
                    'menu_price' => $this->input->post('m_price'),
                );
                $response = updateData(PRODUCT_MENU, $ci_mp_data_up, array('menu_id' => $id));
                if($response){

                    if(isset($m_location) && !empty($m_location)){
                        foreach($m_location as $key => $location) {
                            $form_cat_data = array(
                                'mng_state_id' =>'0',
                                'mng_city_id' => $m_city,
                                'mng_area_id' => $m_area,
                                'mng_area_location' => $location,
                                'mng_type_id' => $m_types_str,
                            );

                            $check_menu_t = get_list(MANAGE_PRODUCT_MENU,'mng_menu_id',array('mng_menu_id' => $id),'ASC');
                            if(isset($check_menu_t[0]['mng_menu_id']) && $check_menu_t[0]['mng_menu_id'] != '' ){
                                $response = updateData(MANAGE_PRODUCT_MENU, $form_cat_data, array('mng_menu_id' => $id));
                            }else{
                                $array_form_cat_data =   array('mng_menu_id' => $id) ;
                                $res_img = insertData_with_lastid(array_merge($form_cat_data,$array_form_cat_data), MANAGE_PRODUCT_MENU);
                            }

                        }
                    }

                    if (isset($_FILES['product_upload']['name']) && !empty($_FILES['product_upload']) && $_FILES['product_upload']['name']['0'] != '') {
                        $file_upload = upload_array_files('./uploads/product_menu/' . date('Y'), $_FILES['product_upload']);
                        foreach($file_upload as $key => $upload_f) {
                            $form_image_data = array(
                                'image_title' => 'Menu image',
                                'image_path' => $upload_f,
                                'image_menu_id' => $id,
                            );
                            $res_img = insertData_with_lastid($form_image_data, PRODUCT_IMAGE);
                        }
                    }

                    $this->session->set_flashdata('update', "Update successfully..!!");
                    redirect('admin/menu');
                }
            }
        }
        // for insert date
        $submit_insert = $this->input->post('submit_insert');
        if(isset($submit_insert) && $submit_insert == 'insert_data'){
            $this->form_validation->set_rules('m_cate', 'Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_name', 'm_name', 'trim|required|xss_clean');

            if ($this->form_validation->run($this) === TRUE)
            {
                $m_city =  $this->input->post('m_city');
                $m_area =  $this->input->post('m_area');
                $m_types =  $this->input->post('m_types');
                $m_location =  explode(',',$this->input->post('m_location_hidden'));
                $m_types_str =  implode(',',$this->input->post('m_types'));

                $query =   $this->db->query("SELECT location_area_id , GROUP_CONCAT(location_id) as location_id FROM `ci_location` WHERE `location_id` IN (".$this->input->post('m_location_hidden').") group by location_area_id");
                $locations =  $query->result_array();

                $ci_mp_data = array(
                    'menu_name' => $this->input->post('m_name'),
                    'menu_discription' => $this->input->post('m_discription'),
                    'menu_category' => $this->input->post('m_cate'),
                    'menu_status' => $this->input->post('m_status'),
                    'menu_price' => $this->input->post('m_price'),
                    'menu_create_time' => date('Y-m-d H:i:s'),
                );
                $result_id = insertData_with_lastid($ci_mp_data,PRODUCT_MENU);
                if($result_id){

                    if(isset($locations) && !empty($locations)){
                        foreach($locations as $key => $location) {
                            $form_cat_data = array(
                                'mng_state_id' =>'0',
                                'mng_city_id' => $m_city,
                                'mng_area_id' => $location['location_area_id'],
                                'mng_area_location' => $location['location_id'],
                                'mng_menu_id' => $result_id,
                                'mng_type_id' => $m_types_str,
                            );
                            $res_img = insertData_with_lastid($form_cat_data, MANAGE_PRODUCT_MENU);
                        }
                    }

                    if (isset($_FILES['product_upload']['name']) && !empty($_FILES['product_upload']) && $_FILES['product_upload']['name']['0'] != '') {
                        $file_upload = upload_array_files('./uploads/product_menu/' . date('Y'), $_FILES['product_upload']);

                        foreach($file_upload as $key => $upload_f) {

                            $form_image_data = array(
                                'image_title' => 'Menu image',
                                'image_path' => $upload_f,
                                'image_menu_id' => $result_id,
                            );

                            $res_img = insertData_with_lastid($form_image_data, PRODUCT_IMAGE);
                        }
                    }
                    $this->session->set_flashdata('insert', "Add successfully..!!");
                    redirect('admin/menu');
                }

            }
        }
        $data = array();
        if($id != null){
            //    $data['get_product']= get_list(PRODUCT_MENU,null,array('menu_id'=>$id));
            $data['get_product']= $this->manage_admin->get_product_menu($id);
        }
        $data['title']='FORM';
        $data['title_tab']='Add Menu';
        $data['view_file'] = "manage_admin/manage_product_menu";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function menu_delete_id($menu_id) {
        if(isset($menu_id) && $menu_id != '' && $menu_id != null) {
            $date_delete = delete_data(PRODUCT_MENU, array('menu_id' => $menu_id));
            delete_data(PRODUCT_IMAGE, array('image_menu_id' => $menu_id));
            delete_data(MANAGE_PRODUCT_MENU, array('mng_menu_id' => $menu_id));
            if ($date_delete) {
                $this->session->set_flashdata('error', "Data delete successfully..!!");
                redirect('admin/menu');
            };
        }
    }

    public function image_delete_id($image_id) {
        if(isset($image_id) && $image_id != '' && $image_id != null) {
            $date_delete_image = delete_data(PRODUCT_IMAGE, array('image_id' => $image_id));
            if ($date_delete_image) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function procuct_cat_delete($cat_id) {
        if(isset($cat_id) && $cat_id != '' && $cat_id != null) {
            $menuid = $_GET['p_id'];
            $date_delete_image = delete_data(MANAGE_PRODUCT_MENU, array('mng_type_id' => $cat_id ,'mng_menu_id' => $menuid));
            if ($date_delete_image) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function product_area_delete($area_id) {
        if(isset($area_id) && $area_id != '' && $area_id != null) {
            $menuid = $_GET['p_id'];
            $date_delete_image = delete_data(MANAGE_PRODUCT_MENU, array('mng_area_id' => $area_id ,'mng_menu_id' => $menuid));
            if ($date_delete_image) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }


    public function food_type() {
        no_cache();
        $data = array();
        $data['title']='FooD Type';
        $data['title_tab']='TIME';
        $data['food_type']= get_list(FOOD_TIME_CATEGORY,'id',null,'ASC');
        $data['view_file'] = "manage_admin/view_list_food_type";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }

    public function food_type_update_id() {
        $food_type_id = $this->input->post('fc_id');
        $update_food_type = $this->input->post('update_food_type');
        if(isset($food_type_id) && $food_type_id != '' && $update_food_type == 'update_food_type') {
            $ci_foodtype_update = array(
                'ftc_name' => $this->input->post('fc_name'),
                'ftc_start_time' => $this->input->post('fc_starttime'),
                'ftc_end_time' => $this->input->post('fc_endtime'),
                'ftc_is_active' => $this->input->post('fc_status'),
            );
            $response = updateData(FOOD_TIME_CATEGORY, $ci_foodtype_update, array('id' => $food_type_id));
            if($response){
                $this->session->set_flashdata('update', "Update successfully..!!");
                redirect('admin/manage_food_type');
            }
        }
    }

    public function show_404() {
        $this->load->view('404');
    }

}
