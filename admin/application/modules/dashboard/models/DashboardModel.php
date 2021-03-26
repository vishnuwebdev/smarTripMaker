<?php
class Dashboardmodel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
        
	public function get_today_bookings($where,$limit,$offset,$table,$order_by){
		$this->db->where($where);
		$this->db->limit($limit,$offset);
		$this->db->order_by($order_by, "desc");
		$query=$this->db->get($table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
		
	}


		public function agent_list($agent_user_type,$agent_user_id,$agenttype){
		$this->db->select_sum('agent_balance', 'total');
		$this->db->order_by("agent_id","desc");
        $this->db->where("agent_user_type",$agent_user_type);
        $this->db->where("agent_user_id",$agent_user_id);
        $this->db->where("agent_type",$agenttype);
		$query=$this->db->get("agent");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	
	function count_total_flight($bp_user_id,$type){
		$this->db->select("fbook_id");
		$this->db->where("fbook_user_type","DSA"); 
		$this->db->where("fbook_module",$type); 
		$this->db->where("fbook_user_id",$bp_user_id);
		$this->db->where("fbook_ob_booking_status","Success");
		$query = $this->db->get("flight_booking_list");
		return $query->num_rows();
    }
	
	function count_total_hotel($bp_user_id,$type){
		$this->db->select("hotboli_id");
		$this->db->where("hotboli_module",$type);
		$this->db->where("hotboli_dsa_id",$bp_user_id); 
		$this->db->where("hotboli_booking_status", "Success");
		$query = $this->db->get("hotel_live_booking_list");
		return $query->num_rows();
    }
	
	function count_total_bus($bp_user_id,$type){
		$this->db->select("busbook_id");
		$this->db->where("busbook_mode",$type);
		$this->db->where("busbook_dsa_id",$bp_user_id); 
		$this->db->where("busbook_status", "Successful");
		$query = $this->db->get("bus_booking");
		return $query->num_rows();
    }

    function count_total_recharge($bp_user_id,$type){
		$this->db->select("reculst_id");
		$this->db->where($type,"0");
		$this->db->where("reculst_dsa_id",$bp_user_id); 
		$this->db->where("reculst_status", "Success");
		$query = $this->db->get("recharge_u_list");
		return $query->num_rows();
    }
	
	
	function count_total_dmt($bp_user_id,$type){
		$this->db->select("reculst_id");
		$this->db->where("dmcusli_mod",$type);
		$this->db->where("reculst_dsa_id",$bp_user_id); 
		$this->db->where("reculst_status", "Success");
		$query = $this->db->get("recharge_u_list");
		return $query->num_rows();
    }

    function count_day_total_bus($bp_user_id,$type){
        $date1=date('Y-m-d');		
		$this->db->select("busbook_id");
		$this->db->where("busbook_mode",$type);
		$this->db->where("busbook_dsa_id",$bp_user_id); 
		$this->db->where("busbook_status", "Successful");
		$this->db->where("DATE(busbook_entry_date)",$date1);
		$query = $this->db->get("bus_booking");
		return $query->num_rows();
    }

    function count_day_total_hotel($bp_user_id,$type){
		$date1=date('Y-m-d');
		$this->db->select("hotboli_id");
		$this->db->where("hotboli_module",$type);
		$this->db->where("hotboli_dsa_id",$bp_user_id); 
		$this->db->where("hotboli_booking_status", "Success");
		$this->db->where("DATE(hotboli_entry_date)",$date1);
		$query = $this->db->get("hotel_live_booking_list");
		return $query->num_rows();
    }

    function count_day_total_flight($bp_user_id,$type){
		$date1=date('Y-m-d');
		$this->db->select("fbook_id");
		$this->db->where("fbook_user_type","DSA"); 
		$this->db->where("fbook_module",$type); 
		$this->db->where("fbook_user_id",$bp_user_id);
		$this->db->where("fbook_ob_booking_status","Success");
		$this->db->where("DATE(fbook_entry_date)",$date1);
		$query = $this->db->get("flight_booking_list");
		return $query->num_rows();
    }
    
    function count_day_total_recharge($bp_user_id,$type){ 
	    $date1=date('Y-m-d');	
		$this->db->select("reculst_id");
		$this->db->where($type,"0");
		$this->db->where("reculst_dsa_id",$bp_user_id); 
		$this->db->where("reculst_status", "Success"); 
		$this->db->where("DATE(reculst_entry_date)",$date1);
		$query = $this->db->get("recharge_u_list");
		return $query->num_rows();
    }
	
	
	function transaction_log_b2c($limit, $offset=NULL,$where,$join_table,$join_left,$join_right){
		$date1=date('Y-m-d');
		$this->db->select("*");
		$this->db->from("dmt_transaction");
		$this->db->where ( $where );
		$this->db->where("DATE(dmttran_entry_date)",$date1);
		//$this->db->limit($limit,$offset);
		$this->db->join($join_table, $join_left.'='.$join_right);
		$this->db->order_by("dmttran_id","desc");
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	function transaction_log_b2b($limit, $offset=NULL,$where,$join_table,$join_left,$join_right){
		$date1=date('Y-m-d');
		$this->db->select("*");
		$this->db->from("dmt_transaction");
		$this->db->where ( $where );
		$this->db->where("DATE(dmttran_entry_date)",$date1);
		//$this->db->limit($limit,$offset);
		$this->db->join($join_table, $join_left.'='.$join_right);
		$this->db->order_by("dmttran_id","desc");
		$query=$this->db->get();
		return $query->num_rows();
	}

	
}