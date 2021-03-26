<?php

class Menu extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('MenuModel');
        $this->model_name = "MenuModel";
    }

    public function index() {
        redirect("flight/booking_list");
    }

    public function menu_list() {
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
        $this->db->where("menu_user_type", "DSA");
        $this->db->where("menu_user_id", $bp_user_id);
        $total_row = $this->db->from("menu")->count_all_results();
        $pagination_segment = 3;
        $per_page = 10;
        $pagination_url = base_url() . "menu/menu_list/";
        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);
        $this->pagination->initialize($config);
        $result = $this->MenuModel->menu_list($config ["per_page"], $page, $bp_user_id);
        $data ['result'] = $result;
        $this->load->view("menu/menu_list", $data);
        //$this->load->view ("menu/menu_list",$data);
    }

    public function add_menu() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
            $this->form_validation->set_rules('menu_title', 'Menu Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("menu/add_menu", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'menu_status' => $this->input->post('status'),
                    'menu_name' => $this->input->post('menu_name'),
                    "menu_slug" => $this->input->post('menu_slug'),
                    "menu_title" => $this->input->post('menu_title'),
                    "menu_order" => $this->input->post('order'),
                    "menu_language" => $this->input->post('language'),
                    'menu_user_type' => "DSA",
                    "menu_user_id" => $bp_updated_by,
                    "menu_type" => $this->input->post('menu_type'),
                    "menu_site_type" => $this->input->post('menusitetype')
                );
                $this->MenuModel->insert_data("menu", $data);
                $this->session->set_flashdata("alert", array(
                    "message" => "Menu  Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("menu/menu_list");
            }
        } else {
            $this->load->view("menu/add_menu", $data);
        }
    }

    public function edit_menu() {

        $activedata = array(
            "activemain" => "menu",
            "displayblock" => "menu",
            "activeclass" => "menu_list"
        );
        $id = url_decode($this->input->get("ref_id"));
        $result = $this->MenuModel->get_menu_by_id($id);
        //print_r($result);
        //die;
        $data ['result'] = $result;
        $data["activedata"] = $activedata;
        $this->load->view("menu/edit_menu", $data);
    }

    public function update_menu() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );
        $data ["activedata"] = $activedata;
        $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
            $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
            $this->form_validation->set_rules('menu_title', 'Menu Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("menu/add_menu", $data);
            } else {
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'menu_status' => $this->input->post('status'),
                    'menu_name' => $this->input->post('menu_name'),
                    "menu_slug" => $this->input->post('menu_slug'),
                    "menu_title" => $this->input->post('menu_title'),
                    "menu_order" => $this->input->post('order'),
                    "menu_language" => $this->input->post('language'),
                    'menu_user_type' => "DSA",
                    "menu_user_id" => $bp_updated_by,
                    "menu_site_type" => $this->input->post('menusitetype'),
                     "menu_type" => $this->input->post('menu_type')
                    
                        
                );
               // print_r( $data ); exit;
                $id = bp_hash($this->input->post('id'));
                $this->MenuModel->update_menu_data("menu", $data, $id);
                $this->session->set_flashdata("alert", array(
                    "message" => "Menu  Successfully Added",
                    "class" => "alert-success"
                ));
                redirect("menu/menu_list");
            }
        } else {
            $this->load->view("menu/add_menu", $data);
        }
    }

    public function update_menu_status() {
        $id = url_decode($this->input->get("ref_id"));
        $data1 = array(
            "menu_status" => $this->input->get("status"),
        );
        $this->MenuModel->update_menu_data("menu", $data1, $id);
        $this->session->set_flashdata("alert", array(
            "message" => "Menu Successfully Updated",
            "class" => "alert-success"
        ));
        redirect("menu/menu_list");
    }

    public function deletemenu() {

        $id = url_decode($this->input->get("menu_id"));

        $data = $this->MenuModel->delete("menu", array("menu_id" => $id));
        redirect("menu/menu_list");
    }

    public function manegeMenu() {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2")
        );

        $data ["activedata"] = $activedata;
        $id = url_decode($this->input->get("menu_id"));

        $getmenudata = $this->MenuModel->get_table_row("*", array("menu_id" => $id, "menu_user_type" => "DSA", "menu_user_id" => $this->dsa_data->dsa_id), "menu");
