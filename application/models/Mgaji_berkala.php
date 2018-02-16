<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgaji_berkala extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	
		$this->load->library(array('upload'));
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nip', $this->input->get('query'))
					 ->or_like('nrp', $this->input->get('query'))
					 ->or_like('nama', $this->input->get('query'));
		// tabel join
		$this->db->select('gaji_berkala.*, kepegawaian.nama AS nama_pegawai, kepegawaian.ID  AS ID_pegawai, kepegawaian.ID AS id_pegawai');

		$this->db->join('kepegawaian', 'gaji_berkala.nip = kepegawaian.nip', 'left');
		

		if($type == 'result')
		{
			return $this->db->get('gaji_berkala', $limit, $offset)->result();
		} else {
			return $this->db->get('gaji_berkala')->num_rows();
		}
	}

	public function create()
	{
		$config['upload_path'] = './public/images/gaji-berkala/';
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
		$btsAkhir->modify('+36 month');

		$gaji_berkala = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			
		);

		$this->db->insert('gaji_berkala', $gaji_berkala);


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Gaji Berkala ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}

	}

	public function get_all_gaji()
    {
        // join tabel
		$this->db->select('*');
		$this->db->from('kepegawaian');
		return $this->db->get()->result();
		
    }



}

/* End of file Mgaji_berkala.php */
/* Location: ./application/models/Mgaji_berkala.php */