<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkepangkatan extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload'));
		$this->load->helper(array('indonesia'));
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nip', $this->input->get('query'))
					 ->or_like('nrp', $this->input->get('query'))
					 ->or_like('nama', $this->input->get('query'));

		if($type == 'result')
		{
			return $this->db->get('kepangkatan', $limit, $offset)->result();
		} else {
			return $this->db->get('kepangkatan')->num_rows();
		}
	}

	public function detail_kepangkatan($param = 0)
	{
		return $this->db->get_where('kepangkatan', array('nip' => $param))->result();
	
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

		$btsAkhir = new DateTime($this->input->post('date'));
		$btsAkhir->modify('+36 month');

		$kepangkatan = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'pangkat' => $this->input->post('pangkat'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
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

	public function update($param = 0)
	{
		$get = $this->get($param);

		$config['upload_path'] = './public/images/kepangkatan/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';

		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			if($get->lampiran_sk != FALSE)
				@unlink("public/images/kepangkatan/{$get->lampiran_sk}");

			$foto = $this->upload->file_name;
		} else {
			$foto = $get->lampiran_sk;
		}

		$btsAkhir = new DateTime($this->input->post('date'));
		$btsAkhir->modify('+36 month');

		$kepangkatan = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'pangkat' => $this->input->post('pangkat'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'golongan' => $this->input->post('golongan'),
			'ruang' => $this->input->post('ruang'),
			'keterangan' => $this->input->post('keterangan'),
			
		);

		$this->db->update('kepangkatan', $kepangkatan, array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepangkatan di Update.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal Update data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
		
	}

	public function delete($param = 0)
	{
		$get= $this->get($param);

		if($get->lampiran_sk != FALSE)
			@unlink("public/images/kepangkatan/{$get->lampiran_sk}");

		$this->db->delete('kepangkatan', array('ID' => $param));

		$this->template->alert(
			' Data Kepangkatan berhasil di Hapus.', 
			array('type' => 'success','icon' => 'check')
		
		);
		
	}

	public function get($param = 0)
	{
		return $this->db->get_where('kepangkatan', array('ID' => $param))->row();
	}
	

}

/* End of file Mkepangkatan.php */
/* Location: ./application/models/Mkepangkatan.php */