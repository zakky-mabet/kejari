<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Extends Class Laporan Masyarakat
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
class P16 extends Admin_panel {

	public $per_page;

	public $page = 20;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Surat Perintah Penujukan Jaksa Penuntuan Umum', "p16");

		$this->load->model(array('mp16'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');
		
		$this->query = $this->input->get('query');

		$this->load->js(base_url("public/app/pidum.js"));
	}
	
	public function index()
	{
		$this->page_title->push("P-16", "Data Surat Perintah Penujukan Jaksa Penuntuan Umum");

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("p16?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mp16->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data['title'] = "Data Surat Perintah Penujukan Jaksa Penuntuan Umum";
		$this->data['per_page'] = $config['per_page'];
		$this->data['num_p16'] = $config['total_rows'];
		$this->data['p16'] = $this->mp16->get_all($this->per_page, $this->page, 'result');
		$this->template->view('pidum/data_p16', $this->data);
	}

	public function create($param = 0)
	{
		$this->page_title->push("P-16 ", "Buat P-16 ");

		$this->breadcrumbs->unshift(2, 'Buat', "p16/create");
		
		$this->form_validation->set_rules('nomor_print', 'NOMOR PRINT', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('dasar', 'DASAR ', 'trim|required');
		$this->form_validation->set_rules('pertimbangan', 'PERTIMBANGAN ', 'trim|required');
		$this->form_validation->set_rules('untuk', 'UNTUK ', 'trim|required');
		$this->form_validation->set_rules('id_user[]', 'MEMERINTAHKAN KEPADA ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp16->create($param);

			redirect(current_url());
		}

		$this->data['title'] = "Buat Surat Perintah Penujukan Jaksa Penuntuan Umum ";
		$this->data['param'] = $param;
		$this->template->view('pidum/create_p16', $this->data);
	}

	public function update($param = 0)
	{
		$this->page_title->push("P-16 ", "Sunting P-16 ");

		$this->breadcrumbs->unshift(2, 'Sunting', "p16/update");
		
		$this->form_validation->set_rules('nomor_print', 'NOMOR PRINT', 'trim|required|callback_validate_nomor');
		$this->form_validation->set_rules('dasar', 'DASAR ', 'trim|required');
		$this->form_validation->set_rules('pertimbangan', 'PERTIMBANGAN ', 'trim|required');
		$this->form_validation->set_rules('untuk', 'UNTUK ', 'trim|required');
		$this->form_validation->set_rules('id_user[]', 'MEMERINTAHKAN KEPADA ', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mp16->update($param);

			redirect(current_url());
		}

		$this->data['title'] = "Sunting Surat Perintah Penujukan Jaksa Penuntuan Umum ";
		$this->data['param'] = $param;
		$this->template->view('pidum/update_p16', $this->data);
	}

	
	/**
	 *
	 * @return string
	 **/
	public function validate_nomor()
	{
		if($this->mp16->nomor_cek($this->input->post('ID')) == TRUE)
		{
			$this->form_validation->set_message('validate_nomor', 'Maaf Nomor ini telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	// public function delete($param = 0)
	// {
	// 	$this->mp16->delete($param);

	// 	redirect('laporan_informasi/harian');
	// }

	
}
