<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Inventory/Inventory_wh_m','wh_m');
	}

	/******			View			******/

	public function index()
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'คลังสินค้า';
			$data['result'] = $this->wh_m->getAll();

			$this->load->view('parts/head',$data);
			$this->load->view('Inventory/Inventory_wh_list',$data);
			$this->load->View('parts/footer');
		}
	}


	/******			Form			******/

	public function create()
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'สร้างคลังสินค้าใหม่';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('Inventory/Warehouse').'">ยกเลิก</a></li>
				<li><a class="button hollow" href="'.site_url('Inventory/Warehouse/create').'">พิมพ์รายงาน</a></li>';

			$this->load->view('parts/head',$data);
			$this->load->view('Inventory/Inventory_wh_form',$data);
			$this->load->view('parts/footer');
		}
	}

	public function data($id)
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'แก้ไขคลังสินค้า';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('Inventory/Warehouse').'">ยกเลิก</a></li>
				<li><a class="button hollow alert delitem" href="'.site_url('Inventory/Warehouse/delete').'/'.$id.'">ลบ</a></li>
				<li><a class="button hollow" href="'.site_url('Inventory/Warehouse/create').'">พิมพ์รายงาน</a></li>';
			$data['data'] = $this->wh_m->get($id);

			$this->load->view('parts/head',$data);
			$this->load->view('Inventory/Inventory_wh_form',$data);
			$this->load->view('parts/footer');
		}
	}

	/******			Database			******/

	public function add()
	{

		$data = array(
			'id'          => $this->input->post('id'),
			'wh_name'     => $this->input->post('wh_name'),
			'wh_add1'     => $this->input->post('wh_add1'),
			'wh_subDist'  => $this->input->post('wh_subDist'),
			'wh_Province' => $this->input->post('wh_Province'),
			'wh_add2'     => $this->input->post('wh_add2'),
			'wh_Dist'     => $this->input->post('wh_Dist'),
			'wh_Postal'   => $this->input->post('wh_Postal')
		);

		$this->wh_m->create($data);
		redirect('Inventory/Warehouse/');
	}

	public function edit($id)
	{
		$data = array(
			'id'          => $this->input->post('id'),
			'wh_name'     => $this->input->post('wh_name'),
			'wh_add1'     => $this->input->post('wh_add1'),
			'wh_subDist'  => $this->input->post('wh_subDist'),
			'wh_Province' => $this->input->post('wh_Province'),
			'wh_add2'     => $this->input->post('wh_add2'),
			'wh_Dist'     => $this->input->post('wh_Dist'),
			'wh_Postal'   => $this->input->post('wh_Postal')
		);

		$this->wh_m->update($data,$id);
		redirect('Inventory/Warehouse/');
	}


	public function delete($id){
		$this->wh_m->delete($id);

		redirect('Inventory/Warehouse/');
	}
}
