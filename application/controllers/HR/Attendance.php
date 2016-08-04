<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Att_model','HR_Att_m');
		$this->load->model('HR/HR_Emp_model','HR_Emp_m');
	}

	/******			View			******/

	public function index()
	{

		$data['title'] = 'บันทึกลงเวลา';
		$data['result'] = $this->HR_Att_m->getAll();
		$data['emp'] = $this->HR_Emp_m->getAll();
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_att_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/att_script');
	}

	/******			Form			******/

	public function data()
	{

		$id = $this->uri->segment(4);
		$data['title'] = 'จัดการการลารายบุคคล';
		$data['execute'] = 
			'<li><a class="button hollow success" data-open="Add">เพิ่ม</a></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Leave').'">กลับ</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Leave/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->HR_Att_model->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_lve_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/leave_script');
	}


	/******			Database			******/

	public function add()
	{

		$data = array(
			'emp_id'    =>	$this->input->post('emp_id'),
			'att_date'  =>	$this->input->post('att_date'),
			'pnch_in'   =>	$this->input->post('pnch_in'),
			'pnch_out'  =>	$this->input->post('pnch_out'),
			'pnch_diff' =>	$this->input->post('pnch_diff')
		);

		$this->HR_Att_m->create($data);
		

		redirect('/HR/Attendance');
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

	public function upload(){

		$this->load->library('csvreader');
        $result =   $this->csvreader->parse_file('att_csv.csv');//path to csv file

        
	}

}
