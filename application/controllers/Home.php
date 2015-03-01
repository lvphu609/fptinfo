<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $header = array(
            'title' => 'FPT services home'
        );
        $this->load->view('template/header', $header);
        $this->load->view('home/index');
        $this->load->view('template/footer');
    }
}
