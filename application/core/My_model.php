<?php
//defined('BASEPATH') or exit('No direct script access allowed');

class My_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
	}

	public function getAllData($table)
	{
		return $this->db->get($table);
	}

	public function getDataById($table, $where)
	{
		return $this->db->get_where($table, $where)->row_array();
	}

	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function updateData($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}

	public function deleteData($table, $where)
	{
		$this->db->delete($table, $where);
	}
}
