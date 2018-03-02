<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spdp extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('ion_auth','firebase_push'));

		$this->load->helper(array('security','indonesia'));
	}

	public function get()
	{
		$response = array();

		if( ! $this->getQuerySpdpByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perkara Umum yang ditampilkan"
			);
		} else {
			$response = array_merge(
				array(
					'status' => 'OK',
					'message' => "Data Perkara Umum berhasil ditampilkan",
				), $this->getQuerySpdpByID($this->input->post('ID'))
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQuerySpdpByID($param = 0)
	{
		$this->db->select('spdp.*, users.first_name AS pelapor');
		$this->db->join('users', 'spdp.user_id = users.id', 'left');
		return $this->db->get_where('spdp', array('spdp.ID' => $param))->row_array();
	}

	public function index()
	{
		$response = array();

		if( ! $this->getQuerySpdp($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data perkara Umum yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data perkara Umum berhasil ditampilkan"
			);
		}

		foreach ($this->getQuerySpdp($this->input->post('limit'), $this->input->post('start')) as $key => $value) 
			$response['results'][] = $value;


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQuerySpdp($limit = 20, $offset = 0)
	{
		if($this->input->post('startdate') != '')
		{
			$this->db->where('DATE(tanggal_masuk) >=', $this->input->post('startdate'));
		} elseif($this->input->post('enddate') != '') {
			$this->db->where('DATE(tanggal_masuk) <=', $this->input->post('enddate'));
		}

		if($this->input->post('filter') == 'Terbaru')
		{
			$this->db->order_by('tanggal_masuk', 'desc');
		} else {
			$this->db->order_by('tanggal_masuk', 'asc');
		}

		return $this->db->get('spdp', $limit, $offset)->result();
	}

}

/* End of file Spdp.php */
/* Location: ./application/controllers/api/Spdp.php */


