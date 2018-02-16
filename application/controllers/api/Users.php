<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth'));

		$this->load->helper(array('security'));
	}
	
	public function login()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$account = $this->_get_account($this->input->post('email'));

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
	        			), $account);
	        	} else {
	        		$response =  array(
	        			'status' => "ERROR",
	        			'message' => "Kombinasi Email dan Password tidak cocok!"
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
		$query = $this->db->get_where('users', array('email' => $param, 'active' => 1));

		if($query->num_rows() == 1)
		{
			return $query->row_array();
		} else {
			return array('password' => '');
		}
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/api/Users.php */