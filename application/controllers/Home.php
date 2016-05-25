<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Dashboard';


		$this->load->view('parts/head',$data);
		$this->load->view('home',$data);
		$this->load->view('parts/footer');	}

	public function rental()
	{
		$data['title'] = 'Rental';


		$this->load->view('parts/head',$data);
		$this->load->view('rental/rental_list',$data);
		$this->load->view('parts/footer');	}
}