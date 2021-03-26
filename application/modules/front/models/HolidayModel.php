<?php

class Holidaymodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	  function get_slider_img($table){
        $this->db->select("*");
       // $this->db->where($where);
		//$whereslider = array('sliimg_dsa_type' => "DSA",'sliimg_slider_module' => "b2c",'sliimg_dsa_id' =>$this->dsa_data->dsa_id,"sliimg_status" => "sliimg_status");
	
		
		//$this->db->where('sliimg_slider_module', 'b2c');
		//$this->db->or_where('sliimg_slider_module', 'Both');
		$this->db->where("(sliimg_slider_module='b2c' OR sliimg_slider_module='Both')", NULL, FALSE);
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
	
	function get_slider_text($table,$where){
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
	function get_offer_img(){
        $this->db->select("*");
		$this->db->limit(5);
		$this->db->order_by('hos_id','desc');
        $query = $this->db->get('home_offer_slider');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
	
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
        $this->db->where_in("holiday_category_id", $cateid);
        $this->db->limit(5);
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


    // 03-01-2020

    
public function get_keyword($refid = NULL){
        $this->db->from("holiday");
        
        $this->db->where_in("holiday_status", "active");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }



    }


	

}
