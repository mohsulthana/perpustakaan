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

    $query = $this->auth_model->login('pengguna', $data);

    if($query->num_rows() === 1) {
      $row = $query->row();
      $userdata = [
        'kd_user'     => $row->kd_user,
        'username'    => $row->username,
        'password'    => $row->password,
        'nm_user'     => $row->nm_user,
        'status'      => 'Logged in',
        'role'        => $row->role,
        'gambar'      => $row->gambar
      ];

      $this->session->set_userdata($userdata); 
      redirect(base_url());
    } else {
      $this->session->set_flashdata('login_error', 'Your account is not authorized');
      redirect(base_url('auth'));
    }
  }
}