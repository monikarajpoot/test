<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Template extends MX_Controller {
	function __construct(){
		//$this->load->module('template');
	}
	public function index($data){			
			$this->load->view('template/user_template',$data);		
	}
	public function admin($data){			
		$this->load->view('template/admin_template',$data);
	}	
}
