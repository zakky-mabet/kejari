<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapmas extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth','firebase_push'));

		$this->load->helper(array('security','indonesia'));
	}

	public function index()
	{
		$response = array();

		if( ! $this->getQueryLapMas($this->input->post('limit'), $this->input->post('start')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perkara yang ditampilkan",
				'results' => array()
			);
		} else {
			$response = array(
				'status' => 'OK',
				'message' => "Data Perkara berhasil ditampilkan"
			);
		}

		foreach ($this->getQueryLapMas($this->input->post('limit'), $this->input->post('start')) as $key => $value) 
			$response['results'][] = $value;


		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function get()
	{
		$response = array();

		if( ! $this->getQueryLapMasByID($this->input->post('ID')) ) {
			$response = array(
				'status' => 'ERROR',
				'message' => "Tidak ada data Perkara yang ditampilkan"
			);
		} else {
			$disposisi = array();
			$dataGroupId = array(2=>0,3=>1,4=>2,5=>3,6=>4);
			$dataGroupName = array(2=>"PIDSUS",3=>"PEMBINAAN",4=>"INTELIJEN",5=>"DATUN",6=>"PIDUM");

			foreach ($this->getLapmasTerusanDisposis($this->input->post('ID')) as $key => $value) 
				$disposisi[] = array(
					'ID'=> $value->ID,
					'group_id' => $dataGroupId[$value->group_id],
					'name' => $dataGroupName[$value->group_id]
			);

			$response = array_merge(
				array(
					'status' => 'OK',
					'message' => "Data Perkara berhasil ditampilkan",
					'disposisi' => $disposisi
				), $this->getQueryLapMasByID($this->input->post('ID'))
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function getLapmasTerusanDisposis($param = 0)
	{
		$this->db->select('terusan_disposisi.*');
		$this->db->join('disposisi', 'disposisi.ID = terusan_disposisi.id_disposisi', 'left');
		return $this->db->get_where('terusan_disposisi', array('disposisi.id_laporan_masyarakat' => $param))->result();
	}

	public function create_instruksi()
	{
		$disposisiData = array(2, 3, 4, 5, 6);
		if($this->input->post('instruksi'))
		{
			if($this->db->get_where('disposisi', array('id_laporan_masyarakat' => $this->input->post('ID')))->num_rows() == FALSE)
			{
				$this->db->insert('disposisi', array(
					'id_laporan_masyarakat' => $this->input->post('ID'),
					'instruksi' => $this->input->post('instruksi')
				));

				$disposisiID = $this->db->insert_id();

				$this->db->update('laporan_masyarakat', array(
					'status_instruksi' => 'telah'
				), array(
					'ID' => $this->input->post('ID')
				));

				foreach ($this->toStringArray($this->input->post('disposisi')) as $key => $value) 
				{
					if($value['checked'] == FALSE)
						continue;

					$this->db->insert('terusan_disposisi', array(
						'group_id' => $disposisiData[$value['key']],
						'id_disposisi' => $disposisiID,
						'tanggal_disposisi_masuk' => date('Y-m-d H:i:s')
					));

					foreach ($this->getUserInGroup(array($disposisiData[$value['key']])) as $key => $value) 
					{
						$this->firebase_push->setTo($value->firebase_token);
				        $this->firebase_push->setTitle("Instruksi dari KAJARI");
				        $this->firebase_push->setMessage("Anda memiliki instruksi baru dari KAJARI");
				        $this->firebase_push->setImage('');
				        $this->firebase_push->setIsBackground(TRUE);
				        $this->firebase_push->setPayload(
				        	array(
				        		'ID' => $this->input->post('ID'),
				        		'category' => 'lapmas'
				        	)
				        );
				        $this->firebase_push->send();

				        $this->db->insert('notifikasi', array(
				        	'pengirim' => 1,
				        	'penerima' => $value->id,
				        	'kategori' => 'lapmas',
				        	'judul' => 'Instruksi dari KAJARI',
				        	'deskripsi' => 'Anda memiliki instruksi baru dari KAJARI',
				        	'tanggal' => date('Y-m-d H:i:s'),
				        	'payload' => json_encode(array(
				        		'ID' => $this->input->post('ID')
				        	)),
				        	'status' => 'unread'
				        ));
					}
				}

				$response = array(
					'status' => 'OK',
					'message' => 'Instruksi berhasil dibuat'
				);
			} else {
				$this->db->update('disposisi', array(
					'instruksi' => $this->input->post('instruksi')
				), array(
					'id_laporan_masyarakat' => $this->input->post('ID')
				));

				$disposisi = $this->db->get_where('disposisi', array(
					'id_laporan_masyarakat' => $this->input->post('ID')
				))->row();

				if( is_array($this->toStringArray($this->input->post('disposisi'))) )
				{
					$object = array();

					$groupID = array();
					foreach (@$this->toStringArray(@$this->input->post('disposisi')) as $key => $value) 
						$groupID[] = $disposisiData[$value['key']];

					$this->db->where('id_disposisi', $disposisi->ID)
							 ->where_not_in('group_id', $groupID)
							 ->delete('terusan_disposisi');
							 
					foreach (@$this->toStringArray(@$this->input->post('disposisi')) as $key => $value) 
					{
						if($value['checked'] == FALSE) 
						{
							$this->db->where('id_disposisi', $disposisi->ID)
									 ->where_in('group_id', $disposisiData[$value['key']])
									 ->delete('terusan_disposisi');
							continue;
						} 

						foreach ($this->getUserInGroup(array($disposisiData[$value['key']])) as $key => $user) 
						{
							$this->firebase_push->setTo($user->firebase_token);
					        $this->firebase_push->setTitle("Instruksi dari KAJARI");
					        $this->firebase_push->setMessage("Anda memiliki 1 instruksi laporan dari KAJARI");
					        $this->firebase_push->setImage('');
					        $this->firebase_push->setIsBackground(FALSE);
					        $this->firebase_push->setPayload(
					        	array(
					        		'ID' => $this->input->post('ID'),
					        		'category' => 'lapmas'
					        	)
					        );
					        $this->firebase_push->send();

					        $this->db->insert('notifikasi', array(
					        	'pengirim' => 1,
					        	'penerima' => $user->id,
					        	'kategori' => 'lapmas',
					        	'judul' => 'Instruksi dari KAJARI',
					        	'deskripsi' => 'Anda memiliki instruksi baru dari KAJARI',
					        	'tanggal' => date('Y-m-d H:i:s'),
					        	'payload' => json_encode(array(
					        		'ID' => $this->input->post('ID')
					        	)),
					        	'status' => 'unread'
					        ));
						}

						if($this->db->get_where('terusan_disposisi', 
							array(
								'id_disposisi' => $disposisi->ID,
								'group_id' => $disposisiData[$value['key']] 
							))->num_rows() 
						) continue;

						$object[] = array(
							'id_disposisi' => $disposisi->ID,
							'group_id' => $disposisiData[$value['key']] 
						);
					}

					if( count($object) >= 1)
						$this->db->insert_batch('terusan_disposisi', $object);
				} else {
					$this->db->where('id_disposisi', $disposisi->ID)
							 ->delete('terusan_disposisi');
				}

				$response = array(
					'status' => 'OK',
					'message' => "Berhasil! instruksi berhasil diubah."
				);
			}
		} else {
			$response = array(
				'status' => 'ERROR',
				'message' => 'Maaf! terjadi kesalahan saat menyimpan data.'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	private function toStringArray($toStringArray = '')
	{
		$toStringArray = explode(',', $toStringArray);

		$outputArray = array();
		foreach ($toStringArray as $key => $value) 
		{
			$keyData = str_replace(['+', '-'], '', filter_var($value, FILTER_SANITIZE_NUMBER_INT));
			$outputArray[] = array(
				'key' => $keyData,
				'checked' => preg_match("/=true/", $value)
			);
		}
	
		return $outputArray;
	}

	private function getQueryLapMasByID($param = 0)
	{
		$this->db->select('laporan_masyarakat.*, users.first_name AS pelapor, disposisi.instruksi, disposisi.ID AS id_disposisi');
		$this->db->join('users', 'laporan_masyarakat.user_id = users.id', 'left');
		$this->db->join('disposisi', 'laporan_masyarakat.ID = disposisi.id_laporan_masyarakat', 'left');
		return $this->db->get_where('laporan_masyarakat', array('laporan_masyarakat.ID' => $param))->row_array();
	}

	private function getQueryLapMas($limit = 20, $offset = 0)
	{
		if($this->input->post('startdate') != '')
		{
			$this->db->where('DATE(tanggal_masuk) >=', $this->input->post('startdate'));
		} elseif($this->input->post('enddate') != '') {
			$this->db->where('DATE(tanggal_masuk) <=', $this->input->post('enddate'));
		}

		if($this->input->post('filter') == 'Terbaru')
		{
			$this->db->order_by('tanggal_masuk', 'desc');
		} else {
			$this->db->order_by('tanggal_masuk', 'asc');
		}

		return $this->db->get('laporan_masyarakat', $limit, $offset)->result();
	}

	private function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }

    private function getUserInGroup($param = array())
    {
    	$this->db->select('users.*');
    	$this->db->join('users_groups', 'users.id = users_groups.user_id', 'left');
    	$this->db->where_in('users_groups.group_id', $param);
    	return $this->db->get('users')->result();
    }


}

/* End of file Lapmas.php */
/* Location: ./application/controllers/api/Lapmas.php */