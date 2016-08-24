<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Leave_model','HR_Leave_m');
	}

	/******			View			******/

	public function index()
	{


		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

		$data['title'] = 'บันทึกการลา';
		$data['Lve'] = $this->HR_Leave_m->sumLeave();
		$data['empAll'] = $this->HR_Leave_m->getAll();
		$data['execute'] = 
			'<li><a class="button hollow success" data-open="Leave">เพิ่ม</a></li>';
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_lve_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/leave_script');
		}
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
		$data['data'] = $this->HR_Leave_m->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_lve_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/leave_script');
	}


	/******			Database			******/

	public function add()
	{

		$date = str_replace('/', '-', $this->input->post('lve_date'));

		$data = array(
			'emp_id'     =>	$this->input->post('emp_id'),
			'lve_date'   =>	date('Y-m-d', strtotime($date)),
			'lve_type'   =>	$this->input->post('lve_type'),
			'lve_reason' =>	$this->input->post('lve_reason'),
			'lve_in'     =>	$this->input->post('lve_in'),
			'lve_out'    =>	$this->input->post('lve_out'),
			'lve_diff'   =>	$this->input->post('lve_diff')
		);

		$this->HR_Leave_m->create($data);
		redirect('/HR/Leave/data/'.$id);
	}

	public function edit()
	{
		$id = $this->input->get('id');
		$date = str_replace('/', '-', $this->input->post('lve_date'));
		
		$data = array(
			'lve_date'   =>	date('Y-m-d', strtotime($date)),
			'lve_in'     =>	$this->input->post('lve_in'),
			'lve_out'    =>	$this->input->post('lve_out'),
			'lve_diff'   =>	$this->input->post('lve_diff')
		);

		$this->HR_Leave_m->update($data,$id);
	}

	public function delete(){
		$id = $this->input->get('id');
		$this->HR_Leave_m->delete($id);
	}


	public function leave_table(){
		$id = $this->input->get('id');
		$data['lve'] = $this->HR_Leave_m->get($id);
		$this->load->view('HR/HR_lve_table',$data);
	}

}
