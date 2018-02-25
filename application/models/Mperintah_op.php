<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mperintah_op extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('no_telaah', $this->input->get('query'))
					 ->or_like('pokok_permasalahan', $this->input->get('query'))
					 ->or_like('saran_tindak', $this->input->get('query'))
					  ->or_like('petunjuk', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, perintah_op.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi, perintah_op.ID AS ID_primary_perintah_op ' );
			
			$this->db->from('perintah_op');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.status_petunjuk', 'telah');

			$this->db->limit($limit, $offset);

			$this->db->order_by('tanggal_disposisi_masuk', 'desc');

			return $this->db->get()->result();			

		} else {

			$this->db->from('perintah_op');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.status_petunjuk', 'telah');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get_in_create($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, perintah_op.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi, perintah_op.ID AS ID_primary_perintah_op ' );
			
			$this->db->from('perintah_op');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('perintah_op.ID', $param);

			return $this->db->get()->row();
	}

	public function notifikasi()
	{
		return $this->db->get_where('perintah_op',array('nomor_prinops' => NULL) )->num_rows();
	}

	public function get_id_perintah_op($param = 0)
	{
		return $this->db->get_where('perintah_op', array('ID' => $param) )->num_rows();
	}

	public function create_surat_op($param = 0)
	{
		$data = array(
			'nomor_prinops' => $this->input->post('nomor_prinops'),
			'tanggal_dibuat' => date('Y-m-d H:i:s'),
			'deskripsi_untuk' => $this->input->post('deskripsi_untuk'),
		); 

		$this->db->update('perintah_op', $data, array('ID' => $param));

		$this->db->insert('lapopsin', array('id_perintah_op' => $param) );

		foreach ($this->input->post('id_user') as $value) {
			$this->insert_kepada($param, $value);
		}	
   
		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Surat Perintah Operasi Intelijen berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan surat.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update_surat_op($param = 0)
	{
		$data = array(
			'nomor_prinops' => $this->input->post('nomor_prinops'),
			'tanggal_dibuat' => date('Y-m-d H:i:s'),
			'deskripsi_untuk' => $this->input->post('deskripsi_untuk'),
		); 

		$this->db->update('perintah_op', $data, array('ID' => $param));

		foreach ($this->input->post('id_user') as $value) {
			$this->insert_kepada($param, $value);
		}	
      
		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Surat Perintah Operasi Intelijen berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan surat.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function insert_kepada($param = 0, $id_user = 0)
	{

		if ($id_user != 1) {

			if ($this->cek_perintah_kepada($param, $id_user) == 0) {

			$perintah_op = array(
				'id_perintah_op' => $param,
				'id_user' => $id_user,
			); 

			$this->db->insert('perintah_op_kepada', $perintah_op);
			}
		}
		
		//////////// Batas cek

		if ($id_user == 1) {

			$this->firebase_push->setTo($this->get_firebase_token($id_user)); // set kebanyak
	        $this->firebase_push->setTitle("SEKSI INTELIJEN");
	        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." Surat Perintah Operasi Intelijen telah dibuat dengan nomor : ".$this->input->post('nomor_prinops')."  oleh Seksi Intelijen ");
	        $this->firebase_push->setImage('');
	        $this->firebase_push->setIsBackground(FALSE);
	        $this->firebase_push->setPayload(
	        	array(
	        		'ID' => $param,
	        		'category' => 'perintah_op'
	        	)
	        );
	        $this->firebase_push->send();

	        $notif = array(
				'pengirim' => $this->ion_auth->user()->row()->id,
				'penerima' => $id_user,
				'judul' => 'SEKSI INTELIJEN',
				'kategori' => 'perintah_op',
				'deskripsi' => "Surat Perintah Operasi Intelijen telah dibuat dengan nomor : ".$this->input->post('nomor_prinops')." oleh Seksi Intelijen ",
				'tanggal' => date('Y-m-d H:i:s'),
				'payload' => json_encode(
					array(
	        		'ID' => $param,
	        		'category' => 'perintah_op',
	        			)),
			);

			$this->db->insert('notifikasi', $notif); 

		} elseif(!$id_user != 1) {

			$this->firebase_push->setTo($this->get_firebase_token($id_user)); // set kebanyak
	        $this->firebase_push->setTitle("Surat Perintah Operasi Intelijen Baru Masuk");
	        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Surat Perintah Operasi Intelijen kepada anda dengan nomor :".$this->input->post('nomor_prinops'));
	        $this->firebase_push->setImage('');
	        $this->firebase_push->setIsBackground(FALSE);
	        $this->firebase_push->setPayload(
	        	array(
	        		'ID' => $param,
	        		'category' => 'perintah_op'
	        	)
	        );
	        $this->firebase_push->send();

	        $notif = array(
				'pengirim' => $this->ion_auth->user()->row()->id,
				'penerima' => $id_user,
				'judul' => 'Surat Perintah Operasi Intelijen Baru Masuk',
				'kategori' => 'perintah_op',
				'deskripsi' => "mengirim Surat Perintah Operasi Intelijen kepada anda dengan nomor : ".$this->input->post('nomor_prinops') ,
				'tanggal' => date('Y-m-d H:i:s'),
				'payload' => json_encode(
					array(
	        		'ID' => $param,
	        		'category' => 'perintah_op',
	        			)),
			);

			$this->db->insert('notifikasi', $notif); 
		}
		
	}

	public function cek_perintah_kepada($param = 0, $user = 0)
	{
		return $this->db->get_where('perintah_op_kepada', array('id_perintah_op' => $param, 'id_user' => $user) )->num_rows();
	}
	
}

