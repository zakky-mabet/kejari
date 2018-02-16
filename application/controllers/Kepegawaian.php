<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepegawaian extends Admin_panel 
{
	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kepegawaian', "kepegawaian");

		$this->load->model(array('mkepegawaian'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/kepegawaian.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Kepegawaian", "Data Kepegawaian");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("kepegawaian?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mkepegawaian->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Kepegawaian";
		$this->data['kepegawaian'] = $this->mkepegawaian->get_all($this->per_page, $this->page, 'result');
		$this->template->view('kepegawaian/data-kepegawaian', $this->data);
	}

	public function create()
	{
		$this->page_title->push("Kepegawaian", "Tambah Data Kepegawaian");

		$this->breadcrumbs->unshift(3, 'Tambahkan', "kepegawaian/create");

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('nrp', 'NRP', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan terakhir', 'trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'trim');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepegawaian->create();

			redirect(current_url());
		}

		$this->data['title'] = "Tambahkan Kepegawaian";
		$this->template->view('kepegawaian/create-kepegawaian', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push("Kepegawaian", "Ubah Data Kepegawaian");

		$this->breadcrumbs->unshift(3, 'Ubah', "kepegawaian/create");

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('nrp', 'NRP', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan terakhir', 'trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'trim');
		$this->form_validation->set_rules('status', 'Status Dinas', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepegawaian->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Ubah Kepegawaian";
		$this->data['get'] = $this->mkepegawaian->get($param);
		$this->template->view('kepegawaian/update-kepegawaian', $this->data);	
	}

	public function delete($param = 0)
	{
		$this->mkepegawaian->delete($param);

		redirect('kepegawaian');
	}
}

/* End of file Kepegawaian.php */
/* Location: ./application/controllers/Kepegawaian.php */