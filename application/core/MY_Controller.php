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
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */