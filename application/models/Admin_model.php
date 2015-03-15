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
  
  public function articleList($paging_limit,$page = NULL,$data_filter = NULL){
    $this->db->from('articles');
    $this->db->where('deleted_at',NULL);
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function storeArticle($input){
    $content = $input['box-content-article'];
    $title = $input['title-article'];
    $desc = $this->shorter($content,120);

    $date = getCurrentDate();

    $data = array(
       'title' => trim($title),
       'content' => trim($content),
       'desc' => $desc,
       'created_at' => $date,
       'updated_at' => $date
    );

    $this->db->insert('articles', $data); 

  }

  public function countRecord($table){
    $this->db->from($table);
    $this->db->where('deleted_at',NULL);
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

    $date = getCurrentDate();

    $data = array(
       'title' => trim($title) ,
       'content' => trim($content) ,
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
    $position = $input['mn_position'];
    $article_id = $input['mn_article_id'];

    $date = getCurrentDate();

    $data = array(
       'name' => $name ,
       'positions' => $position ,
       'article_id' => $article_id,
       'created_at' => $date,
       'updated_at' => $date
    );

    $this->db->insert('menu', $data); 

  }

  public function menuList($paging_limit,$page = NULL,$data_filter = NULL){
    $this->db->select('me.id,me.name,me.positions,me.article_id,art.title');
    $this->db->from('menu as me');
    $this->db->where('me.deleted_at',NULL);
    $this->db->join('articles as art','me.article_id = art.id');
    if ($page !== null)
    {
      $begin = ($page - 1)*$paging_limit;
      $this->db->limit($paging_limit, $begin);
    }
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function updateMenu($input){
    $id = $input['menu-id'];
    $name = $input['mn_name'];
    $position = $input['mn_position'];
    $article_id = $input['mn_article_id'];

    $date = getCurrentDate();

    $data = array(
       'name' => trim($name) ,
       'positions' => $position ,
       'article_id' => $article_id,
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


}

?>