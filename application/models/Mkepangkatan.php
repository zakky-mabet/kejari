<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkepangkatan extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload'));
		$this->load->helper(array('indonesia'));
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nip', $this->input->get('query'))
					 ->or_like('nrp', $this->input->get('query'))
					 ->or_like('nama', $this->input->get('query'));

		if($type == 'result')
		{	
			
			$this->db->order_by('date_create', 'desc');

			return $this->db->get('kepangkatan', $limit, $offset)->result();
		} else {
			return $this->db->get('kepangkatan')->num_rows();
		}
	}

	public function detail_kepangkatan($param = 0)
	{
		$this->db->order_by('date_create', 'desc');

		return $this->db->get_where('kepangkatan', array('nip' => $param))->result();

		
	}
	// cara cek bahwa data ada atau tidak
	public function cek_data($param = 0)
	{
		return $this->db->get_where('kepegawaian', array('ID' => $param) )->num_rows();
	}

	public function cek_pangkat($param = 0)
	{
		return $this->db->get_where('kepangkatan', array('ID' => $param) )->num_rows();
	}

	public function pangkat($param = 0)
	{
		return $this->db->get_where('pangkat', array('ID' => $param))->row();
	}

	public function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }

	public function create()
	{
		$config['upload_path'] = './public/images/kepangkatan/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';

		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			$foto = $this->upload->file_name;
		} else {
			$foto = '';
		}

		$btsAkhir = new DateTime($this->input->post('date'));
		$btsAkhir->modify('+47 month');
		

		$kepangkatan = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'id_pangkat' => $this->input->post('id_pangkat'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'), 
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			'date_create' => date('Y-m-d H:i:s'),

		);

		$this->db->insert('kepangkatan', $kepangkatan);

		$pegawai = $this->db->get_where('kepegawaian', array('nip' => $this->input->post('nip')))->row();

		$this->firebase_push->setTo($this->get_firebase_token(1));
        $this->firebase_push->setTitle("Kenaikan Pangkat");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Laporan Kenaikan Pangkat : ".$this->input->post('nomor') );
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $pegawai->ID,
        		'category' => 'kepegawaian',
        		'name'	=> $pegawai->nama
        	)
        );
        $this->firebase_push->send();
        $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'kepegawaian',
			'penerima' => 1,
			'judul' => 'KENAIKAN PANGKAT',
			'deskripsi' => "mengirim Laporan Kenaikan Pangkat, Nomor : ".$this->input->post('nomor') ,
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $pegawai->ID,
        		'category' => 'kepegawaian',
        		'name'	=> $pegawai->nama
        			)),
		); 

		$this->db->insert('notifikasi', $notif);


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepangkatan ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function hitungHari($datenow = '', $batas_akhir = '')
	{	
		return (strtotime($batas_akhir) - strtotime($datenow)) / (24*3600);
		
	}

	public function update($param = 0)
	{
		$get = $this->get($param);

		$config['upload_path'] = './public/images/kepangkatan/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '5120';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';

		$this->upload->initialize($config);
		
		if($this->upload->do_upload('foto')) 
		{
			if($get->lampiran_sk != FALSE)
				@unlink("public/images/kepangkatan/{$get->lampiran_sk}");

			$foto = $this->upload->file_name;
		} else {
			$foto = $get->lampiran_sk;
		}

		$btsAkhir = new DateTime($this->input->post('date'));
		$btsAkhir->modify('+47 month');

		$kepangkatan = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'id_pangkat' => $this->input->post('id_pangkat'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			'date_create' => date('Y-m-d H:i:s'),
			
		);

		$this->db->update('kepangkatan', $kepangkatan, array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data kepangkatan di Update.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal Update data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
		
	}

	public function delete($param = 0)
	{
		$get= $this->get($param);

		if($get->lampiran_sk != FALSE)
			@unlink("public/images/kepangkatan/{$get->lampiran_sk}");

		$this->db->delete('kepangkatan', array('ID' => $param));

		$this->template->alert(
			' Data Kepangkatan berhasil di Hapus.', 
			array('type' => 'success','icon' => 'check')
		
		);
		
	}

	public function get($param = 0)
	{
		return $this->db->get_where('kepangkatan', array('ID' => $param))->row();
	}
	
	public function get_all_pangkat()
    {
        // join tabel
		$this->db->select('*');
		$this->db->from('pangkat');
		return $this->db->get()->result();
    }
}

/* End of file Mkepangkatan.php */
/* Location: ./application/models/Mkepangkatan.php */