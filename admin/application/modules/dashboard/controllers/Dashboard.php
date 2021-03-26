<?php

class Dashboard extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('DashboardModel');
        $this->load->helper("dashboard/dashboard");
    }
    public function index()
    {
        $activedata = array(
            "displayblock" => "",
            "activeclass" => "",
            "activemain" => "dashboard",
        );
        $bp_user_id = $this->dsa_data->dsa_id;
        $this->db->where("com_user_type", "DSA");
        $this->db->where("com_user_id", $bp_user_id);
        $total_row = $this->db->from("common_queries")->count_all_results();
        $data["totalQueries"] = $total_row;
        $data["activedata"] = $activedata;
        $date1 = date('Y-m-d');
        $bookingwhere = array(
            "fbook_user_type" => "DSA",
            "fbook_user_id" => $bp_user_id,
            "DATE(fbook_entry_date)" => $date1,

        );
        $result = $this->DashboardModel->get_today_bookings($bookingwhere, 5, null, "flight_booking_list", "fbook_id");
        $data["result"] = $result;
        $pax = array();
        if ($result != "0") {
            foreach ($result as $results) {
                $booking_id = $results->fbook_id;
                $pax[$booking_id] = $this->Common_Model->get_table_result("*", "fpax_booking_id", $booking_id, "flight_pax_list");
            }
        }
        $data['pax'] = $pax;
        //flight total booking_id
        $data["b2c_day_total_flight_booking"] = $this->DashboardModel->count_day_total_flight($bp_user_id, "B2C"); //day
        $data["b2c_total_flight_booking"] = $this->DashboardModel->count_total_flight($bp_user_id, "B2C");
        //end of flight total booking
        //hotel total booking_id
        $data["b2c_day_total_month_hotel"] = $this->DashboardModel->count_day_total_hotel($bp_user_id, "B2C");
        $data["b2c_total_month_hotel"] = $this->DashboardModel->count_total_hotel($bp_user_id, "B2C");
        //end of hotel total booking
        $this->load->view("dashboard/index", $data);
    }

    public function transaction_log_b2c($id = null)
    {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2"),
        );
        $data["activedata"] = $activedata;
        $join_table = "customer";
        $join_left = "dmttran_customer_id";
        $join_right = "cust_id";
        $da = explode("&per_page", $_SERVER["QUERY_STRING"]);
        $account_id = bp_hash($id);
        if ($this->input->get("per_page")) {
            $page = $this->input->get("per_page");
        } else {
            $page = 0;
        }
        $where = array("dmttran_dsa_id" => $this->dsa_data->dsa_id);

        if ($this->input->get("statement_type") == "min") {
            // print_r($where);
            $where["MONTH(dmttran_entry_date)"] = date('m');
        }

        if ($this->input->get("statement_type") == "year") {
            if ($this->input->get("state_month") != null && !empty($this->input->get("state_month"))) {

                $where["MONTH(dmttran_entry_date)"] = $this->input->get("state_month");
                $where["YEAR(dmttran_entry_date)"] = $this->input->get("state_year");
            } else {
                $where["YEAR(dmttran_entry_date)"] = $this->input->get("state_year");

            }

        }

        if ($this->input->get("statement_type") == "custom") {
            $where["DATE(dmttran_entry_date)>="] = date_format(date_create($this->input->get("st_fromdate")), "y-m-d");
            $where["DATE(dmttran_entry_date)<="] = date_format(date_create($this->input->get("st_todate")), "y-m-d");
        }
        $this->db->where($where);
        $total_row = $this->db->from("dmt_transaction")->count_all_results();
        $pagination_segment = 4;
        $per_page = 10;
        $pagination_url = base_url() . $this->uri->segment("1") . "/" . $this->uri->segment("2") . "/" . $this->uri->segment("3") . "?" . $da[0];
        $config = bp_pagination($pagination_url, $pagination_segment, $total_row, $per_page, $join_table, $join_left, $join_right);
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);

        $result = $this->DashboardModel->transaction_log_b2c($config["per_page"], $page, $where, $join_table, $join_left, $join_right);
        return $result;

    }

    public function transaction_log_b2b($id = null)
    {
        $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1") . "/" . $this->uri->segment("2"),
        );
        $data["activedata"] = $activedata;
        $join_table = "agent";
        $join_left = "dmttran_agent_id";
        $join_right = "agent_id";
        $da = explode("&per_page", $_SERVER["QUERY_STRING"]);
        $account_id = bp_hash($id);
        if ($this->input->get("per_page")) {
            $page = $this->input->get("per_page");
        } else {
            $page = 0;
        }
        $where = array("dmttran_dsa_id" => $this->dsa_data->dsa_id);

        if ($this->input->get("statement_type") == "min") {
            // print_r($where);
            $where["MONTH(dmttran_entry_date)"] = date('m');
        }

        if ($this->input->get("statement_type") == "year") {
            if ($this->input->get("state_month") != null && !empty($this->input->get("state_month"))) {

                $where["MONTH(dmttran_entry_date)"] = $this->input->get("state_month");
                $where["YEAR(dmttran_entry_date)"] = $this->input->get("state_year");
            } else {
                $where["YEAR(dmttran_entry_date)"] = $this->input->get("state_year");

            }

        }

        if ($this->input->get("statement_type") == "custom") {
            $where["DATE(dmttran_entry_date)>="] = date_format(date_create($this->input->get("st_fromdate")), "y-m-d");
            $where["DATE(dmttran_entry_date)<="] = date_format(date_create($this->input->get("st_todate")), "y-m-d");
        }
        $this->db->where($where);
        $total_row = $this->db->from("dmt_transaction")->count_all_results();
        $pagination_segment = 4;
        $per_page = 10;
        $pagination_url = base_url() . $this->uri->segment("1") . "/" . $this->uri->segment("2") . "/" . $this->uri->segment("3") . "?" . $da[0];
        $config = bp_pagination($pagination_url, $pagination_segment, $total_row, $per_page, $join_table, $join_left, $join_right);
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);
        $result = $this->DashboardModel->transaction_log_b2b($config["per_page"], $page, $where, $join_table, $join_left, $join_right);
        return $result;

    }

    public function show_balance_ajax()
    {

        $bp_user_id = $this->dsa_data->dsa_id;
        $result = $this->Common_Model->get_table("*", "scre_user_id", $bp_user_id, "sms_credential");
        if ($result->scre_provider == "srdv") {
            $bp_result = check_srdv_sms_balance($result->scre_key);
            if ($bp_result->error == "") {

                echo $bp_result->trans_credits;

            } else {

                echo "0";
            }

        } else {
            echo "0";
        }

    }

}
