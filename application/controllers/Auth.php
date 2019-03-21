<?php

class Auth extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('auth_model');
    if($this->session->userdata('status') === 'Logged in') redirect(base_url());
  }

  public function index()
  {
    $data['title']  = 'Login';
    $this->load->view('templates/header', $data);
    $this->load->view('login', $data);
  }

  public function login()
  {
    $this->data['title']          = 'Login';

    $username       = htmlspecialchars($this->input->post('username'));
    $password       = $this->input->post('password');

    $data = [
      'username'    => $username,
      'password'    => $password
    ];

    $query = $this->auth_model->login('pengguna', $data)->row();

    $userdata = [
      'username'    => $query->username,
      'nm_user'     => $query->nm_user,
      'status'      => 'Logged in'
    ];
    $this->session->set_userdata($userdata);
    redirect(base_url());
  }
}