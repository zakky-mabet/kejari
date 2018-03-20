<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class P18 extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Surat Hasil Penyidikan Belum Lengkap', "p18");

		$this->load->model(array('mp18'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/pidum.js"));
	}
	
	public function index()
	{
		$this->page_title->push("P-18", "Data Surat Hasil Penyidikan Belum Lengkap");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("p18?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mp18->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Surat Hasil Penyidikan Belum Lengkap";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_p18'] = $config['total_rows'];
		$this->data['p18'] = $this->mp18->get_all($this->per_page, $this->page, 'result');
		$this->template->view('pidum/data_p18', $this->data);
	}

	public function create($param = 0)
	{
		$this->page_title->push("P-18 ", "Buat P-18 ");

		$this->breadcrumbs->unshift(2, 'Buat', "p18/create");
		
		$this->form_validation->set_rules('nomor', 'NOMOR', 'trim|required');
		$this->form_validation->set_rules('sifat', 'SIFAT ', 'trim|required');
		$this->form_validation->set_rules('perihal', 'PERIHAL ', 'trim|required');
		$this->form_validation->set_rules('dikirim_kepada', 'KEPADA ', 'trim|required');
		$this->form_validation->set_rules('ditempat', 'TEMPAT ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp18->create($param);

			redirect(site_url('p18'));
		}

		$this->data['title'] = "Buat Surat Hasil Penyidikan Belum Lengkap ";
		$this->data['param'] = $param;
		$this->template->view('pidum/create_p18', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push("P-18 ", "Sunting P-18 ");

		$this->breadcrumbs->unshift(2, 'Sunting', "p18/update");
		
		$this->form_validation->set_rules('nomor', 'NOMOR', 'trim|required');
		$this->form_validation->set_rules('sifat', 'SIFAT ', 'trim|required');
		$this->form_validation->set_rules('perihal', 'PERIHAL ', 'trim|required');
		$this->form_validation->set_rules('dikirim_kepada', 'KEPADA ', 'trim|required');
		$this->form_validation->set_rules('ditempat', 'TEMPAT ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp18->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Sunting Surat Hasil Penyidikan Belum Lengkap ";
		$this->data['param'] = $param;
		$this->template->view('pidum/update_p18', $this->data);
	}



	public function delete($param = 0)
	{
		$this->mp18->delete($param);

		redirect('p18');
	}

	
}
