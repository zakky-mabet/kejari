<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlaporan_masyarakat extends MY_model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('nomor', $this->input->get('query'))
					 ->or_like('deskripsi', $this->input->get('query'))
					 ->or_like('asal', $this->input->get('query'));

		if($type == 'result')
		{
			$this->db->select('laporan_masyarakat.ID AS ID_laporan,laporan_masyarakat.nomor,laporan_masyarakat.tanggal_masuk,laporan_masyarakat.asal, laporan_masyarakat.deskripsi, disposisi.*' );
			
			$this->db->from('laporan_masyarakat');

			$this->db->join('disposisi', 'laporan_masyarakat.ID = disposisi.id_laporan_masyarakat', 'LEFT');

			$this->db->limit($limit, $offset);

			$this->db->order_by('ID_laporan', 'desc');

			return $this->db->get()->result();

		} else {

			$this->db->from('laporan_masyarakat');

			$this->db->join('disposisi', 'laporan_masyarakat.ID = disposisi.id_laporan_masyarakat', 'LEFT');

			$this->db->limit($limit, $offset);

			return $this->db->get()->num_rows();
		}
	}

	public function get($param= 0, $type='')
	{
		if ($type == 'num_rows') {
			return $this->db->get_where('laporan_masyarakat', array('ID' => $param))->num_rows();

		} elseif ($type == 'cek_disposisi') {

			return $this->db->get_where('disposisi', array('id_laporan_masyarakat' => $param))->num_rows();
		}
		elseif ($type == 'cek_disposisi_ID') {

			return $this->db->get_where('disposisi', array('ID' => $param))->num_rows();
		}
		 elseif ($type == 'get_disposisi') {

			return $this->db->get_where('disposisi', array('ID' => $param))->row();
		} else {

			return $this->db->get_where('laporan_masyarakat', array('ID' => $param))->row();
		}
	}

	public function notification_laporan_masyarakat()
	{
		 return $this->db->get_where('laporan_masyarakat', array('status_instruksi' => 'belum'))->num_rows();
	}

	public function create()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'tanggal_masuk' => date('Y-m-d'),
			'asal' => $this->input->post('asal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'user_id' => $this->input->post('user_id'),
			'status_instruksi' => 'belum'
		); 

		$this->db->insert('laporan_masyarakat', $data);

		$id_laporan_masyarakat = $this->db->insert_id();

        $this->firebase_push->setTo($this->get_firebase_token(1));
        $this->firebase_push->setTitle("SEKSI INTELIJEN");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Laporan perkara kepada anda, Nomor : ".$this->input->post('nomor') );
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'lapmas'
        	)
        );
        $this->firebase_push->send();

        $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'lapmas',
			'penerima' => 1,
			'judul' => 'SEKSI INTELIJEN',
			'deskripsi' => "mengirim Laporan perkara kepada anda, Nomor : ".$this->input->post('nomor') ,
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'lapmas',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Laporan Perkara berhasil disimpan dan dikirim ke KAJARI', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function cek_nomor_laporan($param = 0)
	{
		return $this->db->get_where('laporan_masyarakat', array('ID' => $param) )->num_rows();
	}

	public function update($param = 0)
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'tanggal_masuk' => date('Y-m-d'),
			'asal' => $this->input->post('asal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'user_id' => $this->input->post('user_id'),

		);

		$this->db->update('laporan_masyarakat', $data, array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data Laporan Perkara berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data yang diubah.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function nomor_cek($param = 0)
	{
		if($param == FALSE)
		{
			return $this->db->get_where('laporan_masyarakat', array('nomor' => $this->input->post('nomor')))->num_rows();
		} else {
			return $this->db->query("SELECT nomor FROM laporan_masyarakat WHERE nomor IN('{$this->input->post('nomor')}') AND ID != {$param}")->num_rows();
		}	
	}

	public function delete($param = 0)
	{
		$this->db->delete('laporan_masyarakat', array('ID' => $param));

		$this->db->delete('disposisi', array('ID' => $this->input->get('disposisi')));

		$this->db->delete('terusan_disposisi', array('id_disposisi' => $this->input->get('disposisi')));

		$this->template->alert(
			' Data Laporan Perkara berhasil dihapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	
	public function instruksi_disposisi($param)
	{
		$disposisi = array(
			'id_laporan_masyarakat' => $param,
			'instruksi' => $this->input->post('instruksi'),
		);

		$this->db->insert('disposisi', $disposisi);

		  
		$id_disposisi = $this->db->insert_id();

		$terusan_disposisi = array(
			'id_disposisi' => $id_disposisi,
			'group_id' => $this->input->post('group_id'),
			'tanggal_disposisi_masuk' => date('Y-m-d H:i:s')
		);

		$this->db->insert('terusan_disposisi', $terusan_disposisi);

		$data = array(
			'status_instruksi' => 'telah',
		);

		$this->db->update('laporan_masyarakat', $data, array('ID' => $param));

		foreach ($this->mlaporan_masyarakat->get_group(4) as $key => $value) {

				// LOOP NOTIFIKASI
		      	$this->insert_kepada($value->id, $param);
		}    

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Instruksi dan disposisi telah dikirim.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function get_id_laporan_in_disposisi($param = 0)
	{
		return $this->db->get_where('disposisi', array('ID' => $param ) )->row();
	}
	
	public function update_instruksi_disposisi($param = 0)
	{
		$disposisi = array(
			'instruksi' => $this->input->post('instruksi'),
		);

		$this->db->update('disposisi', $disposisi, array('ID' => $param));

		$terusan_disposisi = array(
			'group_id' => $this->input->post('group_id'),
			'tanggal_disposisi_masuk' => date('Y-m-d H:i:s')
		);

		$this->db->update('terusan_disposisi', $terusan_disposisi, array('id_disposisi' => $param));

		foreach ($this->mlaporan_masyarakat->get_group(4) as $key => $value) {

			// LOOP NOTIFIKASI
		    $this->insert_kepada($value->id, $this->get_id_laporan_in_disposisi($param)->id_laporan_masyarakat);
		}

		if($this->db->affected_rows())
		{
			$this->template->alert(
				'Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				'Tidak ada data yang diubah.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function insert_kepada($id_user = 0, $id_laporan_masyarakat = 0)
	{
		$this->firebase_push->setTo($this->get_firebase_token($id_user));
        $this->firebase_push->setTitle("1 Instruksi Baru Masuk");
        $this->firebase_push->setMessage($this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Instruksi kepada anda");
        $this->firebase_push->setImage('');
        $this->firebase_push->setIsBackground(FALSE);
        $this->firebase_push->setPayload(
        	array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'lapmas'
        	)
        );
        $this->firebase_push->send();

		 $notif = array(
			'pengirim' => $this->ion_auth->user()->row()->id,
			'kategori' => 'lapmas',
			'judul' => '1 Instruksi Baru Masuk',
			'penerima' => $id_user,
			'deskripsi' => $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name." mengirim Instruksi kepada anda",
			'tanggal' => date('Y-m-d H:i:s'),
			'payload' => json_encode(
				array(
        		'ID' => $id_laporan_masyarakat,
        		'category' => 'lapmas',
        			)),
		); 

		$this->db->insert('notifikasi', $notif);
	}

	
}

