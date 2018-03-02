<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Laporan_informasi extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan Informasi', "laporan_informasi");

		$this->load->model(array('mlaporan_informasi'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/intel.js"));
	}
	
	public function index()
	{
		show_404();
	}

	public function harian()
	{
		$this->page_title->push("Laporan Informasi ", "Data Laporan Informasi Harian");

		$this->breadcrumbs->unshift(2, 'Laporan Informasi Harian', "laporan_informasi/harian");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("laporan_informasi/harian?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mlaporan_informasi->get_all(null, null, 'Informasi Harian', 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Laporan Informasi Harian";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_harian'] = $config['total_rows'];
		$this->data['harian'] = $this->mlaporan_informasi->get_all($this->per_page, $this->page, 'Informasi Harian', 'result');
		$this->template->view('intel/data_laporan_informasi', $this->data);
	}
	
	public function khusus()
	{
		$this->page_title->push("Laporan Informasi ", "Data Laporan Informasi Khusus");

		$this->breadcrumbs->unshift(2, 'Laporan Informasi Khusus', "laporan_informasi/khusus");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("laporan_informasi/khusus?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mlaporan_informasi->get_all(null, null, 'Informasi Khusus', 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Laporan Informasi Khusus";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_harian'] = $config['total_rows'];
		$this->data['harian'] = $this->mlaporan_informasi->get_all($this->per_page, $this->page, 'Informasi Khusus', 'result');
		$this->template->view('intel/data_laporan_informasi', $this->data);
	}

	public function create()
	{
		$this->page_title->push("Laporan Informasi ", "Buat Laporan Informasi ");

		$this->breadcrumbs->unshift(2, 'Buat', "laporan_informasi/create");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('informasi_diperoleh', 'Informasi yang diperoleh', 'trim|required');
		$this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'trim|required');
		$this->form_validation->set_rules('trend_perkembangan', 'Trend Perkembangan / Perkiraan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Pendapat / Saran / Tindak', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori ', 'trim|required');
		$this->form_validation->set_rules('id_user[]', 'Kirim Kepada ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mlaporan_informasi->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Laporan Informasi ";
		$this->template->view('intel/create_laporan_informasi', $this->data);
	}

	public function update($param = 0)
	{
		if (!$param) {
			show_404();
		}
		if ($this->mlaporan_informasi->get_num($param) == 0) {
			show_404();
		}

		$this->page_title->push("Laporan Informasi ", "Sunting Laporan Informasi ");

		$this->breadcrumbs->unshift(2, 'Sunting', "laporan_informasi/update");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('informasi_diperoleh', 'Informasi yang diperoleh', 'trim|required');
		$this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'trim|required');
		$this->form_validation->set_rules('trend_perkembangan', 'Trend Perkembangan / Perkiraan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Pendapat / Saran / Tindak', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori ', 'trim|required');
		$this->form_validation->set_rules('id_user[]', 'Kirim Kepada ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mlaporan_informasi->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Sunting Laporan Informasi ";
		$this->data['param'] = $param;
		$this->template->view('intel/update_laporan_informasi', $this->data);
	}

	/**
	 * Check Nomor Laporan Informasi
	 *
	 * @return string
	 **/
	public function validate_nomor()
	{
		if($this->mlaporan_informasi->nomor_cek($this->input->post('ID')) == TRUE)
		{
			$this->form_validation->set_message('validate_nomor', 'Maaf Nomor ini telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function delete($param = 0)
	{
		$this->mlaporan_informasi->delete($param);

		redirect('laporan_informasi/harian');
	}

	public function notifikasi()
	{
		$this->page_title->push("Laporan Informasi ", "Buat Laporan Informasi ");

		$this->breadcrumbs->unshift(2, 'Buat', "laporan_informasi/create");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('informasi_diperoleh', 'Informasi yang diperoleh', 'trim|required');
		$this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'trim|required');
		$this->form_validation->set_rules('trend_perkembangan', 'Trend Perkembangan / Perkiraan', 'trim|required');
		$this->form_validation->set_rules('saran_tindak', 'Pendapat / Saran / Tindak', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori ', 'trim|required');
		$this->form_validation->set_rules('id_user[]', 'Kirim Kepada ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mlaporan_informasi->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Laporan Informasi ";
		$this->template->view('intel/testnotif', $this->data);
	}
}
