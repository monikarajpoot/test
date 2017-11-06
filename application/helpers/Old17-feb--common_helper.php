<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @ Function Name      : pr
 * @ Function Params    : $data {mixed}, $kill {boolean}
 * @ Function Purpose   : formatted display of value of varaible
 * @ Function Returns   : foramtted string
 */
function no_cache() {
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

function pr($data, $kill = true) {
    $str = "";
    if ($data != '') {
        $str .= str_repeat("=", 25) . " " . ucfirst(gettype($data)) . " " . str_repeat("=", 25);
        $str .= "<pre>";
        if (is_array($data)) {
            $str .= print_r($data, true);
        }
        if (is_object($data)) {
            $str .= print_r($data, true);
        }
        if (is_string($data)) {
            $str .= print_r($data, true);
        }
        $str .= "</pre>";
    } else {
        $str .= str_repeat("=", 22) . " Empty Data " . str_repeat("=", 22);
    }

    if ($kill) {
        die($str .= str_repeat("=", 55));
    }
    echo $str;
}

function pre($data, $kill = true) {
    $str = "";
    if ($data != '') {
        $str .= str_repeat("=", 25) . " " . ucfirst(gettype($data)) . " " . str_repeat("=", 25);
        $str .= "<pre>";
        if (is_array($data)) {
            $str .= print_r($data, true);
        }
        if (is_object($data)) {
            $str .= print_r($data, true);
        }
        if (is_string($data)) {
            $str .= print_r($data, true);
        }
        $str .= "</pre>";
    } else {
        $str .= str_repeat("=", 22) . " Empty Data " . str_repeat("=", 22);
    }

    if ($kill) {
        echo $str .= str_repeat("=", 55);
    } else {
        echo $str;
    }
}

/**
 *
 * @param type $filename
 * @return type 
 */
if (!function_exists('current_file_name')) {

    function current_file_name($filename = '') {
        return basename(str_replace('\\', '/', $filename), ".php");

        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // $path = preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
        // $array = explode('\\', $path);
        // $len = count($array) - 1;
        // return $array[$len];
    }

}

/**
 *
 * @param type $filename
 * @return type 
 */
if (!function_exists('current_file_dir')) {

    function current_file_dir($filename = '') {
        return basename(dirname(str_replace('\\', '/', $filename))) . '/';

        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // $path = preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
        // $array = explode('\\', $path);
        // $len = count($array) - 2;
        // if ($array[$len] != 'view') {
        // return $array[$len] . '/';
        // }
        // return;
    }

}

if (!function_exists('objectToArray')) {

    function objectToArray($obj) {
        print_r($obj);
        echo is_object($obj);
        if (is_object($obj)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $obj = get_object_vars($obj);
        }
    }

}

function all_month() {
    return $all_month = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
}

function is_date($str) {
    try {
        $dt = new DateTime(trim($str));
    } catch (Exception $e) {
        return false;
    }
    $month = $dt->format('m');
    $day = $dt->format('d');
    $year = $dt->format('Y');
    if (checkdate($month, $day, $year)) {
        return true;
    } else {
        return false;
    }
}

function str_rand($length = 8, $seeds = 'alphanum') {
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';

    // Choose seed
    if (isset($seedings[$seeds])) {
        $seeds = $seedings[$seeds];
    }

    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);

    // Generate
    $str = '';
    $seeds_count = strlen($seeds);

    for ($i = 0; $length > $i; $i++) {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }

    return strtoupper($str);
}

/**
 * Method to authorise exess
 */
function authorize() {
    $ci = & get_instance();
    //pr($ci->session->all_userdata());
	$id = $ci->session->userdata("is_front_user");
    $pro_country = $ci->session->userdata['pro_country'];
    $pro_state = $ci->session->userdata['pro_state'];
    $pro_district = $ci->session->userdata['pro_district'];
    if ($id == "") {
        $ci->session->set_flashdata("inner_message", "<div class='alert alert-info' style='text-align:center;'>Please login first to access internal pages.</div>");
        redirect("/");
    }
	/*else if($pro_country=='' || $pro_state=='' || $pro_district==''){
		 $redurl= base_url().'user_profile';
		 redirect("$redurl");
	}*/
}

function isAdminAuthorize() {
    $ci = & get_instance();
	$id = $ci->session->userdata("admin_logged_in");
    if ($id == "") {
        $ci->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>' . $ci->lang->line('input_warning_label') . '</strong><br><p>' . $ci->lang->line('without_login_message') . '</p></div>');
        redirect("/");
    }
}
function checkUserrole() {
    $CI = & get_instance();
    return $CI->session->userdata('user_role');
}

function checkusremail($str, $role) {
    $ci = & get_instance();
    $result = $ci->db->get_where(USERS,array('puser_email' =>"$str", 'ppuser_status' => '1', 'puser_role_id' => $role));
    return $result->num_rows();
}

function checkusrmoile($str, $role) {
    $ci = & get_instance();
    $result = $ci->db->get_where(USERS,array('puser_mobile1' => $str, 'puser_status' => '1', 'puser_role_id' => $role));
    return $result->num_rows();
}

function check_userlogin_password($loginname, $pwd, $role) {
    $ci = & get_instance();
    $result = $ci->db->get_where(USERS, array('puser_email' => $loginname, 'puser_password' => md5($pwd), 'puser_status' => '1', 'puser_role_id' => $role));
    $rows = $result->row_array();
	return $rows;
}


//update the any data with common function    
function updateData($table_name, $table_data, $condition) {
    $CI = & get_instance();
    $CI->db->where($condition);
    $check = $CI->db->update($table_name, $table_data);
    //echo $CI->db->last_query();
    return $check;
}

