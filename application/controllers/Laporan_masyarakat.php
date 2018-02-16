<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Laporan_masyarakat extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan Masyarakat', "laporan_masyarakat");

		$this->load->model(array('mlaporan_masyarakat'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Laporan Masyarakat", "Buat Laporan Masyarakat");

		$this->breadcrumbs->unshift(2, 'Buat', "laporan_masyarakat/index");

		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');
		$this->form_validation->set_rules('asal', 'Asal', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Prihal', 'trim|required');


		if ($this->form_validation->run() == TRUE)
		{
			$this->mlaporan_masyarakat->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Laporan Masyarakat";
		$this->template->view('intel/create_laporan_masyarakat', $this->data);
	}

	public static function data_laporan()
	{
		$this->page_title->push("Laporan Masyarakat", "Data Laporan Masyarakat");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("data_laporan?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mlaporan_masyarakat->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Laporan Masyarakat";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_data_laporan'] = $config['total_rows'];
		$this->data['data_laporan'] = $this->mlaporan_masyarakat->get_all($this->per_page, $this->page, 'result');
		$this->template->view('intel/data_laporan_masyarakat', $this->data);
	}
	

	// public function instruksi_disposisi($param = 0)
	// {

	// 	if (!$param) {
	// 		show_404();
	// 	}

	// 	if ($this->mlaporan_masyarakat->get($param) == 0) {
	// 		show_404();
	// 	}
	// 	if ($this->mlaporan_masyarakat->get($param, 'cek_disposisi') == 1) {
			
	// 		show_404();
	// 	} 

	// 	$this->page_title->push("Laporan Masyarakat", "Buat Instruksi dan Disposisi");

	// 	$this->breadcrumbs->unshift(3, 'Buat', "laporan_masyarakat/instruksi_disposisi");

	// 	$this->form_validation->set_rules('instruksi', 'Instruksi', 'trim|required');
	// 	$this->form_validation->set_rules('group_id', 'Disposisi', 'trim|required');


	// 	if ($this->form_validation->run() == TRUE)
	// 	{
	// 		$this->mlaporan_masyarakat->instruksi_disposisi($param);

	// 		redirect(current_url());
	// 	}
	// 	$this->data['title'] = "Buat Instruksi dan Disposisi";
	// 	$this->template->view('intel/instruksi_disposisi', $this->data);
	// }

}
