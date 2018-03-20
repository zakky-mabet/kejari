<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mp18 extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0 , $type = 'result' )
	{	
		if($this->input->get('query') != '')
			$this->db->like('p18.nomor', $this->input->get('query'))
					 ->or_like('p18.sifat', $this->input->get('query'))
					  ->or_like('p18.dikirim_kepada', $this->input->get('query'))
					 ->or_like('p18.perihal', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->order_by('p18.ID', 'desc');

			$this->db->select('p18.ID AS ID_primary_p18, p18.nomor AS nomor_p18, p18.sifat AS sifat_p18,  p18.perihal AS perihal_p18, p18.dikirim_kepada AS dikirim_kepada_p18, p18.tanggal_create AS tanggal_create_p18');

			$this->db->from('p18');

			$this->db->join('p17', 'p18.id_p17 = p17.ID', 'LEFT');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->result();

		} else {

			$this->db->from('p18');

			$this->db->join('p17', 'p18.id_p17 = p17.ID', 'LEFT');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get ($param = 0){

			$this->db->select('p17.ID AS ID_primary_p17, p17.nomor AS nomor_p17, spdp.nomor AS nomor_spdp, p16.ID AS ID_primary_p16, spdp.tanggal_update AS tanggal_update_spdp, p16.tanggal_update AS tanggal_update_p16, p17.tanggal_update AS tanggal_update_p17, p17.tanggal_create AS tanggal_create_p17, p16.user_id AS id_user_p16, p17.id_user AS id_user_p17, p16.*, p17.* ,spdp.*,  ');

			$this->db->from('p17');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p17.ID', $param);

			return $this->db->get()->row();
	}

	public function get_on_update ($param = 0){

			$this->db->select('p17.ID AS ID_primary_p17, p17.nomor AS nomor_p17, spdp.nomor AS nomor_spdp, p16.ID AS ID_primary_p16, spdp.tanggal_update AS tanggal_update_spdp, p16.tanggal_update AS tanggal_update_p16, p17.tanggal_update AS tanggal_update_p17, p17.tanggal_create AS tanggal_create_p17, p16.user_id AS id_user_p16, p17.id_user AS id_user_p17, p16.*, p17.* ,spdp.*,  p18.nomor AS nomor_p18, p18.sifat AS sifat_p18,  p18.perihal AS perihal_p18, p18.dikirim_kepada AS dikirim_kepada_p18, p18.tanggal_create AS tanggal_create_p18 , p18.ditempat AS ditempat_p18');

			$this->db->from('p18');

			$this->db->join('p17', 'p18.id_p17 = p17.ID', 'LEFT');

			$this->db->join('p16', 'p17.id_p16 = p16.ID', 'LEFT');

			$this->db->join('spdp', 'p16.id_spdp = spdp.ID', 'LEFT');

			$this->db->where('p18.ID', $param);

			return $this->db->get()->row();
	}

	public  function cek_id_p18_on_p19($param = 0)
	{
		return $this->db->get_where('p19', array('id_p18' => $param) )->num_rows();
	}	

	public function create($param = 0)
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'id_p17' => $param,
			'sifat' => $this->input->post('sifat'),
			'perihal' => $this->input->post('perihal'),
			'dikirim_kepada' => $this->input->post('dikirim_kepada'),
			'ditempat' => $this->input->post('ditempat'),
			'id_user' => $this->ion_auth->user()->row()->id,
			'tanggal_create' => date('Y-m-d'),
		); 

		$this->db->insert('p18', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-18 berhasil disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
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

		$this->db->update('p18', $data, array('ID' => $param ) );

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-18 berhasil diubah.', 
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
		$this->db->delete('p18', array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data P-18 berhasil dhapus.', 
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

