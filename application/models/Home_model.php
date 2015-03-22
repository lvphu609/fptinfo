<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
    $this->load->database();   
  }

  public function getMenuTop(){
  	$this->db->from('menu');
    $this->db->where('deleted_at',NULL);
    $this->db->where('positions','top');
    $this->db->order_by('sort_order','ASC');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function getFieldById($table,$field,$id){
  	$id = intval($id);
    $this->db->select($field);
    $this->db->from($table);
    $this->db->where('id',$id);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0];
  }

  public function getMenuByPositoin($positions){
    $this->db->select('t1.name as parent_name,  t1.article_id as parent_article_id, t2.name, t2.parent,  t2.article_id');
    $this->db->from('menu as t1');
    $this->db->join('menu as t2','t2.parent = t1.id','left');
    $this->db->where('t1.parent',NULL);
    $this->db->where('t1.deleted_at',NULL);
    $this->db->where('t2.deleted_at',NULL);
    $this->db->where('t1.positions',$positions);
    $this->db->order_by('t1.sort_order');
    $this->db->order_by('t1.name');
    $this->db->order_by('t2.sort_order');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function getMenuParrent($positions){
    $this->db->distinct();
    $this->db->select('t1.*');
    $this->db->from('menu as t1');
    $this->db->join('menu as t2','t2.parent = t1.id','left');
    $this->db->where('t1.parent',NULL);
    $this->db->where('t1.deleted_at',NULL);
    $this->db->where('t2.deleted_at',NULL);
    $this->db->where('t1.positions',$positions);
    $this->db->order_by('t1.sort_order');
    $this->db->order_by('t1.name');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  
  public function parseMenuByPosition($positions){
        //nenu left parse master
        $menu = $this->getMenuByPositoin($positions);
        $menuParent = $this->getMenuParrent($positions);
        if(count($menuParent) > 0){
            foreach ($menuParent as $keyP => $mnPa) {
                if(count($menu) > 0){ 
                    foreach ($menu as $keyS => $mnsub) {
                        if($mnsub['parent'] == $mnPa['id']){
                            $menuParent[$keyP]['submenu'][$keyS] = $mnsub;
                        }
                    }
                }
            }
        }
        return $menuParent;
    }

    public function search($keyword){
        $this->db->select('ar.*');
        $this->db->from('articles as ar');
        $this->db->join('menu as mn','ar.id = mn.article_id');
        $this->db->where('ar.deleted_at',NULL);
        $this->db->where('mn.deleted_at',NULL);
        $this->db->like('ar.content',$keyword);
        $this->db->or_like('ar.title',$keyword);
        $this->db->or_like('mn.name',$keyword);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getContentHomePage(){
        $this->db->select('content');
        $this->db->from('articles');
        $this->db->where('title','TRANG CHỦ');
        $this->db->where('deleted_at',NULL);
        $query = $this->db->get();
        $result = $query->result_array();

        if(count($result) > 0){
            return $result[0]['content'];
        }else{
            return FALSE;
        }
        
    }

    public function getCarousel(){
        $this->db->select('*');
        $this->db->from('carousel');
        $this->db->where('deleted_at',NULL);
        $this->db->order_by('sort_order');
        $query = $this->db->get();
        $result = $query->result_array();

        if(count($result) > 0){
            return $result;
        }else{
            return FALSE;
        }
    }


 }