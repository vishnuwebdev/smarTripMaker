<?php
class Flight_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
        
        function get_dsa_markup($id,$bp_dom_int){
		$this->db->select ( "*" );
		$this->db->from ( 'dsa_markup' );
		$this->db->where ( 'dsamark_user_id', $id );
		$this->db->where ( 'dsamark_dom_int', $bp_dom_int );
		$this->db->where ( 'dsamark_b2b_b2c', "b2c" );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->result ();
		}
	}
        
        function insert_booking($data){

		$this->db->insert('flight_booking_list', $data); 
                $insert_id = $this->db->insert_id();

                return  $insert_id;

		}
                
        function insert_booking_pax_details($data){

		return $this->db->insert('flight_pax_list', $data); 

		}
                
        function insert_temp($data,$type=NULL){
		 if($type == "array"){			 
 		$this->db->insert_batch('flight_temp_data', $data); 
			 } else {
		$this->db->insert('flight_temp_data', $data); 
		 }
		}
                
        function get_bookingflight_data($bookingid){
                    
            $this->db->select("*");
			$this->db->from('flight_booking_list');
			$this->db->where('fbook_id',$bookingid);
			//$this->db->order_by("fbook_id", $bookingid);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
           }
                
        function update_booking($data,$id){

		$this->db->where('fbook_id', $id);

		$this->db->update('flight_booking_list', $data); 

		}
                
        function get_search_detail($ref_id, $key){	
			$this->db->select("*");
			$this->db->from('flight_temp_data');
			$this->db->where('ftemp_ref_id', $ref_id);
			$this->db->order_by("ftemp_id", "desc");			
			$this->db->where('ftemp_key', $key);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		
		
	//===========
	
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
                
                
		function get_booking_by_id($id,$fld="*"){		

			$this->db->select($fld);

			$this->db->from('flight_booking_list');

			$this->db->where('fbook_id',$id);

			$query=$this->db->get();

			if($query->num_rows() ==''){

				return '';

			}else{

				return $query->row();

			}

		}
                
        function get_pax_by_id($id){

		

		$this->db->select('*');

			$this->db->from('flight_pax_list');

			$this->db->where('fpax_booking_id',$id);

			$query=$this->db->get();

			if($query->num_rows() ==''){

				return '';

			}else{

				return $query->result();

			}

		

		}

		function get_coupon_data($select,$where,$table){
			$this->db->select($select);
			$this->db->where($where);
			$query = $this->db->get($table);
			if($query->num_rows() > 0){
				return $query->row();
			}
			else{
				return "0";
			}
		}
		
		public function updatecouponlimit($id,$new_limit){
			$this->db->where('coupon_id', $id);
			$this->db->set('coupon_use_limit', $new_limit);
			$query=$this->db->update('coupon');
			return $query;
		}


		function fligth_on_cupon($data){
			$this->db->insert('flight_on_coupon_use', $data); 
			$insert_id = $this->db->insert_id();
			return  $insert_id;
	
		}

			function get_flight_discount($dsa_id){
			$this->db->select ( "*" );
			$this->db->from ( 'dsa_flight_discount' );
			$this->db->where ( 'dsafdis_dsa_id', $dsa_id );
			$this->db->where ( 'dsafdis_module', 'b2c' );
			$query = $this->db->get ();
			if ($query->num_rows () == '') {
				return '';
			} else {
				return $query->result ();
			}
		}
	//USER LOGIN
	
	 public function userlogin($email, $password) {
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
	
	//GET GUEST BOOKING ROW
	
	
	function get_booking_by_booking_id($booking_id,$mobile){
			$this->db->select('*');
			$this->db->from('flight_booking_list');
			$this->db->where('fbook_id',$booking_id);
			$this->db->where('fbook_contact_phone',$mobile);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		
		
		function get_booking_by_session_id($session_id,$fld="*"){
			$this->db->select($fld);
			$this->db->from('flight_booking_list');
			$this->db->where('fbook_sessionid',$session_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}

		}
	
	// function get_booking_by_booking_id($ticket_pnr,$emailid){
			// $this->db->select('*');
			// $this->db->from('flight_booking_list');
			// $this->db->where('fbook_ob_pnr',$ticket_pnr);
			// $this->db->where('fbook_contact_email',$emailid);
			// $query=$this->db->get();
			// if($query->num_rows() ==''){
				// return '';
			// }else{
				// return $query->row();
			// }
		// }
	
}
?>