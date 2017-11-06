<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_page extends MX_Controller {
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

    public function index($page_name = null){
        no_cache();
        $submit_update = $this->input->post('submit_update');
        $pm_menu_id = $this->input->post('pm_menu_id');
        $page_id = $this->input->post('p_id');
        if(isset($submit_update) && isset($page_name) && $submit_update == 'update_page'){
            $this->form_validation->set_rules('p_title', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_content', 'content', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) === TRUE)
            { $about_data = array(
                    'pm_menu_id' =>$pm_menu_id,
                    'pm_page_title' => $this->input->post('p_title'),
                    'pm_page_detail' => $this->input->post('p_content'),
                    'pm_page_created_date' => date('Y-m-d h:i:s'),
                );
                $response = updateData('pm_pages', $about_data, array('pm_page_id' => $page_id));
                if($response){
                    $this->session->set_flashdata('message', "Update successfully..!!");
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
        $data = array();
        $data['title_tab']='Page';
        if($page_name){
            $data['get_page']= get_rows("SELECT page.*,menu.menu_name 
			FROM  pm_pages AS page
			INNER JOIN pm_news_category AS menu ON menu.menu_id=page.pm_menu_id
			WHERE page.pm_menu_id=$page_name");        			
			//pre($data['get_page']);
            $data['menuId']=$page_name;
            $data['title']=$data['get_page'][0]['menu_name'];
        }else{
            redirect('admin/dashboard');
        }
        $data['view_file'] = "manage_admin/manage_pages";
        $data['module_name'] = "manage_admin";
        $this->template->admin($data);
    }
}
