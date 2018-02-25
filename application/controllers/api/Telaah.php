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
					'status_petunjuk' => 'telah',
				), array(
					'ID' => $this->input->post('ID')
				));
				if($this->db->get_where('perintah_op', array('id_telaah' => $this->input->post('ID')))->num_rows() == FALSE) 
				{
					$this->db->insert('perintah_op', array(
						'id_telaah' => $this->input->post('ID'),
						'nomor_prinops' => null,
						'tanggal_dibuat' => null,
						'deskripsi_untuk' => null
					));
				}
				$response = array(
					'status' => 'OK',
					'message' => "Petunjuk telaah berhasil dibuat."
				);

				foreach ($this->getUserInGroup(array(4)) as $key => $user) 
				{
					$this->firebase_push->setTo($user->firebase_token);
					$this->firebase_push->setTitle("Petunjuk dari KAJARI");
					$this->firebase_push->setMessage("Anda memiliki petunjuk dari dari KAJARI");
					$this->firebase_push->setImage('');
					$this->firebase_push->setIsBackground(TRUE);
					$this->firebase_push->setPayload(
						array(
						 	'ID' => $this->input->post('ID'),
						 	'category' => 'telaah_intel'
						)
					);
					$this->firebase_push->send();

					$this->db->insert('notifikasi', array(
						'pengirim' => 1,
						'penerima' => $user->id,
						'kategori' => 'telaah_intel',
						'judul' => 'Instruksi dari KAJARI',
						'deskripsi' => 'Anda memiliki instruksi baru dari KAJARI',
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

/* End of file Telaah.php */
/* Location: ./application/controllers/api/Telaah.php */