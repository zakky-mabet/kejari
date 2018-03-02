<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlaporan_informasi extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0, $where = '' , $type = 'result' )
	{	
		if($this->input->get('query') != '')
			$this->db->like('nomor', $this->input->get('query'))
					 ->or_like('sumber_informasi', $this->input->get('query'))
					 ->or_like('trend_perkembangan', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->limit($limit, $offset);

			$this->db->where('kategori', $where);

			$this->db->order_by('ID', 'desc');

			return $this->db->get('laporan_informasi')->result();

		} else {
			$this->db->where('kategori', $where);

			$this->db->limit($limit, $offset);

			return $this->db->get('laporan_informasi')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('laporan_informasi', array('ID' => $param) )->row();
	}

	public function get_num($param = 0)
	{
		return $this->db->get_where('laporan_informasi', array('ID' => $param) )->num_rows();
	}

	public function nomor_cek($param = 0)
	{
		if($param == FALSE)
		{
			return $this->db->get_where('laporan_informasi', array('nomor' => $this->input->post('nomor')))->num_rows();
		} else {
			return $this->db->query("SELECT nomor FROM laporan_informasi WHERE nomor IN('{$this->input->post('nomor')}') AND ID != {$param}")->num_rows();
		}	
	}

	public function create()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'informasi_diperoleh' => $this->input->post('informasi_diperoleh'),
			'sumber_informasi' => $this->input->post('sumber_informasi'),
			'trend_perkembangan' => $this->input->post('trend_perkembangan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'kategori' => $this->input->post('kategori'),
			'id_user' => $this->ion_auth->user()->row()->id,
			'tanggal_create' => date('Y-m-d'),
		); 

		$this->db->insert('laporan_informasi', $data);

		$id_laporan_informasi = $this->db->insert_id();

		foreach ($this->input->post('id_user') as $value) {

			$this->insert_kepada($id_laporan_informasi, $value, $this->input->post('kategori'));
		}	

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data laporan informasi berhasil disimpan.', 
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
			'informasi_diperoleh' => $this->input->post('informasi_diperoleh'),
			'sumber_informasi' => $this->input->post('sumber_informasi'),
			'trend_perkembangan' => $this->input->post('trend_perkembangan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'kategori' => $this->input->post('kategori'),
			'id_user' => $this->ion_auth->user()->row()->id,
			'tanggal_update' => date('Y-m-d'),
		); 

		$this->db->update('laporan_informasi',  $data, array('ID' => $param) );

		$id_laporan_informasi = $param;

		foreach ($this->input->post('id_user') as $value) {

			$this->insert_kepada($id_laporan_informasi, $value, $this->input->post('kategori'));
		}	

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data laporan informasi berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function insert_kepada($id_laporan_informasi = 0, $id_user = 0 , $kategori = '')
	{
		
		if ($this->cek_kepada($id_laporan_informasi, $id_user) == 0) {

			$penerima = array(
				'id_laporan_informasi' => $id_laporan_informasi,
				'id_user' => $id_user,
			); 

			$this->db->insert('penerima_laporan_informasi', $penerima);
		}

		$this->firebase_push->setTo($this->get_firebase_token($id_user)); // set kebanyak
	    $this->firebase_push->setTitle("INTELIJEN");
	    $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim lapoan informasi kepada anda dengan nomor :".$this->input->post('nomor'));
	    $this->firebase_push->setImage('');
	    $this->firebase_push->setIsBackground(FALSE);
	    $this->firebase_push->setPayload(
	        	array(
	        		'ID' => $id_laporan_informasi,
	        		'category' => 'laporan_informasi'
	        	)
	        );
	    $this->firebase_push->send();

	    $notif = array(
				'pengirim' => $this->ion_auth->user()->row()->id,
				'penerima' => $id_user,
				'judul' => 'INTELIJEN',
				'kategori' => 'laporan_informasi',
				'deskripsi' => "mengirim laporan informasi kepada anda dengan nomor : ".$this->input->post('nomor') ,
				'tanggal' => date('Y-m-d H:i:s'),
				'payload' => json_encode(
					array(
	        		'ID' => $id_laporan_informasi,
	        		'category' => 'laporan_informasi',
	        			)),
			);

			$this->db->insert('notifikasi', $notif); 
	}

	public function cek_kepada($id_laporan_informasi = 0, $id_user = 0)
	{
		return $this->db->get_where('penerima_laporan_informasi', array('id_laporan_informasi' => $id_laporan_informasi, 'id_user' => $id_user) )->num_rows();
	}

	public function delete($param = 0)
	{
		$this->db->delete('laporan_informasi', array('ID' => $param));

		$this->db->delete('penerima_laporan_informasi', array('id_laporan_informasi' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data laporan informasi berhasil dhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	
}

