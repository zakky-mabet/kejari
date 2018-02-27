<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mperkara extends MY_model {

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
			
			$this->db->from('terusan_disposisi');

			$this->db->join('telaah', 'terusan_disposisi.ID = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			$this->db->order_by('tanggal_disposisi_masuk', 'desc');

			return $this->db->get()->result();

		} 
		else {

			$this->db->from('terusan_disposisi');

			$this->db->join('telaah', 'terusan_disposisi.ID = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function notifikasi()
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('terusan_disposisi');

			$this->db->join('telaah', 'terusan_disposisi.ID = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.id_terusan_disposisi', NULL);

			return $this->db->get()->num_rows();
	}

	public function get($param = 0)
	{
		return $this->db->get_where('telaah', array('ID' => $param))->row();
	}

	public function get_in_create($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('terusan_disposisi');

			$this->db->join('telaah', 'terusan_disposisi.ID = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('terusan_disposisi.ID', $param);

			return $this->db->get()->row();
	}

	public function security($param = 0, $type = '')
	{
		if ($type == 'cek_id_terusan_disposisi_telaah') {
			return $this->db->get_where('telaah', array('id_terusan_disposisi' => $param) )->num_rows();
		}

	}

	public function create_telaah($param = 0)
	{
		$data = array(
			'no_telaah'  => $this->input->post('no_telaah'),
			'pokok_permasalahan'  => $this->input->post('pokok_permasalahan'),
			'uraian_permasalahan' => $this->input->post('uraian_permasalahan'),
			'telaahan' => $this->input->post('telaahan'),
			'kesimpulan' => $this->input->post('kesimpulan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'id_terusan_disposisi' => $param,
			'group_id' => 4,
			'id_user_pembuat_telaah' => $this->ion_auth->user()->row()->id,
			'tanggal_di_telaah' => date('Y-m-d H:i:s'),
		); 

		$this->db->insert('telaah', $data);

		$id_telaah = $this->db->insert_id();

		$this->firebase_push->setTo($this->get_firebase_token(1)); // set to ke kajari
        $this->firebase_push->setTitle("SEKSI INTELIJEN");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." Mengirim Dokumen Telaah baru kepada anda, Nomor Telaah :". $this->input->post('no_telaah') );
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $id_telaah,
        		'category' => 'telaah_intel'
        	)
        );
        $this->firebase_push->send();

        $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'telaah_intel',
			'penerima' => 1,
			'judul' => 'SEKSI INTELIJEN',
			'deskripsi' => 'Mengirim Dokumen Telaah baru kepada anda, Nomor Telaah : '.$this->input->post('no_telaah'),
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $id_telaah,
        		'category' => 'telaah_intel',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Telaah telah dibuat.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal membuat telaah, Coba lagi!', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update_telaah($param = 0)
	{
		$telaah = array(
			'no_telaah'  => $this->input->post('no_telaah'),
			'pokok_permasalahan'  => $this->input->post('pokok_permasalahan'),
			'uraian_permasalahan' => $this->input->post('uraian_permasalahan'),
			'telaahan' => $this->input->post('telaahan'),
			'kesimpulan' => $this->input->post('kesimpulan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'group_id' => 4,
			'id_user_pembuat_telaah' => $this->ion_auth->user()->row()->id,
			'tanggal_di_telaah' => date('Y-m-d H:i:s'),
		);

		$this->db->update('telaah', $telaah, array('ID' => $param));

		$this->firebase_push->setTo($this->get_firebase_token(1)); // set to ke kajari
        $this->firebase_push->setTitle("SEKSI INTELIJEN");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." Mengirim Dokumen Telaah baru kepada anda, Nomor Telaah :". $this->input->post('no_telaah') );
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $param,
        		'category' => 'telaah_intel'
        	)
        );
        $this->firebase_push->send();

        $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'telaah_intel',
			'penerima' => 1,
			'judul' => 'SEKSI INTELIJEN',
			'deskripsi' => 'Mengirim Dokumen Telaah baru kepada anda, Nomor Telaah : '.$this->input->post('no_telaah'),
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $param,
        		'category' => 'telaah_intel',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data telaah berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data yang diubah.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function get_update_telaah($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi ' );
			
			$this->db->from('terusan_disposisi');

			$this->db->join('telaah', 'terusan_disposisi.ID = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('telaah.id_terusan_disposisi', $param);

			return $this->db->get()->row();
	}

}

