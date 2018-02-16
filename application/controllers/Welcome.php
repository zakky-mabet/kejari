<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->page_title->push("Dashboard", "Halaman Utama Sistem");
	}
	
	public function index()
	{
		$this->data['title'] = "Dashboard";
		$this->template->view('dashboard', $this->data);
	}
}