function insertData($tableData, $tableName) {
    $CI = & get_instance();
    $row = $CI->db->insert($tableName, $tableData);
    return $row;
}

function insertData_with_lastid($tableData, $tableName) {
    $CI = & get_instance();
    $row = $CI->db->insert($tableName, $tableData);
    return $CI->db->insert_id();
}

/**
 * @ Function Name      : get_list
 * @ Function Params    : $data {mixed}, $kill {boolean}
 * @ Function Purpose   : formatted display of value of varaible
 * @ Function Returns   : foramtted string
 */
function get_list($table_name, $orderby ='', $condition ='', $order_by = 'DESC' ) {
    $CI = & get_instance();
    if (!empty($condition)) {
        $CI->db->where($condition);
    }
    if (!empty($orderby)) {
        $CI->db->order_by($orderby, $order_by);
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->result_array();
    return $data;
}
function get_list_with_in($table_name, $orderby,$column,$dataarray) {
	$CI = & get_instance();
	$CI->db->where_in($column,$dataarray);
    if (!empty($orderby)) {
        $CI->db->order_by($orderby, 'DESC');
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
	///echo $CI->db->last_query();
    $data = $query->result_array();
    return $data;
}
function get_list_orderwise($table_name, $orderby, $condition,$whr_condition=null) {
    $CI = & get_instance();
	if($whr_condition!=''){
		$where_condition=$whr_condition;
	}else{ $where_condition='where';}
    if (!empty($condition)) {
		$CI->db->$where_condition($condition);
    }
    if(!empty($orderby) && is_array($orderby)) {
		$CI->db->order_by($orderby['col'], $orderby['order']);
	}else if(!empty($orderby)) {
        $CI->db->order_by($orderby, 'DESC');
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->result_array();
	//echo $CI->db->last_query();
    return $data;
}

function get_list_with_column($table_name,$column_name,$orderby, $condition) {
    $CI = & get_instance();
	if(!empty($column_name)){
		$CI->db->select($column_name);
	}
    if (!empty($condition)) {
        $CI->db->where($condition);
    }
    if(!empty($orderby)) {
        $CI->db->order_by($orderby, 'DESC');
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->row_array();
    return $data;
}
function get_row($sql){
	$CI = & get_instance();
	return $CI->db->query($sql)->row_array();
}

function get_rows($sql){
	$CI = & get_instance();
	return $CI->db->query($sql)->result_array();
}
function delete_data($table_name, $condition) {
    $CI = &get_instance();
    $CI->db->where($condition);
    $res = $CI->db->delete($table_name);
    return $res;
}
function upload_file($file_name) {
    if($file_name != '') {
        $CI = &get_instance();
        $path = './uploads/users/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['file_name'] = md5(microtime() . rand());
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
        $CI->load->library('upload', $config);
        if (!$CI->upload->do_upload($file_name)) {
            return $error = array('error' => $CI->upload->display_errors());
        } else {
            return $upload_data = $CI->upload->data();
        }
    }
}

function getcity($city_id = null , $state_name = null) {
    $CI = & get_instance();
    $CI->db->select('city_id,city_name,city_state');
    if($city_id != null){
        $CI->db->where('city_id', $city_id);
    }
    $CI->db->where('city_state_id', '1');
    $CI->db->order_by('city_name','ASC');
    $CI->db->from(CITY);
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result;
}

function get_area($city_id = null) {
    $CI = & get_instance();
    $CI->db->select('*');
    if($city_id != null){
        $CI->db->where('area_city_id', $city_id);
    }
    $CI->db->order_by('area_name','ASC');
    $CI->db->from(AREA);
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result;
}
function get_locality($area_id = null) {
    $CI = & get_instance();
    $CI->db->select('*');
    if($area_id != null){
        $CI->db->where('location_area_id', $area_id);
    }
    $CI->db->order_by('location_name','ASC');
    $CI->db->from(LOCATION);
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result;
}
function sent_sms(){
	include APPPATH . 'third_party/way2sms-api.php';
	$client = new WAY2SMSClient();
    $client->login('9893910866', '9893910866');
    $client->send('9893910866', 'This is test sms');
    //Add sleep between requests to make this requests more human like! 
    //A blast of request's may mark the ip as spammer and blocking further requests.
    sleep(1);
    //$client->send('987654321,9876501234', 'msg2');
    //sleep(1);
    $client->logout();
}
function get_order_list($condition = null,$limit = false){
    $CI = & get_instance();
    $tbl1 = ORDER;
    $tbl2 = USERS;
    $tbl3 = CITY;
    $tbl4 = AREA;
    $CI->db->select('id,user_name,user_city_id,user_area_id,user_address,user_phone,user_email,puser_status,user_register_date	,user_category,contact_persone,order_id,order_reg_id,order_category,datatime,order_status, order_serialize_val, order_payment_mode ,order_amount,order_discription,order_user_id,order_type,order_used_coupon,order_used_coupone_amount,order_items,order_applied_percent_amount,order_address , city_name , area_name');
    $CI->db->from($tbl1);
    $CI->db->join($tbl2, "$tbl2.id = $tbl1.order_user_id", 'left');
    $CI->db->join($tbl3, "$tbl3.city_id = $tbl2.user_city_id", 'left');
    $CI->db->join($tbl4, "$tbl4.area_id = $tbl2.user_area_id", 'left');
    if($condition != null){
        $CI->db->where($condition);
    }
    if($limit != false){
        $CI->db->limit('5');
    }
    $CI->db->order_by("datatime", 'desc');
    $query = $CI->db->get();
    //  echo $this->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
        return FALSE;
    }
}

function upload_array_files($path, $files)
{ 
    $CI = & get_instance();
    $config = array(
        'upload_path'   => $path,
        'allowed_types' => '*',
        // 'overwrite'     => 1,
        'max_size'      => '2000',
    );
    if(!is_dir($path)) //create the folder if it's not already exists
    {
        mkdir($path,0755,TRUE);
    }
    $CI->load->library('upload', $config);
    $images = array();
	
    //foreach ($files['name'] as $key => $image) {
        $_FILES['images[]']['name']= $files['name'];
        $_FILES['images[]']['type']= $files['type'];
        $_FILES['images[]']['tmp_name']= $files['tmp_name'];
        $_FILES['images[]']['error']= $files['error'];
        $_FILES['images[]']['size']= $files['size'];

        $fileName = 'M'.md5(microtime().rand());
        /*$images[] = array('name' => $fileName,
            'path'=>$path
        );*/
        $config['file_name'] = $fileName;
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('images[]')) {
            $upload_details = $CI->upload->data();
        } else {
            echo "error";
            return false;
        }
        $path1 = substr($path, 2);
        $data_f = $path1."/".$upload_details['file_name'];
    //}
    // return $images;
    return $data_f;
}

function get_imagepath_byid($menuid = null ,$image_id = null, $incondition = false) {
    $CI = & get_instance();
    if($menuid != null){
        $CI->db->where('image_menu_id', $menuid);
    }else{
    if($incondition == true){
        $CI->db->where_in('image_id', $image_id);
    }else{
        $CI->db->where('image_id', $image_id);
    }}
    $CI->db->order_by('image_id', 'DESC');
    $query = $CI->db->get(PRODUCT_IMAGE);
    $result = $query->result_array();
    return $result;
}

function menu_type(){
    $menu_type = array(
        '1' => 'Meals',
        '2' => 'Combos',
        '3' => 'Salads',
        '4' => 'Accomplishments',
    );
    return $menu_type ;
}

function get_product_list($condition = null,$limit = false){
    $CI = & get_instance();
    $tbl1 = PRODUCT_MENU;
    $CI->db->select('*');
    $CI->db->from($tbl1);
    if($condition != null){
        $CI->db->where($condition);
    }
    if($limit != false){
        $CI->db->limit('5');
    }
    $CI->db->order_by("menu_id", 'desc');
    $query = $CI->db->get();
    //  echo $this->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
        return FALSE;
    }
}

	function get_product_with_filter($task,$condition,$page,$limit)
    {
        //pre($condition);
        //echo $page.'='.$limit;
        $cityid=$condition['cityid'];
        $areaid=$condition['areaid'];
        $locationid=$condition['location'];
		$CI = & get_instance();
		$query1 ="SELECT a.menu_id ,pimg.image_path as imgpath,a.menu_name,a.menu_price ,a.menu_discription ,c.mng_type_id,a.menu_status , 
				GROUP_CONCAT(DISTINCT(c.mng_type_id)) AS cat , 
				city.city_name AS cityname,
				GROUP_CONCAT(DISTINCT(c.mng_area_id)) AS AREA , 
				city_area.area_name AS cityareaname,
				GROUP_CONCAT(DISTINCT(d.location_name)) AS arealocation , 
				GROUP_CONCAT(DISTINCT(c.id)) AS manage_id, 
				GROUP_CONCAT(DISTINCT(e.ftc_name)) AS catnm 
				FROM ci_product_as_menu AS a 
				inner JOIN ci_product_menu AS c ON a.menu_id = c.mng_menu_id and c.mng_city_id=$cityid and c.mng_area_id=$areaid and c.mng_area_location=$locationid  
				LEFT JOIN ci_city AS city ON city.city_id = c.mng_city_id
				LEFT JOIN ci_area AS city_area ON city_area.area_id = c.mng_area_id
				LEFT JOIN ci_location AS d ON d.location_id = c.mng_area_location 
				LEFT JOIN ci_product_image AS pimg ON pimg.image_menu_id = a.menu_id and pimg.image_show_status=1 
				LEFT JOIN ci_food_time_category AS e ON e.id = c.mng_type_id  ";
		//if($condition != null){
		//	$query1 .="where a.menu_id = '".$condition."'";
		//}
        $query1 .="GROUP BY a.menu_id order by a.menu_id desc";
        if($limit && $page ){            
            $query1 .=" limit $page,$limit";
        }else if($limit){
            $query1 .=" limit $limit";
        }
       // echo '<br/>'.$query1.'<br/>';
        $query = $CI->db->query($query1);
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	function get_menu_detail($task,$id){
		if($task=='menuid'){
			$wheres=" WHERE a.menu_id = $id ";
		}
		$sql_qry="SELECT a.menu_id,pimg.image_path as imgpath,a.menu_name,a.menu_price ,a.menu_discription ,a.menu_status , 
				GROUP_CONCAT(DISTINCT(c.mng_type_id)) AS mng_type_id, 
				GROUP_CONCAT(DISTINCT(e.ftc_name)) AS menutype, 
				GROUP_CONCAT(DISTINCT(a.menu_category)) AS cat , 
				menucat.category_title AS catnm, 
				GROUP_CONCAT(DISTINCT(c.mng_area_id)) AS AREA , 
				city.city_name AS cityname,				 
				GROUP_CONCAT(DISTINCT(city_area.area_name)) AS cityareaname ,
				GROUP_CONCAT(DISTINCT(d.location_name)) AS arealocation, 
				GROUP_CONCAT(DISTINCT(c.mng_area_location)) AS arealocation_ids, 
				GROUP_CONCAT(DISTINCT(c.id)) AS manage_id 				
				FROM ci_product_as_menu AS a 
				LEFT JOIN ci_product_menu AS c ON a.menu_id = c.mng_menu_id 
				LEFT JOIN ci_city AS city ON city.city_id = c.mng_city_id
				LEFT JOIN ci_area AS city_area ON city_area.area_id = c.mng_area_id
				LEFT JOIN ci_location AS d ON d.location_id = c.mng_area_location 
				LEFT JOIN ci_food_time_category AS e ON e.id = c.mng_type_id  
				LEFT JOIN ci_food_belongs_category AS menucat ON menucat.category_id= a.menu_category 
				LEFT JOIN ci_product_image AS pimg ON pimg.image_menu_id = a.menu_id and pimg.image_show_status=1 
				$wheres
				GROUP BY a.menu_id";
				
		$menudetail=get_row($sql_qry);
		return $menudetail;
		
	}
	
	function get_menu_list($task,$id){
		if($task=='menuid'){
			$wheres=" WHERE a.menu_id = $id ";
		}else if($task=='wherein'){
			$wheres=" WHERE a.menu_id in($id) ";
		}
		$sql_qry="SELECT a.menu_id,pimg.image_path as imgpath,a.menu_name,a.menu_price ,a.menu_discription ,a.menu_status , 
				GROUP_CONCAT(DISTINCT(c.mng_type_id)) AS foodtype_id , 
				GROUP_CONCAT(DISTINCT(e.ftc_name)) AS foodtype_title ,				
				GROUP_CONCAT(DISTINCT(c.mng_type_id )) AS foodcategory_id,
				GROUP_CONCAT(DISTINCT(menucategory.category_title )) AS foodcategory_title,				
				c.mng_city_id AS city_id,
				city.city_name AS cityname_title,
				GROUP_CONCAT(DISTINCT(c.mng_area_id)) AS food_area_id , 
				city_area.area_name AS cityareaname_title,
				GROUP_CONCAT(DISTINCT(c.mng_area_location)) AS arealocation_id,
				GROUP_CONCAT(DISTINCT(d.location_name)) AS arealocation_title , 
				GROUP_CONCAT(DISTINCT(c.id)) AS manage_id
				FROM ci_product_as_menu AS a 
				LEFT JOIN ci_product_menu AS c ON a.menu_id = c.mng_menu_id 
				LEFT JOIN ci_city AS city ON city.city_id = c.mng_city_id
				LEFT JOIN ci_area AS city_area ON city_area.area_id = c.mng_area_id
				LEFT JOIN ci_location AS d ON d.location_id = c.mng_area_location 
				LEFT JOIN ci_food_time_category AS e ON e.id = c.mng_type_id 				

				LEFT JOIN ci_food_belongs_category AS menucategory ON menucategory.category_id = c.mng_type_id 				

				LEFT JOIN ci_product_image AS pimg ON pimg.image_menu_id = a.menu_id and pimg.image_show_status=1 
				$wheres
				GROUP BY a.menu_id";				


		$menudetail=get_rows($sql_qry);
		return $menudetail;
		
	}
	
	function get_discount($menuid){
		$sql_dis="SELECT cm.cd_id,cm.cd_title,cm.cd_start_date,cm.cd_end_date,
				cm.counpon_code,cm.coupon_type,cm.coupon_apply_type,cm.coupon_apply_number as coupon_discount_amount,cm.coupon_flat_present,
				cap.applied_city,cap.applied_area,cap.applied_location,cap.applied_Category as foodtype,
				cap.applied_menu_id,cap.applied_type as menu_category,cap.coupon_applied_status
				FROM `ci_coupon_discount_master` AS cm 
				INNER JOIN `ci_coupon_applied` AS cap ON cap.coupon_discount_master_id=cm.cd_id  
				WHERE cm.coupon_type='discount' and cm.cd_is_active=1 AND CURDATE() BETWEEN cm.cd_start_date AND cm.cd_end_date";
		$discountdetail=get_rows($sql_dis);
		
		$discountlist=array();
		//pre($discountdetail);
		foreach($discountdetail as $dky=>$discountval){ 
				//pr($discountval);
				if($discountval['applied_city']!='0'){					
					$discountlist[$dky]['applied_city']=$discountval['applied_city'];				
				}				
				if($discountval['applied_area']=='9999'){					
					$all_area_ids= get_row("SELECT GROUP_CONCAT(area_id) as areaids FROM ci_area WHERE area_city_id=".$discountval['applied_city']);
					$discountlist[$dky]['applied_area']=$all_area_ids['areaids'];
				}else if($discountval['applied_area']!='0'){
					$discountlist[$dky]['applied_area']=$discountval['applied_area'];
				}
				if($discountval['applied_location']=='9999'){					
					$all_location_ids= get_row("SELECT GROUP_CONCAT(location_id) as locationids FROM ci_location WHERE location_area_id=".$discountval['applied_area']);
					$discountlist[$dky]['applied_location']=$all_location_ids['locationids'];
				}else if($discountval['applied_location']!='0'){
					$discountlist[$dky]['applied_location']=$discountval['applied_location'];					
				}
				if($discountval['foodtype']=='9999'){					
					$all_menutype_ids= get_row("SELECT GROUP_CONCAT(id) as menutypids FROM ci_food_time_category WHERE ftc_is_active=1");
					$discountlist[$dky]['foodtype']=$all_menutype_ids['menutypids'];
				}else{
					$discountlist[$dky]['foodtype']=$discountval['foodtype'];					
				}
				$discountlist[$dky]['menu_category']=$discountval['menu_category'];	
				
				$discountlist[$dky]['counpon_code']=$discountval['counpon_code'];
				$discountlist[$dky]['coupon_type']=$discountval['coupon_type'];
				$discountlist[$dky]['coupon_apply_type']=$discountval['coupon_apply_type'];
				$discountlist[$dky]['coupon_discount_amount']=$discountval['coupon_discount_amount'];
				$discountlist[$dky]['coupon_flat_present']=$discountval['coupon_flat_present'];				
		}
		//pre($discountlist);
		if(!empty($discountlist)){			
			foreach($discountlist as $dsky => $discounts){
				@$applied_city = $discounts['applied_city'];
				@$applied_area = $discounts['applied_area'];
				@$applied_location = $discounts['applied_location'];
				@$menu_category = $discounts['menu_category'];
				@$foodtype = $discounts['foodtype'];
				if($applied_city!=""){
					$chitywr=" and menuids.mng_city_id=$applied_city and ";
				}else { $chitywr=''; }
				if($applied_area!=""){
					$areawr="  menuids.mng_area_id in ($applied_area) ";
				}else{ $areawr ='';}
				if($applied_location!=""){
					$locationwr=" and menuids.mng_area_location in ($applied_location) and ";
				}else{ $locationwr ='';}
				
				if($menu_category!=""){
					$menu_category=" and masmenu.menu_category=$menu_category";
				}else{ $menu_category ='';}
				
				if($foodtype!=""){
					$foodtype=" and  menuids.mng_type_id in ($foodtype) ";
				}else{ $foodtype ='';}
				$dis_sql="select menuids.mng_menu_id,menuids.mng_type_id,menuids.mng_state_id,menuids.mng_city_id,

								menuids.mng_area_id,menuids.mng_area_location 
								from ci_product_as_menu as masmenu
								inner join ci_product_menu as menuids on masmenu.menu_id=menuids.mng_menu_id $chitywr  $areawr $foodtype  
								where masmenu.menu_id = $menuid $menu_category ";

				//pre($dis_sql);
				$is_discountdetail = get_row($dis_sql);
				//echo "actual discount";
				//pre($is_discountdetail);
				if(empty($is_discountdetail)){
					$discountlist[$dsky]['is_discount']='no';
					unset($discountlist[$dsky]);
				}else{
					$discountlist[$dsky]['is_discount']='yes';
					$discountlist[$dsky][]=$is_discountdetail; 
				}
			}
		}
		//pre($discountlist);
		return $discountlist;
	}
	
	function check_coupon_is_apply_or_not($task,$couponecode)
	{
		$CI = & get_instance();
		$cpn_master = $CI->db->dbprefix(COUPON_DISCOUNT_MASTER);
		$cpn_applied = $CI->db->dbprefix(COUPON_APPLIED);
		$usr_orders=$CI->db->dbprefix(ORDER);
		$coupon_sql="select *
					from $cpn_master AS cm 
					INNER JOIN $cpn_applied AS cap ON cap.coupon_discount_master_id=cm.pm_coupon_id 
					WHERE cm.pm_coupon_code='".$couponecode."' and cm.pm_coupon_status=1 AND CURDATE() BETWEEN cap.ca_created_date AND cap.ca_end_date";	
		$coupon_detail=get_row($coupon_sql);
		if(empty($coupon_detail)){
			$response['status']='false';
			$response['message']='Invalid coupone code.';
		}else{
			$coupon_sql="select order_used_coupon,datatime FROM $usr_orders WHERE order_used_coupon='".$couponecode."'";
			$used_coupon_detail=get_row($coupon_sql);
			if(!empty($used_coupon_detail)){
				$response['status']='false';
				$response['message']='coupone code already used.';
			}else{
				$response['status']='true';
				$response['message']=$coupon_detail;
			}	
		}
		//if(time($active_time)>=strtotime($foodtype['ftc_start_time']) && time($active_time)<strtotime($foodtype['ftc_end_time'])){ $cls="style='background:#e34426;color:#fff'";}else { $cls='';}
		return $response;
	}	
	function get_cart_item_ids($task){
		$CI = & get_instance();
		if(empty($CI->cart->contents())){
			return false;
		}
		foreach($CI->cart->contents() as $crtky=>$crtval){			
				if($task=='itemids'){					
					$itemids[]=$crtval['id'];			
				}
		}
		return $itemids;
	}	
	
	function group_cart_area(){
		$cartids = get_cart_item_ids('itemids');
		$itemids= implode(',',$cartids);
		$itemsidsarray= get_rows("select mng_area_id,mng_menu_id from ci_product_menu where mng_menu_id in ($itemids) group by mng_menu_id");
		//pre($itemsidsarray);
		foreach($itemsidsarray as $pky=>$pval){
			if($pval['mng_area_id']!=''){				
				$arrayids[$pval['mng_area_id']][$pky]=$pval;
			}
		}
		return $arrayids;
	}
	
	function get_cart_row($rowid){
		$CI = & get_instance();
		if(empty($CI->cart->contents())){
			return false;
		}
		foreach($CI->cart->contents() as $crtky=>$crtval){			
				if(md5($rowid)==$crtky){
					$cartkeys[$crtky]=$crtval;
				}
		}
		return $cartkeys;
		
	}	

	function short_cartitems_according_column(){
		$CI = & get_instance();
		$cartitems = $CI->cart->contents();
		$scartitems =  sksort($cartitems);
		return  $cartitems;
	}
	function get_delivery_charge(){
		$CI = & get_instance();
		$cartitems = $CI->cart->contents();
		//pre($cartitems);
		$area_ids_array=array();
		foreach($cartitems as $del_items){
			$area_ids_array[]=$del_items['areaid'];						
		}
		//$area_ids_array = explode(',',$del_items['areaid']);
		//pre($area_ids_array);
		$area_unique_ids_array=array_unique($area_ids_array);		
		//pre($area_unique_ids_array);
		$area_unique_ids = implode(',',$area_unique_ids_array);		
		$get_deliverycharge= get_row("select sum(area_delivery_charge) as delivery_charge from ci_area where area_id in ($area_unique_ids)");
		return $get_deliverycharge['delivery_charge'];
		//return $deliverycharge = (DELIVERY_CHARGE * );

	}
	
	function sksort(&$array, $subkey="areaname", $sort_ascending=true) {
	if (count($array))
		$temp_array[key($array)] = array_shift($array);
	foreach($array as $key => $val){
		$offset = 0;
		$found = false;
		foreach($temp_array as $tmp_key => $tmp_val)
		{
			if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
			{
				$temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
											array($key => $val),
											array_slice($temp_array,$offset)
										  );
				$found = true;
			}
			$offset++;
		}
		if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
	}

	if ($sort_ascending) $array = array_reverse($temp_array);

	else $array = $temp_array;
}
	
	
function get_subscription_byuser($sub_id = null) {
    $CI = & get_instance();
    $CI->db->select('*');
    if($sub_id != null){
        $CI->db->where('user_sub_id', $sub_id);
    }
    $CI->db->order_by('user_sub_id','DESC');
    $CI->db->from(USER_SUBSCRIPTION_PACKAGE);
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result;
}

function get_subscription_master($sub_id = null) {
        $CI = & get_instance();
        $qry ="SELECT `subscription_id`, `subscription_typeid` , subscription_package , subscription_rate , ftc_name , package_name FROM `ci_subscription` left join ci_subscription_package on ci_subscription_package.package_id = ci_subscription.subscription_package left join ci_food_time_category on ci_food_time_category.id = ci_subscription.subscription_typeid";
        $qry .=" WHERE `subscription_id` IN (".$sub_id.")";
        $query = $CI->db->query($qry);
        $res_array1 =  $query->result_array();
        return $res_array1 ;
}

function get_all_subscription_ofuser($user_id = null) {
    $CI = & get_instance();
    $tbl1 = USER_SUBSCRIPTION_PACKAGE;
    $tbl2 = USERS;
    $CI->db->select('ci_user_subscription_package.user_sub_id, ci_user_subscription_package.user_id as sub_user ,ci_user_subscription_package.user_name as sub_name,   ci_user_subscription_package.user_address as sub_address, ci_user_subscription_package.user_mobile as sub_mobile ,ci_user_subscription_package.user_subscription_ids ,ci_user_subscription_package.user_sub_rate as sub_rate,ci_user_subscription_package.user_sub_time as sub_time ,ci_users.user_name,ci_users.user_address,ci_users.user_phone ,ci_users.user_email');
    $CI->db->from($tbl1);
    $CI->db->join($tbl2, "$tbl2.id = $tbl1.user_id", 'left');
    $CI->db->order_by('user_sub_id','DESC');
    $query = $CI->db->get();
   // echo $CI->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
        return FALSE;
    }
}

