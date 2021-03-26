<?php
class UserModel extends CI_Model {



    public function __construct() {

        parent::__construct();

    }

    function pagination_table_edit($limit, $offset=NULL,$where_1_name,$where_1_value,$where_2_name,$where_2_value,$order_by,$table) {
        $this->db->where($where_1_name,$where_1_value);
        $this->db->where($where_2_name,$where_2_value);
        $this->db->limit($limit,$offset);
        $this->db->order_by($order_by, "desc");
        $query=$this->db->get($table);
        if($query->num_rows()>0){
            return $query->result();
        }else{
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
	
	public function userlogin_by_id($userID) {
        $this->db->where('cust_id', $userID);
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

    public function register($data1) {
        //$id = $_SESSION['customer_id'];
        return $this->db->insert('customer', $data1);
    }

    public function getUserData($userid) {
        $this->db->where('cust_id', $userid);
        $query = $this->db->get('customer');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        } else {
            return NULL;
        }
    }

    function check_fb_id($email) {
        $this->db->from("customer");
        $this->db->or_where("cust_email", $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function fb_data_entry($fb_data) {
        $this->db->insert("customer", $fb_data);
    }
	
	
	public function checkUser($data = array()){
        $this->db->select("cust_id");
        $this->db->from("customer");
        $con = array(
            'cust_login_by' => $data['cust_login_by'],
            'cust_social_id' => $data['cust_social_id']
        );
        $this->db->where($con);
        $query = $this->db->get();
        $check = $query->num_rows();
        if($check > 0){
            // Get prev user data
            $result = $query->row_array();
            
            // Update user data
            $data['cust_update_date'] = date("Y-m-d H:i:s");
            $update = $this->db->update("customer", $data, array('cust_id'=>$result['cust_id']));
            
            // user id
            $userID = $result['cust_id'];
        }else{
            // Insert user data
            $data['cust_entry_date'] = date("Y-m-d H:i:s");
            $data['cust_update_date'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert("customer",$data);
            
            // user id
            $userID = $this->db->insert_id();
        }
        
        // Return user id
        return $userID?$userID:false;
    }
	
	public function checkUser_fb($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select("cust_id");
			$this->db->from("customer");
            $this->db->where(array('cust_login_by'=>$userData['cust_login_by'],'cust_social_id'=>$userData['cust_social_id']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['cust_update_date'] = date("Y-m-d H:i:s");
                $update = $this->db->update("customer",$userData,array('cust_id'=>$prevResult['cust_id']));
                
                //get user ID
                $userID = $prevResult['cust_id'];
            }else{
                //insert user data
                $userData['cust_entry_date']  = date("Y-m-d H:i:s");
                $userData['cust_update_date'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert("customer",$userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }

    function userlogin_face($email) {
        $this->db->where('cust_email', $email);
        $query = $this->db->get('customer');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $data = array('userid' => $row->cust_id, 'validated' => true);
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

    
    public function mailexists_customer($mail,$userid){
        $this->db->where('cust_email', $mail);
        $this->db->where('cust_user_id',$userid);
        $this->db->where('cust_user_type',"DSA");
       	$query = $this->db->get('customer');
		if($query->num_rows() == 1){
	       return 	true;
			} else {
				return false;
		 }
		}
                
        public function get_flight_booking($userid=NULL){  
            $this->db->select("*");
			$this->db->from('flight_booking_list');
			$this->db->where('fbook_customer_id',$userid);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return 'not';
			}else{
				return $query->result();
			}  
        }

        public function get_hotel_booking($userid=NULL){  
            $this->db->select("*");
			$this->db->from('hotel_live_booking_list');
			$this->db->where('hotboli_customer_id',$userid);
			$this->db->order_by('hotboli_id', "desc");
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return 'not';
			}else{
				return $query->result();
			}  
        }
                
         public function get_pax_detail($bookingid=NULL){
            $this->db->select("*");
			$this->db->from('flight_pax_list');
			$this->db->where('fpax_booking_id',$bookingid);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}  
        }
                
        public function get_temp_data($bookingid=NULL){
            $this->db->select("*");
			$this->db->from('flight_temp_data');
			$this->db->where('ftemp_ref_id',$bookingid);
			$query=$this->db->get();
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
            
        function insert_token($mail_id,$data1,$userid) {
            $this->db->where("cust_email",$mail_id);
            $this->db->where('cust_user_id',$userid);
            $this->db->where('cust_user_type',"DSA");
            $this->db->set("cust_verfy_token",$data1);
            $this->db->update("customer");    
            return true;
        }

        function token_exists_customer($token,$userid){
            $this->db->where('cust_verfy_token', $token);
            $this->db->where('cust_user_id',$userid);
            $this->db->where('cust_user_type',"DSA");
            $query = $this->db->get('customer');
            if($query->num_rows() == 1){
                    return 	true;
                } else {
                    return false;
            }
        }
            
        function update_password($token,$new_password,$userid){
            $this->db->where('cust_verfy_token', $token);
            $this->db->where('cust_user_id',$userid);
            $this->db->where('cust_user_type',"DSA");
            $this->db->set("cust_password",$new_password);
            $this->db->update("customer"); 
            return true;
        }

        function remove_token($token,$userid){
            $this->db->where('cust_verfy_token', $token);
            $this->db->where('cust_user_id',$userid);
            $this->db->where('cust_user_type',"DSA");
            $this->db->set('cust_verfy_token' , 'NULL');        
            $this->db->update('customer', $data);
        }

        function update_profile($id,$data){
            $this->db->where('cust_id', $id);
            $this->db->update('customer', $data);
        }
            
        function do_upload() {
            $this->load->library('upload');
            $config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
            $config['upload_path']    =  FCPATH . '/assets/profile_pic';
            $config['max_size']       = '4024';
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if($this->upload->do_upload())
            {
                $image_data = $this->upload->data();
                return $image_data;
            } else {
                print_r ($this->upload->display_errors());
                exit();
            }
        }


        public function get_hotel_pax_detail($bookingid = NULL) {
            $this->db->select("*");
            $this->db->from('hotel_live_booking_pax');
            $this->db->where('hotbopax_booking_id', $bookingid);
            $query = $this->db->get();
            if ($query->num_rows() == '') {
                return '';
            } else {
                return $query->result();
            }
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
    
    function get_bookingflight_data_off($userid) {
		$this->db->select ( "*" );
		$this->db->from ( 'flight_booking_list' );
		$this->db->where ( 'fbook_customer_id', $userid );
		$this->db->order_by('fbook_id', "desc");
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->result();
		}
	}
	
	public function get_pax_detail_off($bookingid = NULL) {
        $this->db->select("*");
        $this->db->from('flight_pax_list');
        $this->db->where('fpax_booking_id', $bookingid);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
	
		function update_customer_date($data,$id){
		$this->db->where("cust_id",$id);
		$this->db->update("customer",$data);
		return "success";
	}


    function get_cust($dis){
        $this->db->select("*");
        $this->db->where("cust_status","active");
        $this->db->where("cust_id",$dis);
        $query = $this->db->get("customer");
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
    
    function get_opt($dsa_id){
        $this->db->select("*");
        $this->db->where("recudsaopr_dsa_id",$dsa_id);
        //$this->db->where("recudsaopr_agent_class",$agent_cls);
        $this->db->from("recharge_u_dsa_operator");
       // $this->db->join('recharge_u_admin_operator',"rechuadopr_id = recudsaopr_operator_id");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return "0";
        }
    }
    
    
    function get_this_month($bp_user_id){   
        $this->db->where('MONTH(recharge_u_list.reculst_entry_date) = MONTH(NOW())');
        $this->db->where_in("reculst_customer_id",$bp_user_id);
        $query = $this->db->get('recharge_u_list');
        return $query->result();
    }
    
    function today_data($bp_user_id){
        $this->db->where('DATE(recharge_u_list.reculst_entry_date) = DATE(NOW())');
        $this->db->where_in("reculst_customer_id",$bp_user_id);
        $query = $this->db->get('recharge_u_list');
        return $query->result();
    }
    
    function get_month_data($int,$bp_user_id){
        $this->db->where('MONTH(recharge_u_list.reculst_entry_date) = MONTH(NOW() - INTERVAL '.$int.' MONTH)');
        $this->db->where_in("reculst_customer_id",$bp_user_id);
        $query = $this->db->get('recharge_u_list');
        return $query->result();
    }

	public function holiday_list($user_id){
		$this->db->select("*");
		$this->db->order_by("com_id","desc");		
		$this->db->where("com_cust_id",$user_id);
		$this->db->where("com_query_type","package");
		$this->db->from("common_queries");
		$this->db->join('holiday', 'common_queries.com_reff = holiday.holiday_id');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
    }
    
    public function visa_list($user_id){
		$this->db->select("*");
		$this->db->order_by("id","desc");		
		$this->db->where("userId",$user_id);
		$this->db->where("request_visa_id >","0");
		$this->db->from("visa");
		// $this->db->join('holiday', 'common_queries.com_reff = holiday.holiday_id');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
    }


    public function visa_type (){
        $this->db->select("*");
		$this->db->where("visa_status","active");
		$this->db->from("visa_list");
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
    }
    
    

}

