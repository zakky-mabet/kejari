<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Perkara extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Perkara', "perkara");

		$this->load->model(array('mperkara'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		$this->page_title->push("Perkara", "Data Perkara Masuk");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("perkara?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mperkara->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Perkara Masuk";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_perkara'] = $config['total_rows'];
		$this->data['perkara'] = $this->mperkara->get_all($this->per_page, $this->page, 'result');
		$this->template->view('intel/data_perkara_masuk', $this->data);

	}

	public function create_telaah($param = 0)
	{
		if (!$param) {
			show_404();
		}

		if ($this->mperkara->security($param, 'cek_id_terusan_disposisi_telaah') == 1 ) {
			show_404();
		}

		$this->page_title->push("Perkara", "Buat Telaahan Intelijen");

		$this->breadcrumbs->unshift(2, 'Buat', "perkara/create_telaah");

		$this->form_validation->set_rules('no_telaah', 'Nomor', 'trim|required');
		$this->form_validation->set_rules('pokok_permasalahan', 'Pokok Permasalahan', 'trim|required');
		$this->form_validation->set_rules('uraian_permasalahan', 'Uraian Permasalahan', 'trim|required');
		$this->form_validation->set_rules('telaahan', 'Telaahan', 'trim|required');
		$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Saran Tindak', 'trim|required');


		if ($this->form_validation->run() == TRUE)
		{
			$this->mperkara->create_telaah($param);

			redirect(base_url('perkara'));
		}
		$this->data['title'] = "Buat Telaahan Intelijen";
		$this->data['param'] = $param;
		$this->template->view('intel/create_telaah', $this->data);
	}


	public function update_telaah($param = 0)
	{
		if (!$param) {
			show_404();
		}

		$this->page_title->push("Perkara", "Sunting Telaahan Intelijen");

		$this->breadcrumbs->unshift(3, 'Sunting', "perkara/update_telaah");

		$this->form_validation->set_rules('no_telaah', 'Nomor', 'trim|required');
		$this->form_validation->set_rules('pokok_permasalahan', 'Pokok Permasalahan', 'trim|required');
		$this->form_validation->set_rules('uraian_permasalahan', 'Uraian Permasalahan', 'trim|required');
		$this->form_validation->set_rules('telaahan', 'Telaahan', 'trim|required');
		$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Saran Tindak', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mperkara->update_telaah($param);

			redirect(current_url());
		}
		$this->data['get'] = $this->mperkara->get($param);
		$this->data['title'] = "Sunting Telaahan Intelijen";
		$this->template->view('intel/update_telaah', $this->data);
	}

	

}
