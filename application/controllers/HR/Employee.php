<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Emp_model','hr_emp_m');
	}

	/******			View			******/

	public function index()
	{

		$this->load->library('pagination');

		$config['base_url'] = site_url().'/HR/Employee';
		$config['total_rows'] = $this->hr_emp_m->countAll();
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

		$data['title'] = 'ฐานข้อมูลพนักงาน';
		$data['result'] = $this->hr_emp_m->getAll($config['per_page'],$page);
		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Emp_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/employee_script');
	}

	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างพนักงานใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Employee').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Employee/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Emp_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/employee_script');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไขพนักงาน';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Employee').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/HR/Employee/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Employee/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->hr_emp_m->get($id);

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Emp_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/employee_script');
	}


	/******			Database			******/

	public function add()
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('valid_email','<code style="color:red;">กรุณาตรวจสอบรูปแบบของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('regex_match','<code style="color:red;">กรุณาตรวจสอบรูปแบบตัวของ %s อีกครั้ง</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','ชื่อ partner','required');
		$this->form_validation->set_rules('emp_fname','ชื่อ','required');
		$this->form_validation->set_rules('emp_lname','นามสกุล','required');
		$this->form_validation->set_rules('emp_nation','สัญชาติ','required');

		$this->form_validation->set_rules('emp_Postal','รหัสไปรษณีย์','exact_length[5]|integer');

		$this->form_validation->set_rules('emp_tel1','เบอร์โทรศัพท์ 1','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('emp_tel2','เบอร์โทรศัพท์ 2','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('emp_email','e-mail','valid_email');
		$this->form_validation->set_rules('emp_emer_call','เบอร์โทรศัพท์ติดต่อฉุกเฉิน','regex_match[/^[0-9().-]+$/]');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'id'               =>	$this->input->post('id'),
				'emp_prefix'       =>	$this->input->post('emp_prefix'),
				'emp_fname'        =>	$this->input->post('emp_fname'),
				'emp_lname'        =>	$this->input->post('emp_lname'),
				'emp_nickname'     =>	$this->input->post('emp_nickname'),
				'emp_nation'       =>	$this->input->post('emp_nation'),
				'emp_DOB'          =>	$this->input->post('emp_DOB'),
				'emp_sex'          =>	$this->input->post('emp_sex'),
				'emp_position_now' =>	$this->input->post('emp_position_now'),
				'emp_dept_now'     =>	$this->input->post('emp_dept_now'),
				'emp_position'     =>	json_encode($this->input->post('emp_position')),
				'emp_type'         =>	$this->input->post('emp_type'),
				'emp_startdate'    =>	$this->input->post('emp_startdate'),
				'emp_enddate'      =>	$this->input->post('emp_enddate'),
				'emp_status'       =>	$this->input->post('emp_status'),

				'emp_add1'        =>	$this->input->post('emp_add1'),
				'emp_add2'        =>	$this->input->post('emp_add2'),
				'emp_SubDist'     =>	$this->input->post('emp_SubDist'),
				'emp_Dist'        =>	$this->input->post('emp_Dist'),
				'emp_Province'    =>	$this->input->post('emp_Province'),
				'emp_Postal'      =>	$this->input->post('emp_Postal'),

				'emp_tel1'      =>	$this->input->post('emp_tel1'),
				'emp_tel2'      =>	$this->input->post('emp_tel2'),
				'emp_email'     =>	$this->input->post('emp_email'),
				'emp_emergency' =>	$this->input->post('emp_emergency'),
				'emp_emer_call' =>	$this->input->post('emp_emer_call'),

				'emp_training'    =>	json_encode($this->input->post('emp_training')),
				
				'emp_cid'          =>	$this->input->post('emp_cid'),
				'emp_cid_exp'      =>	$this->input->post('emp_cid_exp'),
				'emp_passport'     =>	$this->input->post('emp_passport'),
				'emp_passport_exp' =>	$this->input->post('emp_passport_exp'),
				'emp_visa'         =>	$this->input->post('emp_visa'),
				'emp_visa_exp'     =>	$this->input->post('emp_visa_exp'),
				'emp_wp'           =>	$this->input->post('emp_wp'),
				'emp_wp_exp'       =>	$this->input->post('emp_wp_exp'),
				
				'emp_driver_license'     =>	$this->input->post('emp_driver_license'),
				'emp_driver_license_exp' =>	$this->input->post('emp_driver_license_exp'),
				'emp_bike_license'       =>	$this->input->post('emp_bike_license'),
				'emp_bike_license_exp'   =>	$this->input->post('emp_bike_license_exp'),
				'emp_truck_license'      =>	$this->input->post('emp_truck_license'),
				'emp_truck_license_exp'  =>	$this->input->post('emp_truck_license_exp'),
			);

			$this->hr_emp_m->create($data);
			

			redirect('/HR/Employee/');
		}else{

			$this->create();
		}
	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('valid_email','<code style="color:red;">กรุณาตรวจสอบรูปแบบของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('regex_match','<code style="color:red;">กรุณาตรวจสอบรูปแบบตัวของ %s อีกครั้ง</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('emp_fname','ชื่อ','required');
		$this->form_validation->set_rules('emp_lname','นามสกุล','required');
		$this->form_validation->set_rules('emp_nation','สัญชาติ','required');

		$this->form_validation->set_rules('emp_Postal','รหัสไปรษณีย์','exact_length[5]|integer');

		$this->form_validation->set_rules('emp_tel1','เบอร์โทรศัพท์ 1','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('emp_tel2','เบอร์โทรศัพท์ 2','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('emp_email','e-mail','valid_email');
		$this->form_validation->set_rules('emp_emer_call','เบอร์โทรศัพท์ติดต่อฉุกเฉิน','regex_match[/^[0-9().-]+$/]');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'emp_prefix'       =>	$this->input->post('emp_prefix'),
				'emp_fname'        =>	$this->input->post('emp_fname'),
				'emp_lname'        =>	$this->input->post('emp_lname'),
				'emp_nickname'     =>	$this->input->post('emp_nickname'),
				'emp_nation'       =>	$this->input->post('emp_nation'),
				'emp_DOB'          =>	$this->input->post('emp_DOB'),
				'emp_sex'          =>	$this->input->post('emp_sex'),
				'emp_position_now' =>	$this->input->post('emp_position_now'),
				'emp_dept_now'     =>	$this->input->post('emp_dept_now'),
				'emp_position'     =>	json_encode($this->input->post('emp_position')),
				'emp_type'         =>	$this->input->post('emp_type'),
				'emp_startdate'    =>	$this->input->post('emp_startdate'),
				'emp_enddate'      =>	$this->input->post('emp_enddate'),
				'emp_status'       =>	$this->input->post('emp_status'),

				'emp_add1'        =>	$this->input->post('emp_add1'),
				'emp_add2'        =>	$this->input->post('emp_add2'),
				'emp_SubDist'     =>	$this->input->post('emp_SubDist'),
				'emp_Dist'        =>	$this->input->post('emp_Dist'),
				'emp_Province'    =>	$this->input->post('emp_Province'),
				'emp_Postal'      =>	$this->input->post('emp_Postal'),

				'emp_tel1'      =>	$this->input->post('emp_tel1'),
				'emp_tel2'      =>	$this->input->post('emp_tel2'),
				'emp_email'     =>	$this->input->post('emp_email'),
				'emp_emergency' =>	$this->input->post('emp_emergency'),
				'emp_emer_call' =>	$this->input->post('emp_emer_call'),

				'emp_training'    =>	json_encode($this->input->post('emp_training')),
				
				'emp_cid'          =>	$this->input->post('emp_cid'),
				'emp_cid_exp'      =>	$this->input->post('emp_cid_exp'),
				'emp_passport'     =>	$this->input->post('emp_passport'),
				'emp_passport_exp' =>	$this->input->post('emp_passport_exp'),
				'emp_visa'         =>	$this->input->post('emp_visa'),
				'emp_visa_exp'     =>	$this->input->post('emp_visa_exp'),
				'emp_wp'           =>	$this->input->post('emp_wp'),
				'emp_wp_exp'       =>	$this->input->post('emp_wp_exp'),
				
				'emp_driver_license'     =>	$this->input->post('emp_driver_license'),
				'emp_driver_license_exp' =>	$this->input->post('emp_driver_license_exp'),
				'emp_bike_license'       =>	$this->input->post('emp_bike_license'),
				'emp_bike_license_exp'   =>	$this->input->post('emp_bike_license_exp'),
				'emp_truck_license'      =>	$this->input->post('emp_truck_license'),
				'emp_truck_license_exp'  =>	$this->input->post('emp_truck_license_exp'),
			);

			$this->hr_emp_m->update($data,$id);
			

			redirect('/HR/Employee/');
		}else{

			$this->data($id);
		}
	}

	public function delete($id){
		$this->hr_emp_m->delete($id);

		redirect('/HR/Employee/');
	}

	public function lookup(){
		$keyword = $this->input->post('search');
		$query = $this->hr_emp_m->lookup($keyword);

		echo json_encode($query);

	}
}
