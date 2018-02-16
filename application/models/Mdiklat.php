<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdiklat extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload'));
	}

	public function get_all_pegawai()
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
		$this->db->select('riwayat_diklat.*, kepegawaian.nama AS nama_pegawai, kepegawaian.ID  AS ID_pegawai, kepegawaian.ID AS id_pegawai');

		$this->db->join('kepegawaian', 'riwayat_diklat.nip = kepegawaian.nip', 'left');
		

		if($type == 'result')
		{
			return $this->db->get('riwayat_diklat', $limit, $offset)->result();
		} else {
			return $this->db->get('riwayat_diklat')->num_rows();
		}
	}

	public function create()
	{
		$config['upload_path'] = './public/diklat-file/images/';
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

		$riwayat_diklat = array(
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'tingkat' => $this->input->post('tingkat'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'lampiran' => $foto,
			'keterangan' => $this->input->post('keterangan'),

		);

		$this->db->insert('riwayat_diklat', $riwayat_diklat);


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Riwayat ditambahkan.', 
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

		$config['upload_path'] = './public/diklat-file/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';
		
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			if($get->foto != FALSE)
				@unlink("public/diklat-file/images/{$get->foto}");

			$foto = $this->upload->file_name;
		} else {
			$foto = $get->lampiran;
		}

		$riwayat_diklat = array(
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'tingkat' => $this->input->post('tingkat'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'lampiran' => $foto,
			'keterangan' => $this->input->post('keterangan'),

		);

		$this->db->update('riwayat_diklat', $riwayat_diklat, array('ID' => $param));


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Riwayat Diklat berhasil di Update.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}

	}

	public function delete($param = 0)
	{
		$get = $this->get($param);

		if($get->lampiran != FALSE)
			@unlink("public/diklat-file/images/{$get->lampiran}");

		$this->db->delete('riwayat_diklat', array('ID' => $param));

		$this->template->alert(
			' Data Riwayat Diklat berhasil di Hapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function detail_pegawai($param = 0)
	{
		$this->db->select('
							kepegawaian.nip,
							kepegawaian.nama AS nama_pegawai, kepegawaian.foto, kepegawaian.nrp, kepegawaian.tempat_lahir, kepegawaian.tgl_lahir,
							kepegawaian.jns_kelamin, kepegawaian.alamat, kepegawaian.agama, kepegawaian.pendidikan_terakhir
						');

		$this->db->where('kepegawaian.ID', $param);

		return $this->db->get('kepegawaian')->row();
	}

	public function get($param = 0)
	{

		return $this->db->get_where('riwayat_diklat', array('ID' => $param))->row();
	}

}

/* End of file Mdiklat.php */
/* Location: ./application/models/Mdiklat.php */