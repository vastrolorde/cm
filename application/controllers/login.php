<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	}
  
  	public function index()
  	{

  	}
 
  	public function login()
  	{
  		$this->data['page_title'] = 'Login';
		if($this->input->post())
		{

		}
		$this->load->helper('form');
		$this->render('admin/login_view','admin_master');
  	}
  
  	public function logout()
  	{

  	}
}