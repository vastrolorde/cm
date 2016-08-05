<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once APPPATH.'third_party/Ion-Auth/libraries/Ion_auth.php';
	}
  
  	public function index()
  	{

  	}
 
  	public function login()
  	{
  		$data['title'] = 'Login';
		$this->load->view('login/login',$data);
  	}

	public function reset()
  	{
  		$data['title'] = 'Reset Password';
		$this->load->view('login/reset',$data);
  	}
  
  	public function logout()
  	{

  	}
}