<?php

class Customer extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('Customer_Model');
    }

    public function index() {
        $activedata = array(
            "activemain" => "customer",
            "displayblock" => "customer",
            "activeclass" => "customer"
        );
        $data["activedata"] = $activedata;
        $user_type = "DSA";
        $user_id = $this->dsa_data->dsa_id;
        $result = $this->Customer_Model->customer_list($user_type, $user_id);
        $data ['result'] = $result;
        $this->load->view("customer/customer_list", $data);
    }

    public function add_new_customer() {
        $activedata = array(
            "activemain" => "customer",
            "displayblock" => "customer",
            "activeclass" => "customer/add_new_customer"
        );
        $data["activedata"] = $activedata;
        $this->load->view("customer/add_new_customer", $data);
    }

    public function insert_customer_data() {
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $data = array(
                "cust_first_name" => $this->input->post("cust_first_name"),
                "cust_last_name" => $this->input->post("cust_last_name"),
                "cust_email" => $this->input->post("cust_email"),
                "cust_mobile" => $this->input->post("cust_mobile"),
                "cust_password" => md5($this->input->post("cust_password")),
                "cust_address" => $this->input->post("cust_address"),
                "cust_city" => $this->input->post("cust_city"),
                "cust_state" => $this->input->post("cust_state"),
                "cust_country" => $this->input->post("cust_country"),
                "cust_pincode" => $this->input->post("cust_pincode"),
                "cust_remark" => $this->input->post("cust_remark"),
                "cust_user_type" => "DSA",
                "cust_user_id" => $this->dsa_data->dsa_id,
            );
            $this->Customer_Model->insert_new_customer($data);
            $this->session->set_flashdata("alert", array(
                "message" => "New Customer successfully Added",
                "class" => "alert-success"
            ));
            redirect("customer");
        } else {
            redirect();
        }
    }
    public function update_customer_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"cust_status" => $this->input->get ( "status" ),
		);
		$this->Customer_Model->update_customer_data ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( "customer");
	}
        public function change_password(){
		$activedata = array (
				 "activemain" => "customer",
            "displayblock" => "customer",
            "activeclass" => "customer"
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"cust_password" => md5($this->input->get ( "password" )),
		);
		$this->Customer_Model->update_customer_data ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( "customer");
		}else{
			$this->load->view("customer/update_password",$data);
		}
	}
        public function delete_customer(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$this->Customer_Model->delete_customer ($id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "CUstomer Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ( "customer");
	}

	// Add Topup
	
	  public function topup() {
		$activedata = array (
				"activemain" => "customer",
				"displayblock" => "customer",
				"activeclass" => "customer" 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		//PrintArray($id );
		//die; 
		$result = $this->Customer_Model->get_customer_by_id ( $id );
		$data ['result'] = $result;
		$this->load->view ( "customer/topup", $data );
	}
    public function update_topup() {
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$id = bp_hash ( $this->input->post ( "cust_id" ) );
			$result = $this->Customer_Model->get_customer_by_id ( $id );
			$bp_old_baalnce = $result->cust_balance;
			$bp_new_balance = $result->cust_balance + $this->input->post ( "balance" );
			$bp_old_dsa_baalnce = $this->dsa_data->dsa_balance;
			
			
			$bp_new_dsa_balance = $bp_old_dsa_baalnce - $this->input->post ( "balance" );
			$bp_credit = $this->input->post ( "balance" );
			$bp_detail = $this->input->post ( "remark" );
			$bp_update_by = "Admin";
			
				$data = array (
					"balance_log_user_id" => $result->cust_id,
					"balance_log_user_name" => $result->cust_first_name,
					"balance_log_user_type" => "customer",
					"balance_log_detail" => $bp_detail,
					"balance_log_credit" => $bp_credit,
					"balance_log_balance" => $bp_new_balance,
					"balance_log_update_by" => $bp_update_by,
										
				);
				$this->Customer_Model->insert_balance_log ( $data );
				$data1 = array (
						"cust_balance" => $bp_new_balance 
				);
				$this->Customer_Model->update_customer_date ( $data1, $id );
				$dsa_data = array (
						"balance_log_user_id" => $this->dsa_data->dsa_id,
						"balance_log_user_name" => $this->dsa_data->dsa_company_name,
						"balance_log_user_type" => "DSA",
						"balance_log_detail" => "DSA Balance Deduct",
						"balance_log_debit" => $bp_credit,
						"balance_log_balance" => $bp_new_dsa_balance,
						"balance_log_update_by" => $bp_update_by, 
						
				);
				$this->Customer_Model->insert_balance_log ( $dsa_data );
				
				$this->session->set_flashdata ( "alert", array (
						"message" => "Customer balance successfully Updated",
						"class" => "alert-success" 
				) );
				$bp_message = "Dear Customer!, " . $bp_detail . ". Your Main balance is " . $bp_new_balance . ".";
				$number = $result->cust_mobile;
				// send_sms ( $number, $bp_message, "" );
				redirect ( "customer/topup/?ref_id=" . url_encode ( $id ) );		
		
		} else {
			redirect ();
		}
	}
	public function deduct() {
		$activedata = array (
				"activemain" => "customer",
				"displayblock" => "customer",
				"activeclass" => "customer" 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$result = $this->Customer_Model->get_customer_by_id ( $id );
		$data ['result'] = $result;
		$this->load->view ( "customer/deduct", $data );
	}
	public function update_deduct() {
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$id = bp_hash ( $this->input->post ( "cust_id" ) );
			$result = $this->Customer_Model->get_customer_by_id ( $id );
			$bp_old_baalnce = $result->cust_balance;
			$bp_new_balance = $result->cust_balance - $this->input->post ( "balance" );
			$bp_old_dsa_baalnce = $this->dsa_data->dsa_balance;
			
			
			
			$bp_new_dsa_balance = $bp_old_dsa_baalnce + $this->input->post ( "balance" );
			$bp_deduct = $this->input->post ( "balance" );
			$bp_detail = $this->input->post ( "remark" );
			$bp_update_by = "Super Admin";
			$data = array (
					"balance_log_user_id" => $result->cust_id,
					"balance_log_user_name" => $result->cust_first_name,
					"balance_log_user_type" => "customer",
					"balance_log_detail" => $bp_detail,
					"balance_log_debit" => $bp_deduct,
					"balance_log_balance" => $bp_new_balance,
					"balance_log_update_by" => $bp_update_by,
					
			);
			$this->Customer_Model->insert_balance_log ( $data );
			$data1 = array (
					"cust_balance" => $bp_new_balance 
			);
			$this->Customer_Model->update_customer_date ( $data1, $id );
			$dsa_data = array (
						"balance_log_user_id" => $this->dsa_data->dsa_id,
						"balance_log_user_name" => $this->dsa_data->dsa_company_name,
						"balance_log_user_type" => "DSA",
						"balance_log_detail" => "DSA Balance Topup",
						"balance_log_credit" => $bp_deduct,
						"balance_log_balance" => $bp_new_dsa_balance,
						"balance_log_update_by" => $bp_update_by,
						
				);
			$this->Customer_Model->insert_balance_log ( $dsa_data );
			
			
			
			$this->session->set_flashdata ( "alert", array (
					"message" => "Customer balance successfully Updated",
					"class" => "alert-success" 
			) );
			$bp_message = "Dear Customer!, " . $bp_detail . ". Your Main balance is " . $bp_new_balance . ".";
			$number = $result->cust_mobile;
		
			// send_sms ( $number, $bp_message, "" );
			//print_r($res); exit;
			redirect ( "customer/deduct/?ref_id=" . url_encode ( $id ) );
		} else {
			redirect ();
		}
	}
	public function customer_transaction_log() {
		$activedata = array (
				"activemain" => "customer",
				"displayblock" => "customer",
				"activeclass" => "customer" 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$result1 = $this->Customer_Model->get_customer_by_id ( $id );
		$result = $this->Customer_Model->get_customer_transaction ( $id );
		$data ['result'] = $result;
		$this->load->view ( "customer/customer_transaction", $data );
	}
	
	
}
