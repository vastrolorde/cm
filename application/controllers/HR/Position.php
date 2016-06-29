<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Position_model','hr_Position_m');
		$this->load->library('pdf'); // Load library
	}

	/******			View			******/

	public function index()
	{

		$this->load->library('pagination');

		$config['base_url'] = site_url().'/HR/Position';
		$config['total_rows'] = $this->hr_Position_m->countAll();
		$config['per_page'] = 20;
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

		$data['title'] = 'จัดการตำแหน่ง';
		$data['result'] = $this->hr_Position_m->getAll($config['per_page'],$page);
		$data['pagination'] = $this->pagination->create_links();
		$data['mask'] = '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';


		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Position_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/position_script');
	}

	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างตำแหน่งใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Position').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Position/create').'">พิมพ์รายงาน</a></li>';
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		$data['dept'] = $this->hr_Position_m->dept();

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Position_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/position_script');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไขตำแหน่ง';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Position').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/HR/Position/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Position/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->hr_Position_m->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		$data['dept'] = $this->hr_Position_m->dept();

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Position_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/position_script');
	}


	/******			Database			******/

	public function add()
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','รหัสตำแหน่ง','required');
		$this->form_validation->set_rules('position_name','ชื่อตำแหน่ง','required');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'id'           =>	$this->input->post('id'),
				'position_name'    =>	$this->input->post('position_name'),
				'active'    =>	$this->input->post('active'),
				'dept_id'  =>	$this->input->post('dept_id'),
				'position_manager' =>	$this->input->post('position_manager'),
				'position_purpose' =>	$this->input->post('position_purpose'),
				'position_jd' =>	json_encode($this->input->post('position_jd'))
			);

			$this->hr_Position_m->create($data);
			

			redirect('/HR/Position/');
		}else{

			$this->create();
		}
	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
			$data = array(
				'active'    =>	$this->input->post('active'),
				'dept_id'  =>	$this->input->post('dept_id'),
				'position_manager' =>	$this->input->post('position_manager'),
				'position_purpose' =>	$this->input->post('position_purpose'),
				'position_jd' =>	json_encode($this->input->post('position_jd'))
			);

			$this->hr_Position_m->update($data,$id);
			

			redirect('/HR/Position/');
	}

	public function delete($id){
		$this->hr_Position_m->delete($id);

		redirect('/HR/Position/');
	}

	public function lookup_manager(){
		$keyword = $this->input->post('lookup');
		$this->db->SELECT('*');
		$this->db->FROM('hr_position');
		$this->db->LIKE('position_name',$keyword);
		$query = $this->db->get()->result();

		echo json_encode($query);

	}

		// --------------- pdf --------------- //

	public function org_chart(){
		    // Generate PDF by saying hello to the world
		$this->load->view('HR/pdf/org_chart');

	}	


}