function area_detail($areaid){
	$area_detail = get_row("select *  from ci_area where 	area_id=$areaid");
	return $area_detail;
}

function total_amount($task,$del_charg,$cart_amount,$cpn_amnt,$disc_amnt){
	if($task=='alltotal'){
		$amount1=($del_charg+$cart_amount);
		if($del_charg!='' && $cart_amount!='' && $cpn_amnt!='' && $cpn_amnt!='0' && $disc_amnt!='' && $disc_amnt!='0'){
			$amnt2=($amount1-$cpn_amnt);
			$amount1=($amnt2-$disc_amnt);
		}else if($del_charg!='' && $cart_amount!='' && $disc_amnt!='' && $disc_amnt!='0'){
			$amount1=($amount1-$cpn_amnt);
		}else if($del_charg!='' && $cart_amount!='' && $cpn_amnt!='' && $cpn_amnt!='0'){
			$amount1=($amount1-$cpn_amnt);
		}
	}
	return $amount1;
}
function get_subscription_detail($subscribid){
	return $subscription_detail = get_row("select * from ci_user_subscription_package where user_sub_id=$subscribid");
	
}
function subscription_packages_details($package_subscription_id){
	$sql="SELECT pack_subs.subscription_id AS subpkg_id, 
		pack_subs.subscription_typeid AS subpkg_food_type_id, 
		foodtype.ftc_name AS subpkg_food_type_name,
		pack_subs.subscription_package AS subpkg_dayid, pkg_days.package_name AS 
		subpkg_days, pack_subs.subscription_rate AS subpkg_amount FROM `ci_subscription` AS pack_subs 
		INNER JOIN ci_subscription_package AS pkg_days ON pkg_days.package_id=pack_subs.subscription_package
		INNER JOIN ci_food_time_category AS foodtype ON foodtype.id IN (pack_subs.subscription_typeid)
		WHERE pack_subs.subscription_id IN($package_subscription_id)";
	return $sub_packages_list = get_rows($sql);
}

