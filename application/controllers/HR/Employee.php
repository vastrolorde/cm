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


		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

		$data['title'] = 'ฐานข้อมูลพนักงาน';
		$data['result'] = $this->hr_emp_m->getAll();


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Emp_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/employee_script');
		}
	}

	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างพนักงานใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Employee').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Employee/create').'">พิมพ์รายงาน</a></li>';
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		$data['dept'] = $this->hr_emp_m->getDept();
		$data['position'] = $this->hr_emp_m->getPosition();
			$this->load->model('others/Province_m','Province'); //Province Plugin
		$data['Province_all'] = $this->Province->province(); //Province Plugin

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
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		$data['dept'] = $this->hr_emp_m->getDept();
		$data['position'] = $this->hr_emp_m->getPosition();
			$this->load->model('others/Province_m','Province'); //Province Plugin
		$data['Province_all'] = $this->Province->province(); //Province Plugin

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Emp_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/employee_script');
	}


	/******			Database			******/

	public function add()
	{

		$date = array(
			'emp_DOB'                =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_DOB')))),
			'emp_startdate'          =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_startdate')))),
			'emp_enddate'            =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_enddate')))),
			'emp_passport_exp'       =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_passport_exp')))),
			'emp_visa_exp'           =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_visa_exp')))),
			'emp_wp_exp'             =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_wp_exp')))),
			'emp_driver_license_exp' =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_driver_license_exp')))),
			'emp_bike_license_exp'   =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_bike_license_exp')))),
			'emp_truck_license_exp'  =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_truck_license_exp'))))
			);

		$data = array(
			'id'               =>	$this->input->post('id'),
			'emp_prefix'       =>	$this->input->post('emp_prefix'),
			'emp_fname'        =>	$this->input->post('emp_fname'),
			'emp_lname'        =>	$this->input->post('emp_lname'),
			'emp_nickname'     =>	$this->input->post('emp_nickname'),
			'emp_nation'       =>	$this->input->post('emp_nation'),
			'emp_DOB'          =>	$date['emp_DOB'],
			'emp_sex'          =>	$this->input->post('emp_sex'),
			'emp_position_now' =>	$this->input->post('emp_position_now'),
			'emp_dept_now'     =>	$this->input->post('emp_dept_now'),
			'emp_position'     =>	json_encode($this->input->post('emp_position')),
			'emp_type'         =>	$this->input->post('emp_type'),
			'emp_startdate'    =>	$date['emp_startdate'],
			'emp_enddate'      =>	$date['emp_enddate'],
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
			'emp_cid_exp'      =>	$date['emp_cid_exp'],
			'emp_passport'     =>	$this->input->post('emp_passport'),
			'emp_passport_exp' =>	$date['emp_passport_exp'],
			'emp_visa'         =>	$this->input->post('emp_visa'),
			'emp_visa_exp'     =>	$date['emp_visa_exp'],
			'emp_wp'           =>	$this->input->post('emp_wp'),
			'emp_wp_exp'       =>	$date['emp_wp_exp'],
			
			'emp_driver_license'     =>	$this->input->post('emp_driver_license'),
			'emp_driver_license_exp' =>	$date['emp_driver_license_exp'],
			'emp_bike_license'       =>	$this->input->post('emp_bike_license'),
			'emp_bike_license_exp'   =>	$date['emp_bike_license_exp'],
			'emp_truck_license'      =>	$this->input->post('emp_truck_license'),
			'emp_truck_license_exp'  =>	$date['emp_truck_license_exp'],
		);

		$this->hr_emp_m->create($data);
		
		redirect('/HR/Employee/');
	}

	public function edit($id)
	{
		$date = array(
			'emp_DOB'                =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_DOB')))),
			'emp_startdate'          =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_startdate')))),
			'emp_enddate'            =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_enddate')))),
			'emp_passport_exp'       =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_passport_exp')))),
			'emp_visa_exp'           =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_visa_exp')))),
			'emp_wp_exp'             =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_wp_exp')))),
			'emp_driver_license_exp' =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_driver_license_exp')))),
			'emp_bike_license_exp'   =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_bike_license_exp')))),
			'emp_truck_license_exp'  =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('emp_truck_license_exp'))))
			);

		$data = array(
			'emp_prefix'       =>	$this->input->post('emp_prefix'),
			'emp_fname'        =>	$this->input->post('emp_fname'),
			'emp_lname'        =>	$this->input->post('emp_lname'),
			'emp_nickname'     =>	$this->input->post('emp_nickname'),
			'emp_nation'       =>	$this->input->post('emp_nation'),
			'emp_DOB'          =>	$date['emp_DOB'],
			'emp_sex'          =>	$this->input->post('emp_sex'),
			'emp_position_now' =>	$this->input->post('emp_position_now'),
			'emp_dept_now'     =>	$this->input->post('emp_dept_now'),
			'emp_position'     =>	json_encode($this->input->post('emp_position')),
			'emp_type'         =>	$this->input->post('emp_type'),
			'emp_startdate'    =>	$date['emp_startdate'],
			'emp_enddate'      =>	$date['emp_enddate'],
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
			'emp_cid_exp'      =>	$date['emp_cid_exp'],
			'emp_passport'     =>	$this->input->post('emp_passport'),
			'emp_passport_exp' =>	$date['emp_passport_exp'],
			'emp_visa'         =>	$this->input->post('emp_visa'),
			'emp_visa_exp'     =>	$date['emp_visa_exp'],
			'emp_wp'           =>	$this->input->post('emp_wp'),
			'emp_wp_exp'       =>	$date['emp_wp_exp'],
			
			'emp_driver_license'     =>	$this->input->post('emp_driver_license'),
			'emp_driver_license_exp' =>	$date['emp_driver_license_exp'],
			'emp_bike_license'       =>	$this->input->post('emp_bike_license'),
			'emp_bike_license_exp'   =>	$date['emp_bike_license_exp'],
			'emp_truck_license'      =>	$this->input->post('emp_truck_license'),
			'emp_truck_license_exp'  =>	$date['emp_truck_license_exp'],
		);

		$this->hr_emp_m->update($data,$id);
		
		redirect('/HR/Employee/');
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
