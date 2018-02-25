<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printop extends CI_Controller 
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

		if( ! $this->getQueryPrintOpByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perintah Operasi Intelijen yang ditampilkan"
			);
		} else {
			$printOp = $this->getQueryPrintOpByID($this->input->post('ID'));
			$tglDibuat = new DateTime($printOp->tanggal_dibuat);

			$response = array(
				'status' => 'OK',
				'message' => "Data Perintah Operasi Intelijen berhasil ditampilkan",
				'ID' => $printOp->ID,
				'nomor_prinops' => $printOp->nomor_prinops,
				'tanggal_dibuat' =>  date_id($tglDibuat->format('Y-m-d'), TRUE)." - ".$tglDibuat->format('H:i A'),
				'deskripsi_untuk' =>  $printOp->deskripsi_untuk,
				'diperintahkan' => array()
			);

			foreach ($this->getQueryUserPrintOpByID($this->input->post('ID')) as $key => $value) 
			{
				$response['diperintahkan'][] = array(
					'ID' => $value->ID,
					'nip' => $value->nip,
					'nama' => $value->nama,
					'foto' => base_url("public/images/pegawai/".$value->foto),
					'pangkat' => $value->pangkat
				);
			} 
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));		
	}

	public function getlapopsin()
	{
		$response = array();

		if( ! $this->getQueryLapopsinByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perintah Operasi Intelijen yang ditampilkan"
			);
		} else {
			$response = array_merge(
	 			array(
					'status' => 'OK',
					'message' => "Data Perintah Operasi Intelijen berhasil ditampilkan",
				), 
				$this->getQueryLapopsinByID($this->input->post('ID'))
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));		
	}

	public function setpendapat()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if($this->input->post('pendapat'))
			{
				$this->db->update('lapopsin', array(
					'pendapat_kajari' => $this->input->post('pendapat'),
					'tanggal_pendapat_kajari' => date('Y-m-d H:i:s')
				), array(
					'ID' => $this->input->post('ID')
				));
				$response = array(
					'status' => 'OK',
					'message' => "Pendapat lapopsin berhasil dibuat."
				);

				foreach ($this->getUserInGroup(array(4)) as $key => $user) 
				{
					$this->firebase_push->setTo($user->firebase_token);
					$this->firebase_push->setTitle("Pendapat LAPOPSIN dari KAJARI");
					$this->firebase_push->setMessage("Kajari mengirimkan pendapat Laporan Hasil Operasi Intelijen");
					$this->firebase_push->setImage('');
					$this->firebase_push->setIsBackground(TRUE);
					$this->firebase_push->setPayload(
						array(
						 	'ID' => $this->input->post('ID'),
						 	'category' => 'lapopsin'
						)
					);
					$this->firebase_push->send();

					$this->db->insert('notifikasi', array(
						'pengirim' => 1,
						'penerima' => $user->id,
						'kategori' => 'lapopsin',
						'judul' => 'Pendapat LAPOPSIN dari KAJARI',
						'deskripsi' => 'Kajari mengirimkan pendapat Laporan Hasil Operasi Intelijen',
						'tanggal' => date('Y-m-d H:i:s'),
						'payload' => json_encode(array(
							'ID' => $this->input->post('ID')
						)),
						'status' => 'unread'
					));
				}
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

	private function getQueryPrintOpByID($param = 0)
	{
		return $this->db->get_where('perintah_op', array('ID' => $param))->row();
	}

	private function getQueryLapopsinByID($param = 0)
	{
		$this->db->select('lapopsin.*, kepegawaian.nama, kepegawaian.nip');
		$this->db->join('users', 'lapopsin.id_user_input = users.id', 'left');
		$this->db->join('kepegawaian', 'users.nip = kepegawaian.nip', 'left');
		return $this->db->get_where('lapopsin', array('lapopsin.ID' => $param))->row_array();
	}

	private function getQueryUserPrintOpByID($param = 0)
	{
		$this->db->select("
			kepegawaian.ID, kepegawaian.nip, kepegawaian.nama, kepegawaian.foto,
			(SELECT 
				nama_pangkat FROM kepangkatan 
				LEFT JOIN pangkat ON kepangkatan.id_pangkat = pangkat.ID 
				WHERE 
					users.nip  = kepangkatan.nip
			 ORDER BY kepangkatan.batas_akhir DESC LIMIT 1) AS pangkat
		");
		$this->db->join('users', 'perintah_op_kepada.id_user = users.id', 'left');
		$this->db->join('kepegawaian', 'users.nip = kepegawaian.nip', 'left');

		return $this->db->get_where('perintah_op_kepada', array('perintah_op_kepada.id_perintah_op' => $param))->result();
	}

	private function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }

    private function getUserInGroup($param = array())
    {
    	$this->db->select('users.*');
    	$this->db->join('users_groups', 'users.id = users_groups.user_id', 'left');
    	$this->db->where_in('users_groups.group_id', $param);
    	return $this->db->get('users')->result();
    }
}

/* End of file Printop.php */
/* Location: ./application/controllers/api/Printop.php */