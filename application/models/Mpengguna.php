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
			$this->db->like('kepegawaian.nip', $this->input->get('query'))
					 ->or_like('kepegawaian.nrp', $this->input->get('query'))
					 ->or_like('kepegawaian.nama', $this->input->get('query'));

		// tabel join berdasarkan data yang terakhir
		$this->db->select("kepegawaian.* ");
		$this->db->order_by('ID', 'DESC');
		$this->db->group_by('kepegawaian.nip');

		if($type == 'result')
		{
			return $this->db->get('kepegawaian', $limit, $offset)->result();
		} else {
			return $this->db->get('kepegawaian')->num_rows();
		}
	}

	public function user($param = 0)
	{
		return $this->db->get_where('kepegawaian', array('ID' => $param))->row();
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
			'nama' => $this->input->post('name'),
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('no_tlp'),
			'foto' => $foto
		);

		$this->db->update('kepegawaian', $data, array('ID' => $this->input->post('id')));

		$data2 = array(
			
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			
		);
		if($this->input->post('new_pass') != '')
			$data['password'] = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

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

		
}

/* End of file Mpengguna.php */
/* Location: ./application/models/Mpengguna.php */