<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdokumen_telaah extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nomor', $this->input->get('query'))
					 ->or_like('deskripsi', $this->input->get('query'))
					 ->or_like('asal', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('telaah');

			$this->db->join('terusan_disposisi', 'terusan_disposisi.id_disposisi = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			$this->db->order_by('tanggal_disposisi_masuk', 'desc');

			return $this->db->get()->result();

		} if($type == 'notifikasi')
		{
			$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('telaah');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.status_petunjuk', 'belum');

			return $this->db->get()->num_rows();

		}
		else {

			$this->db->from('telaah');

			$this->db->join('terusan_disposisi', 'terusan_disposisi.id_disposisi = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get_in_create($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('telaah');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.ID', $param);

			return $this->db->get()->row();
	}

	public function create_petunjuk($param = 0)
	{
		$data = array(
			'petunjuk' => $this->input->post('petunjuk'),
			'tanggal_petunjuk' => date('Y-m-d H:i:s'),
			'status_petunjuk' => 'telah'
		); 

		$this->db->update('telaah', $data, array('ID' => $param));

		$perintah_op = array(
			'id_telaah' => $param,
		); 

		$this->db->insert('perintah_op', $perintah_op);

		foreach ($this->mdokumen_telaah->get_group(4) as $key => $value) {

				// LOOP NOTIFIKASI
		      	$this->insert_kepada($value->id, $param);
		}

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Petunjuk telaahan intelijen disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update_petunjuk($param = 0)
	{
		$data = array(
			'petunjuk' => $this->input->post('petunjuk'),
			'tanggal_petunjuk' => date('Y-m-d H:i:s'),
		); 

		$this->db->update('telaah', $data, array('ID' => $param));

		foreach ($this->mdokumen_telaah->get_group(4) as $key => $value) {

				// LOOP NOTIFIKASI
		      	$this->insert_kepada($value->id, $param);
		}

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Petunjuk telaahan intelijen diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data diubah.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function insert_kepada($id_user = 0, $id_laporan_masyarakat = 0)
	{
		$this->firebase_push->setTo($this->get_firebase_token($id_user));
        $this->firebase_push->setTitle("Petunjuk dari KAJARI");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim petunjuk kepada anda");
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'telaah_intel'
        	)
        );
        $this->firebase_push->send();

		 $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'telaah_intel',
			'judul' => 'Petunjuk dari KAJARI',
			'penerima' => $id_user,
			'deskripsi' =>" mengirim petunjuk kepada anda",
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'telaah_intel',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);
	}

	
	
}

