<?php

class Coupon extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('CouponModel');
    }

    public function allcoupon() {
        $activedata = array(
            "activemain" => "coupon",
            "displayblock" => "coupon",
            "activeclass" => "allcouponlist"
        );
        $dsa_id = $this->dsa_data->dsa_id;
        $data ["activedata"] = $activedata;
        $pages = $this->CouponModel->getAllCoupon($dsa_id);
        $data ["result"] = $pages;

        $this->load->view("coupon/allcoupon", $data);
    }

    function add_coupon() {

        $activedata = array(
            "activemain" => "coupon",
            "displayblock" => "coupon",
            "activeclass" => "coupon/add_coupon"
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('coupon_amount', 'coupon amount', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("coupon/allcoupon", $data);
            } else {
                
                if($this->input->post('coupon_amount_type') == "percent" && $this->input->post('coupon_amount') > 100 ){
                   
                    $this->session->set_flashdata("alert", array(
                    "message" => "Please add amount value.",
                    "class" => "alert-danger"
                ));
                redirect("coupon/allcoupon");
                    
                }else{
                    
                }
                $bp_updated_by = $this->dsa_data->dsa_id;
                
                
                $data = array(
                    'coupon_status' => "inactive",
                    'coupon_amount' => $this->input->post('coupon_amount'),
                    'coupon_amount_type' => $this->input->post('coupon_amount_type'),
                    "coupon_code" => $this->input->post('coupon_no'),
                    "coupon_start_date" => $this->input->post('start_date'),
                    'coupon_end_date' => $this->input->post('expiry_date'),
                    "coupon_use_limit" => $this->input->post('coupon_use_limit'),
                    'coupon_user_type' => "DSA",
                    'coupon_remark'=>$this->input->post('coupon_remark'),
                    "coupon_user_id" => $bp_updated_by
                );
                $this->CouponModel->insert_coupon_data($data);
                $this->session->set_flashdata("alert", array(
                    "message" => "coupon Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("coupon/allcoupon");
            }
        } else {
            
        }
    }

    public function update_coupon_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "coupon_status" => $this->input->get("status"),
        );
        $this->CouponModel->update_coupon_date($data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "coupon Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("coupon/allcoupon");
    }

    public function deletecoupon() {

        $id = url_decode($this->input->get("coupon_id"));

        $data = $this->CouponModel->deleteCoupon($id);
        redirect("coupon/allcoupon");
    }



   

}
