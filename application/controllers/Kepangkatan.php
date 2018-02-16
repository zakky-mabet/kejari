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
		$this->load->js(base_url("public/app/diklat/kepangkatan.js"));

	}

	public function index()
	{
		$this->page_title->push("Kepegawaian", "Data Kepegawaian");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("kepangkatan?per_page={$this->per_page}&query={$this->query}");
		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mkepangkatan->get_all(null, null, 'num');
		$this->pagination->initialize($config);

		$this->data['title'] = "Data Kepegawaian";
		$this->data['kepangkatan'] = $this->mkepangkatan->get_all($this->per_page, $this->page, 'result');
		$this->template->view('kepegawaian/detail-kepangkatan', $this->data);
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
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepangkatan->create();

			redirect(current_url());
		}

		$this->data['title'] = "Detail Riwayat Diklat";
		$this->template->view('kepegawaian/create-pangkatan', $this->data);
			
	}
	// ini adalah tabel detail kepangkatan
	public function detail_kepangkatan($param = 0)
	{
		$this->page_title->push("Kepegawaian", "Detail Kepangkatan");

		$this->breadcrumbs->unshift(3, 'kepegawaian', "kepegawaian/index");

		$this->breadcrumbs->unshift(4, 'Detail Kepangkatan', "kepegawaian/create");

		$this->data['title'] = "Detail Kepangkatan";
		$this->data['param'] = $param;
		$this->data['kepangkatan'] = $this->mkepangkatan->detail_kepangkatan($param);
		$this->data['get'] = $this->db->get_where('kepegawaian', array('ID'=> $param))->row();
		$this->template->view('kepegawaian/detail-kepangkatan', $this->data);	
	}


	public function create_pangkat($param = 0)
	{
		$this->page_title->push("Tambahkan Kepangkatan");

		$this->breadcrumbs->unshift(3, 'Detail Kepangkatan', "kepegawaian/create");
		$this->breadcrumbs->unshift(4, 'Tambahkan Kepangkatan', "kepegawaian/create");

		$this->form_validation->set_rules('date', 'TMT', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
		$this->form_validation->set_rules('ruang', 'Ruang', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepangkatan->create();

			redirect(current_url());
		}

		$this->data['title'] = "Detail Kepangkatan";
		//$this->data['kepangkatan'] = $this->mkepangkatan->detail_kepangkatan($param);
		$this->data['get'] = $this->db->get_where('kepegawaian', array('kepegawaian.ID'=> $param))->row();
		$this->template->view('kepegawaian/create-kepangkatan', $this->data);	
		
	}


	public function update($param = 0)
	{
		$this->page_title->push("Detail Kepangkatan","Ubah Data Kepangkatan");

		$this->breadcrumbs->unshift(3, 'Detail Kepangkatan', "kepegawaian/create");
		$this->breadcrumbs->unshift(4, 'Ubah Data Kepangkatan', "kepegawaian/create");

		$this->form_validation->set_rules('date', 'TMT', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
		$this->form_validation->set_rules('ruang', 'Ruang', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mkepangkatan->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Detail Kepangkatan";
		$this->data['pangkat'] = $this->mkepangkatan->get($param);

		$this->template->view('kepegawaian/update-kepangkatan', $this->data);
		
	}

	public function delete($param = 0)
	{
		$this->mkepangkatan->delete($param);

		redirect(site_url('kepangkatan/detail_kepangkatan/'.$this->input->get('back')));
	}

}

/* End of file Kepangkatan.php */
/* Location: ./application/controllers/Kepangkatan.php */