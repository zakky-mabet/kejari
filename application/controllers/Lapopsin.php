<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Lapopsin extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan Hasil Operasi Intelijen', "lapopsin");

		$this->load->model(array('mlapopsin'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Laporan Hasil Operasi Intelijen", "Data Laporan Hasil Operasi Intelijen ");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("lapopsin?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mlapopsin->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Laporan Hasil Operasi Intelijen ";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_lapopsin'] = $config['total_rows'];
		$this->data['lapopsin'] = $this->mlapopsin->get_all($this->per_page, $this->page, 'result');
		$this->template->view('intel/data_lapopsin', $this->data);

	}

	public function create_lapopsin($param = 0)
	{
		if (!$param) {
			show_404();
		}

		if ($this->mlapopsin->security($param) == 0 ) {
			show_404();
		}

		$this->page_title->push("Laporan Hasil Operasi Intelijen", "Buat Laporan Perintah Operasi Intelijen ");

		$this->breadcrumbs->unshift(2, 'Buat', "lapopsin/create_lapopsin");

		$this->form_validation->set_rules('nomor_laphosin', 'Nomor Lapopsin', 'trim|required');
		$this->form_validation->set_rules('dasar', 'Dasar', 'trim|required');
		$this->form_validation->set_rules('tugas', 'Tugas', 'trim|required');
		$this->form_validation->set_rules('bahan_keterangan', 'Bahan Keterangan', 'trim|required');
		$this->form_validation->set_rules('data_diperoleh', 'Data yang diperoleh', 'trim|required');
		$this->form_validation->set_rules('telaahan', 'Telaahan', 'trim|required');
		$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Saran Tindak', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mlapopsin->create_lapopsin($param);

			redirect(site_url('lapopsin'));
		}
		$this->data['title'] = "Buat Laporan Perintah Operasi Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/create_lapopsin', $this->data);
	}

	public function update_lapopsin($param = 0)
	{
		if (!$param) {
			show_404();
		}

		if ($this->mlapopsin->security($param) == 0 ) {
			show_404();
		}

		$this->page_title->push("Laporan Hasil Operasi Intelijen", "Sunting Laporan Perintah Operasi Intelijen ");

		$this->breadcrumbs->unshift(2, 'Sunting', "lapopsin/update_lapopsin");

		$this->form_validation->set_rules('nomor_laphosin', 'Nomor Lapopsin', 'trim|required');
		$this->form_validation->set_rules('dasar', 'Dasar', 'trim|required');
		$this->form_validation->set_rules('tugas', 'Tugas', 'trim|required');
		$this->form_validation->set_rules('bahan_keterangan', 'Bahan Keterangan', 'trim|required');
		$this->form_validation->set_rules('data_diperoleh', 'Data yang diperoleh', 'trim|required');
		$this->form_validation->set_rules('telaahan', 'Telaahan', 'trim|required');
		$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Saran Tindak', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mlapopsin->update_lapopsin($param);

			redirect(site_url('lapopsin'));
		}
		$this->data['title'] = "Sunting Laporan Perintah Operasi Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/update_lapopsin', $this->data);
	}
}
