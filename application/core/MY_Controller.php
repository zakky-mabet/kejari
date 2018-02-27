<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	}
}

/**
* Extends Class Authentifaction
*
* @author Vicky Nitinegoro <pkpvicky@gmail.com> 
* @link Developer Link http://vicky.work/
*/
class Admin_panel extends MY_Controller
{
	public $user_login;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->library(
			array('ion_auth','form_validation','slug','session','template','breadcrumbs', 'pagination','page_title')
		);

		$this->load->helper(array('menus'));

		if($this->ion_auth->logged_in() != FALSE) 
		{
			$this->data['user'] = $this->ion_auth->user()->row();
		} else {
			redirect('auth','refresh');
		}

		$this->load->helper(
			array('text', 'form','date')
		);

		$this->breadcrumbs->unshift(0, 'Dashboard', "/");
	}

	public function empty_tables()
	{
		$this->db->empty_table('disposisi');
		$this->db->empty_table('lapopsin');
		$this->db->empty_table('laporan_masyarakat');
		$this->db->empty_table('notifikasi');
		$this->db->empty_table('perintah_op');
		$this->db->empty_table('perintah_op_kepada');
		$this->db->empty_table('telaah');
		$this->db->empty_table('terusan_disposisi');

		if($this->db->affected_rows())
		{
			echo 'empty tables success'; 
				
		} else {

			echo 'Maaf, Terjadi Kesalahan'; 

		}

	}
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */