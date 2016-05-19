<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {

	/******			View			******/

	public function index()
	{
		$this->load->view('welcome_message');
	}


	/******			Form			******/

	public function create()
	{
		$this->load->view('welcome_message');
	}

	public function data()
	{
		$this->load->view('welcome_message');
	}

	/******			Database			******/

	public function add()
	{
		$this->load->view('welcome_message');
	}

	public function edit()
	{
		$this->load->view('welcome_message');
	}
}
