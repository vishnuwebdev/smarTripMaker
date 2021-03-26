<?php

class Testimonial extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('TestimonialModel');
        $this->model_name = "TestimonialModel";
    }

   
    public function testimonial_list() {
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
        $this->db->where("testimo_user_type", "DSA");
        $this->db->where("testimo_user_id", $bp_user_id);
        $total_row = $this->db->from("testimonial")->count_all_results();
        $pagination_segment = 3;
        $per_page = 10;
        $pagination_url = base_url() . "menu/menu_list/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
        $result = $this->TestimonialModel->testimonial_list($config ["per_page"], $page, $bp_user_id);
        $data ['result'] = $result;
        //print_r($data);
        $this->load->view("testimonial/testimonial_list", $data);
        //$this->load->view ("menu/menu_list",$data);
    }

    public function add_testimonial() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('testimonial_name', 'Name', 'required');
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
             $this->form_validation->set_rules('designation', 'Designation', 'required');
              $this->form_validation->set_rules('description', 'Description', 'required');
               $this->form_validation->set_rules('email', 'Email Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("testimonial/add_testimonial", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'testimo_status' => $this->input->post('status'),
                    'testimo_name' => $this->input->post('testimonial_name'),
                    "testimo_comment" => $this->input->post('description'),
                    "testimo_phone" => $this->input->post('phone'),
                    "testimo_email" => $this->input->post('email'),
                    "testimo_designation" => $this->input->post('designation'),
                    "testimo_company" => $this->input->post('company_name'),
                     "testimo_language" => $this->input->post('language'),
                    "testimo_star" => $this->input->post('star'),
                    "testimo_site_type" => $this->input->post('testimositetype'),
                    'testimo_user_type' => "DSA",
                    "testimo_user_id" => $bp_updated_by
                );
                $this->TestimonialModel->insert_data("testimonial", $data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Menu  Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("testimonial/testimonial_list");
            }
        } else {
            $this->load->view("testimonial/add_testimonial", $data);
        }
    }

    public function edit_testimonial() {

        $activedata = array(
            "activemain" => "testimonial",
            "displayblock" => "testimonial",
            "activeclass" => "testimonial_list"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->TestimonialModel->get_testimo_by_id($id);
        //print_r($result);
        //die;
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("testimonial/edit_testimonial", $data);
    }

    public function update_testimonial() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
               $this->form_validation->set_rules('testimonial_name', 'Name', 'required');
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
             $this->form_validation->set_rules('designation', 'Designation', 'required');
              $this->form_validation->set_rules('description', 'Description', 'required');
               $this->form_validation->set_rules('email', 'Email Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("testimonial/add_testimonial", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                 $data = array(
                    'testimo_status' => $this->input->post('status'),
                    'testimo_name' => $this->input->post('testimonial_name'),
                    "testimo_comment" => $this->input->post('description'),
                    "testimo_phone" => $this->input->post('phone'),
                    "testimo_email" => $this->input->post('email'),
                    "testimo_designation" => $this->input->post('designation'),
                    "testimo_company" => $this->input->post('company_name'),
                     "testimo_language" => $this->input->post('language'),
                    "testimo_star" => $this->input->post('star'),
                    "testimo_site_type" => $this->input->post('testimositetype'),
                    'testimo_user_type' => "DSA",
                    "testimo_user_id" => $bp_updated_by
                );
                $id = url_decode($this->input->post('ref_id'));
                // print_r($id);
                // die;
                $this->TestimonialModel->update_testimo_data("testimonial", $data, $id);
                $this->session->set_flashdata("alert", array(
                    "message" => "testimonial  Successfully Updated",
                    "class" => "alert-success"
                ));
                redirect("testimonial/testimonial_list");
            }
        } else {
            $this->load->view("testimonial/add_testimonial", $data);
        }
    }

    public function update_testimonial_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "testimo_status" => $this->input->get("status"),
        );
        $this->TestimonialModel->update_testimo_data("testimonial", $data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "Testimonial Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("testimonial/testimonial_list");
    }

    public function deletetestimo() {

        $id = url_decode($this->input->get("testimo_id"));

        $data = $this->TestimonialModel->delete("testimonial", array("testimo_id" => $id));
        redirect("testimonial/testimonial_list");
    }

    
   
     
    
    
}
