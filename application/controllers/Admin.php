<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public static $user_session;

    public static $dataJs = [
                    'jquery-2.1.3.min.js',
                    'jquery.md5.js',
                    'bootstrap.min.js',
                    'mod_login.js'
                ];
    public static $dataCss = [
                    'admin_page.css'
                ];

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('admin_model');
	    $this->load->library('session');
        static::$user_session = $this->session->userdata('user_login');
	}

    public function index(){
        $data['js_file'] = static::$dataJs;
        $data['css_file'] = static::$dataCss;

        if(empty(static::$user_session)){           
            $this->load->view('admin/login',$data);
        }else{
            $this->load->view('admin/pages/header',$data);
            $this->load->view('admin/pages/menu');
            $this->load->view('admin/pages/dashboard',$data);
            $this->load->view('admin/pages/footer');
        }
    }

    public function auth()
	{
        if(!empty(static::$user_session)) return false; //logined

		$username = $this->input->post('username');
        // $remember = $this->input->post('remember');
        $password = $this->input->post('encrypt-password');
		
        $checkLogin = $this->admin_model->check_login($username,$password);

        if($checkLogin == false){
            $data['error'] = true;
            $data['js_file'] = static::$dataJs;
            $this->load->view('admin/login',$data);
        }else{
           redirect('admin');
        }
       
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin');
    }

    public function temp(){
        if(empty(static::$user_session)) return false;

        echo "adasd";
    }


}
