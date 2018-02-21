<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Perintah_op extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Perintah OP', "perintah_op");

		$this->load->model(array('mperintah_op'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Perintah OP", "Data Perintah OP ");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("perintah_op?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mperintah_op->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Perintah OP ";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_perintah_op'] = $config['total_rows'];
		$this->data['perintah_op'] = $this->mperintah_op->get_all($this->per_page, $this->page, 'result');
		$this->template->view('intel/data_perintah_op', $this->data);

	}

	public function create_surat_op($param = 0)
	{
		if (!$param) {
			show_404();
		}


		$this->page_title->push("Perintah OP", "Buat Surat Perintah OP ");

		$this->breadcrumbs->unshift(2, 'Buat', "perintah_op/create_surat_op");

		$this->form_validation->set_rules('no_telaah', 'Nomor', 'trim|required');
		$this->form_validation->set_rules('pokok_permasalahan', 'Pokok Permasalahan', 'trim|required');
		$this->form_validation->set_rules('uraian_permasalahan', 'Uraian Permasalahan', 'trim|required');
		$this->form_validation->set_rules('telaahan', 'Telaahan', 'trim|required');
		$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Saran Tindak', 'trim|required');


		if ($this->form_validation->run() == TRUE)
		{
			$this->mperintah_op->create_surat_op($param);

			redirect(base_url('perintah_op'));
		}
		$this->data['title'] = "Buat Telaahan Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/create_surat_op', $this->data);
	}



}
