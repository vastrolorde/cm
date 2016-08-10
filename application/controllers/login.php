<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
  
  public function index()
	{

    if (!$this->ion_auth->logged_in()) {
      $data['title'] = 'Login';
      $this->load->view('login/login',$data);
    }else{
      redirect('home');
    }

	}

    // View&Execute

      // Users

  public function admin()
  {

    if(!$this->ion_auth->is_admin()){
      echo 'คุณไม่ใช่ Admin';
      
      redirect('/login');
    }else{
      
      $data['title'] = 'Admin Panel';
      $data['users'] = $this->ion_auth->users()->result();
      
      $this->load->view('parts/head_admin',$data);
      $this->load->view('login/admin/users',$data);
      $this->load->view('parts/footer');
      $this->load->view('scripts/admin_script');
    }
  }
    
  public function create_user(){
    if(!$this->ion_auth->is_admin()){
      echo 'คุณไม่ใช่ Admin';
      
      redirect('/login');
    }else{
      
      $data['title'] = 'Admin Panel';
      $data['execute'] = 
        '<li><input class="button hollow success" type="submit"></li>
        <li><a class="button hollow warning" href="'.site_url('/login/admin').'">ยกเลิก</a></li>';
          
      $this->load->view('parts/head_admin',$data);
      $this->load->view('login/admin/users_form',$data);
      $this->load->view('parts/footer');
    }
  }

  public function edit_user($id)
  {

    if(!$this->ion_auth->is_admin()){
        echo 'คุณไม่ใช่ Admin';
        
        redirect('/login');
    }else{
        
      $data['title'] = 'Admin Panel';
      $data['user'] = $this->ion_auth->user($id)->result();
      $data['execute'] = 
        '<li><input class="button hollow success" type="submit"></li>
        <li><a class="button hollow warning" href="'.site_url('/login/admin').'">ยกเลิก</a></li>';
            
      $this->load->view('parts/head_admin',$data);
      $this->load->view('login/admin/users_form',$data);
      $this->load->view('parts/footer');
    }
  }

  public function add_user(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $email = $this->input->post('email');
    $additional_data = array(
      'first_name' =>  $this->input->post('first_name'),
      'last_name'  =>  $this->input->post('last_name'),
    );

    $this->ion_auth->register($username,$password,$email,$additional_data);
    redirect('login/admin');

  }

  public function update_user($id){
    $data = array(
      'username'   =>  $this->input->post('username'),
      'password'   =>  $this->input->post('password'),
      'first_name' =>  $this->input->post('first_name'),
      'last_name'  =>  $this->input->post('last_name'),
      'email'      =>  $this->input->post('email')
    );

    $this->ion_auth->update($id,$data);
    redirect('login/admin');
  }

  public function del_user($id){
  	$this->ion_auth->delete_user($id);
    	redirect('login/admin');
  }

      // Group


  public function group()
  {

    if(!$this->ion_auth->is_admin()){
      echo 'คุณไม่ใช่ Admin';
      
      redirect('/login');
    }else{
      
      $data['title'] = 'User Group';
      $data['groups'] = $this->ion_auth->groups()->result();
      
      $this->load->view('parts/head_admin',$data);
      $this->load->view('login/admin/groups',$data);
      $this->load->view('parts/footer');
      $this->load->view('scripts/admin_script');
    }
  }

  public function create_group(){
		if(!$this->ion_auth->is_admin()){
			echo 'คุณไม่ใช่ Admin';
			
			redirect('/group');
		}else{
			
			$data['title'] = 'Group Panel';
			$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/login/group').'">ยกเลิก</a></li>';
			
			$this->load->view('parts/head_admin',$data);
			$this->load->view('login/admin/groups_form',$data);
			$this->load->view('parts/footer');
		}
  }

  public function edit_group($id)
  {
		if(!$this->ion_auth->is_admin()){
			echo 'คุณไม่ใช่ Admin';
			
			redirect('/group');
		}else{
			
			$data['title'] = 'Group Panel';
			$data['group'] = $this->ion_auth->group($id)->result();
			$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/login/group').'">ยกเลิก</a></li>';
			
			$this->load->view('parts/head_admin',$data);
			$this->load->view('login/admin/groups_form',$data);
			$this->load->view('parts/footer');
		}
  }

  public function add_group(){
		$group = $this->input->post('group');
		$group_desc = $this->input->post('group_desc');
		
		$this->ion_auth->create_group($group,$group_desc);
		redirect('login/group');
  }

  public function update_group($id){
		$group = $this->input->post('group');
		$group_desc = $this->input->post('group_desc');
		$this->ion_auth->update_group($id,$group,$group_desc);

		redirect('login/group');
  }

  public function del_group($id){
		$this->ion_auth->delete_group($id,$group,$group_desc);

		redirect('login/group');
  }

  public function auth()
  {

    if(!$this->ion_auth->is_admin()){
      echo 'คุณไม่ใช่ Admin';
      
	    redirect('/login');
    }else{
      $data['title'] = 'Authorization Panel';

  		$this->db->select('u.id,u.email');
  		$this->db->from('users_groups as ug');
  		$this->db->join('users as u','ug.user_id = u.id');
  		$this->db->join('groups as g','ug.group_id = g.id');
  		$this->db->select('g.id,g.name');
      $this->db->select('ug.user_id,ug.group_id');
      $this->db->order_by('ug.group_id');
  		$data['result'] = $this->db->get()->result();

  		$this->load->view('parts/head_admin',$data);
  		$this->load->view('login/admin/auth',$data);
  		$this->load->view('parts/footer');
      $this->load->view('scripts/admin_script');
    }
  }

  public function create_auth(){
    if(!$this->ion_auth->is_admin()){
      echo 'คุณไม่ใช่ Admin';
      
      redirect('/login');
    }else{
      
      $data['title'] = 'Authorization Panel';
      $data['execute'] = 
      '<li><input class="button hollow success" type="submit"></li>
      <li><a class="button hollow warning" href="'.site_url('/login/group').'">ยกเลิก</a></li>';
      $data['users'] = $this->ion_auth->users()->result();
      $data['groups'] = $this->ion_auth->groups()->result();
      
      $this->load->view('parts/head_admin',$data);
      $this->load->view('login/admin/auth_form',$data);
      $this->load->view('parts/footer');
    }
  }

  public function edit_auth($id){

  }

  public function add_auth(){
    $user = $this->input->post('user');
    $group = $this->input->post('group');
    $this->ion_auth->add_to_group($group, $user);
    
    redirect('login/auth');
  }

  public function update_auth($id){

  }

  public function del_auth($id){

  }


    // Login System

  public function login()
  {
    $user = $this->input->post('login');
    $pass = $this->input->post('password');

    if($this->ion_auth->login($user,$pass)){
      redirect('/home');
  }else{
      $_SESSION['error_msg'] = $this->ion_auth->errors();
      $this->session->mark_as_flash('error_msg');

      redirect('/login');
    }
  }

	public function reset()
  {
  	$data['title'] = 'Reset Password';
		$this->load->view('login/reset',$data);
  }
  
  public function logout()
  {
    $this->ion_auth->logout();
    $this->load->view('login/logout');
  }
}