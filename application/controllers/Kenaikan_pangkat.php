<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_pangkat extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array('mkenaikan_pangkat'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/kepegawaian.js"));
		$this->load->js(base_url("public/app/diklat/kepangkatan.js"));

	}

	public function index()
	{
		$this->page_title->push("Kepegawaian", "Data Kepegawaian");
		$this->breadcrumbs->unshift(3, 'Kenaikan Pangkat', "kenaikan_pangkat/index");
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("kepangkatan?per_page={$this->per_page}&query={$this->query}");
		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mkepangkatan->get_all(null, null, 'num');
		$this->pagination->initialize($config);

		$this->data['title'] = "Data Kepegawaian";
		$this->data['kepangkatan'] = $this->mkenaikan_pangkat->get_all($this->per_page, $this->page, 'result');
		$this->template->view('kenaikan-pangkat/create_kenaikan_pangkat', $this->data);
	}

	public function create()
	{
		$this->page_title->push("Kenaikan Pangkat", "Tambahkan Data Kenaikan Pangkat");

		$this->breadcrumbs->unshift(3, 'Kenaikan Pangkat', "kenaikan_pangkat/index");
		
		$this->breadcrumbs->unshift(4, 'Tambahkan Data', "kenaikan_pangkat/create");

		$this->form_validation->set_rules('nip','Nama Pegawai','trim|required');
		$this->form_validation->set_rules('id_pangkat','Pangkat','trim|required');
		$this->form_validation->set_rules('date', 'TMT', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkenaikan_pangkat->create();

			redirect(current_url());
		}

		$this->data['title'] = "Tambahkan Kepegawaian";
		$this->template->view('kenaikan-pangkat/create_kenaikan_pangkat', $this->data);
		
	}

}

/* End of file Kenaikan_pangkat.php */
/* Location: ./application/controllers/Kenaikan_pangkat.php */