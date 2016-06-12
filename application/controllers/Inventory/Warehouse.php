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


		$this->load->library('pagination');

		$config['base_url'] = site_url().'/Inventory/Warehouse';
		$config['total_rows'] = $this->wh_m->countAll();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		

		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}else{
			$page = 0;
		}

		$data['title'] = 'คลังสินค้า';
		$data['result'] = $this->wh_m->getAll($config['per_page'],$page);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('parts/head',$data);
		$this->load->view('Inventory/Inventory_wh_list',$data);
		$this->load->View('parts/footer');
	}


	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างคลังสินค้าใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('Inventory/Warehouse').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('Inventory/Warehouse/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head',$data);
		$this->load->view('Inventory/Inventory_wh_form',$data);
		$this->load->view('parts/footer');
	}

	public function data($id)
	{
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

	/******			Database			******/

	public function add()
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','รหัสคลังสินค้า','required');
		$this->form_validation->set_rules('wh_name','ชื่อคลังสินค้า','required');

		$this->form_validation->set_rules('wh_Postal','รหัสไปรษณีย์','exact_length[5]|integer');

		if ($this->form_validation->run() == TRUE){
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
		}else{

			$this->create();
		}
	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','รหัสคลังสินค้า','required');
		$this->form_validation->set_rules('wh_name','ชื่อคลังสินค้า','required');

		$this->form_validation->set_rules('wh_Postal','รหัสไปรษณีย์','exact_length[5]|integer');

		if ($this->form_validation->run() == TRUE){
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
		}else{

			$this->data($id);
		}
	}


	public function delete($id){
		$this->wh_m->delete($id);

		redirect('Inventory/Warehouse/');
	}
}
