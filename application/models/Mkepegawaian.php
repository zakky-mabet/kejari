<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkepegawaian extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload'));
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{

		
		if($this->input->get('query') != '')
			$this->db->like('kepegawaian.nip', $this->input->get('query'))
					 ->or_like('kepegawaian.nrp', $this->input->get('query'))
					 ->or_like('kepegawaian.nama', $this->input->get('query'));

		// tabel join berdasarkan data yang terakhir
		$this->db->select("kepegawaian.*, (SELECT nama_pangkat FROM kepangkatan LEFT JOIN pangkat ON kepangkatan.id_pangkat = pangkat.ID 
																	WHERE kepegawaian.nip  = kepangkatan.nip ORDER BY kepangkatan.nip 
																	DESC LIMIT 1) AS pangkat
											");
		$this->db->order_by('ID', 'DESC');
		$this->db->group_by('kepegawaian.nip');

		if($type == 'result')
		{
			return $this->db->get('kepegawaian', $limit, $offset)->result();
		} else {
			return $this->db->get('kepegawaian')->num_rows();
		}
	}
	
	public function create()
	{
		$config['upload_path'] = './public/images/pegawai/';
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

		$kepegawaian = array(
			'nip' => $this->input->post('nip'),
			'nrp' => $this->input->post('nrp'),
			'nama' => $this->input->post('name'),
			'tempat_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jns_kelamin' => $this->input->post('gender'),
			'agama' => $this->input->post('agama'),
			'no_tlp' => $this->input->post('telepon'),
			'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
			'alamat' => $this->input->post('alamat'),
			'jabatan' => $this->input->post('jabatan'),
			'bidang' => $this->input->post('bidang'),
			'status_dinas' => '1',
			'foto' => $foto
		);

		$this->db->insert('kepegawaian', $kepegawaian);

		$additional_data = array(
								'first_name' => $this->input->post('name'),
								'nip' => $this->input->post('nip'),
								'password' => password_hash($this->input->post('nip'), PASSWORD_DEFAULT),
								'active' => 1
								);

			$this->ion_auth->register(
			null, 
			null,
			null, 
			$additional_data, 
			$this->input->post('group')
		);

		$this->db->insert('users', $additional_data, array('nip' => $this->input->post('nip')));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepegawaian ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}



	public function get($param = 0)
	{
		return $this->db->get_where('kepegawaian', array('ID' => $param))->row();
	}


	public function cek_data($param = 0)
	{
		return $this->db->get_where('kepegawaian', array('ID' => $param) )->num_rows();
	}


	public function update($param = 0)
	{
		$get = $this->get($param);

		$config['upload_path'] = './public/images/pegawai/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';
		
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			if($get->foto != FALSE)
				@unlink("public/images/pegawai/{$get->foto}");

			$foto = $this->upload->file_name;
		} else {
			$foto = $get->foto;
		}

		$kepegawaian = array(
			'nip' => $this->input->post('nip'),
			'nrp' => $this->input->post('nrp'),
			'nama' => $this->input->post('name'),
			'tempat_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jns_kelamin' => $this->input->post('gender'),
			'agama' => $this->input->post('agama'),
			'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('telepon'),
			'status_dinas' => $this->input->post('status'),
			'jabatan' => $this->input->post('jabatan'),
			'bidang' => $this->input->post('bidang'),
			'foto' => $foto
		);

		$this->db->update('kepegawaian', $kepegawaian, array('ID' => $param));

		$additional_data = array(
								'first_name' => $this->input->post('name'),
								'nip' => $this->input->post('nip'),
								'password' => password_hash($this->input->post('nip'), PASSWORD_DEFAULT),
								'active' => $this->input->post('status') ,
								);

			$this->ion_auth->register(
			null, 
			null,
			null, 
			$additional_data, 
			$this->input->post('group')
		);

		$this->db->update('users', $additional_data, array('nip' => $this->input->post('nip')));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepegawaian berhasil di update.', 
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

		if($get->foto != FALSE)
			@unlink("public/images/pegawai/{$get->foto}");

		
		$this->db->delete('kepegawaian', array('ID' => $param));
		
		$this->template->alert(
			' Data kepegawaian berhasil Hapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

}

/* End of file Mkepegawaian.php */
/* Location: ./application/models/Mkepegawaian.php */