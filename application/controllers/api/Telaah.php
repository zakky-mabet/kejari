<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telaah extends CI_Controller 
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

		if( ! $this->getQueryTelaahByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Telaah yang ditampilkan"
			);
		} else {
			$telaah = $this->getQueryTelaahByID($this->input->post('ID'));
			$tglTelaah = new DateTime($telaah->tanggal_di_telaah);
			$tglPetunjuk = new DateTime($telaah->tanggal_petunjuk);
			$response = array(
				'status' => 'OK',
				'message' => "Data Telaah berhasil ditampilkan",
				'ID' => $telaah->ID,
				'no_telaah' => $telaah->no_telaah,
				'pokok_permasalahan' => $telaah->pokok_permasalahan,
				'uraian_permasalahan' => $telaah->uraian_permasalahan,
				'telaahan' => $telaah->telaahan,
				'petunjuk' => $telaah->petunjuk,
				'kesimpulan' => $telaah->kesimpulan,
				'saran_tindak' => $telaah->saran_tindak,
				'tanggal_telaah' =>  date_id($tglTelaah->format('Y-m-d'), TRUE)." - ".$tglTelaah->format('H:i A'),
				'tanggal_petunjuk' => date_id($tglPetunjuk->format('Y-m-d'), TRUE)." - ".$tglPetunjuk->format('H:i A'),
				'status_petunjuk' => $telaah->status_petunjuk
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQueryTelaahByID($param = 0)
	{
		return $this->db->get_where('telaah', array('ID' => $param))->row();
	}

	public function setpetunjuk()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if($this->input->post('petunjuk'))
			{
				$this->db->update('telaah', array(
					'petunjuk' => $this->input->post('petunjuk'),
					'tanggal_petunjuk' => date('Y-m-d H:i:s'),
					'status_petunjuk' => 'telah'
				), array(
					'ID' => $this->input->post('ID')
				));
				$response = array(
					'status' => 'OK',
					'message' => "Petunjuk telaah berhasil dibuat."
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
}

/* End of file Telaah.php */
/* Location: ./application/controllers/api/Telaah.php */