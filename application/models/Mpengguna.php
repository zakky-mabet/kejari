<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpengguna extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{

		if($this->input->get('query') != '')
			$this->db->like('users.nip', $this->input->get('query'))
					 ->or_like('users.nama', $this->input->get('query'));

		// tabel join berdasarkan data yang terakhir
		$this->db->select("users.* ");
		if($type == 'result')
		{
			return $this->db->get('users', $limit, $offset)->result();
		} else {
			return $this->db->get('users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('users', array('id' => $param))->row();
	}


	public function update()
	{

	$get_pass = $this->mpengguna->get_by_id($this->input->post('id'));

	if (password_verify($this->input->post('old_pass'), $get_pass->password) == TRUE ) 
	{

		$config['upload_path'] = './public/images/pegawai/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';
		
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			if($get_pass->foto != FALSE)
				@unlink("public/images/pegawai/{$get_pass->foto}");

			$foto = $this->upload->file_name;
		} else {
			$foto = $get_pass->foto;
		}

		$data = array(
			'nama' => $this->input->post('first_name'). ' ' .$this->input->post('last_name'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $foto
		);

		$this->db->update('kepegawaian', $data, array('ID' => $this->input->post('id')));

		$data2 = array(
			
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone' => $this->input->post('no_tlp'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			
		);
		if($this->input->post('new_pass') != '')
			$data2['password'] = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		$this->db->update('users', $data2, array('ID' => $this->input->post('id')));


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Pengguna berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	

	}else {
		
		$this->template->alert(
				' Password Lama Anda Salah.', 
				array('type' => 'danger','icon' => 'times')
			);
		}

	}

	public function update_user($param = 0)
	{
		$user = array(
			'nip' => $this->input->post('nip'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'active' => $this->input->post('status'),
			
		);

		$this->db->update('users', $user, array('id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Pengguna berhasil di update.', 
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

/* End of file Mpengguna.php */
/* Location: ./application/models/Mpengguna.php */