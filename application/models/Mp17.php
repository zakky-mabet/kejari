<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mp17 extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0 , $type = 'result' )
	{	
		if($this->input->get('query') != '')
			$this->db->like('p17.nomor', $this->input->get('query'))
					 ->or_like('p17.sifat', $this->input->get('query'))
					 ->or_like('p17.dikirim_kepada', $this->input->get('query'))
					 ->or_like('p17.perihal', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->order_by('p17.ID', 'desc');

			$this->db->select('p17.ID AS ID_primary_p17, p17.nomor AS nomor_p17, spdp.nomor AS nomor_spdp, p16.ID AS ID_primary_p16, spdp.tanggal_update AS tanggal_update_spdp, p16.tanggal_update AS tanggal_update_p16, p17.tanggal_update AS tanggal_update_p17, p17.tanggal_create AS tanggal_create_p17, p16.user_id AS id_user_p16, p16.*, p17.* ,spdp.*');

			$this->db->from('p17');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->result();

		} else {

			$this->db->from('p17');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get_p17 ($param = 0){

			$this->db->select('p16.ID AS ID_primary_p16, spdp.tanggal_update AS tanggal_update_spdp, p16.tanggal_update AS tanggal_update_p16, p16.*, spdp.*,p16.user_id AS id_user_p16, ');

			$this->db->from('p16');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p16.ID', $param);

			return $this->db->get()->row();
	}

	public  function get_update_p17($param = 0)
	{
		$this->db->select('p17.ID AS ID_primary_p17, p17.nomor AS nomor_p17, spdp.nomor AS nomor_spdp, p16.ID AS ID_primary_p16, spdp.tanggal_update AS tanggal_update_spdp, p16.tanggal_update AS tanggal_update_p16, p17.tanggal_update AS tanggal_update_p17, p17.tanggal_create AS tanggal_create_p17, p16.user_id AS id_user_p16, p16.*, p17.* ,spdp.*');

			$this->db->from('p17');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p17.ID', $param);

			return $this->db->get()->row();
	}

	public  function cek_id_p16_on_p17($param = 0)
	{
			$this->db->from('p17');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p16.ID', $param);

			return $this->db->get()->num_rows();
	}

	public function nomor_cek($param = 0)
	{
		if($param == FALSE)
		{
			return $this->db->get_where('p17', array('nomor_print' => $this->input->post('nomor')))->num_rows();
		} else {
			return $this->db->query("SELECT nomor_print FROM p17 WHERE nomor_print IN('{$this->input->post('nomor_print')}') AND ID != {$param}")->num_rows();
		}	
	}

	public function create($param = 0)
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'id_p16' => $param ,
			'sifat' => $this->input->post('sifat'),
			'perihal' => $this->input->post('perihal'),
			'dikirim_kepada' => $this->input->post('dikirim_kepada'),
			'ditempat' => $this->input->post('ditempat'),
			'id_user' => $this->ion_auth->user()->row()->id,
			'tanggal_create' => date('Y-m-d'),
		); 

		$this->db->insert('p17', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-17 berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}
	
	public  function cek_id_p17_on_p18($param = 0)
	{
		return $this->db->get_where('p18', array('id_p17' => $param) )->num_rows();
	}	

	public function update($param = 0)
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),

			'sifat' => $this->input->post('sifat'),
			'perihal' => $this->input->post('perihal'),
			'dikirim_kepada' => $this->input->post('dikirim_kepada'),
			'ditempat' => $this->input->post('ditempat'),
			'id_user' => $this->ion_auth->user()->row()->id,
			'tanggal_update' => date('Y-m-d'),
		); 

		$this->db->update('p17', $data, array('ID' => $param ) );

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-17 berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data diubah.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$this->db->delete('p17', array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-17 berhasil dhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	
}

