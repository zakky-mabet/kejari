<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class Spdp extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Surat Pemberitahuan Dimulainya Penyidikan', "spdp");

		$this->load->model(array('mspdp'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/pidum.js"));
	}
	
	public function index()
	{
		
	}

	public function create()
	{
		$this->page_title->push("Surat Pemberitahuan Dimulainya Penyidikan ", "Buat Baru ");

		$this->breadcrumbs->unshift(2, 'Buat', "laporan_informasi/create");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('asal', 'Asal ', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mspdp->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Baru Surat Pemberitahuan Dimulainya Penyidikan ";
		$this->template->view('intel/create_spdp', $this->data);
	}

	public function update($param = 0)
	{
		if (!$param) {
			show_404();
		}
		if ($this->mspdp->get_num($param) == 0) {
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
			$this->mspdp->update($param);

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
		if($this->mspdp->nomor_cek($this->input->post('ID')) == TRUE)
		{
			$this->form_validation->set_message('validate_nomor', 'Maaf Nomor ini telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function delete($param = 0)
	{
		$this->mspdp->delete($param);

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
			$this->mspdp->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Laporan Informasi ";
		$this->template->view('intel/testnotif', $this->data);
	}
}
