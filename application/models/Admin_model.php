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

  function isExistUserName($username)
  {

    $this->db->select('username, password');
    $this->db->from('user');
    $this->db->where('username = ', $username);
    $query = $this->db->get();
    if ($query->num_rows() == 1) return $query->row();
    return null;
  }

  function  addUserInfoToSession($username)
  {

    $user_info = $this->getInfoUserByUserName($username);

    $session_array = array('user_login' => $user_info);

    $this->session->set_userdata($session_array);
  }

  function  getInfoUserByUserName($username)
  {

    $this->db->select('id, username');

    $this->db->from('user');

    $this->db->where('username = ', $username);
    
    $query = $this->db->get();

    $results = $query->result_array();

    return $results[0];
  }

}

?>