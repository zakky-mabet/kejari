<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapmas extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth','firebase_push'));

		$this->load->helper(array('security','indonesia'));

            $this->firebase_push->setTitle("1 Laporan Perkara Baru")
                                ->setMessage("Muhammad Zakky mengirim Laporan perkara kepada anda")
                                ->setID(175)
                                ->setActivityName('DetailKepegawaianActivity')
                                ->setTo($this->get_firebase_token(1))
                                ->send();
	}

	public function push()
	{

	}

	public function index()
	{
		$response = array();

		if( ! $this->getQueryLapMas($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perkara yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data Perkara berhasil ditampilkan",
				'hasil' => $this->firebase_push->fields()
			);
		}

		foreach ($this->getQueryLapMas($this->input->post('limit'), $this->input->post('start')) as $key => $value) 
			$response['results'][] = $value;


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getQueryLapMas($limit = 20, $offset = 0)
	{
		//$this->db->where('asal', ';hhhhhhhhhhhh');

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

		return $this->db->get('laporan_masyarakat', $limit, $offset)->result();
	}

	public function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }

}

/* End of file Lapmas.php */
/* Location: ./application/controllers/api/Lapmas.php */