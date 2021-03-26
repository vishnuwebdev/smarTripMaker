<?php

class Visa extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('VisaModel');
        $this->model_name = "VisaModel";
    }

    public function index() {
        echo "Access Forbidden";
    }

    public function visa_list() {
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
        $total_row = $this->db->from("visa_list")->count_all_results();
        $pagination_segment = 3;
        $per_page = 10;
        $pagination_url = base_url() . "visa/visa_list/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
		
        $result = $this->VisaModel->visa_list($config ["per_page"], $page, $bp_user_id = null);
        $data ['result'] = $result;
        $this->load->view("visa/visa_list", $data);
    }
    
    public function visa_location() {
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
        $total_row = $this->db->from("location")->count_all_results();
        $pagination_segment = 3;
        $per_page = 20;
        
        $pagination_url = base_url() . "visa/visa_location/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
        
        $result = $this->VisaModel->visa_location($config ["per_page"], $page);
        $data ['result'] = $result;
        $this->load->view("visa/visa_location", $data);
    }
    
    public function update_visa_location_status(){
        $id = url_decode($this->input->get("ref_id"));
        $status = $this->input->get("status");
        $data1 = array(
            "visa_status" => ($status == 'active') ? "1" : "0",
        );
        $this->VisaModel->update_visa_location_data("location", $data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "Visa Location Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("visa/visa_location");
    }

    public function add_visa() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
		
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('visa_title', 'Visa Title', 'required');
            $this->form_validation->set_rules('country_id', 'Visa Location', 'required');
            $this->form_validation->set_rules('visa_amount', 'Visa Amount', 'required');
            $this->form_validation->set_rules('visa_duration', 'Visa Duration', 'required');
            if ($this->form_validation->run() == FALSE) {
				$cat = $this->VisaModel->select_info("location", array('location_status' => "active"));
				$options = '';
				if ($cat) {
					$options = array('' => 'Select Location...');
					foreach ($cat as $row) {
						$name = $row['location_location'];
						$id = $row['location_id'];
						$options[$id] = $name;
					}
				}
				$data['location'] = array(
					'name' => 'country_id',
					'id' => 'country_id',
					'data-md-selectize' => '',
					'options' => $options,
					'class' => "form-control",
					'selected' =>$this->form_validation->set_value('country_id'),
				);
				
                $this->load->view("visa/add_visa", $data);
            } else {

                $data = array(
                    'visa_title' 	=> $this->input->post('visa_title'),
                    "visa_amount" 	=> $this->input->post('visa_amount'),
                    "duration" 	=> $this->input->post('visa_duration'),
                    "country_id" 	=> $this->input->post('country_id'),
					'visa_status' 	=> $this->input->post('status'),
                );
                $this->VisaModel->insert_data("visa_list", $data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Visa Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("visa/visa_list");
            }
        } else {
			
			$cat = $this->VisaModel->select_info("location", array('location_status' => "active"));
			$options = '';
			if ($cat) {
				$options = array('' => 'Select Location...');
				foreach ($cat as $row) {
					$name = $row['location_location'];
					$id = $row['location_id'];
					$options[$id] = $name;
				}
			}
			$data['location'] = array(
				'name' => 'country_id',
				'id' => 'country_id',
				'data-md-selectize' => '',
				'options' => $options,
				'class' => "form-control",
				'selected' =>$this->form_validation->set_value('country_id'),
			);

            $this->load->view("visa/add_visa", $data);
        }
    }

    public function edit_visa() {

        $activedata = array(
            "activemain" => "menu",
            "displayblock" => "menu",
            "activeclass" => "menu_list"
        );
        $id = url_decode($this->input->get("ref_id"));
		
        $result = $this->VisaModel->get_visa_by_id($id);
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
		
		$cat = $this->VisaModel->select_info("location", array('location_status' => "active"));
		$options = '';
		if ($cat) {
			$options = array('' => 'Select Location...');
			foreach ($cat as $row) {
				$name = $row['location_location'];
				$id = $row['location_id'];
				$options[$id] = $name;
			}
		}
		$data['location'] = array(
			'name' => 'country_id',
			'id' => 'country_id',
			'data-md-selectize' => '',
			'options' => $options,
			'class' => "form-control",
			'selected' =>$this->form_validation->set_value('country_id', $result->country_id),
		);
			
        $this->load->view("visa/edit_visa", $data);
    }

    public function update_visa() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('visa_title', 'Visa Title', 'required');
            $this->form_validation->set_rules('country_id', 'Visa Location', 'required');
            $this->form_validation->set_rules('visa_amount', 'Visa Amount', 'required');
            $this->form_validation->set_rules('visa_duration', 'Visa Duration', 'required');
           
			if ($this->form_validation->run() == FALSE) {
				$cat = $this->VisaModel->select_info("location", array('location_status' => "active"));
				$options = '';
				if ($cat) {
					$options = array('' => 'Select Location...');
					foreach ($cat as $row) {
						$name = $row['location_location'];
						$id = $row['location_id'];
						$options[$id] = $name;
					}
				}
				$data['location'] = array(
					'name' => 'country_id',
					'id' => 'country_id',
					'data-md-selectize' => '',
					'options' => $options,
					'class' => "form-control",
					'selected' =>$this->form_validation->set_value('country_id'),
				);
				
                $this->load->view("visa/edit_visa", $data);
            } else {

                $data = array(
                    'visa_title' 	=> $this->input->post('visa_title'),
                    "visa_amount" 	=> $this->input->post('visa_amount'),
                    "duration" 	=> $this->input->post('visa_duration'),
                    "country_id" 	=> $this->input->post('country_id'),
					'visa_status' 	=> $this->input->post('status'),
                );

				$id = bp_hash($this->input->post('id'));
                $this->VisaModel->update_visa_data("visa_list", $data, $id);
                $this->session->set_flashdata("alert", array(
                    "message" => "Visa Successfully Updated",
                    "class" => "alert-success"
                ));
                redirect("visa/visa_list");
            }
        } else {
            $this->load->view("visa/edit_visa", $data);
        }
    }

    public function update_visa_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "visa_status" => $this->input->get("status"),
        );
        $this->VisaModel->update_visa_data("visa_list", $data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "Visa Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("visa/visa_list");
    }

    public function deletevisa() {

        $id = url_decode($this->input->get("id"));

        $data = $this->VisaModel->delete("visa_list", array("id" => $id));
        redirect("visa/visa_list");
    }
}
