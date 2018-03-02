<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends admin_panel
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(2, 'Pengguna', "pengguna/create");

		$this->load->model(array('ion_auth_model'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		
		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push("Pengaturan", "Data Pengguna Sistem");

		$this->breadcrumbs->unshift(3, 'Data Pengguna Sistem', "pengguna/index");
		
		$config = $this->template->pagination_list();
		
		$config['base_url'] = site_url("pengguna?per_page={$this->per_page}&query={$this->query}");
		
		$config['per_page'] = $this->per_page;
		
		//$config['total_rows'] = $this->ion_auth_model->get_all(null, null, 'num');
		// untuk memanggil data dari database
		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		
		$this->pagination->initialize($config);
		
		$this->data['title'] = "Pengguna Sistem";
		
		$this->template->view('pengguna/pengguna-sistem', $this->data);
	}

	public function update($param = 0)
	{	
		
		$this->page_title->push("Account", "Pengguna Account");

		$this->breadcrumbs->unshift(3, 'Pengguna Account', "pengguna/index");

		$this->data['title'] = "account";
		$this->template->view('pengguna/update-user', $this->data);
		
	}

}

/* End of file pengguna.php */
/* Location: ./application/controllers/pengguna.php */