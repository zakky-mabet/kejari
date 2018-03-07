<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends admin_panel
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(2, 'Pengguna', "pengguna/create");

		$this->load->model(array('ion_auth_model'));

		$this->load->model(array('mpengguna'));

		$this->load->model(array('mkepegawaian'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		
		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');
		$this->load->js(base_url("public/app/pengguna.js"));
	}

	public function index()
	{
		$this->page_title->push("Pengaturan", "Data Pengguna Sistem");

		$this->breadcrumbs->unshift(3, 'Data Pengguna Sistem', "pengguna/index");
		
		$config = $this->template->pagination_list();
		
		$config['base_url'] = site_url("pengguna?per_page={$this->per_page}&query={$this->query}");
		
		$config['per_page'] = $this->per_page;
		
		$config['total_rows'] = $this->ion_auth_model->get_users_groups(null, null, 'num');
		// untuk memanggil data dari database
		$this->data['users'] = $this->ion_auth->users()->result();
		
		$this->pagination->initialize($config);
		
		$this->data['title'] = "Pengguna Sistem";
		
		$this->template->view('pengguna/pengguna-sistem', $this->data);
	}

	public function update($param = 0)
	{	
		
		$this->page_title->push("Account", "Pengguna Account");

		$this->breadcrumbs->unshift(3, 'Pengguna Account', "pengguna/index");

		$this->form_validation->set_rules('first_name', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Nama Belakang', 'trim|required');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[5]');
		$this->form_validation->set_rules('repeat_pass', 'Ini', 'trim|matches[new_pass]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->mpengguna->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "account";
		
		$this->template->view('pengguna/update-account', $this->data);
		
	}

	public function update_user($param = 0)
	{	
		
		$this->page_title->push("Pengguna", "Data Pengguna");

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Nama Belakang', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mpengguna->update_user($param);

			redirect(current_url());
		}

		$this->data['title'] = "account";
		$this->data['get'] = $this->mpengguna->get($param);
		$this->template->view('pengguna/update-user', $this->data);
		
	}

	public function delete($id)
	{
		$this->ion_auth->delete_user($id);

		redirect('pengguna');
	
	}

}

/* End of file pengguna.php */
/* Location: ./application/controllers/pengguna.php */