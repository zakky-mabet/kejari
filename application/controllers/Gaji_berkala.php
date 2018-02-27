<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_berkala extends Admin_panel 
{	
	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(2, 'Gaji Berkala', "gaji_berkala/index");

		$this->load->model(array('mgaji_berkala'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->data['gaji_berkala'] = $this->mgaji_berkala->get($this->per_page, $this->page, 'result');

		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/gaji.js"));
		$this->load->css(base_url("public/app/diklat/diklat.css"));
	}

	public function index()
	{
		$this->page_title->push("Gaji Berkala", "Data Gaji Berkala");

		$this->breadcrumbs->unshift(3, 'Data Gaji Berkala', "gaji_berkala/index");
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("gaji-berkala?per_page={$this->per_page}&query={$this->query}");
		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mgaji_berkala->get_all(null, null, 'num');
		$this->pagination->initialize($config);

		$this->data['title'] = "Gaji Berkala";
		$this->data['gaji_berkala'] = $this->mgaji_berkala->get_all($this->per_page, $this->page, 'result');
		$this->template->view('gaji-berkala/data-gaji-berkala', $this->data);
		
	}

	public function create()
	{
		$this->page_title->push("Gaji Berkala", "Tambah Data Gaji Berkala");

		$this->breadcrumbs->unshift(3, 'Tambahkan', "gaji-berkala/create");

		$this->form_validation->set_rules('nip', 'NIP - Pegawai', 'trim|required');
		$this->form_validation->set_rules('date', 'Tanggal Mulai Terdaftar', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mgaji_berkala->create();

			redirect(current_url());
		}

		$this->data['title'] = "Tambahkan Data Gaji Berkala";
		$this->template->view('gaji-berkala/create-gaji', $this->data);
	}

	public function update($param = 0 )
	{ 
		if (!$param) {
			show_404();
		}

		if ($this->mgaji_berkala->cek_data($param) == 0) {
			show_404();
		}
		$this->page_title->push("Gaji Berkala", "Ubah Data Gaji Berkala");

		$this->breadcrumbs->unshift(3, 'Ubah Data', "gaji-berkala/create");

		$this->form_validation->set_rules('nip', 'NIP - Pegawai', 'trim|required');
		$this->form_validation->set_rules('date', 'Tanggal Mulai Terdaftar', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mgaji_berkala->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Tambahkan Data Gaji Berkala";
		//terhubung dengan model gaji dengan nama get
		$this->data['gaji'] = $this->mgaji_berkala->get($param);
		$this->template->view('gaji-berkala/update-gaji', $this->data);
	}

	public function delete($param = 0)
	{
		$this->mgaji_berkala->delete($param);

		redirect('gaji_berkala');
	}

	public function print_out()
	{
		$config = $this->template->pagination_list();

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mgaji_berkala->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Laporan Gaji Berkala";
		$this->data['num_data_laporan'] = $config['total_rows'];
		$this->data['gaji_berkala'] = $this->mgaji_berkala->get_all($this->per_page, $this->page, 'result');
		$this->load->view('pages/gaji-berkala/data_laporan_gaji_berkala_print', $this->data);
	}

}

/* End of file Gaji_berkala.php */
/* Location: ./application/controllers/Gaji_berkala.php */