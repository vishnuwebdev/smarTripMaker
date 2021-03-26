<?php

class Holidaymodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	  function get_slider_img($table,$where){
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

    function get_releted_packeges($cateid,$id) {

        $this->db->from("holiday");
        $this->db->where_in("holiday_category_id", $cateid);
        $this->db->where_in("holiday_user_id", $id);
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

    function insert_booking($data) {

        $this->db->insert('holiday_booking', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
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

    public function register_query($data1) {
		  
        return $this->db->insert('common_queries', $data1);
    }


    function pagination_table($limit, $offset = NULL, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table, $extrawhere = NULL) {
		if ($extrawhere != NULL) {
			$this->db->where ( $extrawhere );
		}
		$this->db->where ( $where_2_name, $where_2_value );
		$this->db->where ( $where_1_name, $where_1_value );
		
		$this->db->limit ( $limit, $offset );
		$this->db->order_by ( $order_by, "desc" );
		$query = $this->db->get ( $table );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
    }
    

}
