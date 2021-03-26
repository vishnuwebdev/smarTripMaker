<?php
class Holiday extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'Holiday_Model' );
		$this->model_name = "Holiday_Model";
	}
	public function index() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) 
		);
		$data ["activedata"] = $activedata;
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday";
		$where_1_name = "holiday_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holiday_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holiday_id";
		$bp_template_name = "package_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 30;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function holiday_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday";
		$where_1_name = "holiday_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holiday_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holiday_id";
		$bp_template_name = "full_package_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 20;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function delete_image() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$image_id = url_decode ( $this->input->get ( "image_id" ) );
		$data = $this->Common_Model->delete_table ( "holimg_id", $image_id, "holiday_image" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Image Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" )."/tour_images/?ref_id=".url_encode($id));
	}
	public function edit_image_detail(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$image_id = url_decode ( $this->input->get ( "image_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = $this->input->post ( 'image' );
			} else {
				$image_data1 = $this->$bp_model_name->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					'holimg_holiday_id' => $id,
					'holimg_image' => $bp_image_name,
					'holimg_title' => $this->input->post ( 'title' ),
					"holimg_alt" => $this->input->post ( 'alt' ),
					'holimg_detail' => $this->input->post ( 'detail' ),
					'holimg_status' => $this->input->post ( 'status' ),
			);
			$table = "holiday_image";
			$where_1_name = "holimg_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holimg_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "holimg_id";
			$where_3_value = $image_id;
			$this->Common_Model->update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Updated",
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/tour_images/?ref_id=".url_encode($id));
		} else {
			$table = "holiday_image";
			$where_1_name = "holimg_id";
			$where_1_value = $image_id;
			$where_2_name = "holimg_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_image=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_image']=$bp_image;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_tour_image", $data );
		}
	}
	public function update_package_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holiday_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holiday_id", $id, "holiday", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Package Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" ));
	}
	public function update_image_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$image_id = url_decode ( $this->input->get ( "image_id" ) );
		$data1 = array (
				"holimg_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holimg_id", $image_id, "holiday_image", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Image Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" )."/tour_images/?ref_id=".url_encode($id));
	}
	public function add_package_images(){
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
			$bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = "";
			} else {
				$image_data1 = $this->$bp_model_name->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$data_1 = array (
					'holimg_holiday_id' => $id,
					'holimg_image' => $bp_image_name,
					'holimg_title' => $this->input->post ( 'title' ),
					"holimg_alt" => $this->input->post ( 'alt' ),
					'holimg_detail' => $this->input->post ( 'detail' ),
					'holimg_status' => $this->input->post ( 'status' ),
					'holimg_user_type' => "DSA",
					"holimg_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_image", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Image Successfully Added",
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/tour_images/?ref_id=".url_encode($id));
		} else {
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_tour_image", $data );
		}
	}
	public function delete_itinerary() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$itineray_id = url_decode ( $this->input->get ( "itinerary_id" ) );
		$data = $this->Common_Model->delete_table ( "holiti_id", $itineray_id, "holiday_itinerary" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Itinerary Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" )."/tour_itinerary/?ref_id=".url_encode($id));
	}
	public function tour_images(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
				redirect();
		} else {
			$table = "holiday_image";
			$where_1_name = "holimg_holiday_id";
			$where_1_value = $id;
			$where_2_name = "holimg_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_iamges=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_iamges']=$bp_iamges;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/tour_images", $data );
		}
	}
	public function tour_itinerary(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			redirect();
		} else {
			$table = "holiday_itinerary";
			$where_1_name = "holiti_holiday_id";
			$where_1_value = $id;
			$where_2_name = "holiti_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_itinerary=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_itinerary']=$bp_itinerary;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/tour_itinerary", $data );
		}
	}
	public function edit_itinerary_detail(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$itineray_id = url_decode ( $this->input->get ( "itinerary_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_model_name = $this->model_name;
			$bp_meal="";
			if(isset($_POST['meal'])){
				foreach($_POST['meal'] as $bp){
					if($bp_meal==""){
						$bp_meal=$bp;
					}else{
						$bp_meal=$bp_meal.",".$bp;
					}
				}
			}
			$data_1 = array (
					'holiti_holiday_id' => $id,
					'holiti_name' => $this->input->post ( 'name' ),
					'holiti_title' => $this->input->post ( 'title' ),
					"holiti_meal" => $bp_meal ,
					'holiti_detail' => $this->input->post ( 'detail' ),
					'holiti_remark' => $this->input->post ( 'remark' ),
			);
			$table = "holiday_itinerary";
			$where_1_name = "holiti_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holiti_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "holiti_id";
			$where_3_value = $itineray_id;
			$this->Common_Model->update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Itinerary Successfully Updated",
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/tour_itinerary/?ref_id=".url_encode($id));
		} else {
			// $table = "holiday_meal";
			// $where_1_name = "holmeal_user_type";
			// $where_1_value = "DSA";
			// $where_2_name = "holmeal_user_id";
			// $where_2_value = $this->dsa_data->dsa_id;
			// $bp_meal=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			// $data['bp_meal']=$bp_meal;
			
			$table = "holiday_itinerary";
			$where_1_name = "holiti_id";
			$where_1_value = $itineray_id;
			$where_2_name = "holiti_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_itinerary=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_itinerary']=$bp_itinerary;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_tour_itinerary", $data );
		}
	}
	public function add_package_itinerary(){
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
			$bp_model_name = $this->model_name;
			$bp_meal="";
			if(isset($_POST['meal'])){
				foreach($_POST['meal'] as $bp){
					if($bp_meal==""){
						$bp_meal=$bp;
					}else{
						$bp_meal=$bp_meal.",".$bp;
					}
				}
			}
			$data_1 = array (
					'holiti_holiday_id' => $id,
					'holiti_name' => $this->input->post ( 'name' ),
					'holiti_title' => $this->input->post ( 'title' ),
					//"holiti_meal" => $bp_meal ,
					'holiti_detail' => $this->input->post ( 'detail' ),
					'holiti_remark' => $this->input->post ( 'remark' ),
					'holiti_user_type' => "DSA",
					"holiti_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_itinerary", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/tour_itinerary/?ref_id=".url_encode($id));
		} else {
			// $table = "holiday_meal";
			// $where_1_name = "holmeal_user_type";
			// $where_1_value = "DSA";
			// $where_2_name = "holmeal_user_id";
			// $where_2_value = $this->dsa_data->dsa_id;
			// $bp_meal=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			// $data['bp_meal']=$bp_meal;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_tour_itinerary", $data );
		}
	}


	public function edit_package_detail(){
		
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
			$bp_model_name = $this->model_name;
			$bp_room_amenity="";
			$bp_category_id="";
			$bp_category_name="";
			if(isset($_POST['amenity'])){
				foreach($_POST['amenity'] as $bp){
					if($bp_room_amenity==""){
						$bp_room_amenity=$bp;
					}else{
						$bp_room_amenity=$bp_room_amenity.",".$bp;
					}
				}
			}
			if(isset($_POST['category'])){
				foreach($_POST['category'] as $bp){
					if($bp_category_id==""){
						$bp_cat=explode("---", $bp);
						$bp_category_id=$bp_cat[0];
						$bp_category_name=$bp_cat[1];
					}else{
						$bp_cat=explode("---", $bp);
						$bp_category_id=$bp_category_id.",".$bp_cat[0];
						$bp_category_name=$bp_category_name.",".$bp_cat[1];
					}
				}
			}
			$bp_locations="";
			if(isset($_POST['location'])){
				foreach($_POST['location'] as $bp){
					if($bp_locations==""){
						$bp_locations=$bp;
					}else{
						$bp_locations=$bp_locations.",".$bp;
					}
				}
			}
			$bp_sub_category="";
			if(isset($_POST['sub_category'])){
				foreach($_POST['sub_category'] as $bp){
					if($bp_sub_category==""){
						$bp_sub_category=$bp;
					}else{
						$bp_sub_category=$bp_sub_category.",".$bp;
					}
				}
			}
			if($_FILES['userfile']['error']>0){
				$bp_image_name=$this->input->post ( 'package_image' );
			}else{
				$image_data1=$this->$bp_model_name->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$bp_sunday_monday="";
			if(isset($_POST['sunday_monday'])){
				foreach($_POST['sunday_monday'] as $bp){
					if($bp_sunday_monday==""){
						$bp_sunday_monday=$bp;
					}else{
						$bp_sunday_monday=$bp_sunday_monday.",".$bp;
					}
				}
			}
			$bp_pick_up_location="";
			if(isset($_POST['pick_up_location'])){
				foreach($_POST['pick_up_location'] as $bp){
					if($bp_pick_up_location==""){
						$bp_pick_up_location=$bp;
					}else{
						$bp_pick_up_location=$bp_pick_up_location.",".$bp;
					}
				}
			}
                        
                        $pickup_hotel = "";
                        if($this->input->post("pick_hotel") != NULL) {
                         $pickup_hotel = implode(",", $this->input->post("pick_hotel"));
                        }
                        if(isset($_POST['multi_lan'])){
                        $multilang = serialize($this->input->post("multi_lan"));
                              }else{
                               $multilang="";   
                              }
                        
                       // PrintArray($multilang);
                       // die;
			$data_1 = array (
					'holiday_name' => $this->input->post ( 'name' ),
					'holiday_slug' => $this->input->post ( 'slug' ),
					'search_keyword' => $this->input->post ( 'search_keyword' ),
					'holiday_start_price' => $this->input->post ( 'price' ),
					'holiday_rating' => $this->input->post ( 'rating' ),
					'holiday_night' => $this->input->post ( 'night' ),
					'holiday_city_route' => $this->input->post ( 'route' ),
					'holiday_category_id' => $bp_category_id,
					'holiday_category_name' => $bp_category_name,
					'holiday_hotel' => $pickup_hotel,
					'holiday_room_type' => $this->input->post ( 'room' ),
					"holiday_room_amenity" => $bp_room_amenity ,
					'holiday_short_description' => $this->input->post ( 'short_desc' ),
					'holiday_long_description' => $this->input->post ( 'long_desc' ),
					'holiday_language' => $this->input->post ( 'language' ),
					'holiday_is_featured' => $this->input->post ( 'featured' ),
					'holiday_location' => $bp_locations,
					'holiday_sub_category_id' => $bp_sub_category,
					"holiday_feature_image" => $bp_image_name,
					'holiday_user_type' => "DSA",
					"holiday_user_id" => $bp_updated_by,
					//'holiday_max_pax_allowed' => $this->input->post ( 'max_pax_allowed' ),
					'holiday_adult_price' => $this->input->post ( 'adult_fare' ),
					'holiday_child_price' => $this->input->post ( 'child_fare' ),
					'holiday_infant_price' => $this->input->post ( 'infant_fare' ),
					//'holiday_youtube_video_link' => $this->input->post ( 'package_youtube_link' ),
					//'holiday_noof_booking_today' => $this->input->post ( 'package_today_booking' ),
					
			);
			$table = "holiday";
			$where_1_name = "holiday_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holiday_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "holiday_id";
			$where_3_value = $id;
			$this->Common_Model->update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/edit_package_detail/?ref_id=".url_encode($id));
		} else {
			$table = "holiday_hotel_extra";
			$where_1_name = "hohex_user_type";
			$where_1_value = "DSA";
			$where_2_name = "hohex_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_hotel_extra=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_hotel_extra']=$bp_hotel_extra;
			$table = "holiday_category";
			$where_1_name = "holcat_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holcat_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_package_category=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_package_category']=$bp_package_category;
			$table = "holiday_hotel";
			$where_1_name = "holhot_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holhot_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_package_hotel=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_package_hotel']=$bp_package_hotel;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$table = "location";
			$where_1_name = "location_status";
			$where_1_value = "active";
			$where_2_name = "location_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_location=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_location']=$bp_location;
			$table = "holiday_sub_category";
			$where_1_name = "holsubc_status";
			$where_1_value = "active";
			$where_2_name = "holsubc_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_sub_category=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_sub_category']=$bp_sub_category;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_package", $data );
		}
	}

	
	public function inclusion_exclusion(){
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
			$bp_model_name = $this->model_name;
			$holiday_inclusion="";
			$holiday_exclusion="";
			if(isset($_POST['inclusion'])){
				foreach($_POST['inclusion'] as $bp){
					if($holiday_inclusion==""){
						$holiday_inclusion=$bp;
					}else{
						$holiday_inclusion=$holiday_inclusion.",".$bp;
					}
				}
			}
		   if(isset($_POST['exclusion'])){
				foreach($_POST['exclusion'] as $bp){
					if($holiday_exclusion==""){
						$holiday_exclusion=$bp;
					}else{
						$holiday_exclusion=$holiday_exclusion.",".$bp;
					}
				}
			}
			$data_1 = array (
					'holiday_inclusion' => $holiday_inclusion,
					'holiday_exclusion' => $holiday_exclusion
			);
			$table = "holiday";
			$where_1_name = "holiday_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holiday_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "holiday_id";
			$where_3_value = $id;
			$this->Common_Model->update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Package Successfully Updated",
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/inclusion_exclusion/?ref_id=".url_encode($id));
		} else {
			$table = "holiday_inclusion";
			$where_1_name = "holinc_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holinc_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_inclusion=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_inclusion']=$bp_inclusion;
			$table = "holiday_exclusion";
			$where_1_name = "holexc_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holexc_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_exclusion=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_exclusion']=$bp_exclusion;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/inclusion_exclusion", $data );
		}
	}
	public function tour_extra(){
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
			$bp_model_name = $this->model_name;
			$data_1 = array (
					'holiday_contact' => $this->input->post("contact"),
					'holiday_meta_title' => $this->input->post("meta_title"),
					'holiday_meta_keyword' => $this->input->post("meta_keyword"),
					'holiday_meta_description' => $this->input->post("meta_desc"),
					'holiday_policy' => $this->input->post("policy"),
					'holiday_transport' => $this->input->post("transport"),
					'holiday_additional_info' => $this->input->post("addition_info"),
					'holiday_how_to_book' => $this->input->post("how_to_book"),
			);
			$table = "holiday";
			$where_1_name = "holiday_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holiday_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$where_3_name = "holiday_id";
			$where_3_value = $id;
			$this->Common_Model->update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Package Successfully Updated",
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/tour_extra/?ref_id=".url_encode($id));
		} else {
			$table = "holiday_contact_detail";
			$where_1_name = "holcond_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holcond_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_contact=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_contact']=$bp_contact;
			$result = $this->Common_Model->get_table ( "*", "holiday_id", $id, "holiday" );
			$data ['result'] = $result;
			$data ['id'] = $id;
			$this->load->view ( $this->uri->segment ( "1" ) . "/tour_extra", $data );
		}
	}
	public function category_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday_category";
		$where_1_name = "holcat_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holcat_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holcat_id";
		$bp_template_name = "category_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function sub_category_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday_sub_category";
		$where_1_name = "holsubc_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holsubc_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holsubc_id";
		$bp_template_name = "sub_category_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 100;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function add_category() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/add_category" 
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_model_name = $this->model_name;
			// if ($_FILES ['userfile'] ['error'] > 0) {
				// $bp_image_name = "";
			// } else {
				// $image_data1 = $this->$bp_model_name->do_upload ();
				// $bp_image_name = $image_data1 ['file_name'];
			// }
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data = array (
					'holcat_name' => $this->input->post ( 'name' ),
					'holcat_status' => $this->input->post ( 'status' ),
					//'holcat_language' => $this->input->post ( 'language' ),
					//"holcat_start_price" => $this->input->post ( 'start_price' ),
					//"holcat_order" => $this->input->post ( 'order' ),
					//'holcat_image' => $bp_image_name,
					"holcat_insert_by" => $bp_updated_by . ', admin',
					'holcat_user_type' => "DSA",
					"holcat_user_id" => $bp_updated_by 
			);
			$this->$bp_model_name->insert_blog_category ( $data );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( "holiday/category_list" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_new_category", $data );
		}
	}
	public function add_sub_category() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/".$this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = "";
			} else {
				$image_data1 = $this->$bp_model_name->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holsubc_name' => $this->input->post ( 'name' ),
					'holsubc_status' => $this->input->post ( 'status' ),
					//"holsubc_start_price" => $this->input->post ( 'start_price' ),
					"holsubc_parent_catrgory" => $this->input->post ( 'parent_category' ),
					//"holsubc_language" => $this->input->post ( 'language' ),
					// "holsubc_order" => $this->input->post ( 'order' ),
					 'holsubc_image' => $bp_image_name,
					"holsubc_insert_by" => $bp_updated_by . ', admin',
					'holsubc_user_type' => "DSA",
					"holsubc_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table("holiday_sub_category",$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( "holiday/sub_category_list" );
		} else {
			$type="holcat_user_type";
			$type_val="DSA";
			$user_id="holcat_user_id";
			$id=$this->dsa_data->dsa_id;
			$table="holiday_category";
			$data['category_list']=$this->Common_Model->get_table_dsa($type,$type_val,$user_id,$id,$table);
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_new_sub_category", $data );
		}
	}
	public function update_category_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holcat_status" => $this->input->get ( "status" ) 
		);
		$this->Common_Model->update_table ( "holcat_id", $id, "holiday_category", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Category Successfully Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/category_list" );
	}
	public function update_sub_category_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holsubc_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holsubc_id", $id, "holiday_sub_category", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Sub Category Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/sub_category_list" );
	}
	public function deletecategory() {
		$id = url_decode ( $this->input->get ( "cat_id" ) );
		$data = $this->Common_Model->delete_table ( "holcat_id", $id, "holiday_category" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Category Deleted Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/category_list" );
	}
	public function delete_sub_category() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holsubc_id", $id, "holiday_sub_category" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Category Deleted Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/sub_category_list" );
	}
	public function edit_category_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_model_name = $this->model_name;
			// if ($_FILES ['userfile'] ['error'] > 0) {
				// $bp_image_name = $this->input->post ( 'holcat_image' );
			// } else {
				// $image_data1 = $this->$bp_model_name->do_upload ();
				// $bp_image_name = $image_data1 ['file_name'];
			// }
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data = array (
					'holcat_name' => $this->input->post ( 'name' ),
					'holcat_status' => $this->input->post ( 'status' ),
					//"holcat_start_price" => $this->input->post ( 'start_price' ),
					//"holcat_language" => $this->input->post ( 'language' )
					// "holcat_order" => $this->input->post ( 'order' ),
					// 'holcat_image' => $bp_image_name 
			);
			$this->Common_Model->update_table ( "holcat_id", $id, "holiday_category", $data );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
			redirect ( "holiday/category_list" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holcat_id", $id, "holiday_category" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_category", $data );
		}
	}
	public function edit_sub_category_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_model_name = $this->model_name;
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = $this->input->post ( 'holsubc_image' );
			} else {
				$image_data1 = $this->$bp_model_name->do_upload ();
				$bp_image_name = $image_data1 ['file_name'];
			}
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data = array (
					'holsubc_name' => $this->input->post ( 'name' ),
					'holsubc_status' => $this->input->post ( 'status' ),
					//"holsubc_start_price" => $this->input->post ( 'start_price' ),
					"holsubc_parent_catrgory" => $this->input->post ( 'parent_category' ),
					//"holsubc_language" => $this->input->post ( 'language' ),
					// "holsubc_order" => $this->input->post ( 'order' ),
					 'holsubc_image' => $bp_image_name,
					"holsubc_insert_by" => $bp_updated_by . ', admin',
					'holsubc_user_type' => "DSA",
					"holsubc_user_id" => $bp_updated_by
			);
			$this->Common_Model->update_table ( "holsubc_id", $id, "holiday_sub_category", $data );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( "holiday/sub_category_list" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holsubc_id", $id, "holiday_sub_category" );
			$data ['result'] = $result;
			$type="holcat_user_type";
			$type_val="DSA";
			$user_id="holcat_user_id";
			$id=$this->dsa_data->dsa_id;
			$table="holiday_category";
			$data['category_list']=$this->Common_Model->get_table_dsa($type,$type_val,$user_id,$id,$table);
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_sub_category", $data );
		}
	}
	public function add_inclusion() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holinc_status' => $this->input->post ( 'status' ),
					'holinc_name' => $this->input->post ( 'name' ),
					//"holinc_detail" => $this->input->post ( 'detail' ),
					"holinc_icon" => $this->input->post ( 'icon' ),
					//"holinc_language" => $this->input->post ( 'language' ),
					//'holinc_auto_select' => $this->input->post ( 'select' ),
					"holinc_updated_by" => $bp_updated_by . ', admin',
					'holinc_user_type' => "DSA",
					"holinc_user_id" => $bp_updated_by 
			);
			$this->Common_Model->insert_table ( "holiday_inclusion", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( $this->uri->segment ( "1" ) . "/inclusion_list" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_new_inclusion", $data );
		}
	}
	public function inclusion_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday_inclusion";
		$where_1_name = "holinc_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holinc_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holinc_id";
		$bp_template_name = "inclusion_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function update_inclusion_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holinc_status" => $this->input->get ( "status" ) 
		);
		$this->Common_Model->update_table ( "holinc_id", $id, "holiday_inclusion", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Inclusion Successfully Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/inclusion_list" );
	}
	public function edit_inclusion_detail() {
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
			$data_1 = array (
					'holinc_status' => $this->input->post ( 'status' ),
					'holinc_name' => $this->input->post ( 'name' ),
					//"holinc_detail" => $this->input->post ( 'detail' ),
					//"holinc_icon" => $this->input->post ( 'icon' ),
					//"holinc_language" => $this->input->post ( 'language' ),
					'holinc_auto_select' => $this->input->post ( 'select' ) 
			);
			$this->Common_Model->update_table ( "holinc_id", $id, "holiday_inclusion", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
			redirect ( "holiday/inclusion_list" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holinc_id", $id, "holiday_inclusion" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_inclusion", $data );
		}
	}
	public function delete_inclusion() {
		$id = url_decode ( $this->input->get ( "cat_id" ) );
		$data = $this->Common_Model->delete_table ( "holinc_id", $id, "holiday_inclusion" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Inclusion Deleted Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/inclusion_list" );
	}
	public function add_exclusion() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holexc_status' => $this->input->post ( 'status' ),
					'holexc_name' => $this->input->post ( 'name' ),
					//"holexc_detail" => $this->input->post ( 'detail' ),
					"holexc_icon" => $this->input->post ( 'icon' ),
					//"holexc_language" => $this->input->post ( 'language' ),
					//'holexc_auto_select' => $this->input->post ( 'select' ),
					"holexc_updated_by" => $bp_updated_by . ', admin',
					'holexc_user_type' => "DSA",
					"holexc_user_id" => $bp_updated_by 
			);
			$this->Common_Model->insert_table ( "holiday_exclusion", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( $this->uri->segment ( "1" ) . "/exclusion_list" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_new_exclusion", $data );
		}
	}
	public function exclusion_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "holiday_exclusion";
		$where_1_name = "holexc_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holexc_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holexc_id";
		$bp_template_name = "exclusion_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function update_exclusion_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holexc_status" => $this->input->get ( "status" ) 
		);
		$this->Common_Model->update_table ( "holexc_id", $id, "holiday_exclusion", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Exclusion Successfully Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/exclusion_list" );
	}
	public function edit_exclusion_detail() {
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
			$data_1 = array (
					'holexc_status' => $this->input->post ( 'status' ),
					'holexc_name' => $this->input->post ( 'name' ),
					//"holexc_detail" => $this->input->post ( 'detail' ),
					"holexc_icon" => $this->input->post ( 'icon' ),
					//"holexc_language" => $this->input->post ( 'language' ),
					//'holexc_auto_select' => $this->input->post ( 'select' ) 
			);
			$this->Common_Model->update_table ( "holexc_id", $id, "holiday_exclusion", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success" 
			) );
			redirect ( "holiday/exclusion_list" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holexc_id", $id, "holiday_exclusion" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_exclusion", $data );
		}
	}
	public function delete_exclusion() {
		$id = url_decode ( $this->input->get ( "cat_id" ) );
		$data = $this->Common_Model->delete_table ( "holexc_id", $id, "holiday_exclusion" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Exclusion Deleted Updated",
				"class" => "alert-success" 
		) );
		redirect ( $this->uri->segment ( "1" ) . "/exclusion_list" );
	}
	public function hotel_type() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$user_type = "DSA";
		$user_id = $this->dsa_data->dsa_id;
		$hotel_set_type="hotel_type";
		$bp_model_name = $this->model_name;
		$result = $this->$bp_model_name->hotel_setting_list ( $user_type, $user_id,$hotel_set_type );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/hotel_type_list", $data );
	}
	public function add_hotel_type() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_language' => $this->input->post ( 'language' ),
					"hohex_update_by" => $bp_updated_by . ', admin',
					'hohex_type' => "hotel_type",
					'hohex_user_type' => "DSA",
					"hohex_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_type" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_hotel_type", $data );
		}
	}
	public function update_hotel_type_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"hohex_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Hotel Type Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/hotel_type" );
	}
	public function edit_hotel_type_detail() {
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
			$data_1 = array (
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_language' => $this->input->post ( 'language' )
			);
			$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_type" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "hohex_id", $id, "holiday_hotel_extra" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_hotel_type", $data );
		}
	}
	public function delete_hotel_type() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "hohex_id", $id, "holiday_hotel_extra" );
		$this->session->set_flashdata ( "alert", array (
					"message" => "Request  Successfully updated",
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_type" );
	}
	public function hotel_amenity() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$user_type = "DSA";
		$user_id = $this->dsa_data->dsa_id;
		$hotel_set_type="hotel_amenity";
		$bp_model_name = $this->model_name;
		$result = $this->$bp_model_name->hotel_setting_list ( $user_type, $user_id,$hotel_set_type );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/hotel_amenity_list", $data );
	}
	public function add_hotel_amenity() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_icon' => $this->input->post ( 'icon' ),
					'hohex_language' => $this->input->post ( 'language' ),
					"hohex_update_by" => $bp_updated_by . ', admin',
					'hohex_type' => "hotel_amenity",
					'hohex_user_type' => "DSA",
					"hohex_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_amenity" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_hotel_amenity", $data );
		}
	}
	public function update_hotel_amenity_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"hohex_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Hotel Amenity Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/hotel_amenity" );
	}
	public function edit_hotel_amenity_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
			    "activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_icon' => $this->input->post ( 'icon' ),
					'hohex_language' => $this->input->post ( 'language' ),
			);
			$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_amenity" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "hohex_id", $id, "holiday_hotel_extra" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_hotel_amenity", $data );
		}
	}
	public function delete_hotel_amenity() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "hohex_id", $id, "holiday_hotel_extra" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/hotel_amenity" );
	}
	public function room_type() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				 "activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$user_type = "DSA";
		$user_id = $this->dsa_data->dsa_id;
		$hotel_set_type="room_type";
		$bp_model_name = $this->model_name;
		$result = $this->$bp_model_name->hotel_setting_list ( $user_type, $user_id,$hotel_set_type );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/room_type_list", $data );
	}
	public function add_room_type() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_language' => $this->input->post ( 'language' ),
					"hohex_update_by" => $bp_updated_by . ', admin',
					'hohex_type' => "room_type",
					'hohex_user_type' => "DSA",
					"hohex_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/room_type" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_room_type", $data );
		}
	}
	public function update_room_type_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"hohex_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "ROom Type Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/room_type" );
	}
	public function edit_room_type_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				 "activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_language' => $this->input->post ( 'language' )
			);
			$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/room_type" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "hohex_id", $id, "holiday_hotel_extra" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_room_type", $data );
		}
	}
	public function delete_room_type() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "hohex_id", $id, "holiday_hotel_extra" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/room_type" );
	}
	public function room_amenity() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$user_type = "DSA";
		$user_id = $this->dsa_data->dsa_id;
		$hotel_set_type="room_amenity";
		$bp_model_name = $this->model_name;
		$result = $this->$bp_model_name->hotel_setting_list ( $user_type, $user_id,$hotel_set_type );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/room_amenity_list", $data );
	}
	public function add_room_amenity() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_icon' => $this->input->post ( 'icon' ),
					'hohex_language' => $this->input->post ( 'language' ),
					"hohex_update_by" => $bp_updated_by . ', admin',
					'hohex_type' => "room_amenity",
					'hohex_user_type' => "DSA",
					"hohex_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/room_amenity" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_room_amenity", $data );
		}
	}
	public function update_room_amenity_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"hohex_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Room Amenity Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/room_amenity" );
	}
	public function edit_room_amenity_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_type"
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hohex_status' => $this->input->post ( 'status' ),
					'hohex_name' => $this->input->post ( 'name' ),
					'hohex_icon' => $this->input->post ( 'icon' ),
					'hohex_language' => $this->input->post ( 'language' ),
			);
			$this->Common_Model->update_table ( "hohex_id", $id, "holiday_hotel_extra", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/room_amenity" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "hohex_id", $id, "holiday_hotel_extra" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_room_amenity", $data );
		}
	}
	public function delete_room_amenity() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "hohex_id", $id, "holiday_hotel_extra" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/room_amenity" );
	}
	public function hotel_list() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$bp_amenity_list= $this->$bp_model_name->hotel_setting_list ( $bp_user_type, $bp_user_id,"hotel_amenity" );
		if($bp_amenity_list!="not"){
			foreach($bp_amenity_list as $bp){
				$bp_hotel_amenity[$bp->hohex_id]['name']=$bp->hohex_name;
				$bp_hotel_amenity[$bp->hohex_id]['icon']=$bp->hohex_icon;
			}
		}
		$bp_type_list= $this->$bp_model_name->hotel_setting_list ( $bp_user_type, $bp_user_id,"hotel_type" );
		if($bp_type_list!="not"){
			foreach($bp_type_list as $bp){
				$bp_hotel_type[$bp->hohex_id]['name']=$bp->hohex_name;
			}
		}
		$data ["bp_hotel_type"] = $bp_hotel_type;
		$data ["bp_hotel_amenity"] = $bp_hotel_amenity;
		$table = "holiday_hotel";
		$where_1_name = "holhot_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "holhot_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "holhot_id";
		$bp_template_name = "hotel_list";
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
	public function add_hotel() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" .$this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_model_name = $this->model_name;
			$bp_hotel_amenity="";
			if(isset($_POST['amenity'])){
				foreach($_POST['amenity'] as $bp){
					if($bp_hotel_amenity==""){
						$bp_hotel_amenity=$bp;
					}else{
						$bp_hotel_amenity=$bp_hotel_amenity.",".$bp;
					}
				}
			}
			if($_FILES['userfile']['error']>0){
				$bp_image_name="";
			}else{
				$image_data1=$this->$bp_model_name->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$data_1 = array (
					'holhot_status' => $this->input->post ( 'status' ),
					'holhot_name' => $this->input->post ( 'name' ),
					'holhot_hotel_type' => $this->input->post ( 'type' ),
					"holhot_hotel_amenity" => $bp_hotel_amenity ,
					'holhot_short_desc' => $this->input->post ( 'short_desc' ),
					'holhot_long_desc' => $this->input->post ( 'long_desc' ),
					'holhot_language' => $this->input->post ( 'language' ),
					'holhot_location' => $this->input->post ( 'location' ),
					"holhot_feture_image" => $bp_image_name,
					'holhot_user_type' => "DSA",
					"holhot_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_hotel", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/hotel_list" );
		} else {
			$table = "holiday_hotel_extra";
			$where_1_name = "hohex_user_type";
			$where_1_value = "DSA";
			$where_2_name = "hohex_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_hotel_extra=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_hotel_extra']=$bp_hotel_extra;
			$table = "location";
			$where_1_name = "location_status";
			$where_1_value = "active";
			$where_2_name = "location_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_location=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_location']=$bp_location;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_hotel", $data );
		}
	}
	public function update_hotel_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holhot_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holhot_id", $id, "holiday_hotel", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/hotel_list" );
	}
	public function edit_hotel_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/hotel_list"
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_model_name = $this->model_name;
			$bp_hotel_amenity="";
			if(isset($_POST['amenity'])){
				foreach($_POST['amenity'] as $bp){
					if($bp_hotel_amenity==""){
						$bp_hotel_amenity=$bp;
					}else{
						$bp_hotel_amenity=$bp_hotel_amenity.",".$bp;
					}
				}
			}
			if($_FILES['userfile']['error']>0){
				$bp_image_name=$this->input->post ( 'holhot_feture_image' );
			}else{
				$image_data1=$this->$bp_model_name->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$data_1 = array (
					'holhot_name' => $this->input->post ( 'name' ),
					'holhot_hotel_type' => $this->input->post ( 'type' ),
					"holhot_hotel_amenity" => $bp_hotel_amenity ,
					'holhot_short_desc' => $this->input->post ( 'short_desc' ),
					'holhot_long_desc' => $this->input->post ( 'long_desc' ),
					'holhot_language' => $this->input->post ( 'language' ),
					'holhot_location' => $this->input->post ( 'location' ),
					"holhot_feture_image" => $bp_image_name
			);
			$this->Common_Model->update_table ( "holhot_id", $id, "holiday_hotel", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/edit_hotel_detail/?ref_id=".url_encode($id));
		} else {
			$table = "holiday_hotel_extra";
			$where_1_name = "hohex_user_type";
			$where_1_value = "DSA";
			$where_2_name = "hohex_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_hotel_extra=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_hotel_extra']=$bp_hotel_extra;
			$result = $this->Common_Model->get_table ( "*", "holhot_id", $id, "holiday_hotel" );
			$data ['result'] = $result;
			$table = "location";
			$where_1_name = "location_status";
			$where_1_value = "active";
			$where_2_name = "location_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_location=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_location']=$bp_location;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_hotel", $data );
		}
	}
	public function delete_hotel() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holhot_id", $id, "holiday_hotel" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/hotel_list" );
	}
	public function payment_mode() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$type="holpaym_user_type";
		$type_val = "DSA";
		$user_id="holpaym_user_id";
		$id = $this->dsa_data->dsa_id;
		$table="holiday_payment_mode";
		$short_by="holpaym_id";
		$bp_model_name = $this->model_name;
		$result = $this->Common_Model->get_table_dsa_short($type,$type_val,$user_id,$id,$short_by,$table);
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/payment_mode_list", $data );
	}
	public function add_payment_mode() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holpaym_status' => $this->input->post ( 'status' ),
					'holpaym_name' => $this->input->post ( 'name' ),
					'holpaym_amount' => $this->input->post ( 'amount' ),
					"holpaym_amount_type" => "percentage",
					'holpaym_mode' => $this->input->post ( 'mode' ),
					'holpaym_language' => $this->input->post ( 'language' ),
					'holpaym_user_type' => "DSA",
					"holpaym_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_payment_mode", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/payment_mode" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_payment_mode", $data );
		}
	}
	public function update_payment_mode_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holpaym_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holpaym_id", $id, "holiday_payment_mode", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/payment_mode" );
	}
	public function edit_payment_mode_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) ."/".  $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holpaym_status' => $this->input->post ( 'status' ),
					'holpaym_name' => $this->input->post ( 'name' ),
					'holpaym_amount' => $this->input->post ( 'amount' ),
					'holpaym_mode' => $this->input->post ( 'mode' ),
					'holpaym_language' => $this->input->post ( 'language' ),
			);
			$this->Common_Model->update_table ( "holpaym_id", $id, "holiday_payment_mode", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/payment_mode" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holpaym_id", $id, "holiday_payment_mode" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_payment_mode", $data );
		}
	}
	public function delete_payment_mode() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holpaym_id", $id, "holiday_payment_mode" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/payment_mode" );
	}
	public function contact_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$type="holcond_user_type";
		$type_val = "DSA";
		$user_id="holcond_user_id";
		$id = $this->dsa_data->dsa_id;
		$table="holiday_contact_detail";
		$short_by="holcond_id";
		$bp_model_name = $this->model_name;
		$result = $this->Common_Model->get_table_dsa_short($type,$type_val,$user_id,$id,$short_by,$table);
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/contact_detail_list", $data );
	}
	public function add_contact_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holcond_status' => "active",
					'holcond_name' => $this->input->post ( 'name' ),
					'holcond_email' => $this->input->post ( 'email' ),
					'holcond_phone' => $this->input->post ( 'phone' ),
					'holcond_support_name' => $this->input->post ( 'service_name' ),
					'holcond_language' => $this->input->post ( 'language' ),
					'holcond_user_type' => "DSA",
					"holcond_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_contact_detail", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/contact_detail" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_contact_detail", $data );
		}
	}
	public function update_contact_detail_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holcond_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holcond_id", $id, "holiday_contact_detail", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/contact_detail" );
	}
	public function edit_contact_detail() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) ."/".  $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holcond_status' => "active",
					'holcond_name' => $this->input->post ( 'name' ),
					'holcond_email' => $this->input->post ( 'email' ),
					'holcond_phone' => $this->input->post ( 'phone' ),
					'holcond_language' => $this->input->post ( 'language' ),
					'holcond_support_name' => $this->input->post ( 'service_name' ),
			);
			$this->Common_Model->update_table ( "holcond_id", $id, "holiday_contact_detail", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/contact_detail" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holcond_id", $id, "holiday_contact_detail" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_contact_detail", $data );
		}
	}
	public function delete_contact_detail() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holcond_id", $id, "holiday_contact_detail" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/contact_detail" );
	}
	public function meal() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$type="holmeal_user_type";
		$type_val = "DSA";
		$user_id="holmeal_user_id";
		$id = $this->dsa_data->dsa_id;
		$table="holiday_meal";
		$short_by="holmeal_id";
		$bp_model_name = $this->model_name;
		$result = $this->Common_Model->get_table_dsa_short($type,$type_val,$user_id,$id,$short_by,$table);
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/meal_list", $data );
	}
	public function add_meal() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holmeal_status' => "active",
					'holmeal_meal_type' => $this->input->post ( 'type' ),
					'holmeal_meal_description' => $this->input->post ( 'desc' ),
					'holmeal_meal_name' => $this->input->post ( 'name' ),
					'holmeal_icon' => $this->input->post ( 'icon' ),
					'holmeal_language' => $this->input->post ( 'language' ),
					'holmeal_user_type' => "DSA",
					"holmeal_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "holiday_meal", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/meal" );
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_meal", $data );
		}
	}
	public function update_meal_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"holmeal_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "holmeal_id", $id, "holiday_meal", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/meal" );
	}
	public function edit_meal() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) ."/".  $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'holmeal_status' => "active",
					'holmeal_meal_type' => $this->input->post ( 'type' ),
					'holmeal_meal_description' => $this->input->post ( 'desc' ),
					'holmeal_meal_name' => $this->input->post ( 'name' ),
					'holmeal_language' => $this->input->post ( 'language' ),
					'holmeal_icon' => $this->input->post ( 'icon' )
			);
			$this->Common_Model->update_table ( "holmeal_id", $id, "holiday_meal", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_updated" ),
					"class" => "alert-success"
			) );
			redirect ( $this->uri->segment ( "1" ) . "/meal" );
		} else {
			$result = $this->Common_Model->get_table ( "*", "holmeal_id", $id, "holiday_meal" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_meal", $data );
		}
	}
	public function delete_meal() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holmeal_id", $id, "holiday_meal" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request  Successfully updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) . "/meal" );
	}
	public function add_package() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" .$this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
                    
                    
			
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_model_name = $this->model_name;
			$bp_room_amenity="";
			$bp_category_id="";
			$bp_category_name="";
			if(isset($_POST['amenity'])){
				foreach($_POST['amenity'] as $bp){
					if($bp_room_amenity==""){
						$bp_room_amenity=$bp;
					}else{
						$bp_room_amenity=$bp_room_amenity.",".$bp;
					}
				}
			}
			if(isset($_POST['category'])){
				foreach($_POST['category'] as $bp){
					if($bp_category_id==""){
						$bp_cat=explode("---", $bp);
						$bp_category_id=$bp_cat[0];
						$bp_category_name=$bp_cat[1];
					}else{
						$bp_cat=explode("---", $bp);
						$bp_category_id=$bp_category_id.",".$bp_cat[0];
						$bp_category_name=$bp_category_name.",".$bp_cat[1];
					}
				}
			}
			$bp_locations="";
			if(isset($_POST['location'])){
				foreach($_POST['location'] as $bp){
					if($bp_locations==""){
						$bp_locations=$bp;
					}else{
						$bp_locations=$bp_locations.",".$bp;
					}
				}
			}
			$bp_sub_category="";
			if(isset($_POST['sub_category'])){
				foreach($_POST['sub_category'] as $bp){
					if($bp_sub_category==""){
						$bp_sub_category=$bp;
					}else{
						$bp_sub_category=$bp_sub_category.",".$bp;
					}
				}
			}
			if($_FILES['userfile']['error']>0){
				$bp_image_name="";
			}else{
				$image_data1=$this->$bp_model_name->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$bp_sunday_monday="";
			if(isset($_POST['sunday_monday'])){
				foreach($_POST['sunday_monday'] as $bp){
					if($bp_sunday_monday==""){
						$bp_sunday_monday=$bp;
					}else{
						$bp_sunday_monday=$bp_sunday_monday.",".$bp;
					}
				}
			}
			$bp_pick_up_location="";
			if(isset($_POST['pick_up_location'])){
				foreach($_POST['pick_up_location'] as $bp){
					if($bp_pick_up_location==""){
						$bp_pick_up_location=$bp;
					}else{
						$bp_pick_up_location=$bp_pick_up_location.",".$bp;
					}
				}
			}
                        $pickup_hotel = "";
                        if($this->input->post("pick_hotel") != NULL){
                         $pickup_hotel = implode(",", $this->input->post("pick_hotel"));
                        }
                        
                         if(isset($_POST['multi_lan'])){
                        $multilang = serialize($this->input->post("multi_lan"));
                              }else{
                               $multilang="";   
                              }
			// PrintArray($_POST);
			// die;
			$data_1 = array (
					'holiday_status' => "inactive",
					'holiday_name' => $this->input->post ( 'name' ),
					'holiday_slug' => $this->input->post ( 'slug' ),
					'search_keyword' => $this->input->post ( 'search_keyword' ),
					'holiday_start_price' => $this->input->post ( 'price' ),
					'holiday_rating' => $this->input->post ( 'rating' ),
					'holiday_night' => $this->input->post ( 'night' ),
					//'holiday_city_route' => $this->input->post ( 'route' ),
					'holiday_category_id' => $bp_category_id,
					'holiday_category_name' => $bp_category_name,
					'holiday_hotel' => $pickup_hotel,
				//	'holiday_room_type' => $this->input->post ( 'room' ),
				//	"holiday_room_amenity" => $bp_room_amenity ,
					'holiday_short_description' => $this->input->post ( 'short_desc' ),
					'holiday_long_description' => $this->input->post ( 'long_desc' ),
					'holiday_language' => 'en',
					'holiday_is_featured' => $this->input->post ( 'featured' ),
					'holiday_location' => $bp_locations,
					'holiday_sub_category_id' => $bp_sub_category,
					"holiday_feature_image" => $bp_image_name,
					'holiday_user_type' => "DSA",
					"holiday_user_id" => $bp_updated_by,
					//'holiday_pickup_location' => $bp_pick_up_location,
				//	'holiday_sunday_monday' => $multilang,
				//	'holiday_max_pax_allowed' => $this->input->post ( 'max_pax_allowed' ),
					//'holiday_adult_price' => $this->input->post ( 'adult_fare' ),
				//	'holiday_child_price' => $this->input->post ( 'child_fare' ),
					//'holiday_infant_price' => $this->input->post ( 'infant_fare' ),
			);
			$this->Common_Model->insert_table ( "holiday", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" ));
		} else {
			$table = "holiday_hotel_extra";
			$where_1_name = "hohex_user_type";
			$where_1_value = "DSA";
			$where_2_name = "hohex_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_hotel_extra=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_hotel_extra']=$bp_hotel_extra;
			$table = "holiday_category";
			$where_1_name = "holcat_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holcat_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_package_category=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_package_category']=$bp_package_category;
			$table = "holiday_hotel";
			$where_1_name = "holhot_user_type";
			$where_1_value = "DSA";
			$where_2_name = "holhot_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_package_hotel=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_package_hotel']=$bp_package_hotel;
			$table = "location";
			$where_1_name = "location_status";
			$where_1_value = "active";
			$where_2_name = "location_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_location=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_location']=$bp_location;
			$table = "holiday_sub_category";
			$where_1_name = "holsubc_status";
			$where_1_value = "active";
			$where_2_name = "holsubc_user_id";
			$where_2_value = $this->dsa_data->dsa_id;
			$bp_sub_category=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
			$data['bp_sub_category']=$bp_sub_category;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_package", $data );
		}
	}
	public function delete_package() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "holiday_id", $id, "holiday" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Package Deleted Updated",
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" ) );
	}



	public function query() {
		$activedata = array(
			"activemain" => $this->uri->segment ( "1" ),
			"displayblock" => $this->uri->segment ( "1" ),
			"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		 );
		 $data["activedata"] = $activedata;
		 $user_type = "DSA";
		 $user_id = $this->dsa_data->dsa_id;
		 $result = $this->Holiday_Model->query_list($user_type, $user_id);
		 $data ['result'] = $result;

		 $this->load->view($this->uri->segment("1")."/query_list", $data);
	 }
	 
	 public function update_query_status(){
		 $id = url_decode ( $this->input->get ( "ref_id" ) );
		 $data1 = array (
				 "com_status" => $this->input->get ( "status" ),
		 );
		 $this->Holiday_Model->update_query_data ( $data1,$id);
		 $this->session->set_flashdata ( "alert", array (
				 "message" => "Request Successfully Updated",
				 "class" => "alert-success"
		 ) );
		 redirect ($this->uri->segment("1")."/query");
	 }
		 public function delete_query(){
		 $id = url_decode ( $this->input->get ( "ref_id" ) );
		 $this->Holiday_Model->delete_query ($id);
		 $this->session->set_flashdata ( "alert", array (
				 "message" => "Query Deleted Successfully",
				 "class" => "alert-success"
		 ) );
		 redirect ($this->uri->segment("1")."/query");
	 }
	
}
