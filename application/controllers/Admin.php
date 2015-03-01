<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    /*$model = array('abc');
	    $this->load->model($model);*/
	    $this->load->library('session');
        $this->info_user   = $this->session->userdata('user_login');
        if(!$this->info_user){
            $this->login();
            //$this->index();
        }else{
          $user_session=$this->info_user;
          $this->index();          
        }
	}
    
    public function index()
    {
        /*$header = array(
            'title' => 'FPT services home'
        );
        $this->load->view('template/header', $header);
        $this->load->view('home/index');
        $this->load->view('template/footer');*/
    }

    public function login(){
    	$this->load->view('admin/login');
    }

    public function auth()
	{
	    $username = $this->input->post('username');
	    $remember = $this->input->post('remember');
	    $haspas = $this->input->post('haspas');
	    $encrypt_password = $this->input->post('hidden-value');


	    $userAccountPwd = true;
	    if (empty($haspas)) {
	      $encrypt_password = md5($username . $encrypt_password . Common_enum::APP_TOKEN); //md5 mat khau nahn duoc tu param
	      $userAccountPwd = $this->login_model->check_login($username, $encrypt_password);
	    } else {
	      $arr_haspas = explode(".", $haspas);
	      $haspas_username = $arr_haspas[1];
	      $haspas_password = $arr_haspas[0];

	      $userAccountPwd = $this->login_model->check_login_haspas($haspas_username, $haspas_password);
	    }
	    if ($userAccountPwd == null) {

	      $this->_logout();

	      $data['error'] = true;
	      $data['username'] = $username;
	      delete_cookie(
	        $name = 'ci_cookie',
	        $domain = '',
	        $path = '/',
	        $prefix = 'pan_'
	      );
	      $data['js_file'] = array('jquery.md5.js');
	      $this->load->view('login_view', $data);
	    } else {
	      if (is_numeric($remember) == 1) {
	        $cookie_data = $username . '_innoria' . md5('_innoria' . $username . $userAccountPwd) . '_pan' . md5('_pan' . $username . md5($userAccountPwd));
	        $this->input->set_cookie(
	          $name = 'ci_cookie',
	          $value = $cookie_data,
	          $expire = '18500',
	          $domain = '',
	          $path = '/',
	          $prefix = 'pan_',
	          $secure = FALSE
	        );
	      } else {
	        delete_cookie(
	          $name = 'ci_cookie',
	          $domain = '',
	          $path = '/',
	          $prefix = 'pan_'
	        );
	      }
	      redirect('home');
	    }
	}



}
