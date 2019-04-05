<?php

class Dashboard extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('buku_model');
    $this->load->model('siswa_model');
    $this->load->model('peminjaman_model');
    if(empty($this->session->userdata('status') === 'Logged in')) redirect(base_url('auth'));
  }

  public function index()
  {
    $data['title']    = 'Home';
    $data['session']  = $this->session->userdata();

    $data['buku_numb']  = $this->buku_model->count_book();
    $data['siswa_numb'] = $this->siswa_model->count_siswa();
    $data['dipinjam']   = $this->peminjaman_model->count_peminjaman();
    $data['dikembalikan']   = $this->peminjaman_model->count_dikembalikan();
    $this->load->template('Pages/home', $data);
  }

  public function profil()
  {
    $data['title']    = 'Home';
    $data['session']  = $this->session->userdata();
    $this->load->template('Pages/profil', $data);
  }
  
  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}