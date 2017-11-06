<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home extends MX_Controller {
    function __construct() {
        parent::__construct();   
		$this->load->module('template'); 
		$this->load->model('users_model');
		$this->load->library('Ajax_pagination');
        $this->perPage = 3;   
 
    }
    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    public function index() {	

			$data['title'] = 'Welcome to MP WEB News';                        
			$data['module_name'] = "site";
			$data['news_list']=array();
			$data['exam_cate']=get_rows("select * from 	pm_exam_category where parent_id='0' order by show_home_in_sequence desc limit 10");
			$data['exam_users']=get_rows("select count(puser_id) as user  from pm_users where 	puser_status='1' ");
			//$data['exam_users1']=get_rows("select * from pm_exam where 	puser_status='1' ");
			
			$data['view_file'] = "site/home";			
			$this->template->index($data);
    }
	public function about_us() {
        $data['title'] = 'About Us'; 
        //$this->load->view('about_us', $data);
		$data['module_name'] = "site";
		$data['view_file'] = "site/about_us";			
		$this->template->index($data);
    }
	
	public function inner_page($pageId) {
		$get_details= get_row("SELECT page.*,menu.menu_name 
		FROM  pm_pages AS page
		INNER JOIN pm_news_category AS menu ON menu.menu_id=page.pm_menu_id
		WHERE page.pm_menu_id=$pageId");		       
		$data['title'] = $get_details['menu_name'];       		
		$data['page_desc'] = $get_details;       
		$data['module_name'] = "site";
		$data['view_file'] = "site/inner_page";			
		$this->template->index($data);
    }
	
	public function pravacy_policy() {
        $data['title'] = 'FAQ';        
		$data['module_name'] = "site";
		$data['view_file'] = "site/privacy_policy";			
		$this->template->index($data);
    }	
	
	public function category($category){
		$get_details= get_row("select menu_name from pm_news_category where status='1' and menu_id=$category");		
		$data['title'] = 'समाचार - '.$get_details['menu_name'];		
		$data['category_id'] =$category;
		$data['module_name'] = "site";
		$data['view_file'] = "site/news_list";			
		$this->template->index($data);
	}
	
	public function category_news_list($catId,$limit,$offset,$columnName=null,$columnvalue=null,$task=null,$order=null,$orderBy=null){
		$response_total = $this->users_model->get_category_news_list($catId,$columnName,$columnvalue,null,null,$task,$order,$orderBy);
    	$response = $this->users_model->get_category_news_list($catId,$columnName,$columnvalue,$limit,$offset,$task,$order,$orderBy);			
        $data['total'] = $response_total['total'];        		
        $data['result'] = $response['result'];
		//pre($data);
        echo json_encode($data);
        exit;	
	}
	public function news_detail($newsId){
		$get_details= get_row("SELECT news.*,cat.menu_id,cat.menu_name,usr.puser_fullname  
			FROM pm_news_master AS news 
			LEFT JOIN pm_news_category AS cat ON news.menu_child_id=cat.menu_id
			inner join pm_users as usr on usr.puser_id=news.is_login_user
			WHERE news.status='1' and news.id=$newsId");		
		$data['title'] = 'समाचार - '.$get_details['menu_name'];				
		$data['news_detail'] =$get_details;
		$data['cat_random'] = get_rows("SELECT `menu_id`,`menu_name` FROM `pm_news_category`  WHERE is_catogoy_or_menu=1 AND STATUS='1' ORDER BY RAND() LIMIT 4");		
		$data['module_name'] = "site";
		$data['view_file'] = "site/news_detail";			
		$this->template->index($data);
	}
    /**
     * encript the datakey 
     * @return mixed
     */
    function __encrip_password($datakey) {
        return md5($datakey);
    }  
}