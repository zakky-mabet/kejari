<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkenaikan_pangkat extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload'));
	}

	public function get_all_pangkat()
    {
        // join tabel
		$this->db->select('*');
		$this->db->from('kepegawaian');
		return $this->db->get()->result();
		
    }

    public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nip', $this->input->get('query'))
					 ->or_like('nrp', $this->input->get('query'))
					 ->or_like('nama', $this->input->get('query'));
		// tabel join
		$this->db->select('kepangkatan.*, kepegawaian.nama AS nama_pegawai, kepegawaian.ID  AS ID_pegawai, kepegawaian.ID AS id_pegawai');

		$this->db->join('kepegawaian', 'kepangkatan.nip = kepegawaian.nip', 'left');
		

		if($type == 'result')
		{
			return $this->db->get('kepangkatan', $limit, $offset)->result();
		} else {
			return $this->db->get('kepangkatan')->num_rows();
		}
	}

    public function get($param = 0)
	{

		return $this->db->get_where('kepangkatan', array('ID' => $param))->row();
	}

	public function create()
	{
		$config['upload_path'] = './public/images/kenaikan_pangkat/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';

		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			$foto = $this->upload->file_name;
		} else {
			$foto = '';
		}

		$btsAkhir = new DateTime($this->input->post('date'));
		$btsAkhir->modify('+47 month');

		$kepangkatan = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'id_pangkat' => $this->input->post('id_pangkat'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			
		);

		$this->db->insert('kepangkatan', $kepangkatan);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepangkatan ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}


}

/* End of file Mkenaikan_pangkat.php */
/* Location: ./application/models/Mkenaikan_pangkat.php */