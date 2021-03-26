<?php
class Hotel_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	function update_table($where,$where_val,$table,$data) {
		$this->db->where ( $where, $where_val );
		$this->db->update ( $table, $data );
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
	
	public function bp_city($data)
	{
		$this->db->select('*');
		$this->db->from('hotel_city_code');
		$this->db->where('Destination',$data);
		$this->db->limit(50);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	public function bp_other_city($data)
	{
		$this->db->select('*');
		$this->db->from('hotel_city_code');
		$this->db->where('Destination!=',$data);
		$this->db->like('Destination',$data, 'both');
		$this->db->limit(50);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	public function findcity($data)
	{
		$this->db->select('*');
		$this->db->from('hotel_city_code');
		$this->db->like('Destination',$data, 'both');
		$this->db->limit(50);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	} 
	function insert_booking($data){
		$this->db->insert("hotel_live_booking_list",$data);
		return $this->db->insert_id();
	}
	function insert_pax($data){
		$this->db->insert("hotel_live_booking_pax",$data);
		return $this->db->insert_id();
	}
	function insert_temp_data($data){
		$this->db->insert("hotel_live_temp_data",$data);
		return $this->db->insert_id();
	}
	
	function get_search_detail($ref_id) {
		$this->db->select ( "*" );
		$this->db->from ( 'hotel_live_booking_list' );
		$this->db->where ( 'hotboli_id', $ref_id );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
    }
	
	    function get_hotel_temp_data($ref_id)
    {
        $this->db->select ( "*" );
        $this->db->from ( 'hotel_live_temp_data' );
        $this->db->where ( 'hotdata_booking_id', $ref_id );
        $query = $this->db->get ();
        if ($query->num_rows () == '') {
            return '';
        } else {
            return $query->row ();
        }
    }
	
	function get_hotel_temp_info($key,$ref_id)
    {
        $this->db->select ( "*" );
        $this->db->from ( 'hotel_live_temp_data' );
        $this->db->where ( 'hotdata_booking_id', $ref_id );
		$this->db->where ( 'hotdata_key', $key);
        $query = $this->db->get ();
        if ($query->num_rows () == '') {
            return '';
        } else {
            return $query->row ();
        }
    }

    function get_search_detail_passenger($ref_id)
	{
		$this->db->select ( "*" );
		$this->db->from ( 'hotel_live_booking_pax' );
		$this->db->where ( 'hotbopax_booking_id', $ref_id );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
    }


	function update_booking($data,$id){
		$this->db->where('hotboli_id', $id);
		$this->db->update('hotel_live_booking_list', $data); 
	}

	function get_dsa_markup($id){
		$this->db->select ( "*" );
		$this->db->from ( 'dsa_hotel_markup' );
		$this->db->where ( 'dsahomark_dsa_id', $id );
		$this->db->where ( 'dsahomark_b2c_b2b', "b2c" );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {

			return $query->result();
		}
	}
	
	function get_dsa_discount($id){
		$this->db->select ( "*" );
		$this->db->from ( 'hotel_discount' );
		$this->db->where ( 'hdis_dsa_id', $id );		
		$this->db->where ( 'hdis_module', "b2c" );
		$query = $this->db->get ();
		if ($query->num_rows() == '') {
			return '';
		} else {
			return $query->row();
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
	
	function get_pax_data($booking_id){
		$this->db->select("*");
		$this->db->from("hotel_live_booking_pax");
		$this->db->where("hotbopax_booking_id",$booking_id);
		$query=$this->db->get();
		return $query->row();
	}
	function get_hotel($city){
		$this->db->select("*");
		$this->db->like("hofl_city",$city, 'both');
		$this->db->where("hofl_status","Active");
		$this->db->from("hotel_off_list");
		 $query=$this->db->get();
		if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }
	}
	function bp_room_availability_get($bp_data_final){
        $this->db->where("hofravai_year",$bp_data_final['final_year']);
        $this->db->where("hofravai_month",$bp_data_final['final_month']);
        $this->db->where($bp_data_final['final_day_1'],"Available");
        // $this->db->where($bp_data_final ['final_day_2'],"Available");
        $this->db->where("hofravai_hotel_id",$bp_data_final['hotel_id']);
        $this->db->from("hotel_off_room_availability");
		$this->db->join('hotel_off_list', 'hotel_off_room_availability.hofravai_hotel_id = hotel_off_list.hofl_id');
		$this->db->join('hotel_off_room_list', 'hotel_off_room_availability.hofravai_room_id = hotel_off_room_list.hoffr_id');
		  $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }			
    }
function bp_room_details ($room_id){
        $this->db->where("hoffr_id",$room_id);
        $this->db->where("hoffr_status","Active");
        $this->db->order_by("hoffr_id", "desc");
        $query=$this->db->get("hotel_off_room_list");
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }
    }	
	
	function bp_hotel_images ($hotel_id){
        $this->db->where("hofhim_hotel_id",$hotel_id);
        $this->db->where("hofhim_status","Active");
        $this->db->order_by("hofhim_id", "desc");
        $query=$this->db->get("hotel_off_hotel_image");
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return "not";
        }
    }
	function bp_room_images ($room_id){
        $this->db->where("hofrimg_room_id",$room_id);
        $this->db->where("hofrimg_status","Active");
        $this->db->order_by("hofrimg_id", "desc");
        $query=$this->db->get("hotel_off_room_image");
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }
    }
	
	function bp_room_availability_get_id($id, $bp_data_final){
        $this->db->where("hofravai_year",$bp_data_final['final_year']);
        $this->db->where("hofravai_month",$bp_data_final['final_month']);
        $this->db->where($bp_data_final['final_day_1'],"Available");
        // $this->db->where($bp_data_final ['final_day_2'],"Available");
        $this->db->where("hofravai_hotel_id",$id);
        $this->db->from("hotel_off_room_availability");
		$this->db->join('hotel_off_list', 'hotel_off_room_availability.hofravai_hotel_id = hotel_off_list.hofl_id');
		$this->db->join('hotel_off_room_list', 'hotel_off_room_availability.hofravai_room_id = hotel_off_room_list.hoffr_id');
		$query = $this->db->get();
         return $query->result();
			
    }
	function bp_room_ammenities ($amenity_id){
        $this->db->where("hoff_id",$amenity_id);
        $this->db->where("hoff_status","Active");
        $this->db->order_by("hoff_id", "desc");
        $query=$this->db->get("hotel_off_extra");
         return $query->result();
        
    }
