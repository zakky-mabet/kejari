<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller 
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

		if( ! $this->getQueryNotifikasi($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Notifikasi yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data Notifikasi berhasil ditampilkan",
				'jumlah_notifikasi' => $this->countNotifikasi($this->input->post('ID')),
			);
		}

		foreach ($this->getQueryNotifikasi($this->input->post('limit'), $this->input->post('start')) as $key => $value) {
			$date = new DateTime($value->tanggal);
			$response['results'][] = array(
				'ID' => $value->ID,
				'pengirim' => $value->pengirim,
				'penerima' => $value->penerima,
				'kategori' => $value->kategori,
				'deskripsi' => $value->kategori,
				'judul' => $value->judul,
				'deskripsi' => $value->deskripsi,
				'tanggal' => date_id($date->format('Y-m-d'))." - ".$date->format('H:i A'),
				'payload' => json_decode($value->payload),
				'status' => $value->status,
				'id_pengirim' => $value->id_pengirim,
				'foto_pegawai' => base_url("public/images/pegawai/{$value->foto_pegawai}")
			);
		}


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQueryNotifikasi($limit = 20, $offset = 0)
	{
		$this->db->select('notifikasi.*, users.id AS id_pengirim, users.first_name AS pengirim, kepegawaian.nama AS pengirim, kepegawaian.foto AS foto_pegawai');
		$this->db->join('users', 'notifikasi.pengirim = users.id', 'left');
		$this->db->join('kepegawaian', 'users.nip = kepegawaian.nip', 'left');

		if($this->input->post('startdate') != '')
		{
			$this->db->where('DATE(notifikasi.tanggal) >=', $this->input->post('startdate'));
		} elseif($this->input->post('enddate') != '') {
			$this->db->where('DATE(notifikasi.tanggal) <=', $this->input->post('enddate'));
		}

		if($this->input->post('filter') == 'Terbaru')
		{
			$this->db->order_by('notifikasi.tanggal', 'desc');
		} elseif($this->input->post('filter') == 'Terlama') {
			$this->db->order_by('notifikasi.tanggal', 'asc');
		} else {
			$this->db->order_by('notifikasi.tanggal', 'desc');
		}

		if($this->input->post('status') == 'Terbaca')
		{
			$this->db->where('notifikasi.status', 'read');
		} elseif($this->input->post('status') == 'Belum Dibaca') {
			$this->db->where('notifikasi.status', 'unread');
		}

		$this->db->where('notifikasi.penerima', $this->input->post('ID'));

		return $this->db->get('notifikasi', $limit, $offset)->result();
	}

	public function update()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if($this->input->post('ID') != '') {
				
				$this->db->update('notifikasi', array('status' => 'read'), array('ID' => $this->input->post('ID')) );

				$response = array(
					'status' => 'OK',
					'message' => "Notifikasi berhasil diubah"
				);
			} else {
				$response = array(
					'status' => 'ERROR',
					'message' => "Ups! terjadi kesalahan saat menyimpan data."
				);
			}	
		} else {
			$response = array(
				'status' => 'ERROR',
				'message' => "Ups! terjadi kesalahan saat menyimpan data."
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function countNotifikasi($param = 0)
	{
		$this->db->where_in('
			notifikasi.pengirim = (SELECT users.nip FROM users WHERE notifikasi.pengirim = users.id AND users.nip = '.$param.')
		');
		return $this->db->get_where('notifikasi', array(
			'notifikasi.status' => 'unread',
			'notifikasi.penerima' => $param
		))->num_rows();
	}
}

/* End of file Notifikasi.php */
/* Location: ./application/controllers/api/Notifikasi.php */
