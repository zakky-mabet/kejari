<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mp16 extends MY_model {

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
			$this->db->order_by('p16.ID', 'desc');

			$this->db->select('p16.ID AS ID_primary_p16, p16.*, spdp.*');

			$this->db->from('p16');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->result();

		} else {

			$this->db->from('p16');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get($param = 0, $type = '')
	{
		if ($type == 'num_rows') {
			return $this->db->get_where('p16', array('ID' => $param))->num_rows();
		}
		elseif ($type == 'spdp_on_p16') {

			return $this->db->get_where('p16', array('id_spdp' => $param))->num_rows();

		}else{

			$this->db->select('p16.ID AS ID_primary_p16, p16.*, spdp.*');

			$this->db->from('p16');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p16.ID', $param);

			return $this->db->get()->row();
		}
	}

	public function nomor_cek($param = 0)
	{
		if($param == FALSE)
		{
			return $this->db->get_where('p16', array('nomor_print' => $this->input->post('nomor_print')))->num_rows();
		} else {
			return $this->db->query("SELECT nomor_print FROM p16 WHERE nomor_print IN('{$this->input->post('nomor_print')}') AND ID != {$param}")->num_rows();
		}	
	}

	public function create($param = 0)
	{
		$data = array(
			'nomor_print' => $this->input->post('nomor_print'),
			'id_spdp' => $param ,
			'dasar' => $this->input->post('dasar'),
			'untuk' => $this->input->post('untuk'),
			'pertimbangan' => $this->input->post('pertimbangan'),
			'user_id' => $this->ion_auth->user()->row()->id,
			'tanggal_create' => date('Y-m-d'),
		); 

		$this->db->insert('p16', $data);

		$id_p16 = $this->db->insert_id();

		foreach ($this->input->post('id_user') as $key => $value) {
				// LOOP NOTIFIKASI
		      	$this->insert_kepada($id_p16 , $value);
		}	

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-16 berhasil disimpan.', 
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
			'nomor_print' => $this->input->post('nomor_print'),
			'dasar' => $this->input->post('dasar'),
			'untuk' => $this->input->post('untuk'),
			'pertimbangan' => $this->input->post('pertimbangan'),
			'user_id' => $this->ion_auth->user()->row()->id,
			'tanggal_update' => date('Y-m-d'),
		); 

		$this->db->update('p16', $data, array('ID' => $param ) );

		$id_p16 = $param;

		foreach ($this->input->post('id_user') as $key => $value) {
				// LOOP NOTIFIKASI
		      	$this->insert_kepada($id_p16 , $value);
		}	

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-16 berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	// public function update($param = 0)
	// {
	// 	$data = array(
	// 		'nomor' => $this->input->post('nomor'),
	// 		'asal' => $this->input->post('asal'),
	// 		'deskripsi' => $this->input->post('deskripsi'),
	// 		'user_id' => $this->ion_auth->user()->row()->id,
	// 		'tanggal_update' => date('Y-m-d'),
	// 	); 

	// 	$this->db->update('spdp',  $data, array('ID' => $param) );

	// 	$id_spdp = $param;

	// 	foreach ($this->mspdp->get_group(6) as $key => $value) {

	// 		// LOOP NOTIFIKASI
	// 	    $this->insert_kepada($value->id, $id_spdp);
	// 	}		

	// 	if($this->db->affected_rows())
	// 	{
	// 		$this->template->alert(
	// 			'Data SPDP berhasil diubah.', 
	// 			array('type' => 'success','icon' => 'check')
	// 		);
	// 	} else {
	// 		$this->template->alert(
	// 			' Gagal menyimpan data.', 
	// 			array('type' => 'warning','icon' => 'times')
	// 		);
	// 	}
	// }

	public function insert_kepada($param = 0, $id_user = 0)
	{

		if ($id_user != 1) {

			if ($this->cek_perintah_kepada($param, $id_user) == 0) {

			$perintah_op = array(
				'id_p16' => $param,
				'id_user' => $id_user,
			); 

			$this->db->insert('diperintahkan_jpu', $perintah_op);
			}
		}
		
		//////////// Batas cek

		if ($id_user == 1) {

			$this->firebase_push->setTo($this->get_firebase_token($id_user)); // set kebanyak
	        $this->firebase_push->setTitle("SEKSI PIDUM");
	        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." Surat P-16 telah dibuat dengan nomor : ".$this->input->post('nomor_print')."  oleh Seksi Intelijen ");
	        $this->firebase_push->setImage('');
	        $this->firebase_push->setIsBackground(FALSE);
	        $this->firebase_push->setPayload(
	        	array(
	        		'ID' => $param,
	        		'category' => 'p16'
	        	)
	        );
	        $this->firebase_push->send();

	        $notif = array(
				'pengirim' => $this->ion_auth->user()->row()->id,
				'penerima' => $id_user,
				'judul' => 'SEKSI PIDUM',
				'kategori' => 'p16',
				'deskripsi' => "Surat P-16 telah dibuat dengan nomor : ".$this->input->post('nomor_prinops')." oleh Seksi Intelijen ",
				'tanggal' => date('Y-m-d H:i:s'),
				'payload' => json_encode(
					array(
	        		'ID' => $param,
	        		'category' => 'p16',
	        			)),
			);

			$this->db->insert('notifikasi', $notif); 

		} elseif(!$id_user != 1) {

			$this->firebase_push->setTo($this->get_firebase_token($id_user)); // set kebanyak
	        $this->firebase_push->setTitle("Surat P-16 Baru Masuk");
	        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Surat P-16 kepada anda dengan nomor :".$this->input->post('nomor_prinops'));
	        $this->firebase_push->setImage('');
	        $this->firebase_push->setIsBackground(FALSE);
	        $this->firebase_push->setPayload(
	        	array(
	        		'ID' => $param,
	        		'category' => 'p16'
	        	)
	        );
	        $this->firebase_push->send();

	        $notif = array(
				'pengirim' => $this->ion_auth->user()->row()->id,
				'penerima' => $id_user,
				'judul' => 'Surat P-16 Baru Masuk',
				'kategori' => 'p16',
				'deskripsi' => "mengirim Surat P-16 kepada anda dengan nomor : ".$this->input->post('nomor_prinops') ,
				'tanggal' => date('Y-m-d H:i:s'),
				'payload' => json_encode(
					array(
	        		'ID' => $param,
	        		'category' => 'p16',
	        			)),
			);

			$this->db->insert('notifikasi', $notif); 
		}
		
	}

	public function cek_perintah_kepada($param = 0, $user = 0)
	{
		return $this->db->get_where('diperintahkan_jpu', array('id_p16' => $param, 'id_user' => $user) )->num_rows();
	}

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

