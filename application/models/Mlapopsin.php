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

			$this->db->join('terusan_disposisi', 'terusan_disposisi.id_disposisi = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');



			$this->db->limit($limit, $offset);

			$this->db->order_by('tanggal_disposisi_masuk', 'desc');

			return $this->db->get()->result();			

		} else {

			$this->db->from('lapopsin');

			$this->db->join('perintah_op', 'lapopsin.id_perintah_op = perintah_op.ID', 'LEFT');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'terusan_disposisi.id_disposisi = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');



			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}


	}

	public function get_in_create($param = 0)
	{
		$this->db->select('laporan_masyarakat.ID AS ID_laporan, laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*, terusan_disposisi.*, telaah.*, perintah_op.*, terusan_disposisi.ID AS ID_primary_terusan_disposisi, telaah.ID AS ID_primary_telaah, disposisi.ID AS ID_primary_disposisi, perintah_op.ID AS ID_primary_perintah_op ' );
			
			$this->db->from('lapopsin');

			$this->db->join('perintah_op', 'lapopsin.id_perintah_op = perintah_op.ID', 'LEFT');

			$this->db->join('telaah', 'perintah_op.id_telaah = telaah.ID', 'LEFT');

			$this->db->join('terusan_disposisi', 'terusan_disposisi.id_disposisi = telaah.id_terusan_disposisi', 'LEFT');

			$this->db->join('disposisi', 'terusan_disposisi.id_disposisi = disposisi.ID', 'LEFT');

			$this->db->join('laporan_masyarakat', 'disposisi.id_laporan_masyarakat = laporan_masyarakat.ID', 'LEFT');

			$this->db->where('lapopsin.ID', $param);

			return $this->db->get()->row();
	}

	
	public function notifikasi()
	{
		return $this->db->get_where('lapopsin',array('nomor_laphosin' => NULL) )->num_rows();
	}
	
	public function get_kepada($param = 0)
	{

		$this->db->select('perintah_op_kepada.id_user' );

		$this->db->from('perintah_op_kepada');

		$this->db->join('perintah_op', 'perintah_op_kepada.id_perintah_op = perintah_op.ID', 'LEFT');

		$this->db->where('perintah_op.ID', $param);

		return $this->db->get()->result();

	}
}

