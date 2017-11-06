<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_auth extends MX_Controller {
     function __construct() {
        parent::__construct();
        //$this->load->controller('template/template','admin_template');
     	$this->load->module('template');
     	$this->load->model('admin_login_model','model_admin_login');

    }
    public function isLoggedIn()
    {
        if ($this->session->userdata('admin_logged_in') === TRUE)
        {
            redirect("admin/dashboard");
        }
    }

    public function index()
    {
		$this->load->helper(array('form', 'url'));
        $this->isLoggedIn();
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_login_pwd');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $data = array();
        $data['title']='Admin Login- '.SITE_NAME;                
        if ($this->form_validation->run($this) === TRUE)
        {
            $login = $this->model_admin_login->logged_in();          			
			if (count($login) > 0)
            {
                $newdata = array(
                    'admin_id'      => $login['puser_id'],
                    'admin_name'    => $login['puser_fullname'],
                    'admin_email'   => $login['puser_email'],
                    'admin_image'   => $login['user_image'],                    
                    'is_add_news'   => $login['puser_add_news'],                    
                    'is_edit_news'   => $login['puser_edit_news'],                    
                    'is_delete_news'   => $login['puser_delete_news'],                    
                    'admin_puser_mobile1'   => $login['puser_mobile1'],                    
                    'user_role'   => $login['puser_role_id'],                    
                    'admin_logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                redirect("admin/dashboard");
            }
        }
		//else{
			//	  $this->form_validation->set_message('message','Invalid user login id and password.');
				//  redirect("admin");
		//}       
        $this->load->view('admin_login');        
    }
    public function check_login_pwd($lgn_name) {
        $pwd =$this->input->post('password');				
        $data['users']=check_userlogin_password($lgn_name,$pwd,'');        
		if(isset($data['users']) && empty($data['users'])){
            $this->form_validation->set_message('check_login_pwd','Invalid admin login Id and Password');
            return FALSE;
        }
        else if(isset($data['users']) && $lgn_name != @$data['users']['puser_email'] && $pwd != @$data['users']['puser_password']) {
            $this->form_validation->set_message('check_login_pwd','Invalid admin login Id and Password');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function forgote_password(){
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $data = array();
        $data['title']='Admin Login- '.SITE_NAME;
        if ($this->form_validation->run($this) === TRUE)
        {
            $useremail = $this->input->post('email');
            //die($this->form_validation->run());

            $userdetail = checkusremail($useremail,'1'); /*1=>Admin*/

            $username = $userdetail['user_name'];
            $userId = $userdetail['id'];
            $newuserpassword = str_rand();
            $res= updateData(USERS,array('user_password'=>md5($newuserpassword)),array('id'=>$userId,'user_status'=>'1'));/*$table_name, $table_data, $condition*/
            if($res){
                    $title = SITE_NAME;
                    $subject = 'Forgot Password Notification at ' . SITE_NAME;
                    $pass_text = $newuserpassword;
                    $messae_txt=SITE_NAME." received a request to forgot password for your account.";
                
                    $inr_message='<tr>
                        <td height="26" style="font-family:Tahoma, Arial, sans-serif; font-size:12px;color:#575757;">
                        <strong>Hi ' . ucfirst($username) . ',</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Tahoma, Arial, sans-serif; font-size:11px; color:#575757; line-height:15px; padding-bottom:10px;font-size:12px;">'.$messae_txt.'</td>
                    </tr>
                    <tr>
                        <td height="5" style="font-family:Tahoma, Arial, sans-serif; font-size:11px; color:#575757; line-height:15px; padding-bottom:10px;font-size:12px;">New Password details are shown below:</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="287" border="0" bgcolor="#D23D3D" cellspacing="1" cellpadding="6" style="border:solid 3px #D23D3D;">
                                <tr>
                                    <td colspan="2">
                                        <strong style="color:#FFF;font-family:segoe UI, Arial, sans-serif; font-size:14px;">Login Detail:</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" width="100" style="font-family:segoe UI, Arial, sans-serif; font-size:12px;" >
                                        <strong>Email Id</strong>
                                    </td>
                                    <td width="270" bgcolor="#ffffff" style="font-family:segoe UI, Arial, sans-serif; font-size:12px;">'.$useremail.'</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" width="100" style="font-family:segoe UI, Arial, sans-serif; font-size:12px;" >
                                        <strong>Password</strong>
                                    </td>
                                    <td width="270" bgcolor="#ffffff" style="font-family:segoe UI, Arial, sans-serif; font-size:12px;">'.$pass_text.'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tr>
                    <td height="25"></td>
                </tr>';
                $emaildata=array('user_password'=>$newuserpassword,'user_primary_email'=>$useremail,'user_name'=>$username,'content_message'=>$inr_message);
                $is_sent = sendForgotPassword($emaildata);
                if($is_sent){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-check"></i> Alert!</h4>New password has been sent on email.</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4>There is something wrong. please try again.</div>');
                }
                redirect('admin');
            }
            
        }else{
            //redirect("admin");
            $this->load->view('admin_login');
            // $data['view_file'] = "admin_login";
            // $data['module_name'] = "admin";
            // $this->template->index($data);
        }
    }

    function useremail_check($str) {
        $data_array=array();
        $data_array=checkusremail($str,$role=1);
        //pre($data_array);
        if(isset($data_array) && empty($data_array)){
            $this->form_validation->set_message('useremail_check', $this->lang->line('email_does_notexist_error_1'));
            return FALSE;
        }
        else if ($str!=@$data_array['emp_email']) {
            $this->form_validation->set_message('useremail_check', $this->lang->line('email_does_notexist_error_1'));
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function show_404() {
         $this->load->view('404');
 	}

    public function logout() {
        $this->session->sess_destroy();
        redirect("admin");
    }
}