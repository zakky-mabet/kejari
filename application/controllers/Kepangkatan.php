<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepangkatan extends Admin_panel 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array('mkepangkatan'));

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

		$config['base_url'] = site_url("kepangkatan?per_page={$this->per_page}&query={$this->query}");

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Kepegawaian";
		$this->data['kepegawaian'] = $this->mkepegawaian->get_all($this->per_page, $this->page, 'result');
		$this->template->view('kepegawaian/detail_kepangkatan', $this->data);
	}

	// ini adalah tambah detai kepangkatan
	public function create()
	{
		$this->page_title->push("Detail Kepangkatan", "Tambahkan Kepangkatan");

		$this->breadcrumbs->unshift(3, 'Data Kepegawaian', "kepegawaian/index");

		$this->breadcrumbs->unshift(4, 'Detail Kepangkatan', "kepegawaian/detail_kepangkatan");

		$this->breadcrumbs->unshift(5, 'Tambahkan Kepangkatan', "kepegawaian/create_kepangkatan");

		$this->form_validation->set_rules('date', 'TMT', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
		$this->form_validation->set_rules('ruang', 'Ruang', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepangkatan->create();

			redirect(current_url());
		}

		$this->data['title'] = "Detail Riwayat Diklat";
		//$this->data['kepegawaian'] = $this->mdiklat->detail_pegawai($param);
		$this->template->view('kepegawaian/create-kepangkatan', $this->data);

		
			
	}

}

/* End of file Kepangkatan.php */
/* Location: ./application/controllers/Kepangkatan.php */