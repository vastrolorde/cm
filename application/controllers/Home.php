<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

		if($this->ion_auth->logged_in()){
			$data['title'] = 'Dashboard';
			$this->load->view('parts/head',$data);
			$this->load->view('home',$data);
			$this->load->view('parts/footer');
		}else{
			$_SESSION['error_msg'] = $this->ion_auth->errors();
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}
	}

}