/*Work Start 14 -Jan*/
function get_user_roles($roles_in_array){
	return get_list_with_in(USERS_ROLE,'puser_role_name','puser_role_id',$roles_in_array);
}

function show_all_blood_group(){
	return array('O-','O+','A+','A-','B+','B-','AB+','AB-');	
}

function get_retailer_wholseler($roleid,$userid){
    $CI = & get_instance();
    $tbl1 = USERS;
    $tbl2 = STATE;
    $tbl4 = USERS_PROFILE;        
    $tbl6 = USERS_ROLE;
    $tbl3 = DISTRICT;
    $CI->db->select("$tbl1.puser_id as id,$tbl1.puser_fullname as user_name,
        $tbl1.puser_email as user_email,
        $tbl1.puser_mobile1 as user_phone,
        $tbl1.puser_role_id, 
        $tbl4.puser_pro_firm_name as firm_name,
        $tbl4.puser_pro_owner_name as owner_name,   
        $tbl6.puser_role_name as userrole      
        ");
        $CI->db->from($tbl1);
        $CI->db->join($tbl4, "$tbl4.puser_id = $tbl1.puser_id", 'inner');        
         $CI->db->join($tbl6, "$tbl6.puser_role_id = $tbl1.puser_role_id", 'inner');
        $CI->db->join($tbl2, "$tbl2.pstatet_id = $tbl4.puser_pro_state", 'left');
        $CI->db->join($tbl3, "$tbl3.pdistrict_id = $tbl4.puser_pro_district", 'left');
        if($userid != null){
            $CI->db->where(array("$tbl4.puser_id"=>$userid));
        }
        if($roleid != null){
            $CI->db->where_in("$tbl1.puser_role_id",$roleid);
        }
       $CI->db->where(array("$tbl1.puser_status"=>1,"$tbl1.puser_is_trash"=>0));   
        
        $query = $CI->db->get();
     //  echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result_array();
    } else {
            return FALSE;
    }
}

