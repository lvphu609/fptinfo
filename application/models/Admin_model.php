<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
    $this->load->database();   
    $this->load->library('session');  
  }

  public function check_login($username, $password)
  {
    $user = $this->isExistUserName($username);
    if (!empty($user)) {
      $password_database = $user->password;
      if (strcmp($password, $password_database) == 0) {
        $this->addUserInfoToSession($username);
        return true;
      }
      return false;
    }
    return false;
  }

  public function isExistUserName($username)
  {

    $this->db->select('username, password');
    $this->db->from('user');
    $this->db->where('username = ', $username);
    $query = $this->db->get();
    if ($query->num_rows() == 1) return $query->row();
    return null;
  }

  public function  addUserInfoToSession($username)
  {

    $user_info = $this->getInfoUserByUserName($username);

    $session_array = array('user_login' => $user_info);

    $this->session->set_userdata($session_array);
  }

  public function  getInfoUserByUserName($username)
  {

    $this->db->select('id, username');

    $this->db->from('user');

    $this->db->where('username = ', $username);
    
    $query = $this->db->get();

    $results = $query->result_array();

    return $results[0];
  }
  
  public function articleList($paging_limit,$page = NULL,$search,$data_filter = NULL){
    $this->db->from('articles');
    $this->db->where('deleted_at',NULL);
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }

    if(!empty($search)){
      if($search != ""){
        $this->db->like('content',$search);
        $this->db->or_like('title',$search);
        $this->db->or_like('desc',$search);
      }
    }

    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

   public function articleListAll(){
    $this->db->from('articles');
    $this->db->where('deleted_at',NULL);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function storeArticle($input){
    $content = $input['box-content-article'];
    $title = $input['title-article'];
    $desc = $this->shorter($content,120);
    $home_show = $input['home_show'];
    $date = getCurrentDate();

    $data = array(
       'title' => trim($title),
       'content' => trim($content),
       'desc' => $desc,
       'created_at' => $date,
       'home_show' => $home_show,
       'updated_at' => $date
    );

    $this->db->insert('articles', $data); 

  }

  public function countRecord($table,$search = NULL){
    $this->db->from($table);
    $this->db->where('deleted_at',NULL);
    if(!empty($search)){
      if($search!=""){
        if($table == "articles"){
          $this->db->like('content',$search);
          $this->db->or_like('title',$search);
          $this->db->or_like('desc',$search);
        }
        if($table == "menu"){
          $this->db->like('name',$search);
        }
      }
    }
    $total = $this->db->count_all_results();
    return $total;
  }

  function shorter($text, $chars_limit)
  {
      $text = strip_tags($text, '<p>');
      $text = str_replace(array("\r\n", "\r", "\n"),' ', $text);
      $text = str_replace(array("<p>","</p>"),'', $text);

      // Check if length is larger than the character limit
      if (strlen($text) > $chars_limit)
      {
          // If so, cut the string at the character limit
          $new_text = substr($text, 0, $chars_limit);
          // Trim off white space
          $new_text = trim($new_text);
          // Add at end of text ...
          return $new_text . "...";
      }
      // If not just return the text as is
      else
      {
      return $text;
      }
  }

  public function delArticle($id){
    $data = array('deleted_at' => getCurrentDate());
    $isDelete = $this->db->update('articles',$data,array('id' => $id));
    if ($isDelete) {            
        return true;
    } else {
        return $this->getFieldById('articles','title',$id);
    }
  }

  public function getFieldById($table,$field,$id){
    $this->db->select($field);
    $this->db->from($table);
    $this->db->where('id',$id);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0];
  }

   public function updateArticle($input){
    $content = $input['box-content-article'];
    $title = $input['title-article'];
    $desc = $this->shorter($content,120);
    $id = $input['article-id'];
    $home_show = $input['home_show'];
    $date = getCurrentDate();

    $data = array(
       'title' => trim($title) ,
       'content' => trim($content) ,
       'home_show' => $home_show,
       'desc' => $desc,
       'updated_at' => $date
    );

    $this->db->update('articles', $data,array('id' => $id)); 

  }

  public function userChangePass($new_pass){
    $isUpdate = $this->db->update('user',array('password' => md5($new_pass)),array('id' => 1));
    if($isUpdate){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function searchArticle($key){
    $this->db->from('articles');
    $this->db->where('deleted_at',NULL);
    $this->db->like('title', $key);
    $this->db->or_like('desc', $key);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function storeMenu($input){
    $name = $input['mn_name'];
    $parent_id = $input['mn_parent_id'];
    $position = $input['mn_position'];
    if(strcmp($position,"top") == 0 || $parent_id == ""){
       $parent_id = NULL;
    }
    $article_id = $input['mn_article_id'];
    $sort_order = $input['sort_order'];
    $date = getCurrentDate();

    $data = array(
       'name' => $name ,
       'positions' => $position ,
       'article_id' => $article_id,
       'sort_order' => $sort_order,
       'parent' => $parent_id,
       'created_at' => $date,
       'updated_at' => $date
    );

    $this->db->insert('menu', $data); 

  }

  public function menuList($paging_limit,$page = NULL,$search,$data_filter = NULL){
    $this->db->select('me.id,me.name,me.positions,me.sort_order,me.parent,me.article_id,art.title');
    $this->db->from('menu as me');
    $this->db->where('me.deleted_at',NULL);
    $this->db->join('articles as art','me.article_id = art.id','left');
    $this->db->order_by('me.sort_order','ASC');
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }
    if(!empty($search)){
      if($search != ""){
        $this->db->like('me.name',$search);
      }
    }
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function menuListAll(){
    $this->db->select('me.id,me.name,me.positions,me.sort_order,me.parent,me.article_id,art.title');
    $this->db->from('menu as me');
    $this->db->where('me.deleted_at',NULL);
    $this->db->join('articles as art','me.article_id = art.id','left');
    $this->db->order_by('me.sort_order','ASC');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function updateMenu($input){
    $id = $input['menu-id'];
    $name = $input['mn_name'];
    $parent_id = $input['mn_parent_id'];
    $position = $input['mn_position'];
    if(strcmp($position,"top") == 0 || $parent_id == ""){
       $parent_id = NULL;
    }
    $article_id = $input['mn_article_id'];
    $sort_order = $input['sort_order'];
    
    $date = getCurrentDate();

    $data = array(
       'name' => trim($name) ,
       'positions' => $position ,
       'article_id' => $article_id,
       'sort_order' => $sort_order,
       'parent' => $parent_id,
       'updated_at' => $date
    );
    $this->db->update('menu', $data,array('id' => $id)); 

  }

  public function delMenu($id){
    $data = array('deleted_at' => getCurrentDate());
    $isDelete = $this->db->update('menu',$data,array('id' => $id));
    if ($isDelete) {            
        return true;
    } else {
        return $this->getFieldById('menu','name',$id);
    }
  }

  public function countMenuRecord($positions,$menu_id){
    $this->db->from('menu');
    $this->db->where('deleted_at',NULL);
    $this->db->where('positions',$positions);
    $this->db->where('id <>',$menu_id);
    $this->db->where('parent',NULL);
    $total = $this->db->count_all_results();
    return $total;
  }

  public function menuListPosition($paging_limit,$page = NULL,$data_filter = NULL,$positions,$menu_id){
    $this->db->from('menu');
    $this->db->where('deleted_at',NULL);
    $this->db->where('positions',$positions);
    $this->db->where('id <>',$menu_id);
    $this->db->where('parent',NULL);
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function searchMenuPosition($key,$positions,$menu_id){
    $this->db->from('menu');
    $this->db->where('deleted_at',NULL);
    $this->db->where('positions',$positions);
    $this->db->where('id <>',$menu_id);
    $this->db->where('parent',NULL);
    $this->db->like('name', $key);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function getMenuById($id){
    $this->db->select('me.id,me.name,me.positions,me.sort_order,me.parent,me.article_id,art.title');
    $this->db->from('menu as me');
    $this->db->where('me.id',$id);
    $this->db->join('articles as art','me.article_id = art.id','left');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0];
  }

  public function carouselList($paging_limit,$page = NULL,$data_filter = NULL){
    $this->db->select('*');
    $this->db->from('carousel');
    $this->db->where('deleted_at',NULL);
    $this->db->order_by('sort_order','ASC');
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function storeCarousel($input){
    $img_url = $input['img_url'];
    $sort_order = $input['sort_order'];
    $date = getCurrentDate();
    $data = array(
       'img_url' => $img_url ,
       'sort_order' => $sort_order,
       'created_at' => $date,
       'updated_at' => $date
    );
    $this->db->insert('carousel', $data); 
  }

  public function getCarouselById($id){
    $this->db->select('*');
    $this->db->from('carousel');
    $this->db->where('id',$id);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0];
  }


  public function updateCarousel($input){
    $id = $input['carousel-id'];
    $img_url = $input['img_url'];
    $sort_order = $input['sort_order'];
    $date = getCurrentDate();

    $data = array(
       'img_url' => $img_url ,
       'sort_order' => $sort_order,
       'updated_at' => $date
    );
    $this->db->update('carousel', $data,array('id' => $id)); 

  }

  public function delCarousel($id){
    $data = array('deleted_at' => getCurrentDate());
    $isDelete = $this->db->update('carousel',$data,array('id' => $id));
    if ($isDelete) {            
        return true;
    } else {
        return $this->getFieldById('carousel','img_url',$id);
    }
  }
  



}

?>