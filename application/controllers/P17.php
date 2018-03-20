<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class P17 extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Surat Permintaan Hasil Penyidikan', "p17");

		$this->load->model(array('mp17'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/pidum.js"));
	}
	
	public function index()
	{
		$this->page_title->push("P-17", "Data Surat Permintaan Hasil Penyidikan");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("p17?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mp17->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Surat Permintaan Hasil Penyidikan";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_p17'] = $config['total_rows'];
		$this->data['p17'] = $this->mp17->get_all($this->per_page, $this->page, 'result');
		$this->template->view('pidum/data_p17', $this->data);
	}

	public function create($param = 0)
	{
		$this->page_title->push("P-17 ", "Buat P-17 ");

		$this->breadcrumbs->unshift(2, 'Buat', "p17/create");
		
		$this->form_validation->set_rules('nomor', 'NOMOR', 'trim|required');
		$this->form_validation->set_rules('sifat', 'SIFAT ', 'trim|required');
		$this->form_validation->set_rules('perihal', 'PERIHAL ', 'trim|required');
		$this->form_validation->set_rules('dikirim_kepada', 'KEPADA ', 'trim|required');
		$this->form_validation->set_rules('ditempat', 'TEMPAT ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp17->create($param);

			redirect(site_url('p17'));
		}

		$this->data['title'] = "Buat Surat Permintaan Hasil Penyidikan ";
		$this->data['param'] = $param;
		$this->template->view('pidum/create_p17', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push("P-17 ", "Sunting P-17 ");

		$this->breadcrumbs->unshift(2, 'Sunting', "p17/update");
		
		$this->form_validation->set_rules('nomor', 'NOMOR', 'trim|required');
		$this->form_validation->set_rules('sifat', 'SIFAT ', 'trim|required');
		$this->form_validation->set_rules('perihal', 'PERIHAL ', 'trim|required');
		$this->form_validation->set_rules('dikirim_kepada', 'KEPADA ', 'trim|required');
		$this->form_validation->set_rules('ditempat', 'TEMPAT ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp17->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Sunting Surat Permintaan Hasil Penyidikan ";
		$this->data['param'] = $param;
		$this->template->view('pidum/update_p17', $this->data);
	}

	
	/**
	 *
	 * @return string
	 **/
	public function validate_nomor()
	{
		if($this->mp17->nomor_cek($this->input->post('ID')) == TRUE)
		{
			$this->form_validation->set_message('validate_nomor', 'Maaf Nomor ini telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function delete($param = 0)
	{
		$this->mp17->delete($param);

		redirect('p17');
	}

	
}
