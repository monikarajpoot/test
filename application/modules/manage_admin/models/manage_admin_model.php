<?php

class Manage_admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function user_data_list($condition = null)
    {
        $tbl1 = USERS;
        $tbl2 = STATE;
        $tbl3 = DISTRICT;
        $tbl4 = USERS_PROFILE;        
        $tbl6 = USERS_ROLE;
       
        $this->db->select("$tbl1.puser_id as id,$tbl1.puser_fullname as user_name,
		$tbl1.puser_email as user_email,
		$tbl1.puser_mobile1 as user_phone,
		$tbl1.puser_role_id,
		$tbl1.puser_register_date as user_register_date,
		$tbl1.puser_status as user_status,
		$tbl1.puser_add_news as is_news_add,
		$tbl1.puser_edit_news as is_news_edit,
		$tbl1.puser_delete_news as is_news_dlt,		
		");
        $this->db->from($tbl1);
        $this->db->join($tbl4, "$tbl4.puser_id = $tbl1.puser_id", 'inner');
        $this->db->join($tbl6, "$tbl6.puser_role_id = $tbl1.puser_role_id", 'inner');             
        if($condition != null){
            $this->db->where($condition);
        }
        $query = $this->db->get();
     //  echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }

    }	
	public function get_state_with_country($condition = null)
    {
        $tbl1 = STATE;
        $tbl2 = COUNTRY;
        $this->db->select('pstatet_id, pstatest_name, pcountry_id, pcounty_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, "$tbl2.pcounty_id = $tbl1.pstatet_id", 'left');
        if($condition != null){
            $this->db->where("$tbl1.pstatet_id", $condition);
        }
        $this->db->order_by('pstatet_id','DESC');
        $query = $this->db->get();
     //  echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }

    }
	
	public function get_product_menu($condition = null)
    {
   
	$query1 ="SELECT a.menu_id ,a.menu_name,a.menu_price ,a.menu_discription ,a.menu_category ,a.menu_status ,
				GROUP_CONCAT(DISTINCT(c.mng_type_id)) AS cat ,
				city.city_name AS cityname,
				GROUP_CONCAT(DISTINCT(c.mng_area_location)) AS mng_area_location ,
				GROUP_CONCAT(DISTINCT(c.mng_area_id)) AS area , 
				GROUP_CONCAT(DISTINCT(city_area.area_name)) AS cityareaname,
				GROUP_CONCAT(DISTINCT(d.location_name)) AS arealocation , 
				GROUP_CONCAT(DISTINCT(c.id)) AS manage_id, 
				GROUP_CONCAT(DISTINCT(e.ftc_name)) AS catnm 
				FROM ci_product_as_menu AS a 
				LEFT JOIN ci_product_menu AS c ON a.menu_id = c.mng_menu_id 
				LEFT JOIN ci_city AS city ON city.city_id = c.mng_city_id
				LEFT JOIN ci_area AS city_area ON city_area.area_id = c.mng_area_id
				LEFT JOIN ci_location AS d ON d.location_id = c.mng_area_location 
				LEFT JOIN ci_food_time_category AS e ON FIND_IN_SET(e.id, c.mng_type_id)  ";
	
     if($condition != null){
         $query1 .="where a.menu_id = '".$condition."'";
     }
        $query1 .="GROUP BY a.menu_id";
		//echo $query1;
        $query = $this->db->query($query1);
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_district_with_state($condition = null)
    {
        $tbl1 = DISTRICT;
        $tbl2 = STATE;
        $tbl3 = COUNTRY;
        $this->db->select('pdistrict_id, pdistrict_name, pstatet_id, pstatest_name, pcounty_id, pcounty_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, "$tbl2.pstatet_id = $tbl1.pstate_id", 'left');
        $this->db->join($tbl3, "$tbl2.pcountry_id = $tbl3.pcounty_id", 'left');
        if($condition != null){
            $this->db->where("$tbl1.pdistrict_id", $condition);
        }
        $this->db->limit('20');
        $this->db->order_by('pdistrict_id','DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }

    }

	public function get_category($condition = null)
    {
        $tbl1 = PRODUCTS_MENULABEL;
        $this->db->select('a.* , b.menu_name as parent_nm');
        $this->db->from($tbl1." as a");
        $this->db->join($tbl1." as b", "b.menu_id = a.parent_id", 'left');
        $this->db->order_by('parent_id,menu_name','ASC');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }

    }

    public function get_news_with_category($condition = null)
    {
        $tbl1 = NEWS_INDEX;
        $tbl2 = PRODUCTS_MENULABEL;
        $tbl3 = PRODUCTS;
        $this->db->select('news_index.pm_news_id as newsid, news_index.pm_master_id,news_index.pm_category_menu_id as news_cat_id, news_index.pm_create_date_time, 
            news_cat.menu_name as cat_name,news_mastr.id as nws_master_id,news_mastr.title,news_mastr.description,news_mastr.status,news_mastr.imagepath ');
        $this->db->from($tbl1." as news_index");
        $this->db->join($tbl2." as news_cat", "news_cat.menu_id = news_index.pm_category_menu_id", 'left');
        $this->db->join($tbl3." as news_mastr", "news_mastr.id = news_index.pm_master_id", 'left');
        if($condition != null){
            $this->db->where("news_index.pm_master_id", $condition);
        }
        $this->db->order_by('pm_news_id','DESC');
        //echo $this->db->last_query(); die;
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }

    }
	
	public function get_news_list($condition = null)
    {
        $tbl1 = "pm_news";        		
        $this->db->from($tbl1);        
        if($condition != null){
            $this->db->where("news_id", $condition);
        }
        $this->db->order_by('news_id','DESC');        
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	
}