<?php

class Holidaymodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
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

    function get_keyword($refid = NULL){
        $this->db->from("holiday");
        
        $this->db->where_in("holiday_status", "active");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }



    }
	
	function get_sub_category($id) {
		$this->db->select("holsubc_name");		
		$this->db->where("holsubc_id", $id);       
        $this->db->where_in("holsubc_status", "active");
        $query = $this->db->get("holiday_sub_category");
        if ($query->num_rows() > 0) {
           return $query->row()->holsubc_name;
        } else {
            return false;
        }
    }
	

	
	// function get_packages_by_category_id($id) {
 //        $this->db->from("holiday");
	// 	$this->db->limit(8);
	// 	$this->db->order_by('holiday_id','desc');
	// 	//$this->db->where_in("holiday_is_featured", "yes");
 //        $this->db->where_in("holiday_category_id", $id);
 //        $this->db->where_in("holiday_status", "active");
 //        $query = $this->db->get();
 //        if ($query->num_rows() > 0) {
 //            return $query->result();
 //        } else {
 //            return false;
 //        }
 //    }


    function get_blog_list($table){
        $this->db->select("*");
        $this->db->where('b_status', 'active');
        $this->db->where('b_category', '4');
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
    function get_packages_by_category_id($id) {
       
        $this->db->select('*');
        $this->db->from('holiday');
        $this->db->like('holiday_category_id', $id, 'none');
        $this->db->where_in("holiday_status", 'active');
        $query = $this->db->get();
       
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	 function get_slider_img($table){
        $this->db->select("*");
        //$this->db->where("(sliimg_slider_module='b2c' OR sliimg_slider_module='Both')", NULL, FALSE);
		$this->db->where('sliimg_status', 'active');
		$this->db->where('sliimg_dsa_type', 'DSA');
		$this->db->where('sliimg_dsa_id', $this->dsa_data->dsa_id);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
	
	//=========
	
	

	  // function get_slider_img($table,$where){
        // $this->db->select("*");
        // $this->db->where($where);
        // $query = $this->db->get($table);
        // if($query->num_rows() > 0){
            // return $query->result();
        // }
        // else{
            // return "0";
        // }
    // }
	
	function get_table($select,$where,$where_val,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}
	
	function get_query_table($select,$where,$where_val,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$this->db->where("com_query_type","package");
		$this->db->join('holiday', 'common_queries.com_reff = holiday.holiday_id');
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}

    public function holiday_query($data1) {
          
        return $this->db->insert('holiday_query', $data1);
    }
    
	
    function get_bookingdetail($refid = NULL) {

        $this->db->from("holiday");
        $this->db->or_where("holiday_slug", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_bookingdetail_by_id($refid = NULL) {

        $this->db->from("holiday");
        $this->db->or_where("holiday_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_bookingimages($refid = NULL) {

        $this->db->from("holiday_image");
        $this->db->or_where("holimg_holiday_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_bitinerary($refid = NULL) {

        $this->db->from("holiday_itinerary");
        $this->db->where("holiti_holiday_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_inclusion($refid) {

        $this->db->from("holiday_inclusion");
        $this->db->where_in("holinc_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_exclusion($refid) {

        $this->db->from("holiday_exclusion");
        $this->db->where_in("holexc_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_releted_packeges($cateid) {

        $this->db->from("holiday");
		$this->db->order_by('holiday_id','desc');
        $this->db->where_in("holiday_category_id", $cateid);
		$this->db->where_in("holiday_status","active");
        $this->db->limit(3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_featured_packeges() {

        $this->db->from("holiday");
        $this->db->where_in("holiday_is_featured", "yes");
        $this->db->where_in("holiday_status", "active");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_category_by_id($cateid = NUll) {

        $this->db->from("holiday_category");
        $this->db->where_in("holcat_id", $cateid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_sub_category_by_id($cateid = NUll) {

        $this->db->from("holiday_sub_category");
        $this->db->where_in("holsubc_id", $cateid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_all_location_json($where1) {

        $this->db->select('location_location');
        $this->db->limit(30);
        // $this->db->where($where);
        $this->db->like('location_location', $where1);
        $query = $this->db->get("location");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "not";
        }
    }
    
     public function get_all_location() {

        $this->db->select('location_location');
        $this->db->limit(30);
        // $this->db->where($where);
        $this->db->where('location_status', "active");
        $query = $this->db->get("location");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "not";
        }
    }

    function insert_booking($data) {

        $this->db->insert('holiday_booking', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
	
	
	public function updateBookingcart($id,$customer_id){
         
        $this->db->where('holbook_id', $id);
        $this->db->set('holbook_customer_id', $customer_id);
        $query=$this->db->update('holiday_booking');
        return $query;
           
           
      
       }
    
	

    function update_booking($id, $data) {

        $this->db->where('holbook_id', $id);

        if ($this->db->update('holiday_booking', $data)) {

            return "success";
        }
    }

    function insert_booking_pax_details($data) {

        return $this->db->insert('holiday_pax', $data);
    }
    function get_booking_by_id($refid = NULL) {

        $this->db->from("holiday_booking");
        $this->db->where("holbook_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
       function get_pax_id($refid = NULL){
            
            $this->db->from("holiday_pax");
        $this->db->where("holpax_booking_id", $refid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
        }
        
             function get_countries(){
			
			$this->db->select("*");
			$this->db->from('country_list');
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
                
    function insert_card($data) {

        $this->db->insert('credit_card', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
	
	function getPaymentMethod($id,$type){
            
        $this->db->from("dsa_payment_gateway");
        $this->db->where("dsapayg_user_id", $id);
        $this->db->where("dsapayg_user_type", $type); 
        $this->db->where("dsapayg_status", "active");   
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
                          return $query->result();
       } else {
                         return false;
		}
	}

	 function getHolidayExtra($id,$type,$tourID){
        $this->db->from("holiday_extra");
		$search  = "FIND_IN_SET('".$tourID."', holextra_assigned)";
        $this->db->where($search);
        $this->db->where("holextra_user_id", $id);
        $this->db->where("holextra_user_type", $type); 
        $this->db->where("holextra_status", "active");   
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
                          return $query->result();
       } else {
                         return false;
      }
    }
 function getHolidayExtraByid($id){
        $this->db->from("holiday_extra");
        $this->db->where("holextra_id", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
                        return $query->result();
              } else {
                        return false;
        }
    }
	
	
    public function updateBookingpayment($id,$pay_by,$amount){
         
        $this->db->where('holbook_id', $id);
        $this->db->set('holbook_payment_by', $pay_by);
        $this->db->set('holbook_paid_amount', $amount);
        $this->db->set('holbook_payment_status',"success");
		$this->db->set('holbook_booking_status',"success");

        $query=$this->db->update('holiday_booking');
        return $query;
    }
	
	public function getHotelNameByid($id){
        $this->db->from("holiday_hotel");
        $this->db->where("holhot_id", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
                        return $query->row();
              } else {
                        return false;
        }
    }

	function get_all_data($table){
        $this->db->select("*");
       // $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }

	 public function register_query($data1) {		  
      //  return $this->db->insert('common_queries', $data1);
	  $this->db->insert('common_queries', $data1);
		return $this->db->insert_id ();
    }
	

}
