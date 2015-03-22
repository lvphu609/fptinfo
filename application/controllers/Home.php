<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {
        $searchKey = $this->input->post('fpt_search');
        $datasearch = array();
        $content_home = NULL;
        $carousel_data = NULL;

        if(!empty($searchKey)){
            $datasearch = $this->home_model->search(trim($searchKey));
        }else{
            $searchKey = NULL;
            $content_home = $this->home_model->getContentHomePage();
            $carousel_data = $this->home_model->getCarousel();
        }

        $data = array(
            'title' => 'FPT services home',
            'action_page' => 'home',
            'menu_top' => $this->home_model->getMenuTop(),
            'menu_left' => $this->home_model->parseMenuByPosition('left'),
            'data_search' => $datasearch,
            'search_key' => $searchKey,
            'content_home' => $content_home,
            'carousel_data' => $carousel_data
        );

        $this->load->view('template/header', $data);
        $this->load->view('home/menu_top',$data);
        $this->load->view('home/search');
        $this->load->view('home/menu_left');         
        $this->load->view('home/content',$data);
        $this->load->view('template/footer');
    }



    public function article($article_id){
        $data = array(
            'title' => 'FPT services article detail',
            'action_page' => 'article_detail',
            'menu_top' => $this->home_model->getMenuTop(),
            'article_content_detail' =>  $this->home_model->getFieldById('articles','content',$article_id),
            'menu_left' => $this->home_model->parseMenuByPosition('left'),
            'menu_right' => $this->home_model->parseMenuByPosition('right'),
        );
        $this->load->view('template/header', $data);
        $this->load->view('home/menu_top',$data);
        $this->load->view('home/search');
        $this->load->view('home/menu_left',$data);         
        $this->load->view('home/menu_right');
        $this->load->view('home/content',$data);
        $this->load->view('template/footer');
    }

    
    



}