$data["menuData"] = $getmenudata;
        $allpages = $this->MenuModel->get_table_result("page_id,page_slug,page_title,page_language", 
      array("page_user_type" => "DSA",
            "page_user_id" => $this->dsa_data->dsa_id,
            "page_language" => $getmenudata->menu_language),
            "pages"
        );
        $menupages = $this->MenuModel->get_table_result("*", 
      array("menupage_user_type" => "DSA",
            "menupage_user_id" => $this->dsa_data->dsa_id,
            "menupage_language" => $getmenudata->menu_language,
            "menupage_menu_id"  =>   $id),
            
            "menu_page"
        );
        $data["menupages"] = $menupages;
        $data["allpages"] = $allpages;
        // print_r($getmenudata);
        // die;
        $this->load->view("menu/manege_menu", $data);
    }
    
    public function add_to_menu_ajax(){
        
             $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
           
            
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'menupage_status' => "active",
                    'menupage_menu_id' => $this->input->post('menuID'),
                    "menupage_page_id" => $this->input->post('pageID'),
                    "menupage_page_title" => $this->input->post('pageTitle'),
                    "menupage_page_display_title" => $this->input->post('pageDisplayTitle'),
                     "menupage_page_slug" => $this->input->post('pageSlug'),
                    "menupage_order" => $this->input->post('pageOrder'),
                    "menupage_language" => $this->input->post('pageLanguage'),
                    'menupage_user_type' => "DSA",
                    "menupage_user_id" => $bp_updated_by,
                    "menupage_menu_type" => $this->input->post('menuType'),
                    "menupage_menu_target" => $this->input->post('menuTarget')
                );
                $menudata["menudata"] = $data;
                $inserid = $this->MenuModel->insert_data_menu("menu_page", $data);
                $menudata["menupageid"] = $inserid;
                $menudata["menuType"] = $this->input->post('menuType');
                $this->load->view("menu/add_to_menu_ajax", $menudata);
                
           
        } else {
            $this->load->view("menu/add_to_menu_ajax", $data);
        }
        
    }
      public function add_custom_menu_ajax(){
        
             $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
           
            
                $bp_updated_by = $this->dsa_data->dsa_id;

                $data = array(
                    'menupage_status' => "active",
                    'menupage_menu_id' => $this->input->post('menuID'),
                    "menupage_page_display_title" => $this->input->post('pageDisplayTitle'),
                    "menupage_page_slug" => $this->input->post('pageSlug'),
                    "menupage_order" => $this->input->post('pageOrder'),
                    "menupage_language" => $this->input->post('pageLanguage'),
                    "menupage_page_title" => $this->input->post('pageDisplayTitle'),
                    'menupage_user_type' => "DSA",
                    "menupage_user_id" => $bp_updated_by,
                    "menupage_menu_type" => $this->input->post('menuType'),
                    "menupage_menu_target" => $this->input->post('menuTarget')
                       
                );
                $menudata["menudata"] = $data;
                $inserid = $this->MenuModel->insert_data_menu("menu_page", $data);
                $menudata["menupageid"] = $inserid;
                $menudata["menuType"] = $this->input->post('menuType');
                $this->load->view("menu/add_to_menu_ajax", $menudata);
                
           
        } else {
            $this->load->view("menu/add_to_menu_ajax", $data);
        }
        
    }
    
     public function update_menu_ajax(){
        
             $request_type = $this->input->server("REQUEST_METHOD");
        if ($request_type == "POST") {
           
            
                $bp_updated_by = $this->dsa_data->dsa_id;
if($this->input->post('menuType')=="custom"){

                 $data = array(
                    "menupage_page_slug" => $this->input->post('customLink'),
                    "menupage_page_display_title" => $this->input->post('pageDisplayTitle'),
                    "menupage_menu_target" => $this->input->post('menuTarget'), 
                    "menupage_order" => $this->input->post('pageOrder'),
                   
                );
    
                   }else{
                $data = array(
                   
                    "menupage_page_display_title" => $this->input->post('pageDisplayTitle'),
                    "menupage_menu_target" => $this->input->post('menuTarget'),
                    "menupage_order" => $this->input->post('pageOrder'),
                   
                );
                   }
                $id = $this->input->post('menupageID');
                $menudata["menudata"] = $data;
                $inserid = $this->MenuModel->update_menu_page_data("menu_page", $data,$id);
                 $datamsg["status"] = "success";
                 $datamsg["massege"]= "successfully updated";
                 echo json_encode($datamsg);
           
        } else {
            
        }
        
    }
    public function delete_menu_page_ajax(){
	
		$id = $this->input->post ( "menupageID" );
	
	    $data = $this->MenuModel->delete("menu_page",array("menupage_id"=>$id));
		$datamsg["status"] = "success";
                 $datamsg["massege"]= "successfully deleted";
                 echo json_encode($datamsg);
	}

}
