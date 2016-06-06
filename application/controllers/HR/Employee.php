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
		$data['title'] = 'ฐานข้อมูลพนักงาน';
		$data['result'] = $this->hr_emp_m->getAll();


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
	}


	/******			Database			******/

	public function add()
	{
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
			'emp_position'     =>	$this->input->post('emp_position'),
			'emp_dept'         =>	$this->input->post('emp_dept'),
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

			'emp_training'    =>	$this->input->post('emp_training'),
			
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
		

		redirect('/HR');

	}

	public function edit($id)
	{

		$data = array(
			'emp_prefix'      =>	$this->input->post('emp_prefix'),
			'emp_fname'       =>	$this->input->post('emp_fname'),
			'emp_lname'       =>	$this->input->post('emp_lname'),
			'emp_nickname'    =>	$this->input->post('emp_nickname'),
			'emp_nation'      =>	$this->input->post('emp_nation'),
			'emp_DOB'         =>	$this->input->post('emp_DOB'),
			'emp_sex'         =>	$this->input->post('emp_sex'),
			'emp_position'    =>	$this->input->post('emp_position'),
			'emp_dept'        =>	$this->input->post('emp_dept'),
			'emp_type'        =>	$this->input->post('emp_type'),
			'emp_startdate'   =>	$this->input->post('emp_startdate'),
			'emp_enddate'     =>	$this->input->post('emp_enddate'),
			'emp_status'      =>	$this->input->post('emp_status'),

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

			'emp_training'    =>	$this->input->post('emp_training'),
			
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
		redirect('/HR');
	}

	public function delete($id){
		$this->hr_emp_m->delete($id);

		redirect('/HR');
	}

	public function lookup(){
		$keyword = $this->input->post('search');
		$query = $this->hr_emp_m->lookup($keyword);

		echo json_encode($query);

	}
}
