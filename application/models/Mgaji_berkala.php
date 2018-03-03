<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgaji_berkala extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	
		$this->load->library(array('upload'));
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('gaji_berkala.nip', $this->input->get('query'))
					 ->or_like('kepegawaian.nama', $this->input->get('query'));
					// tabel join
		$this->db->select('gaji_berkala.*, kepegawaian.nama AS nama_pegawai, kepegawaian.ID  AS ID_pegawai, kepegawaian.ID AS id_pegawai, kepegawaian.pendidikan_terakhir');

		$this->db->join('kepegawaian', 'gaji_berkala.nip = kepegawaian.nip', 'left');
		
		$this->db->order_by('ID', 'desc');

		if($type == 'result')
		{		
			return $this->db->get('gaji_berkala', $limit, $offset)->result();
		} else {

			return $this->db->get('gaji_berkala')->num_rows();
		}
	}

	public function gaji($param = 0)
	{
		return $this->db->get_where('kepangkatan', array('nip' => $param))->result();
	}
		// cara cek bahwa data ada atau tidak
	public function cek_data($param = 0)
	{
		return $this->db->get_where('gaji_berkala', array('ID' => $param) )->num_rows();
	}

	public function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }

	public function create()
	{
		$config['upload_path'] = './public/images/gaji-berkala/';
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
		$btsAkhir->modify('+23 month');

		$gaji_berkala = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			
		);

		$this->db->insert('gaji_berkala', $gaji_berkala);

		$pegawai = $this->db->get_where('kepegawaian', array('nip' => $this->input->post('nip')))->row();

		$this->firebase_push->setTo($this->get_firebase_token(1));
        $this->firebase_push->setTitle("Gaji Berkala");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Laporan Gaji Berkala : ".$this->input->post('nomor') );
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
			'kategori' => 'gaji berkala',
			'penerima' => 1,
			'judul' => 'GAJI BERKALA',
			'deskripsi' => "mengirim Laporan Gaji Berkala, Nomor : ".$this->input->post('nomor') ,
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
				' Data Gaji Berkala ditambahkan.', 
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
		$get = $this->get($param);

		$config['upload_path'] = './public/images/gaji-berkala/';
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
		$btsAkhir->modify('+23 month');

		$gaji_berkala = array(
			'nip' => $this->input->post('nip'),
			'tmt' => $this->input->post('date'),
			'batas_akhir' => $btsAkhir->format('Y-m-d'),
			'no_sk' => $this->input->post('no_sk'),
			'lampiran_sk' => $foto,
			'keterangan' => $this->input->post('keterangan'),
			
		);

		$this->db->update('gaji_berkala', $gaji_berkala, array('ID' => $param));


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Gaji Berkala di Update.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}

	}

	public function delete($param = 0)
	{
		$get = $this->get($param);

		if($get->lampiran_sk != FALSE)
			@unlink("public/images/gaji-berkala/{$get->lampiran_sk}");

		$this->db->delete('gaji_berkala', array('ID' => $param));

		$this->template->alert(
			' Data Riwayat Diklat berhasil di Hapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function get_all_gaji()
    {
        // join tabel
		$this->db->select('*');
		$this->db->from('kepegawaian');
		return $this->db->get()->result();
		
    }

    public function hitungHari($datenow = '', $batas_akhir = '')
	{	
		return (strtotime($batas_akhir) - strtotime($datenow)) / (24*3600);
		
	}

    public function get($param = 0)
	{
		//amnil data dari data base di join dengan 2 tabel
		//$this->db->select('gaji_berkala.*, kepegawaian.nama AS nama_pegawai, kepegawaian.ID  AS ID_pegawai, kepegawaian.pendidikan_terakhir');

		//$this->db->group_by('gaji_berkala.nip');

		//$this->db->join('kepegawaian', 'gaji_berkala.nip = kepegawaian.nip', 'left');

		return $this->db->get_where('gaji_berkala', array('ID'=> $param) )->row();

	}

}

/* End of file Mgaji_berkala.php */
/* Location: ./application/models/Mgaji_berkala.php */