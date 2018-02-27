<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlapopsin extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nomor_prinops', $this->input->get('query'))
					 ->or_like('deskripsi_untuk', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, perintah_op.*, lapopsin.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi, perintah_op.ID AS ID_primary_perintah_op, lapopsin.ID AS ID_primary_lapopsin ' );
			
			$this->db->from('lapopsin');

			$this->db->join('perintah_op', 'lapopsin.id_perintah_op = perintah_op.ID', 'LEFT');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			$this->db->order_by('tanggal_disposisi_masuk', 'desc');

			return $this->db->get()->result();			

		} else {

			$this->db->from('lapopsin');

			$this->db->join('perintah_op', 'lapopsin.id_perintah_op = perintah_op.ID', 'LEFT');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}

	}

	public function get_in_create($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, perintah_op.*, lapopsin.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi, perintah_op.ID AS ID_primary_perintah_op, lapopsin.telaahan AS telaahan_lapopsin, lapopsin.kesimpulan AS kesimpulan_lapopsin, lapopsin.saran_tindak AS saran_tindak_lapopsin, telaah.telaahan AS telaahan_telaah, telaah.kesimpulan AS kesimpulan_telaah, telaah.saran_tindak AS saran_tindak_telaah ' );
			
			$this->db->from('lapopsin');

			$this->db->join('perintah_op', 'lapopsin.id_perintah_op = perintah_op.ID', 'LEFT');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'telaah.id_terusan_disposisi = terusan_disposisi.ID', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('lapopsin.ID', $param);

			return $this->db->get()->row();
	}

	
	public function notifikasi()
	{
		return $this->db->get_where('lapopsin',array('nomor_laphosin' => NULL) )->num_rows();
	}

	public function security($param = 0)
	{
		return $this->db->get_where('lapopsin',array('ID' => $param) )->num_rows();
	}
	
	public function get_kepada($param = 0)
	{

		$this->db->select('perintah_op_kepada.id_user' );

		$this->db->from('perintah_op_kepada');

		$this->db->join('perintah_op', 'perintah_op_kepada.id_perintah_op = perintah_op.ID', 'LEFT');

		$this->db->where('perintah_op.ID', $param);

		return $this->db->get()->result();

	}


	public function create_lapopsin($param = 0)
	{
		$data = array(
			'nomor_laphosin' => $this->input->post('nomor_laphosin'),
			'dasar' => $this->input->post('dasar'),
			'tugas' => $this->input->post('tugas'),
			'bahan_keterangan' => $this->input->post('bahan_keterangan'),
			'data_diperoleh' => $this->input->post('data_diperoleh'),
			'telaahan' => $this->input->post('telaahan'),
			'kesimpulan' => $this->input->post('kesimpulan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'tanggal_laporan_dibuat' => date('Y-m-d H:i:s'),
			'id_user_input' => $this->ion_auth->user()->row()->id
		); 

		$this->db->update('lapopsin', $data, array('ID' => $param) );

		foreach ($this->input->post('id_user') as $value) {
			$this->insert_kepada($param, $value);
		}

		
		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Hasil Operasi Intelijen berhasil disimpan dan dikirim', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				'Maaf, Terjadi Kesalahan menyimpan data', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update_lapopsin($param = 0)
	{
		$data = array(
			'nomor_laphosin' => $this->input->post('nomor_laphosin'),
			'dasar' => $this->input->post('dasar'),
			'tugas' => $this->input->post('tugas'),
			'bahan_keterangan' => $this->input->post('bahan_keterangan'),
			'data_diperoleh' => $this->input->post('data_diperoleh'),
			'telaahan' => $this->input->post('telaahan'),
			'kesimpulan' => $this->input->post('kesimpulan'),
			'saran_tindak' => $this->input->post('saran_tindak'),
			'tanggal_laporan_dibuat' => date('Y-m-d H:i:s'),
			'id_user_input' => $this->ion_auth->user()->row()->id
		); 

		$this->db->update('lapopsin', $data, array('ID' => $param) );

		foreach ($this->input->post('id_user') as $value) {
			$this->insert_kepada($param, $value);
		}

		
		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Hasil Operasi Intelijen berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				'Maaf, Terjadi Kesalahan menyimpan data', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function insert_kepada($param = 0, $id_user = 0)
	{
	
		$this->firebase_push->setTo($this->get_firebase_token($id_user));
        $this->firebase_push->setTitle("SEKSI INTELIJEN");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Laporan Hasil Operasi Intelijen kepada anda dengan nomor : ".$this->input->post('nomor_laphosin'));
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $param,
        		'category' => 'lapopsin'
        	)
        );
        $this->firebase_push->send();

        $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'lapopsin',
			'judul' => 'SEKSI INTELIJEN',
			'penerima' => $id_user,
			'deskripsi' => " mengirim Laporan Hasil Operasi Intelijen kepada anda dengan nomor : ".$this->input->post('nomor_laphosin') ,
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $param,
        		'category' => 'lapopsin',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);
	}
}

