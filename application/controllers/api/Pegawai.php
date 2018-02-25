<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth'));

		$this->load->helper(array('security','indonesia'));

/*		foreach ($this->db->get('gaji_berkala')->result() as $key => $value) 
		{
			$date = new DateTime($value->tmt);
			$date->modify('+24 month');
			$this->db->update('gaji_berkala', array(
				'batas_akhir' => $date->format('Y-m-d')
			), array(
				'ID' => $value->ID
			));
		}*/
/*
		foreach ($this->db->get('kepangkatan')->result() as $key => $value) 
		{
			$this->db->update('kepangkatan', array(
				'id_pangkat' => rand(1, 14)
			), array(
				'ID' => $value->ID
			));
		}
*/
	}

	public function index()
	{
		$response = array();

		if( ! $this->getAllKepegawaian($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data kepegawain yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data kepegawain berhasil ditampilkan",
			);
		}

		foreach ($this->getAllKepegawaian($this->input->post('limit'), $this->input->post('start')) as $key => $value) 
			$response['results'][] = array_merge(
				array(
				'foto_pegawai' => base_url("public/images/pegawai/{$value['foto']}")
			), $value);


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function get()
	{
		$response = array();

		if( ! $this->getPegawai($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data kepegawain yang ditampilkan",
				'results' => array()
			);
		} else {
			$pegawai = $this->getPegawai($this->input->post('ID'));
			$response = array_merge(
	        	array(
					'status' => 'OK',
					'message' => "Data kepegawain berhasil ditampilkan",
					'foto_pegawai' => base_url("public/images/pegawai/{$pegawai['foto']}")
	        	), 
	        	$pegawai
	    	);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getpangkat()
	{
		$response = array();

		if( ! $this->getPangkatPegawai($this->input->post('nip')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data pangkat yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data pangkat berhasil ditampilkan",
			);
		}

		foreach ($this->getPangkatPegawai($this->input->post('nip')) as $key => $value) 
		{
			$response['results'][] = array(
				'ID' => $value->ID,
				'tmt' => date_id($value->tmt),
				'yad' => date_id($value->batas_akhir),
				'nama_pangkat' => $value->pangkat,
				'no_sk' => $value->no_sk,
				'lampiran' => base_url("public/images/kepangkatan/{$value->lampiran_sk}"),
				'simbol' => base_url("public/images/icon/simbol/{$value->simbol}"),
				'golongan' => $value->golongan,
				'keterangan' => $value->keterangan
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getdiklat()
	{
		$response = array();

		if( ! $this->getDiklatPegawai($this->input->post('nip')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data diklat yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data diklat berhasil ditampilkan",
			);
		}

		foreach ($this->getDiklatPegawai($this->input->post('nip')) as $key => $value) 
		{
			$response['results'][] = array(
				'ID' => $value->ID,
				'tgl_mulai' => date_id($value->tgl_mulai),
				'tgl_selesai' => date_id($value->tgl_selesai),
				'nama' => $value->nama,
				'lampiran' => base_url("public/diklat-file/images/{$value->lampiran}"),
				'tingkat' => $value->tingkat,
				'keterangan' => $value->keterangan
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getgajiberkala()
	{
		$response = array();

		if( ! $this->getGajiBerkalaPegawai($this->input->post('nip')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Gaji Berkala yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data Gaji Berkala berhasil ditampilkan",
			);
		}

		foreach ($this->getGajiBerkalaPegawai($this->input->post('nip')) as $key => $value) 
		{
			$response['results'][] = array(
				'ID' => $value->ID,
				'tmt' => date_id($value->tmt),
				'batas_akhir' => date_id($value->batas_akhir),
				'no_sk' => $value->no_sk,
				'lampiran_sk' => base_url("public/gajiberkala-file/images/{$value->lampiran_sk}"),
				'keterangan' => $value->keterangan
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getGajiBerkalaPegawai($param = 0)
	{
		return $this->db->get_where('gaji_berkala', array('nip' => $param))->result();
	}

	private function getDiklatPegawai($param = 0)
	{
		return $this->db->get_where('riwayat_diklat', array('nip' => $param))->result();
	}

	private function getPangkatPegawai($param = 0)
	{
		$this->db->select('kepangkatan.*, pangkat.nama_pangkat AS pangkat, pangkat.golongan, pangkat.simbol');
		$this->db->join('pangkat', 'kepangkatan.id_pangkat = pangkat.ID', 'left');
		return $this->db->get_where('kepangkatan', array('nip' => $param))->result();
	}

	private function getPegawai($param = 0)
	{
		$this->db->select("
			ID, kepegawaian.nip, kepegawaian.nrp, kepegawaian.nama, kepegawaian.tempat_lahir, kepegawaian.agama, kepegawaian.tgl_lahir, kepegawaian.jns_kelamin, kepegawaian.pendidikan_terakhir, kepegawaian.alamat, kepegawaian.no_tlp, kepegawaian.status_dinas, kepegawaian.jabatan, kepegawaian.foto,
			(SELECT 
				nama_pangkat FROM kepangkatan 
				LEFT JOIN pangkat ON kepangkatan.id_pangkat = pangkat.ID 
				WHERE 
					kepegawaian.nip  = kepangkatan.nip
			 ORDER BY kepangkatan.batas_akhir DESC LIMIT 1) AS pangkat
		");

		$this->db->where('kepegawaian.ID', $param);

		return $this->db->get('kepegawaian')->row_array();
	}

	private function getAllKepegawaian($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select("
			ID, kepegawaian.nip, kepegawaian.nrp, kepegawaian.nama, kepegawaian.tempat_lahir, kepegawaian.agama, kepegawaian.tgl_lahir, kepegawaian.jns_kelamin, kepegawaian.pendidikan_terakhir, kepegawaian.alamat, kepegawaian.no_tlp, kepegawaian.status_dinas, kepegawaian.jabatan, kepegawaian.foto,
			(SELECT 
				nama_pangkat FROM kepangkatan 
				LEFT JOIN pangkat ON kepangkatan.id_pangkat = pangkat.ID 
				WHERE 
					kepegawaian.nip  = kepangkatan.nip
			 ORDER BY kepangkatan.batas_akhir DESC LIMIT 1) AS pangkat
		");

		if($this->input->post('query') != '')
			$this->db->like('nip', $this->input->post('query'))
					 ->or_like('nrp', $this->input->post('query'))
					 ->or_like('nama', $this->input->post('query'));

		$this->db->order_by('nama', 'asc');

					 //$this->db->where('nama', 'dfkjk');

		if($type == 'result')
		{
			return $this->db->get('kepegawaian', $limit, $offset)->result_array();
		} else {
			return $this->db->get('kepegawaian')->num_rows();
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/api/Pegawai.php */