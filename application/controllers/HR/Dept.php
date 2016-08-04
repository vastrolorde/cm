<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dept extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Dept_model','hr_dept_m');
	}

	/******			View			******/

	public function index()
	{
		$data['title'] = 'จัดการแผนก';
		$data['result'] = $this->hr_dept_m->getAll();
		$data['mask'] = '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Dept_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/dept_script');
	}

	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างแผนกใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Dept').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Dept/create').'">พิมพ์รายงาน</a></li>';
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Dept_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/dept_script');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไขแผนก';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Dept').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/HR/Dept/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Dept/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->hr_dept_m->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Dept_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/dept_script');
	}


	/******			Database			******/

	public function add()
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','รหัสแผนก','required');
		$this->form_validation->set_rules('dept_name','ชื่อแผนก','required');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'id'           =>	$this->input->post('id'),
				'dept_name'    =>	$this->input->post('dept_name'),
				'dept_mother'  =>	$this->input->post('dept_mother'),
				'dept_manager' =>	$this->input->post('dept_manager'),
				
			);

			$this->hr_dept_m->create($data);
			

			redirect('/HR/Dept/');
		}else{

			$this->create();
		}
	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('dept_name','ชื่อแผนก','required');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'id'           =>	$this->input->post('id'),
				'dept_name'    =>	$this->input->post('dept_name'),
				'dept_mother'  =>	$this->input->post('dept_mother'),
				'dept_manager' =>	$this->input->post('dept_manager'),
				
			);

			$this->hr_dept_m->update($data,$id);
			

			redirect('/HR/Dept/');
		}else{

			$this->data($id);
		}
	}

	public function delete($id){
		$this->hr_dept_m->delete($id);

		redirect('/HR/Dept/');
	}

	public function lookup_emp(){
		$keyword = $this->input->post('lookup');
		$this->db->SELECT('*');
		$this->db->FROM('hr_employee_data');
		$this->db->LIKE('emp_fname',$keyword);
		$query = $this->db->get()->result();

		echo json_encode($query);

	}

	public function lookup_dept(){
		$keyword = $this->input->post('lookup');
		$this->db->SELECT('*');
		$this->db->FROM('hr_dept');
		$this->db->LIKE('dept_name',$keyword);
		$query = $this->db->get()->result();

		echo json_encode($query);

	}

}
