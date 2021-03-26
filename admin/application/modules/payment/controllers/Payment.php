<?php

class Payment extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('PaymentModel');
        $this->model_name = "PaymentModel";
    }

    public function index() {
        redirect("payment/card_list");
    }

    public function add_bank_detail(){
           $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("payment/add_bank_detail", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;
                $data = array(
                    'dsabank_bank_name' => $this->input->post('bank_name'),
                    'dsabank_account_name' => $this->input->post('bank_account_name'),
                    "dsabank_account_number" => $this->input->post('bank_account_number'),
                    "dsabank_branch_name" => $this->input->post('bank_branch_name'),
                    "dsabank_ifsc_code" => $this->input->post('bank_ifsc_code'),
                    "dsabank_swift_code" => $this->input->post('bank_swift_code'),
                    "dsabank_b2b_b2c" => $this->input->post('menusitetype'),
                    'dsabank_user_type' => "DSA",
                    "dsabank_user_id" => $bp_updated_by,
                    "dsabank_status" => $this->input->post('status'),
                );
                $this->PaymentModel->insert_data("dsa_bank_detail", $data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Bank Detail Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("payment/bank_detail_list");
            }
        } else {
            $this->load->view("payment/add_bank_detail", $data);
        }
    }
    public function bank_detail_list(){
        
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        if ($this->uri->segment(3)) {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $bp_user_id = $this->dsa_data->dsa_id;
        $this->db->where("dsabank_user_type", "DSA");
        $this->db->where("dsabank_user_id", $bp_user_id);
        $total_row = $this->db->from("dsa_bank_detail")->count_all_results();
        $pagination_segment = 3;
        $per_page = 10;
        $pagination_url = base_url() . "payment/bank_detail_list/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
        $result = $this->PaymentModel->bankdetail_list($config ["per_page"], $page, $bp_user_id);
        $data ['result'] = $result;
        //print_r($data);
        //die;
        $this->load->view("payment/bank_detail_list", $data);
    }
    
     public function update_bank_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "dsabank_status" => $this->input->get("status"),
        );
        $this->PaymentModel->update_data("dsa_bank_detail", $data1, array("dsabank_id"=>$id));
        $this->session->set_flashdata("alert", array(
            "message" => "Bank status Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("payment/bank_detail_list");
    }
    
     public function edit_bank_detail() {

        $activedata = array(
            "activemain" => "payment",
            "displayblock" => "payment",
            "activeclass" => "edit_bank_detail"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->PaymentModel->get_row_by_id(array("dsabank_id"=>$id),"dsa_bank_detail");
      
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("payment/edit_bank_detail", $data);
    }
    
    public function update_bank_detail() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
           $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("payment/edit_bank_detail", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                
               // PrintArray($this->input->post());
              //  die;
                $data23 = array(
                    'dsabank_bank_name' => $this->input->post('bank_name'),
                    'dsabank_account_name' => $this->input->post('bank_account_name'),
                    "dsabank_account_number" => $this->input->post('bank_account_number'),
                    "dsabank_branch_name" => $this->input->post('bank_branch_name'),
                    "dsabank_ifsc_code" => $this->input->post('bank_ifsc_code'),
                    "dsabank_swift_code" => $this->input->post('bank_swift_code'),
                    "dsabank_b2b_b2c" => $this->input->post('menusitetype'),
                    "dsabank_status" => $this->input->post('status'),
                  
                );
                $id = bp_hash($this->input->post('ref_id'));
                $this->PaymentModel->update_data("dsa_bank_detail", $data23, array("dsabank_id"=>$id));
                $this->session->set_flashdata("alert", array(
                    "message" => "Bank Detail Successfully Updated",
                    "class" => "alert-success"
                ));
                redirect("payment/bank_detail_list");
            }
        } else {
            $this->load->view("payment/edit_bank_detail", $data);
        }
    }
       public function deletebankdetail() {

        $id = url_decode($this->input->get("bank_id"));

        $data = $this->PaymentModel->delete("dsa_bank_detail", array("dsabank_id" => $id));
        redirect("payment/bank_detail_list");
    }

    public function payment_setting(){
        
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        if ($this->uri->segment(3)) {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $bp_user_id = $this->dsa_data->dsa_id;
        $this->db->where("dsapayg_user_type", "DSA");
        $this->db->where("dsapayg_user_id", $bp_user_id);
        $total_row = $this->db->from("dsa_payment_gateway")->count_all_results();
        $pagination_segment = 3;
        $per_page = 10;
        $pagination_url = base_url() . "payment/payment_setting/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
        $result = $this->PaymentModel->getway_list($config ["per_page"], $page, $bp_user_id);
        $data ['result'] = $result;
        // print_r($data);
        // die;
        $this->load->view("payment/payment_getwayList", $data);
    }
    
      public function add_gateway() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            // $this->form_validation->set_rules('getway_name', 'Getway Name', 'required');
         $this->form_validation->set_rules('guserid', 'Getway User ID', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("payment/add_getway", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'dsapayg_status' => $this->input->post('status'),
                    'dsapayg_gateway_name' => $this->input->post('getway_name'),
                    "dsapayg_display_name" => $this->input->post('getway_display_name'),
                    "dsapayg_gateway_user_id" => $this->input->post('guserid'),
                    // "dsapayg_gateway_password" => $this->input->post('gpassword'),
                    // "dsapayg_gateway_key" => $this->input->post('getwaykey'),
                    'dsapayg_user_type' => "DSA",
                    "dsapayg_user_id" => $bp_updated_by,
                    // "dsapayg_gateway_merchant_key" => $this->input->post('g_merchant_key'),
                    // "dsapayg_gateway_salt_key" => $this->input->post('g_salt'),
                    "dsapayg_b2b_b2c" => $this->input->post('sitetype'),
                    "dsapayg_convenience_fee" => $this->input->post('g_convenience_fee'),
                    "dsapayg_type" => $this->input->post('gateway_type'),
                  
                );
                $this->PaymentModel->insert_data("dsa_payment_gateway", $data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Menu  Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("payment/payment_setting");
            }
        } else {
            $this->load->view("payment/add_getway", $data);
        }
    }
    
    
   

    public function edit_gateway_payu() {
        $activedata = array(
            "activemain" => "payment",
            "displayblock" => "payment",
            "activeclass" => "payment_setting"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->PaymentModel->get_getway_by_id($id);
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("payment/edit_gateway_payu", $data);
    }

    public function edit_gateway_cc_avenue() {
        $activedata = array(
            "activemain" => "payment",
            "displayblock" => "payment",
            "activeclass" => "payment_setting"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->PaymentModel->get_getway_by_id($id);
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("payment/edit_gateway_cc_avenue", $data);
    }

   
    


    
    public function update_getway() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('guserid', 'Getway User ID', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("payment/edit_getway", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

               if($this->input->post('status') == ""){
                    $service_provider = "";
               } else{
                    $service_provider = $this->input->post('service_provider');
                  }
                

                $data34 = array(
                    'dsapayg_status' => $this->input->post('status'),
                    "dsapayg_display_name" => $this->input->post('getway_display_name'),
                    "dsapayg_gateway_user_id" => $this->input->post('guserid'),
                    // "dsapayg_gateway_password" => $this->input->post('gpassword'),
                    // "dsapayg_gateway_key" => $this->input->post('getwaykey'),
                    'dsapayg_user_type' => "DSA",
                    "dsapayg_user_id" => $bp_updated_by,
                    // "dsapayg_gateway_merchant_key" => $this->input->post('g_merchant_key'),
                    // "dsapayg_gateway_salt_key" => $this->input->post('g_salt'),
                    "dsapayg_b2b_b2c" => $this->input->post('sitetype'),
                    "dsapayg_convenience_fee" => $this->input->post('g_convenience_fee'),   
                    "dsapayg_service_provider" => $service_provider, 
                    "dsapayg_type" => $this->input->post('gateway_type'),  
                  
                );
                $id = bp_hash($this->input->post('ref_id'));
                $this->PaymentModel->update_getway_data("dsa_payment_gateway", $data34, $id);
                $this->session->set_flashdata("alert", array(
                    "message" => "Getway  Successfully Updated",
                    "class" => "alert-success"
                ));
                redirect("payment/payment_setting");
            }
        } else {
            $this->load->view("payment/edit_getway", $data);
        }
    }
    
      public function update_getway_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "dsapayg_status" => $this->input->get("status"),
        );
        $this->PaymentModel->update_getway_data("dsa_payment_gateway", $data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "Getway status Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("payment/payment_setting");
    }
    
        public function deletegetway() {

        $id = url_decode($this->input->get("getway_id"));

        $data = $this->PaymentModel->delete("dsa_payment_gateway", array("dsapayg_id" => $id));
        redirect("payment/payment_setting");
    }

    
}
