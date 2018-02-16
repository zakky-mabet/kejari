<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat extends Admin_panel 
{

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(2, 'Kepegawaian', "kepegawaian/create");

		$this->load->model(array('mdiklat'));

		$this->load->helper(array('indonesia'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->data['riwayat_diklat'] = $this->mdiklat->get_all($this->per_page, $this->page, 'result');


		$this->page = $this->input->get('page');
		$this->query = $this->input->get('query');


		$this->load->js(base_url("public/app/diklat/diklat.js"));
		$this->load->css(base_url("public/app/diklat/diklat.css"));
	}

	public function index()
	{

		$this->page_title->push("Kepegawaian", "Data Riwayat Diklat");

		$this->breadcrumbs->unshift(3, 'Data Riwayat Diklat', "diklat/index");
		
		$config = $this->template->pagination_list();
		
		$config['base_url'] = site_url("diklat?per_page={$this->per_page}&query={$this->query}");
		
		$config['per_page'] = $this->per_page;
		
		$config['total_rows'] = $this->mdiklat->get_all(null, null, 'num');
		// untuk memanggil data dari database
		$this->data['riwayat_diklat'] = $this->mdiklat->get_all($this->per_page, $this->page, 'result');

		$this->pagination->initialize($config);
		
		$this->data['title'] = "Riwayat Diklat";
		
		$this->template->view('diklat/data_diklat', $this->data);
	}

	public function create()
	{
		

		$this->page_title->push("Kepegawaian", "Tambahkan Data Riwayat Diklat");

		$this->breadcrumbs->unshift(3, 'Data Riwayat Diklat', "diklat/index");

		$this->breadcrumbs->unshift(4, 'Tambahkan Baru', "diklat/create");

		$this->form_validation->set_rules('nip', 'Nip - Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('tingkat', 'Nama Tingkatan', 'trim|required');
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->mdiklat->create();

			redirect(current_url());
		}

		$this->data['title'] = "Riwayat Diklat";

		$this->template->view('diklat/create_diklat', $this->data);

	}

	public function update($param = 0)
	{	

		$this->page_title->push("Kepegawaian", "Ubah Data Riwayat Diklat");

		$this->breadcrumbs->unshift(3, 'Data Riwayat Diklat', "diklat/index");

		$this->breadcrumbs->unshift(4, 'Ubah', "diklat/create");

		$this->form_validation->set_rules('nip', 'Nip - Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('tingkat', 'Nama Tingkatan', 'trim|required');
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mdiklat->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Ubah Riwayat Diklat";
		$this->data['get'] = $this->mdiklat->get($param);
		$this->template->view('diklat/update_diklat', $this->data);
	}

	public function detail_pegawai($param = 0)
	{
		$this->page_title->push("Kepegawaian", "Detail Data Riwayat Diklat");

		$this->breadcrumbs->unshift(3, 'Data Riwayat Diklat', "diklat/index");

		$this->breadcrumbs->unshift(4, 'Detail', "diklat/create");

		$this->data['title'] = "Detail Riwayat Diklat";
		$this->data['kepegawaian'] = $this->mdiklat->detail_pegawai($param);
		$this->template->view('diklat/detail_pegawai', $this->data);
		
	}

	public function delete($param = 0)
	{
		$this->mdiklat->delete($param);

		redirect('diklat');
	}

}

/* End of file Diklat.php */
/* Location: ./application/controllers/Diklat.php */