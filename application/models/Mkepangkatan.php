<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkepangkatan extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload'));
	}

	public function create()
	{
		$config['upload_path'] = './public/images/kepangkatan/';
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
		$date = new DateTime($this->input->post('date'));

		$kepangkatan = array(

			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'tmt' => $this->input->post('date'),
			'pangkat' => $this->input->post('pangkat'),
			'batas_akhir' => $date->modify('+36 month'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'golongan' => $this->input->post('golongan'),
			'ruang' => $this->input->post('ruang'),
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
	// $date = new DateTime(date('Y-m-d'));
		// $date->modify('+36 month');
		// echo "Sekarang : " .date('Y-m-d'). "<br>";
		// echo "36 Bulan kemudian : ".$date->format('Y-m-d') . "\n";
	

}

/* End of file Mkepangkatan.php */
/* Location: ./application/models/Mkepangkatan.php */