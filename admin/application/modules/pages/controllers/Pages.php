<?php

class Pages extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('PageModel');
    }

    public function index() {
        $activedata = array(
            "activemain" => "sitesettingdisplay",
            "displayblock" => "sitesettingdisplay",
            "activeclass" => "pages/allpage_list"
        );
        $dsa_id = $this->dsa_data->dsa_id;
        $data ["activedata"] = $activedata;
        $pages = $this->PageModel->getAllpages($dsa_id);
        $data ["result"] = $pages;

        $this->load->view("pages/all_pages_list", $data);
    }

    function add_new_page() {

        $activedata = array(
            "activemain" => "sitesettingdisplay",
            "displayblock" => "sitesettingdisplay",
            "activeclass" => "pages/add_new_page"
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('page_title', 'Page Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("pages/add_new_page", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;
                if ($_FILES['userfile']['error'] > 0) {
                    $bp_image_name = "";
                } else {
                    $image_data1 = $this->PageModel->do_upload();
                    $bp_image_name = $image_data1 ['file_name'];
                }
                
                $data = array(
                    'page_status' => $this->input->post('page_status'),
                    'page_title' => $this->input->post('page_title'),
                    'page_desc' => $this->input->post('page_detail'),
                    "page_slug" => $this->input->post('page_slug'),
                    "page_meta_title" => $this->input->post('meta_title'),
                    'page_meta_desc' => $this->input->post('meta_description'),
                    "page_meta_keyword" => $this->input->post('meta_keyword'),
                	"page_language" => $this->input->post('page_language'),
                    'page_image' => $bp_image_name,
                    'page_user_type' => "DSA",
                    "page_user_id" => $bp_updated_by
                );
                $this->PageModel->insert_page_data($data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Page Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("pages");
            }
        } else {
            $this->load->view("pages/add_new_page", $data);
        }
    }

    public function update_page_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "page_status" => $this->input->get("status"),
        );
        $this->PageModel->update_page_date($data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "page Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("pages");
    }

    public function deletepage() {

        $id = url_decode($this->input->get("page_id"));

        $data = $this->PageModel->deletePage($id);
        redirect("pages");
    }

    public function editpage() {

        $activedata = array(
           "activemain" => "sitesettingdisplay",
            "displayblock" => "sitesettingdisplay",
            "activeclass" => "pages/allpage_list"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->PageModel->get_page_by_id($id);
        $dsa_id = $this->dsa_data->dsa_id;
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("pages/editpage", $data);
    }

    public function edit_page() {
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {

         //   print_r($_POST);
         //   die;
            $this->form_validation->set_rules('page_title', 'Page title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("pages/editpage", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;
                if ($_FILES['userfile']['error'] > 0) {
                    $bp_image_name = $this->input->post ( 'page_image' );
                } else {
                    $image_data1 = $this->PageModel->do_upload();
                    $bp_image_name = $image_data1 ['file_name'];
                }
               
                $data = array (
                'page_status' => $this->input->post ( 'page_status' ),
                'page_title' => $this->input->post ( 'page_title' ),
                'page_desc' => $this->input->post ( 'page_detail' ),
                "page_slug" => $this->input->post ( 'page_slug' ),
                "page_meta_title" => $this->input->post ( 'meta_title' ),
                'page_meta_desc' => $this->input->post ( 'meta_description' ),
                "page_meta_keyword" => $this->input->post ( 'meta_keyword' ),
                "page_language" => $this->input->post ( 'page_language' ),
                'page_image' => $bp_image_name,
                'page_user_type' => "DSA",
                "page_user_id" => $bp_updated_by
                );
               
                $id = bp_hash($this->input->post('id'));
                $this->PageModel->update_page_date($data, $id);
                $this->session->set_flashdata("alert", array(
                    "message" => "page  Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("pages");
            }
        } else {
            $this->load->view("pages/edit_page", $data);
        }
    }

}
