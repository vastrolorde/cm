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

  	public function admin()
  	{

        
      if(!$this->ion_auth->is_admin()){
        echo 'คุณไม่ใช่ Admin';
        
        redirect('/login');
        }else{
        
        $data['title'] = 'Admin Panel';
        $data['mask'] = '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
        
        $this->load->view('parts/head_admin',$data);
        // $this->load->view('HR/HR_Position_list',$data);
        $this->load->view('parts/footer');
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