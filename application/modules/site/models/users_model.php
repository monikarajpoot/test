<?php
class Users_model extends CI_Model {
    /**
     * Get user data in the database 
     * @return array - column
     */
    public function get_user_data($id = '', $column_name = '*') {
        $tbl_emp = EMPLOYEES;
        $tbl_emp_detail = EMPLOYEE_DETAILS;
        $tbl_emp_role = EMPLOYEEE_ROLE;
        $this->db->select($column_name);
        $this->db->from($tbl_emp);
        $this->db->join($tbl_emp_detail, "$tbl_emp.emp_id = $tbl_emp_detail.emp_id");
        $this->db->join($tbl_emp_role, "$tbl_emp.role_id = $tbl_emp_role.role_id");
        $emp_id = $id == '' ? $this->session->userdata('emp_id') : $id;
        $this->db->where("$tbl_emp.emp_id", $emp_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            //print_r($query->result());die;
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * update password
     * @return boolean - true iff success
     */
    public function update_password($id, $new_pass) {
        $this->db->where('emp_id', $id);
        $data = array(
            'emp_password' => $new_pass,
        );
        $this->db->where('emp_id', $id);
        $this->db->update(EMPLOYEES, $data);
        return true;
    }
    
   
   
	function chk_phone_exist($phone) {
		$this->db->where('puser_mobile1',$phone);				
		$query = $this->db->get(USERS);
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}
	function chk_email_exist($email) {
		$this->db->where('puser_email',$email);				
		$query = $this->db->get(USERS);
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}
	public function get_category_news_list($catId,$columnName,$columnvalue,$limit,$offset,$task,$order,$orderBy){
        $tbl1 ='pm_news_master';        
        $usr_tbl = 'pm_users';        
		$tbl4 = 'pm_news_category';
        $selcted_column="$tbl1.*,$tbl4.menu_id,$tbl4.menu_name,$usr_tbl.puser_fullname";
        $this->db->select($selcted_column);
        $this->db->from($tbl1);    
		$this->db->join($tbl4, "$tbl4.menu_id = $tbl1.menu_child_id", 'inner');
		$this->db->join($usr_tbl, "$usr_tbl.puser_id = $tbl1.is_login_user", 'inner');
		$this->db->where("$tbl1.status",'1');   
		$this->db->where("$tbl1.menu_child_id",$catId);   
		
        if(!empty($order) && $order!='null' && $orderBy!='null'){
            $order = urldecode($order);
            $orderBy = urldecode($orderBy);            
            if( $orderBy == 'true'){
                $orderBy = 'DESC';
            }else{
                $orderBy = 'ASC';
            }           
            $this->db->order_by($order,$orderBy);
        }else{
            $this->db->order_by("$tbl1.created_date",'DESC');
        }        
        if($limit!='' && $offset!=''){            
            $this->db->limit($limit,$offset);
        }
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $result['result'] = $query->result_array();
            $result['total'] = $query->num_rows();
            return $result;
        } else {
            return FALSE;
        }           
    }

}
