<?php
class CouponModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
        
        function insert_coupon_data($data){
		$this->db->insert("coupon",$data);
		return "success";
	}
        
        
        function getAllCoupon($dsa_id){
		$this->db->select("*");
		$this->db->where("coupon_user_id",$dsa_id);
		$this->db->where("coupon_user_type","DSA");
		
		$query=$this->db->get("coupon");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
        function update_coupon_date($data,$id){
		$this->db->where("coupon_id",$id);
		$this->db->update("coupon",$data);
		return "success";
	}
        
        function deleteCoupon($id){
		$this->db->where('coupon_id', $id);
		$this->db->delete('coupon');
		return 1;
	}
        
        
	
}