<?php

class Auth_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function login($table, $user) {
    return $this->db->get_where($table, array(
      'username' => $user['username'],
      'password' => md5($user['password'])
    ));
  }

  public function get_user()
  {
    return $this->db->get('pengguna');
  }
}