function get_user_detail($userid,$isadmin=null){
	$CI = & get_instance();
		$tbl1 = USERS;
        $tbl2 = STATE;
        $tbl3 = DISTRICT;
        $tbl4 = USERS_PROFILE;        
        $tbl6 = USERS_ROLE;
        $CI->db->select("$tbl1.puser_id as id,$tbl1.puser_fullname as user_name,
		$tbl1.puser_email as user_email,
		$tbl1.puser_mobile1 as user_phone,
		$tbl1.puser_role_id,
		$tbl1.puser_register_date as user_register_date,
		$tbl1.puser_status as user_status,
		$tbl1.puser_dob,
		$tbl1.puser_gender,
		$tbl4.puser_pro_address as user_address,
		$tbl4.puser_profile_description,
		$tbl4.puser_pro_city as city,
		$tbl4.puser_pro_mobile2 as mobil2,
		$tbl4.puser_pro_mobile3 as mobil3,
		$tbl4.puser_pro_image as pro_image,
		$tbl4.puser_pro_firm_name as firm_name,
		$tbl4.puser_pro_owner_name as owner_name,
		$tbl4.puser_post_name,
		$tbl4.puser_pro_is_donate_blood,
		$tbl4.puser_pro_blood_group,
		$tbl4.puser_pro_country,
		$tbl4.puser_pro_state,
		$tbl4.puser_pro_district,
		
		$tbl4.pm_doc_area_of_specialization,
		$tbl4.pm_doc_digree,
		$tbl4.pm_doc_education,
		$tbl4.pm_doc_experience,
		$tbl4.pm_doc_loc_fee,
		$tbl4.pm_doc_registration_number,
		
		$tbl2.pstatest_name as state,
	    $tbl3.pdistrict_name as district,
		$tbl6.puser_role_name as userrole
		");
        $CI->db->from($tbl1);
        $CI->db->join($tbl4, "$tbl4.puser_id = $tbl1.puser_id", 'inner');
        $CI->db->join($tbl6, "$tbl6.puser_role_id = $tbl1.puser_role_id", 'inner');
        $CI->db->join($tbl2, "$tbl2.pstatet_id = $tbl4.puser_pro_state", 'left');
        $CI->db->join($tbl3, "$tbl3.pdistrict_id = $tbl4.puser_pro_district", 'left');
        if($userid != null){
            $CI->db->where(array("$tbl4.puser_id"=>$userid));
        }
        if($isadmin==null){
            $CI->db->where(array("$tbl1.puser_status"=>1,"$tbl1.puser_is_trash"=>0));   
        }

        $query = $CI->db->get();
     //  echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
}
function get_medecine_master($medid,$task){
	$CI = & get_instance();
	$tbl2 = MEDICINE_MASTER;        			
	$tbl3 = MEDICINE_CATEGORY_MASTER;
	$tbl4 = MEDICINE_TYPE_MASTER; 	
	$CI->db->from($tbl2);	
	$CI->db->select("$tbl2.*,$tbl3.pm_medicine_use_type_title as med_category,$tbl4.pm_medicine_type_title as medicine_type");
	$CI->db->join($tbl3, "$tbl2.pm_med_medicineusetype = $tbl3.pm_medicine_use_type_id", 'left');
	$CI->db->join($tbl4, "$tbl2.pm_med_medicinetype = $tbl4.pm_medicine_type_id", 'left');
	if($medid && $task=='get_master_med_detail'){
		$CI->db->where(array("$tbl2.pm_med_id"=>$medid));
	}
	$CI->db->where(array("$tbl2.pm_med_status"=>1));
	$query = $CI->db->get();		
	$result['result'] = $query->result_array();
	$result['total'] = $query->num_rows();
	return $result;
}

function get_medacin_detail($id,$task){
    $CI = & get_instance();
    $tbl1 = MEDICINE_USERS;
    $tbl2 = MEDICINE_MASTER;        
    $tbl3 = MEDICINE_CATEGORY_MASTER;
    $tbl4 = MEDICINE_TYPE_MASTER;        
    $tbl5 = COUNTRY;
    $tbl6 = STATE;
    $tbl7 = DISTRICT;
    $tbl8 = USERS_PROFILE;    

    $CI->db->select("$tbl1.*,$tbl2.*, $tbl3.pm_medicine_use_type_title as med_category,$tbl4.pm_medicine_type_title as medicine_type, $tbl5.pcounty_name as country_name, $tbl6.pstatest_name as state_name, $tbl7.pdistrict_name as district_name,$tbl8.puser_pro_firm_name as firm_name,$tbl8.puser_pro_owner_name as owner_name");
    $CI->db->from($tbl1);
    $CI->db->join($tbl2, "$tbl2.pm_med_id = $tbl1.pm_med_id", 'left');
    $CI->db->join($tbl3, "$tbl2.pm_med_medicineusetype = $tbl3.pm_medicine_use_type_id", 'left');
    $CI->db->join($tbl4, "$tbl2.pm_med_medicinetype = $tbl4.pm_medicine_type_id", 'left');
    $CI->db->join($tbl5, "$tbl1.pm_med_usr_country = $tbl5.pcounty_id", 'left');
    $CI->db->join($tbl6, "$tbl1.pm_med_usr_state = $tbl6.pstatet_id", 'left');
    $CI->db->join($tbl7, "$tbl1.pm_med_usr_district = $tbl7.pdistrict_id", 'left');
    $CI->db->join($tbl8, "$tbl8.puser_id = $tbl1.puser_⁯id", 'left');
    if($id!='' && $task=='get_detail'){
        $CI->db->where(array("$tbl1.pm_med_usr_id"=>$id));
    }
    $CI->db->order_by("$tbl1.pm_med_usr_id",'DESC');
    $query = $CI->db->get();
    // echo $this->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
        return FALSE;
    }   
}
function is_filled_state_country_or_not($param1){
	$CI = & get_instance();
	$sql_str="SELECT usr.puser_id, puser_pro_country,puser_pro_state,puser_pro_district,puser_pro_city FROM `pm_users` AS usr
				INNER JOIN `pm_users_profile` AS usrpro ON usr.puser_id=usrpro.puser_id
				WHERE (usr.puser_mobile1 =  '".$param1."' OR  usr.puser_email='".$param1."') AND usr.puser_status=1";
	return $result= get_row($sql_str);
}

