<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
  
  	public function index()
  	{

      $data['title'] = 'Login';
      $this->load->view('login/login',$data);

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

          $this->ion_auth->register($data);
          redirect('login/admin');

        }

        public function update_user($id){
          $data = array(
            'id'         =>  $this->input->post('id'),
            'username'   =>  $this->input->post('username'),
            'password'   =>  $this->input->post('password'),
            'first_name' =>  $this->input->post('first_name'),
            'last_name'  =>  $this->input->post('last_name'),
            'email'      =>  $this->input->post('email')
          );

          $this->ion_auth->update($id,$data);

          redirect('login/admin');

        }

        public function del_user(){}

      // Group


    public function group()
    {

      if(!$this->ion_auth->is_admin()){
        echo 'คุณไม่ใช่ Admin';
        
        redirect('/login');
        }else{
        
        $data['title'] = 'User Group';
        
        $this->load->view('parts/head_admin',$data);
        // $this->load->view('HR/HR_Position_list',$data);
        $this->load->view('parts/footer');
      }
    }     

    public function edit_group($id){}
    public function add_group(){}
    public function update_group(){}
    public function del_group(){}

    public function auth()
    {

      if(!$this->ion_auth->is_admin()){
        echo 'คุณไม่ใช่ Admin';
        
        redirect('/login');
        }else{
        
        $data['title'] = 'Authorization';
        
        $this->load->view('parts/head_admin',$data);
        // $this->load->view('HR/HR_Position_list',$data);
        $this->load->view('parts/footer');
      }
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