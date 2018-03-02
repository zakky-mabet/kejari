<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth','upload'));

		$this->load->helper(array('security'));
	}
	
	public function login()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$account = $this->_get_account($this->input->post('nip'));

			if($account == TRUE)
			{
	        	if (password_verify($this->input->post('password'), $account['password'])) 
	        	{
	                $this->db->update(
	                	'users', array(
	                		'firebase_token' => $this->input->post('token')
	                	), 
	                	array('id' => $account['id'])
	                );

	        		$response =  array_merge(
	        			array(
	        				'status' => 'OK', 
	        				'message' => "Selamat datang ".$account['first_name'],
	        				'user_ID' => $account['id'],
	        				'jumlah_notifikasi' => $this->countNotifikasi($account['id']),
	        				'foto_pegawai' => base_url("public/images/pegawai/{$account['foto']}")
	        			), $account);
	        	} else {
	        		$response =  array(
	        			'status' => "ERROR",
	        			'message' => "Kombinasi NIP dan Password tidak cocok!"
	        		);
	        	}
			} else {
				$response = array(
					'status' => "ERROR",
					'message' => "Maaf! Anda tidak terdaftar pada sistem."
				);
			}
		} else {
			$response = array(
				'status' => "ERROR",
				'message' => "Maaf! Terjadi kesalahan keamanan pada sistem."
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}


	/**
	 * Take a data  accounts
	 *
	 * @param String (nik)
	 * @access private
	 * @return Object
	 **/
	private function _get_account($param = 0)
	{
		$this->db->select('
			users.id, users.first_name, users.password, users.email, kepegawaian.nama, kepegawaian.nip, kepegawaian.no_tlp, kepegawaian.tempat_lahir, kepegawaian.agama, kepegawaian.tgl_lahir, kepegawaian.jns_kelamin, kepegawaian.pendidikan_terakhir, kepegawaian.alamat, kepegawaian.foto, jabatan, firebase_token, users_groups.group_id
		');
		$this->db->join('users_groups', 'users.id = users_groups.user_id', 'left');
		$this->db->join('kepegawaian', 'users.nip = kepegawaian.nip', 'left');
		$this->db->group_by('users.id');
		$query = $this->db->get_where('users', array('users.nip' => $param, 'active' => 1));

		if($query->num_rows() == 1)
		{
			return $query->row_array();
		} else {
			return array('password' => '');
		}
	}

	public function init()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$account = $this->_get_account($this->input->post('nip'));

	    	$this->db->update(
		     	'users', array(
		      	'firebase_token' => $this->input->post('token')
	     	), 
	     		array('id' => $account['id'])
	    	);

			$response =  array_merge(
				array(
			 		'status' => 'OK', 
			 		'message' => "Data pengguna berhasil diperbarui.",
			 		'user_ID' => $account['id'],
			 		'jumlah_notifikasi' => $this->countNotifikasi($account['id']),
			 		'foto_pegawai' => base_url("public/images/pegawai/{$account['foto']}")
			 	), $account);
		} else {
			$response = array(
				'status' => "ERROR",
				'message' => "Maaf! Terjadi kesalahan keamanan pada sistem."
			);
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function countNotifikasi($param = 0)
	{
		return $this->db->get_where('notifikasi', array('penerima' => $param, 'status' => 'unread'))->num_rows();
	}

	public function changepassword()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$account = $this->_get_account($this->input->post('nip'));

			if($account == TRUE)
			{
	        	if (password_verify($this->input->post('old_password'), $account['password'])) 
	        	{
	                $this->db->update(
	                	'users', array(
	                		'email' => $this->input->post('email'),
	                		'password' => ($this->input->post('new_password')!='') ? 
	                						password_hash($this->input->post('new_password'), PASSWORD_DEFAULT) : $account['password']
	                	), 
	                	array('id' => $account['id'])
	                );

	        		$response =  array_merge(
	        			array(
	        				'status' => 'OK', 
	        				'message' => "Perubahan data berhasil disimpan!"
	        			), 
	        		$account);
	        	} else {
	        		$response =  array(
	        			'status' => "ERROR",
	        			'message' => "Password lama anda tidak cocok!"
	        		);
	        	}
			} else {
				$response = array(
					'status' => "ERROR",
					'message' => "Maaf! Anda tidak terdaftar pada sistem."
				);
			}
		} else {
			$response = array(
				'status' => "ERROR",
				'message' => "Maaf! Terjadi kesalahan keamanan pada sistem."
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function uploadfotouser()
	{
		$config['upload_path'] = './public/images/pegawai/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = '10240';
		$config['max_height']  = '10240';
		$config['file_name'] = $this->input->post('nip');
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('upload'))
		{
	        $response = array(
	        	'status' => 'ERROR',
	        	'message' => $this->upload->display_errors()
	        );
		} else {
			$account = $this->db->get_where('kepegawaian',array('nip' => $this->input->post('nip')))->row();

			if($account->foto != '')
				@unlink("./public/images/pegawai/{$account->foto}");
	            
	        $this->db->update(
	        	'kepegawaian', array(
	            	'foto' => $this->upload->file_name,
	        	), 
	        	array('nip' => $account->nip)
	        );

	        $response = array(
	        	'status' => 'ERROR',
	        	'message' => "Foto berhasil diunggah.",
	        	'foto' => base_url("public/images/pegawai/{$this->upload->file_name}")
	        );
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/api/Users.php */
