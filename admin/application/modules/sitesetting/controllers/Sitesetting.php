<?php
class Sitesetting extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'SiteSettingModel' );
	}
	public function social_link() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$id = $this->dsa_data->dsa_id;
		$request_method = $this->input->server ( "REQUEST_METHOD" );
		if ($request_method == "POST") {
			$bp_social_data = serialize ( $_POST );
			$data_2 = array (
					'dsafd_social_links' => $bp_social_data 
			);
			$this->Common_Model->update_table ( "dsafd_dsa_id", $id, "dsa_front_data", $data_2 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
		}
		$result = $this->Common_Model->get_table ( "*", "dsafd_dsa_id", $id, "dsa_front_data" );
		if ($result == "0") {
			$data_1 = array (
					'dsafd_dsa_id' => $id,
			);
			$this->Common_Model->insert_table ( "dsa_front_data", $data_1 );
			$result = $this->Common_Model->get_table ( "*", "dsafd_dsa_id", $id, "dsa_front_data" );
		}
		if ($result->dsafd_social_links != "") {
			$bp_socail_unserilaze_data = unserialize ( $result->dsafd_social_links );
		} else {
			$bp_socail_unserilaze_data = "not";
		}
		$data ['result'] = $bp_socail_unserilaze_data;
		$this->load->view ( "social_links", $data );
	}
	
	public function add_offer_image() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = "";
			} else {
				$image_data1 = $this->SiteSettingModel->do_upload_offer ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					'hos_image' => $bp_image_name,
					'hos_title' => $this->input->post ( 'title' ),
					"hos_url" => $this->input->post ( 'url' ),
			);
			$this->Common_Model->insert_table ( "home_offer_slider", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Added",
					"class" => "alert-success" 
			) );
			redirect ( 'sitesetting/offer_images' );
		} else {
			
			$this->load->view ( "sitesetting/add_offer_image", $data );
		}
		// $this->load->view('add_slider_image',$data);
	}
	
	public function offer_images() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesetting/offer_images",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		
		$data ["activedata"] = $activedata;
		
		
		$bp_iamges = $this->SiteSettingModel->get_offer_images ();
		$data ['bp_iamges'] = $bp_iamges;
		
		$this->load->view ( 'offer_images', $data );
	}
	
	public function delete_offer_image() {
		$id = url_decode ( $this->input->get ( "sliimg_id" ) );
		$data = $this->SiteSettingModel->deleteSliderofferImage ( $id );
		redirect ( "sitesetting/offer_images" );
	}
	
	public function edit_offer_image() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		
		$image_id = url_decode ( $this->input->get ( "image_id" ) );
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			// $bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = $this->input->post ( 'image' );
			} else {
				$image_data1 = $this->SiteSettingModel->do_upload_offer ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					'hos_image' => $bp_image_name,
					'hos_title' => $this->input->post ( 'title' ),
					"hos_url" => $this->input->post ( 'url' ),
					
			);
			
			// $where = array("sliimg_id"=>$image_id);
			$table = "home_offer_slider";
			$where_1_name = "hos_id";
			$where_1_value = $image_id;
			$where_2_name = "hos_id";
			$where_2_value = $image_id;
			$where_3_name = "hos_id";
			$where_3_value = $image_id;
			$this->Common_Model->update_table_dsa ( $where_1_name, $where_1_value, $where_2_name, $where_2_value, $where_3_name, $where_3_value, $table, $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Updated",
					"class" => "alert-success" 
			) );
			redirect ( "sitesetting/offer_images" );
		} else {
			
			$table = "home_offer_slider";
			$where_1_name = "hos_id";
			$where_1_value = $image_id;
			$where_2_name = "hos_id";
			$where_2_value = $image_id;
			$bp_image = $this->Common_Model->get_table_dsa ( $where_1_name, $where_1_value, $where_2_name, $where_2_value, $table );
			$data ['bp_image'] = $bp_image;
			// $data ['id'] = $id;
			$this->load->view ( "sitesetting/edit_offer_image", $data );
		}
	}
	
	
	public function index() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$id = $this->dsa_data->dsa_id;
		$result = $this->SiteSettingModel->get_website_by_id ( $id );
		$data ['result'] = $result;
		$dsa_setting = $this->Common_Model->get_full_table_by_dsa ( "*", "dsaset_user_id", $id, "dsa_setting" );
		$data ['dsa_setting'] = $dsa_setting;
		$data ["activedata"] = $activedata;
		$this->load->view ( "siteSetting", $data );
	}
	public function edit_setting_detail() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_method = $this->input->server ( "REQUEST_METHOD" );
		if ($request_method == "POST") {
			$data_1 = array (
					'dsaset_address_1' => $this->input->post ( "address" ),
					'dsaset_city' => $this->input->post ( "city" ),
					'dsaset_state' => $this->input->post ( "state" ),
					'dsaset_country' => $this->input->post ( "country" ),
					'dsaset_pincode' => $this->input->post ( "pincode" ),
					'dsaset_meta_title' => $this->input->post ( "meta_title" ),
					'dsaset_meta_desc' => $this->input->post ( "meta_description" ),
					'dsaset_meta_keyword' => $this->input->post ( "meta_keyword" ),
					'dsaset_phone' => $this->input->post ( "phone" ),
					'dsaset_email' => $this->input->post ( "email" ),
					'dsaset_news' => $this->input->post ( "news_flash" ),
					'dsaset_sms_signature' => $this->input->post ( "sms_signature" ),
					'dsaset_header' => $this->input->post ( "header_html" ),
					'dsaset_footer' => $this->input->post ( "footer_html" ),
					'dsaset_css' => $this->input->post ( "custom_css" ), 
					'welcome_wallet_balance' => $this->input->post ( "welcome_wallet_balance" ), 
					'detected_wallet_percentage' => $this->input->post ( "detected_wallet_percentage" ) 
			);
			
			// print_r($data_1["dsaset_header"]);
			// die;
			$this->Common_Model->update_table ( "dsaset_id", $id, "dsa_setting", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
			redirect ( "sitesetting" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "dsaset_id", $id, "dsa_setting" );
			$data ['result'] = $result;
			$this->load->view ( "edit_setting", $data );
		}
	}
	public function upload_website_logo() {
		$request_method = $this->input->server ( "REQUEST_METHOD" );
		
		if ($request_method == "POST") {
			if ($_FILES ['userfile'] ['error'] > 0) {
				$this->session->set_flashdata ( "alert", array (
						"message" => $this->lang->line ( "validation_error" ),
						"class" => "alert-danger" 
				) );
				redirect ( "sitesetting" );
			} else {
				$image_data1 = $this->SiteSettingModel->upload_logo ();
				$data = array (
						'dsa_logo' => $image_data1 ['file_name'] 
				);
				
				$this->SiteSettingModel->update_website_data ( $data, $this->dsa_data->dsa_id );
				$this->session->set_flashdata ( "alert", array (
						"message" => $this->lang->line ( "successfully_updated" ),
						"class" => "alert-success" 
				) );
				redirect ( "sitesetting" );
			}
		} else {
			redirect ( "dashboard" );
		}
	}
	public function upload_website_fevicon() {
		$request_method = $this->input->server ( "REQUEST_METHOD" );
		
		if ($request_method == "POST") {
			if ($_FILES ['userfile'] ['error'] > 0) {
				$this->session->set_flashdata ( "alert", array (
						"message" => "Please select a valid fevicon file",
						"class" => "alert-danger" 
				) );
				redirect ( "sitesetting" );
			} else {
				$image_data1 = $this->SiteSettingModel->upload_fevicon ();
				$data = array (
						'dsa_fab' => $image_data1 ['file_name'] 
				);
				
				$this->SiteSettingModel->update_website_data ( $data, $this->dsa_data->dsa_id );
				$this->session->set_flashdata ( "alert", array (
						"message" => "fevicon Successfully Updated",
						"class" => "alert-success" 
				) );
				redirect ( "sitesetting" );
			}
		} else {
			redirect ( "dashboard" );
		}
	}
	function editdetails() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$id = url_decode ( $this->input->get ( "dsa_id" ) );
		$result = $this->SiteSettingModel->get_website_by_id ( $id );
		$data ['result'] = $result;
		$data ["activedata"] = $activedata;
		$this->load->view ( "editDetail", $data );
	}
	public function update_website_detail() {
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			// $details = serialize ( $this->input->post () );
			$data = array (
					"dsa_meta_title" => $this->input->post ( "site_title" ),
					"dsa_meta_desc" => $this->input->post ( "site_meta_description" ),
					"dsa_meta_keyword" => $this->input->post ( "site_meta_keywords" ) 
			);
			$this->SiteSettingModel->update_website_data ( $data, $this->input->post ( 'id' ) );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Website data successfully updated",
					"class" => "alert-success" 
			) );
			redirect ( "sitesetting/editdetails/?dsa_id=" . url_encode ( $this->input->post ( 'id' ) ) );
		} else {
			redirect ( "sitesetting" );
		}
	}
	function cussupport() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		$result = $this->SiteSettingModel->get_website_by_id ( $this->dsa_data->dsa_id );
		$data ['result'] = $result;
		
		$this->load->view ( "cusSupport", $data );
	}
	public function update_support_detail() {
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			// $details = serialize ( $this->input->post () );
			$data = array (
					"dsa_support_email" => $this->input->post ( "support_email" ),
					"dsa_support_mobile" => $this->input->post ( "support_mobile" ),
					"dsa_city" => $this->input->post ( "support_city" ),
					"dsa_state" => $this->input->post ( "support_state" ),
					"dsa_country" => $this->input->post ( "support_country" ),
					"dsa_zip" => $this->input->post ( "support_zip_code" ),
					"dsa_address" => $this->input->post ( "support_address" ),
					"dsa_copy_right" => $this->input->post ( "support_copy_right" ) 
			);
			$this->SiteSettingModel->update_website_data ( $data, $this->input->post ( 'id' ) );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Website data successfully updated",
					"class" => "alert-success" 
			) );
			redirect ( "sitesetting/cussupport" );
		} else {
			redirect ( "sitesetting" );
		}
	}
	public function add_slider_image() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			// $bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = "";
			} else {
				$image_data1 = $this->SiteSettingModel->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					'sliimg_slider_id' => "0",
					'sliimg_image' => $bp_image_name,
					'sliimg_title' => $this->input->post ( 'title' ),
					"sliimg_alt" => $this->input->post ( 'alt' ),
					'sliimg_detail' => $this->input->post ( 'detail' ),
					'sliimg_status' => $this->input->post ( 'status' ),
					'sliimg_dsa_type' => "DSA",
					'sliimg_slider_module' => $this->input->post ( 'module' ),
					"sliimg_dsa_id" => $bp_updated_by 
			);
			$this->Common_Model->insert_table ( "slider_image", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Added",
					"class" => "alert-success" 
			) );
			redirect ( 'sitesetting/slider_images' );
		} else {
			
			$this->load->view ( "sitesetting/add_slider_image", $data );
		}
		// $this->load->view('add_slider_image',$data);
	}
	public function slider_images() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesetting/slider_images",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		
		$data ["activedata"] = $activedata;
		
		$where = array (
				'sliimg_dsa_id' => $this->dsa_data->dsa_id,
				'sliimg_dsa_type' => "DSA" 
		);
		$bp_iamges = $this->SiteSettingModel->get_slider_images ( $where );
		$data ['bp_iamges'] = $bp_iamges;
		// $result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
		// $data ['result'] = $result;
		// $data ['id'] = $id;
		// $this->load->view ( $this->uri->segment ( "1" ) . "/tour_images", $data );
		// print_r($data);
		// die;
		$this->load->view ( 'slider_images', $data );
	}
	public function edit_slider_image() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		
		$image_id = url_decode ( $this->input->get ( "image_id" ) );
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			// $bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = $this->input->post ( 'image' );
			} else {
				$image_data1 = $this->SiteSettingModel->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					
					'sliimg_image' => $bp_image_name,
					'sliimg_title' => $this->input->post ( 'title' ),
					"sliimg_alt" => $this->input->post ( 'alt' ),
					'sliimg_detail' => $this->input->post ( 'detail' ),
					'sliimg_status' => $this->input->post ( 'status' ),
					'sliimg_slider_module' => $this->input->post ( 'module' )
					
			);
			
			// $where = array("sliimg_id"=>$image_id);
			$table = "slider_image";
			$where_1_name = "sliimg_dsa_type";
			$where_1_value = "DSA";
			$where_2_name = "sliimg_dsa_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "sliimg_id";
			$where_3_value = $image_id;
			$this->Common_Model->update_table_dsa ( $where_1_name, $where_1_value, $where_2_name, $where_2_value, $where_3_name, $where_3_value, $table, $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Updated",
					"class" => "alert-success" 
			) );
			redirect ( "sitesetting/slider_images" );
		} else {
			
			$table = "slider_image";
			$where_1_name = "sliimg_id";
			$where_1_value = $image_id;
			$where_2_name = "sliimg_dsa_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_image = $this->Common_Model->get_table_dsa ( $where_1_name, $where_1_value, $where_2_name, $where_2_value, $table );
			$data ['bp_image'] = $bp_image;
			// $data ['id'] = $id;
			$this->load->view ( "sitesetting/edit_slider_image", $data );
		}
	}
	public function update_slider_img_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"sliimg_status" => $this->input->get ( "status" ) 
		);
		// print_r($id);
		// die;
		$this->SiteSettingModel->update_sliderimg_status ( $data1, $id );
		$this->session->set_flashdata ( "alert", array (
				"message" => "coupon Successfully Updated",
				"class" => "alert-success" 
		) );
		redirect ( "sitesetting/slider_images" );
	}
	public function delete_slider_image() {
		$id = url_decode ( $this->input->get ( "sliimg_id" ) );
		$data = $this->SiteSettingModel->deleteSliderImage ( $id );
		redirect ( "sitesetting/slider_images" );
	}
	public function location_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$table = "location";
		$where_1_name = "location_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "location_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "location_id";
		$bp_template_name = "location_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 50;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function add_location() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_country = explode ( "___", $this->input->post ( 'country' ) );
			$bp_country_code = $bp_country ['0'];
			$bp_country_name = $bp_country ['1'];
			$data_1 = array (
					'location_location' => $this->input->post ( 'location' ),
					'location_country_code' => $bp_country_code,
					'location_country_name' => $bp_country_name,
					"location_latitude" => $this->input->post ( 'latitude' ),
					'location_longitude' => $this->input->post ( 'longitude' ),
					'location_language' => $this->input->post ( 'language' ),
					'location_status' => "active",
					'location_user_type' => "DSA",
					"location_user_id" => $bp_updated_by 
			);
			$this->Common_Model->insert_table ( "location", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( $this->uri->segment ( "1" ) . "/location_list" );
		} else {
			$country = $this->Common_Model->get_full_table ( "country_list" );
			$data ['country'] = $country;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_location", $data );
		}
	}
	public function update_location_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"location_status" => $this->input->get ( "status" ) 
		);
		$this->Common_Model->update_table ( "location_id", $id, "location", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_updated" ),
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/location_list" );
	}
	public function edit_location_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_country = explode ( "___", $this->input->post ( 'country' ) );
			$bp_country_code = $bp_country ['0'];
			$bp_country_name = $bp_country ['1'];
			$data_1 = array (
					'location_location' => $this->input->post ( 'location' ),
					'location_country_code' => $bp_country_code,
					'location_country_name' => $bp_country_name,
					"location_latitude" => $this->input->post ( 'latitude' ),
					'location_longitude' => $this->input->post ( 'longitude' ),
					'location_language' => $this->input->post ( 'language' ),
					'location_status' => "active",
					'location_user_type' => "DSA",
					"location_user_id" => $bp_updated_by 
			);
			$this->Common_Model->update_table ( "location_id", $id, "location", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
			redirect ( $this->uri->segment ( "1" ) . "/location_list" );
		} else {
			$country = $this->Common_Model->get_full_table ( "country_list" );
			$data ['country'] = $country;
			$location = $this->Common_Model->get_table ( "*", "location_id", $id, "location" );
			$data ['location'] = $location;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_location", $data );
		}
	}
	public function delete_location() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "location_id", $id, "location" );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_deleted" ),
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/location_list" );
	}
	
	public function prom_text() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesetting/prom_images",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		$data ["activedata"] = $activedata;
		$where = array (
				'promtxt_dsa_id' =>$this->dsa_data->dsa_id,
			
		);
		$bp_iamges = $this->SiteSettingModel->get_prom_text ( $where );
		$data ['bp_iamges'] = $bp_iamges;

	
		$this->load->view (  $this->uri->segment ( "1" ) .'/prom_text_list', $data );
	}
	
	public function add_prom_text() {
		$activedata = array (
				"displayblock" => "sitesettingdisplay",
				"activeclass" => "sitesettingli",
				"activemain" => "setting" 
		);
		$data ["activedata"] = $activedata;
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by= $this->dsa_data->dsa_id;
			$data_1 = array (
					'promtxt_title' => $this->input->post ( 'title' ),
					'promtxt_detail' => $this->input->post ( 'detail' ),
					'promtxt_status' => $this->input->post ( 'status' ),
					'promtxt_dsa_type' => "DSA",
					"promtxt_dsa_id" => $bp_updated_by,
					"promtxt_align" => $this->input->post ( 'position' ) 
			);
			$this->Common_Model->insert_table ( "promotion_text", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Added",
					"class" => "alert-success" 
			) );
			redirect (  $this->uri->segment ( "1" ) .'/prom_text' );
		} else {
			
			$this->load->view (  $this->uri->segment ( "1" ) ."/add_prom_image", $data );
		}
		// $this->load->view('add_slider_image',$data);
	}

	public function update_prom_text_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"promtxt_status" => $this->input->get ( "status" ) 
		);
		$this->Common_Model->update_table ( "promtxt_id", $id, "promotion_text", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => " Successfully Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) .'/prom_text' );
	}

	public function delete_prom_text() {
		$id = url_decode ( $this->input->get ( "prom_id" ) );
		$this->Common_Model->delete_table ( "promtxt_id", $id, "promotion_text" );
		$this->session->set_flashdata ( "alert", array (
			"message" => $this->lang->line ( "successfully_deleted" ),
			"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) .'/prom_text' );
	}

	public function edit_prom_text() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		
		$image_id = url_decode ( $this->input->get ( "text_id" ) );
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'promtxt_title' => $this->input->post ( 'title' ),
					'promtxt_detail' => $this->input->post ( 'detail' ),
					'promtxt_status' => $this->input->post ( 'status' ),
					"promtxt_align" => $this->input->post ( 'position' )  
			);

			$this->Common_Model->update_table ( "promtxt_id", $image_id, "promotion_text", $data_1 );	
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Updated",
					"class" => "alert-success" 
			) );
			redirect ( $this->uri->segment ( "1" ) ."/prom_text" );
		} else {
			
			$table = "promotion_text";
			$where_1_name = "promtxt_id";
			$where_1_value = $image_id;
			$where_2_name = "promtxt_dsa_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_image = $this->Common_Model->get_table_dsa ( $where_1_name, $where_1_value, $where_2_name, $where_2_value, $table );
			$data ['bp_image'] = $bp_image;

			$this->load->view ( $this->uri->segment ( "1" ) ."/edit_prom_image", $data );
		}
	}

}
