<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $tbl = "";
    public $primary_key = "";
    public $primary_name = "";
    public $num_rows = 0;
    public $CI;

    public function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }

    function get_all_rows($order_field = '', $order = 'ASC') {
        $this->db->select('*');
        if ($order_field != '') {
            if ($order == '') {
                $this->db->order_by($order_field);
            } else {
                $this->db->order_by($order_field, $order);
            }
        }
        $query = $this->db->get($this->tbl);
        if ($query->num_rows() != 0) {
            return $query;
        }
        return false;
    }

    function getTotal() {
        $this->db->select($this->primary_key);

        $query = $this->db->get($this->tbl);
        return $query->num_rows();
    }

    function getWhereTotal($where_condition = '') {
        $this->db->select($this->primary_key);
        $this->db->where($where_condition);
        $query = $this->db->get($this->tbl);
        return $query->num_rows();
    }

    function insert($data) {
        if ($this->db->field_exists('modified', $this->tbl)) {
            $data['modified'] = current_mysql_date();
        }
        if ($this->db->field_exists('created', $this->tbl)) {
            $data['created'] = current_mysql_date();
        }
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    function insert_order($data) 
	{
        if ($this->db->field_exists('created', $this->tbl)) {
            $data['created'] = current_mysql_date();
        }
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

	function insert_device($data) {
       
       
		if ($this->db->field_exists('login_time', $this->tb2)) {
            $data['login_time'] = current_mysql_date();
        }
        $this->db->insert($this->tb2, $data);
        return $this->db->insert_id();
    }

    function update($data, $id) {
        if ($this->db->field_exists('modified', $this->tbl)) {
            $data['modified'] = current_mysql_date();
        }
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->tbl, $data);
        return $id;
    }

    function update_where($data, $where = array()) {
        if (is_array($where)) {
            if (count($where) != 0) {
                if ($this->db->field_exists('modified', $this->tbl)) {
                    $data['modified'] = current_mysql_date();
                }
                $this->db->where($where);
                $this->db->update($this->tbl, $data);
                return true;
            }
        }

        return false;
    }
	
	
	
	

    function delete($id) {
        $this->db->delete($this->tbl, array($this->primary_key => $id));
    }

    function delete_by_primary_name($id) {
        $this->db->delete($this->tbl, array($this->primary_name => $id));
    }

    function delete_where($where = array()) {
        if (is_array($where)) {
            if (count($where) != 0) {
                $query = $this->db->delete($this->tbl, $where);
                return $query;
            }
        }
        return false;
    }

    function fromId($id) {
        $this->db->select('*');
        $this->db->where($this->primary_key, intval($id));
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    function fromId_field($select = '*', $id) {
        $this->db->select($select);
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    function fromName($name, $fields = '') {
        if ($fields == '') {
            $this->db->select('*');
        } else {
            $this->db->select($fields);
        }

        $this->db->where('LCASE(' . $this->primary_name . ')', strtolower(trim($name)));
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row[0];
        }
        return false;
    }

    function ifExist($id) {

        $this->db->select($this->primary_key);
        $this->db->where($this->primary_key, intval($id));
        $query = $this->db->get($this->tbl);

        if ($query->num_rows() >= 1) {
            return true;
        }
        return false;
    }
	function fromDevice($login_id, $device_id,$type) {
		if($type==0)
		{
        	$this->db->select($this->primary_key);
        //$this->db->where(arr'user_id', intval($login_id));
			$query = $this->db->get_where($this->tb2,array('user_id'=>$login_id,'device_id'=>$device_id));

        	if ($query->num_rows() >= 1) {
            return true;
        	}
		}
		else
		{
			if ($this->db->field_exists('login_time', $this->tb2)) {
                    $data['login_time'] = current_mysql_date();
                }
                $this->db->where(array('user_id'=>$login_id,'device_id'=>$device_id));
                $this->db->update($this->tb2, $data);
		}
        return false;
    }
	function fromDeviceUpdate($login_id, $device_id) {
		
		if($login_id!='' && $device_id!='')
		{	
			if ($this->db->field_exists('logout_time', $this->tb2)) {
                    $data['logout_time'] = current_mysql_date();
                }
                $this->db->where(array('user_id'=>$login_id,'device_id'=>$device_id));
                $this->db->update($this->tb2, $data);
		}
        return false;
    }
    public function fetch($limit, $start, $where = "", $fields = "*") {
        $this->db->limit($limit, $start);

        $this->db->select($fields);
        if (isset($where)) {
            if (!empty($where)) {
                $this->db->where($where);
            }
        }

        $query = $this->db->get($this->tbl);
        if ($query->num_rows() > 0) {
            return $query;
        }
        return false;
    }

    /**
     *
     * @param array $where
     * @return boolean
     */
    function get_rows_where($where = array(), $order_by = '', $order = 'DESC', $limit = '') {
        if (is_array($where)) {
            if (count($where) != 0) {
                $this->db->select('*');
                $this->db->where($where);
                if (!empty($limit)) {
                    $this->db->limit($limit);
                }

                if ($order_by != '') {
                    if ($order == '') {
                        $this->db->order_by($order_by);
                    } else {
                        $this->db->order_by($order_by, $order);
                    }
                }

                $query = $this->db->get($this->tbl);

                if ($query->num_rows() != 0) {
                    return $query;
                }
            }
        }
        return false;
    }

    function get_selected_rows_where($where, $fields = '*') {
        $this->db->select($fields);
        $this->db->where($where);
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

    function get_selected_rows($fields = '*') {
        $this->db->select($fields);
        $query = $this->db->get($this->tbl);
        if ($query->num_rows() > 0) {
            return $query;
        }
        return false;
    }

    /**
     *
     * @param unknown_type $where
     * @return boolean
     */
    function is_row_exist($where = array(), $fields = '*') {
        if (is_array($where)) {
            if (count($where) != 0) {
                $this->db->select($fields);
                $this->db->where($where);
                $query = $this->db->get($this->tbl);

                if ($query->num_rows() != 0) {
                    return true;
                }
            }
        }
        return false;
    }

    function get_join($join = array(), $where = array(), $fields = '*', $order_by=NULL ,$start = '', $limit = '', $debug = false) {
        if (is_array($join) and is_array($where)) {
            if (!empty($start) and !empty($limit)) {
                $this->db->limit($limit, $start);
            }

            $this->db->select($fields);
            $this->db->from($this->tbl);

            if (count($join) >= 1) {
                foreach ($join as $join_key => $join_block) {
                    if (!isset($join_block['type'])) {
                        $this->db->join($join_block['table'], $join_block['join']);
                    } else {
                        $this->db->join($join_block['table'], $join_block['join'], $join_block['type']);
                    }
                }
            }

            if (count($where) >= 1) {
                foreach ($where as $where_key => $where_logic) {
                    $this->db->where($where_logic);
                }
            }

            if($order_by!=NULL)
            {
                $this->db->order_by($order_by);
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query;
            }

            if($debug)
            {
                echo $this->db->last_query();
            }

        }
        return false;
    }


    function get_join_Total($join = array(), $where = array()) {
        if (is_array($join) and is_array($where)) {


            $this->db->select($this->tbl.'.'.$this->primary_key);
            $this->db->from($this->tbl);

            if (count($join) >= 1) {
                foreach ($join as $join_key => $join_block) {
                    if (!isset($join_block['type'])) {
                        $this->db->join($join_block['table'], $join_block['join']);
                    } else {
                        $this->db->join($join_block['table'], $join_block['join'], $join_block['type']);
                    }
                }
            }

            if (count($where) >= 1) {
                foreach ($where as $where_key => $where_logic) {
                    $this->db->where($where_logic);
                }
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->num_rows();
            }


        }
        return false;

    }
	
	// get all categories
    function get_all_category($id) {
		$where = "member_id =".$id;
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

	// get all product size
    function get_all_size($id) {
		$where = "member_id =".$id;
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

	// get size by ajax
    function get_size($id) {
		$where = "category_id =".$id;
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($this->tbl);
        $row = $query->result();
        if (!empty($row)) {
            return $row;
        }
        return false;
    }

	

}
