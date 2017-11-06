<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_location extends MX_Controller {
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
