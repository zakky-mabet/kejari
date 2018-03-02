<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mspdp extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0 , $type = 'result' )
	{	
		if($this->input->get('query') != '')
			$this->db->like('nomor', $this->input->get('query'))
					 ->or_like('asal', $this->input->get('query'))
					 ->or_like('deskripsi', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->limit($limit, $offset);

			$this->db->order_by('ID', 'desc');

			return $this->db->get('spdp')->result();

		} else {

			$this->db->limit($limit, $offset);

			return $this->db->get('spdp')->num_rows();
		}
	}

	public function get($param = 0, $type = '')
	{
		if ($type == 'num_rows') {
			return $this->db->get_where('spdp', array('ID' => $param))->num_rows();
		}
		elseif ($type == 'spdp_on_p16') {
			return $this->db->get_where('p16', array('id_spdp' => $param))->num_rows();
		}else{
			return $this->db->get_where('spdp', array('ID' => $param))->row();
		}
	}

	public function nomor_cek($param = 0)
	{
		if($param == FALSE)
		{
			return $this->db->get_where('spdp', array('nomor' => $this->input->post('nomor')))->num_rows();
		} else {
			return $this->db->query("SELECT nomor FROM spdp WHERE nomor IN('{$this->input->post('nomor')}') AND ID != {$param}")->num_rows();
		}	
	}

	public function create()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'asal' => $this->input->post('asal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'user_id' => $this->ion_auth->user()->row()->id,
			'tanggal_masuk' => date('Y-m-d'),
		); 

		$this->db->insert('spdp', $data);

		$id_spdp = $this->db->insert_id();

		foreach ($this->mspdp->get_group(6) as $key => $value) {
				// LOOP NOTIFIKASI
		      	$this->insert_kepada($value->id, $id_spdp);
		}	

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data SPDP berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'asal' => $this->input->post('asal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'user_id' => $this->ion_auth->user()->row()->id,
			'tanggal_update' => date('Y-m-d'),
		); 

		$this->db->update('spdp',  $data, array('ID' => $param) );

		$id_spdp = $param;

		foreach ($this->mspdp->get_group(6) as $key => $value) {

			// LOOP NOTIFIKASI
		    $this->insert_kepada($value->id, $id_spdp);
		}		

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data SPDP berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function insert_kepada($id_user = 0, $id_spdp = 0)
	{
		$this->firebase_push->setTo($this->get_firebase_token($id_user));
        $this->firebase_push->setTitle("Surat Perintah Dimulainya Penyidikan Baru");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Surat Perintah Dimulainya Penyidikan kepada anda");
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $id_spdp,
        		'category' => 'spdp'
        	)
        );
        $this->firebase_push->send();

		 $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'spdp',
			'judul' => 'Surat Perintah Dimulainya Penyidikan Baru',
			'penerima' => $id_user,
			'deskripsi' =>" mengirim petunjuk kepada anda",
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $id_spdp,
        		'category' => 'spdp',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);
	}

	// public function cek_kepada($id_laporan_informasi = 0, $id_user = 0)
	// {
	// 	return $this->db->get_where('penerima_laporan_informasi', array('id_laporan_informasi' => $id_laporan_informasi, 'id_user' => $id_user) )->num_rows();
	// }

	// public function delete($param = 0)
	// {
	// 	$this->db->delete('laporan_informasi', array('ID' => $param));

	// 	$this->db->delete('penerima_laporan_informasi', array('id_laporan_informasi' => $param));

	// 	if($this->db->affected_rows())
	// 	{
	// 		$this->template->alert(
	// 			'Data laporan informasi berhasil dhapus.', 
	// 			array('type' => 'success','icon' => 'check')
	// 		);
	// 	} else {
	// 		$this->template->alert(
	// 			' Gagal menghapus data.', 
	// 			array('type' => 'warning','icon' => 'times')
	// 		);
	// 	}
	// }

	
}

