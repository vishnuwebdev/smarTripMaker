<?php

class BlogModel extends CI_Model {

	public function __construct() {

		parent::__construct ();

	}
		function get_blog_list($table){
        $this->db->select("*");
		$this->db->where('b_status', 'active');
		$this->db->where('b_user_type', 'DSA');
		$this->db->where('b_user_id', $this->dsa_data->dsa_id);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
	function get_blog_detail($slug = NULL) {

        $this->db->from("blog_list");
        $this->db->or_where("b_link", $slug);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
	
	//NEW QUERIES28-02-2019
	
	function get_category($id) {
		$this->db->select("holcat_name");		
		$this->db->where("holcat_id", $id);       
        $this->db->where_in("holcat_status", "active");
        $query = $this->db->get("holiday_category");
        if ($query->num_rows() > 0) {
           return $query->row()->holcat_name;
        } else {
            return false;
        }
    }
	
	function get_packages_by_category_id($id) {
        $this->db->from("holiday");
		$this->db->limit(8);
		$this->db->order_by('holiday_id','desc');
		//$this->db->where_in("holiday_is_featured", "yes");
        $this->db->where_in("holiday_category_id", $id);
        $this->db->where_in("holiday_status", "active");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	
	
	
	
	
	
	//OLD QUERIES
	function by_city_name($data)
	{
		$this->db->select('*');
		$this->db->or_where('airport_code !=', $data);
		$this->db->from('airport_list');
		$this->db->like('airport_code', $data);
		$this->db->or_like('airport_city_name',$data, 'both');
		$this->db->limit(50);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result_array();
		}
	}

	public function by_code($data)
	{
		$this->db->select('*');
		$this->db->from('airport_list');
		$this->db->where('airport_code',$data);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result_array();
		}
	}


	public function get_tse_deals($location,$dsa_id) {
		
		$this->db->select("*");
        $this->db->from('voucher_brand');
		//$this->db->join('all_opeartor', 'all_opeartor.code = recharge_details.opcode');
		//$this->db->join('user', 'user.uuid = recharge_details.uuid');
		$this->db->where('voubran_dsa_id',$dsa_id);
		$this->db->like('voubran_local_address', $location);
		$this->db->or_like('voubran_address',$location);
		$this->db->or_like('voubran_city',$location);
		$this->db->or_like('voubran_state',$location);
		$this->db->or_like('voubran_country',$location);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			$row = $query->result();
			return $row;
		}
	
		
	}
	
	
	  function get_brand($dsa_id,$brand_id){
        $this->db->select("*");
        $this->db->where('vouch_dsa_id',$dsa_id);
		$this->db->where('vouch_brand_id',$brand_id);
        $query = $this->db->get('voucher');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
		// function get_category($dsa_id,$category_id) {
		// $this->db->select("*");
        // $this->db->where('voubracat_dsa_id',$dsa_id);
		// $this->db->where('voubracat_id',$category_id);
        // $query = $this->db->get('voucher_brand_category');
        // if($query->num_rows() > 0){
            // return $query->result();
        // }
        // else{
            // return "0";
        // }
	// }
	
	   function get_tse_deals_details($brand_id,$dsa_id){
        $this->db->select("*");
        $this->db->where('voubran_dsa_id',$dsa_id);
		$this->db->where('voubran_id',$brand_id);
        $query = $this->db->get('voucher_brand');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
	function get_mailsetting($userid=NULL){
			
		$this->db->select("*");
		$this->db->from('email_setting');
					$this->db->where('email_user_type',"DSA");
					$this->db->where('email_user_id',$userid);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}

	

	

}

