<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Dokumen_telaah extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Dokumen Telaah', "dokumen_telaah");

		$this->load->model(array('mdokumen_telaah'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Dokumen Telaah", "Data Dokumen Telaah Masuk");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("dokumen_telaah?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mdokumen_telaah->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Dokumen Telaah Masuk";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_dokumen_telaah'] = $config['total_rows'];
		$this->data['dokumen_telaah'] = $this->mdokumen_telaah->get_all($this->per_page, $this->page, 'result');
		$this->template->view('intel/data_telaah_masuk', $this->data);

	}

	public function create_petunjuk($param = 0)
	{
		if (!$param) {
			show_404();
		}

		// if($this->mdokumen_telaah->get_in_create($param)->status_petunjuk == 'telah' ){
		// 	show_404();
		// }

		$this->page_title->push("Dokumen Telaah", "Buat Petunjuk Atas Dokumen Telaah Intelijen");

		$this->breadcrumbs->unshift(2, 'Buat', "dokumen_telaah/create_petunjuk");

		$this->form_validation->set_rules('petunjuk', 'Petunjuk', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mdokumen_telaah->create_petunjuk($param);

			redirect(base_url('dokumen_telaah'));
		}
		$this->data['title'] = "Buat Petunjuk Atas Dokumen Telaah Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/create_petunjuk', $this->data);
	}

	public function update_petunjuk($param = 0)
	{
		if (!$param) {
			show_404();
		}
		if($this->mdokumen_telaah->get_in_create($param)->status_petunjuk == 'belum' ){
			show_404();
		}
		$this->page_title->push("Dokumen Telaah", "Sunting Petunjuk Atas Dokumen Telaah Intelijen");

		$this->breadcrumbs->unshift(2, 'Sunting', "dokumen_telaah/update_petunjuk");

		$this->form_validation->set_rules('petunjuk', 'Petunjuk', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mdokumen_telaah->update_petunjuk($param);

			redirect(current_url());
		}
		$this->data['title'] = "Sunting Petunjuk Atas Dokumen Telaah Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/update_petunjuk', $this->data);
	}

}
