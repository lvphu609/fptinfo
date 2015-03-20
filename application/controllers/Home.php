<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $data = array(
            'title' => 'FPT services home',
            'action_page' => 'home' 
        );
        $this->load->view('template/header', $data);
        $this->load->view('home/menu_top');
        $this->load->view('home/search');
        $this->load->view('home/menu_left');         
        // $this->load->view('home/menu_right');
        $this->load->view('home/content',$data);
        $this->load->view('template/footer');
    }

    public function article(){
    	$data = array(
            'title' => 'FPT services article detail',
            'action_page' => 'detail_page' 
        );
        $this->load->view('template/header', $data);
        $this->load->view('home/menu_top');
        $this->load->view('home/search');
        $this->load->view('home/menu_left');         
        $this->load->view('home/menu_right');
        $this->load->view('home/content',$data);
        $this->load->view('template/footer');
    }



}
