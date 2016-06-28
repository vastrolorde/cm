<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class get_th extends CI_Controller {

		public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('others/province_m','Province_m');
	}

	public function Province(){

	}

	public function Dist(){
		$Province = $this->input->post('Province');
		$query = $this->Province_m->Dist($Province);
		echo json_encode($query);
	}

	public function SubDist(){
		$Dist = $this->input->post('Dist');
		$query = $this->Province_m->SubDist($Dist);
		echo json_encode($query);
	}
}