function bp_hotel_facilities ($id){
        $this->db->where("hoff_id",$amenity_id);
        $this->db->where("hoff_status","Active");
        $this->db->order_by("hoff_id", "desc");
        $query=$this->db->get("hotel_off_extra");
         return $query->result();
        
    }
function bp_hotel_details ($hotel_id){
        $this->db->where("hofl_id",$hotel_id);
        $this->db->where("hofl_status","Active");
        $query=$this->db->get("hotel_off_list");
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }
    }
function insert_booking_offline($data){
		$this->db->insert("hotel_off_booking",$data);
		return $this->db->insert_id();
	}
function insert_pax_offline($data){
		$this->db->insert("hotel_off_pax",$data);
		return $this->db->insert_id();
	}	
	function get_hotel_facilities($get_hotel_facilities){
		$this->db->select("*");
		$this->db->where("hofff_id",$get_hotel_facilities);
		$this->db->from("hotel_off_facility");
		 $query=$this->db->get();
		return $query->result();
	}
	
	function update_booking_offline($data,$id){
		$this->db->where('hoffbo_id', $id);
		$this->db->update('hotel_off_booking', $data); 
	}
	function get_hotel_by_booking_id ($booking_id){
		$this->db->select("*");
        $this->db->where("hotboli_id",$booking_id);
        $query=$this->db->get("hotel_live_booking_list");
           return $query->row();
        
    }
	function get_hotel_by_hotelid ($hotel_id){
		$this->db->select("*");
        $this->db->where("hofl_id",$hotel_id);
        $query=$this->db->get("hotel_off_list");
           return $query->row();
        
    }
	function get_room_by_roomid ($room_id){
		$this->db->select("*");
        $this->db->where("hoffr_id",$room_id);
        $query=$this->db->get("hotel_off_room_list");
           return $query->row();
        
    }
	function get_pax_by_booking_id ($booking_id){
		$this->db->select("*");
        $this->db->where("hotbopax_booking_id",$booking_id);
        $query=$this->db->get("hotel_off_pax");
           return $query->result();
        
    }
	function bp_hotel_images1($hotel_id){
        $this->db->where("hofhim_hotel_id",$hotel_id);
        $this->db->where("hofhim_status","Active");
        $this->db->order_by("hofhim_id", "desc");
        $query=$this->db->get("hotel_off_hotel_image");
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return "not";
        }
    }
	
	//PRINT TICKET FOR GUS
	function get_booking_by_booking_id($ticket_pnr,$emailid){
		$this->db->select ( "*" );
		$this->db->from ( 'hotel_live_booking_list' );
		$this->db->where ( 'hotboli_book_confim_number', $ticket_pnr );
		$this->db->where ( 'hotboli_email', $emailid );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
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
	

	function get_coupon_data($select,$where,$table){
		$this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		} else{
			return "0";
		}
	}


	public function updateCouponLimit($id,$new_limit){
		$this->db->where('coupon_id', $id);
		$this->db->set('coupon_use_limit', $new_limit);
		$query=$this->db->update('coupon');
		return $query;
	}

	function hotelCoupon($data){
		$this->db->insert('hotel_coupon', $data); 
		$insert_id = $this->db->insert_id();
		return  $insert_id;

	}
	
	public function userLogin($email, $password) {
        $this->db->where('cust_email', $email);
        $this->db->where('cust_password', $password);
        $this->db->where('cust_user_id', $this->dsa_data->dsa_id);
        $this->db->where('cust_user_type', "DSA");
        $query = $this->db->get('customer');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $data = array('userid' => $row->cust_id, 'validated' => true);
            $dd['id'] = $row->cust_id;
            $dd['name'] = $row->cust_first_name . ' ' . $row->cust_last_name;
            $dd['userData'] = $row;
            return $dd;
        } else {
            return NULL;
        }
    }
	
}