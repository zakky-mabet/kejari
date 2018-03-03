<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_informasi extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('ion_auth','firebase_push'));

		$this->load->helper(array('security','indonesia'));
	}

	public function index()
	{
		$response = array();

		if( ! $this->getQueryLaporanInformasi($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Laporan informasi yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data Laporan informasi berhasil ditampilkan"
			);
		}

		foreach ($this->getQueryLaporanInformasi($this->input->post('limit'), $this->input->post('start')) as $key => $value) 
			$response['results'][] = $value;


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQueryLaporanInformasi($limit = 20, $offset = 0)
	{
		$this->db->select('laporan_informasi.*, users.first_name AS pengirim');
	
		$this->db->join('users', 'laporan_informasi.id_user = users.id', 'left');

		if($this->input->post('startdate') != '')
		{
			$this->db->where('DATE(tanggal_create) >=', $this->input->post('startdate'));
		} elseif($this->input->post('enddate') != '') {
			$this->db->where('DATE(tanggal_create) <=', $this->input->post('enddate'));
		}

		if($this->input->post('filter') == 'Terbaru')
		{
			$this->db->order_by('tanggal_create', 'desc');
		} else {
			$this->db->order_by('tanggal_create', 'asc');
		}

		//$this->db->where('users.id', $this->input->post('ID'));

		return $this->db->get('laporan_informasi', $limit, $offset)->result();
	}

	public function get()
	{
		$response = array();

		if( ! $this->getQueryLaporanInformasiByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Laporan informasi yang ditampilkan"
			);
		} else {
			$laporanInformasi = $this->getQueryLaporanInformasiByID($this->input->post('ID'));
			
			$response = array_merge(
				array(
					'status' => 'OK',
					'message' => "Data Laporan informasi berhasil ditampilkan",
					'tanggal' => date_id($laporanInformasi['tanggal_create'])
				), $laporanInformasi
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getQueryLaporanInformasiByID($param = 0)
	{
		$this->db->select('laporan_informasi.*, users.first_name AS pengirim');
	
		$this->db->join('users', 'laporan_informasi.id_user = users.id', 'left');

		$this->db->where('laporan_informasi.ID', $this->input->post('ID'));

		return $this->db->get('laporan_informasi')->row_array();
	}
}

/* End of file Laporan_informasi.php */
/* Location: ./application/controllers/api/Laporan_informasi.php */