function get_unique_brand($param){
	$CI = & get_instance();
    if($param=='brandname'){        
        $slct = "distinct(pm_med_brandname)";
    }else if($param=='manufacturer'){
         $slct = "distinct(pm_med_manufacturename)";
     }else if($param=='genericname'){
        $slct = "distinct(pm_med_genericname)";
     }
	$sql_str="SELECT $slct FROM pm_medicines_master";
	$result= get_rows($sql_str);
	$respons=array();
	foreach($result as $val){
		if($param=='brandname'){
			$brandname = str_replace(' ', '_',$val['pm_med_brandname']);
			$respons[$brandname]=$val['pm_med_brandname'];			
		}else if($param=='manufacturer'){
			$menufac = str_replace(' ', '_',$val['pm_med_manufacturename']);
			$respons[$menufac]=$val['pm_med_manufacturename'];			
		}else if($param=='genericname'){
			$gen_name = str_replace(' ', '_',$val['pm_med_genericname']);
			$respons[$gen_name]=$val['pm_med_genericname'];			
		}
	}	
	return $respons; 
}

function get_brand_use_type_cate_master($param){
    $CI = & get_instance();
    $cat_master=  'pm_'.MEDICINE_CATEGORY_MASTER;
    $sql_str="SELECT * FROM $cat_master";
    $result= get_rows($sql_str);       
    return $result; 
}
function get_brand_type_master($param){
    $CI = & get_instance();
    $med_type_master=  'pm_'.MEDICINE_TYPE_MASTER;
    $sql_str="SELECT * FROM $med_type_master";
    $result= get_rows($sql_str);       
    return $result; 
}
function send_message_bysms($mobile,$msg){
	$message = urlencode($msg);
	echo $url ="http://smsindia.kolar18.com/submitsms.jsp?user=shubhamb&key=b7359f9decXX&mobile=$mobile&message=$message&senderid=HEALTH&accusage=1";
	//http://smsindia.kolar18.com/submitsms.jsp?user=shubhamb&key=b7359f9decXX&mobile=9691936767&message=test%20sms&senderid=HEALTH&accusage=1
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
	$data = curl_exec($ch); // execute curl request
	curl_close($ch);
	$return_array  = explode(',',$data);
	return $return_array[2];
	
}
function total_available_sms($logged_usrId){
	$manage_sms_tbl='pm_'.USERS_MANAGE_SMS;
	return $manage_sms_details =get_row("select pm_sms_total_alloted, pm_sms_total_sent from $manage_sms_tbl where pm_sms_status=1 and pm_user_id=$logged_usrId");
	
}

function get_deseas_lists($param){
    $CI = & get_instance();
    $diseasename_master=  'pm_'.DISEASE_NAME_MASTER;
    $sql_str="SELECT pdm_id,pdm_name FROM $diseasename_master where pdm_status=1";
    $result= get_rows($sql_str);       
    return $result; 
}

function get_patient_other_detail($patient_id,$param){
    $CI = & get_instance();
    $patient_other_detail=  'pm_'.USER_PATIENTS;
    $sql_str="select * from $patient_other_detail where puser_id=$patient_id ";
	$result= get_rows($sql_str);       
    return $result; 
}

