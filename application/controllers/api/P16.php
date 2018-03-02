<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P16 extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('ion_auth','firebase_push'));

		$this->load->helper(array('security','indonesia'));
	}
	
	public function push()
	{
		$this->firebase_push->setTo("d4HGOt-Qa-U:APA91bGoXYbKKDVv_CEPl4EMiTOCCeOlJvXExuWgeMTgXFYe4xJ6kdPBrLlRRuuUXNFV3nwNMOf7WmrLeR-boc7RyG6r5De8LC0ypvovQzvmN7UoZV6K5Z6T1J0V4kKHUW_DkW4j8bLp");
		$this->firebase_push->setTitle("Instruksi dari KAJARI");
		$this->firebase_push->setMessage("Anda memiliki 1 instruksi laporan dari KAJARI");
		$this->firebase_push->setImage('');
		$this->firebase_push->setIsBackground(FALSE);
		$this->firebase_push->setPayload(
			array(
				'ID' => 1,
				'category' => 'p16'
			)
		);
		$this->firebase_push->send();


        return $this->output->set_content_type('application/json')->set_output(json_encode($this->firebase_push->getPush()));
	}

	public function get()
	{
		$response = array();

		if( ! $this->getQueryP16ByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data dokumen P16 yang ditampilkan"
			);
		} else {
			$laporanInformasi = $this->getQueryP16ByID($this->input->post('ID'));
			
			$response = array_merge(
				array(
					'status' => 'OK',
					'message' => "Data dokumen P16 berhasil ditampilkan",
					'tanggal' => date_id($laporanInformasi['tanggal_create'])
				), $laporanInformasi
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getQueryP16ByID($param = 0)
	{
		$this->db->where('ID', $this->input->post('ID'));

		return $this->db->get('p16')->row_array();
	}

}

/* End of file P16.php */
/* Location: ./application/controllers/api/P16.php */
?>
