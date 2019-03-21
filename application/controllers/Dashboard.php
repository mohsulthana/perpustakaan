<?php

class Dashboard extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    if(empty($this->session->userdata('status') === 'Logged in')) redirect(base_url('auth'));
  }

  public function index()
  {
    $data['title']    = 'Home';
    $data['session']  = $this->session->userdata();
    $this->load->template('Pages/home', $data);
  }
  
  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}