<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	   public function get_firebase_token($param = 0)
    {
       return $this->db->select('firebase_token')->get_where('users', array('id' => $param))->row('firebase_token');
    }


    public function get_group($param = 0)
    {
    	$this->db->select('users.*, users_groups.*, users_groups.id AS ID_primary_users_group ' );

      $this->db->from('users');

		  $this->db->join('users_groups', 'users.id = users_groups.user_id', 'LEFT');

		   $this->db->where('users_groups.group_id', $param);

		  return $this->db->get()->result();
    }

     public function get_by_id($param = 0)
    {
    	$this->db->select('users.*' );

      	$this->db->from('users');

      	$this->db->where('id', $param);

		return $this->db->get()->row();
    }

    public function get_all_user()
    {

      $this->db->select('users.*, users_groups.*, users_groups.id AS ID_primary_users_group ' );

      $this->db->from('users');

      $this->db->join('users_groups', 'users.id = users_groups.user_id', 'LEFT');

      return $this->db->get()->result();
    }
    
}

