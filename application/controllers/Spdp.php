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
		$this->page_title->push("SPDP", "Data Surat Pemberitahuan Dimulainya Penyidikan");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("spdp?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mspdp->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Surat Pemberitahuan Dimulainya Penyidikan";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_spdp'] = $config['total_rows'];
		$this->data['spdp'] = $this->mspdp->get_all($this->per_page, $this->page, 'result');
		$this->template->view('pidum/data_spdp', $this->data);
	}

	public function create()
	{
		$this->page_title->push("SPDP ", "Buat Baru ");

		$this->breadcrumbs->unshift(2, 'Buat', "spdp/create");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('asal', 'Asal ', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mspdp->create();

			redirect(current_url());
		}

		$this->data['title'] = "Buat Baru Surat Pemberitahuan Dimulainya Penyidikan ";
		$this->template->view('pidum/create_spdp', $this->data);
	}

	public function update($param = 0)
	{
		if (!$param) {
			show_404();
		}

		if ($this->mspdp->get($param, 'num_rows') == 0 ) {
			show_404();
		}

		$this->page_title->push("SPDP", "Sunting Surat Pemberitahuan Dimulainya Penyidikan ");

		$this->breadcrumbs->unshift(2, 'Sunting', "spdp/update");
		
		$this->form_validation->set_rules('nomor', 'Nomor ', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('asal', 'Asal ', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mspdp->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Sunting Surat Pemberitahuan Dimulainya Penyidikan  ";
		$this->data['param'] = $param;
		$this->template->view('pidum/update_spdp', $this->data);
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

		redirect('spdp');
	}


}
