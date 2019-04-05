<?php

class Buku extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('buku_model');
    $this->load->model('penerbit_model');
    $this->load->model('kategori_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data buku';
    $data['session']  = $this->session->userdata();
    $data['buku'] = $this->buku_model->get_buku();
    $data['header']   = 'Data Buku';

    $data['penerbit'] = $this->penerbit_model->get_penerbit();
    $data['kategori'] = $this->kategori_model->get_kategori();

    $data['kode_baru'] = $this->kode_baru->generate_code('buku', 'B');

    $this->load->template('Pages/buku-data', $data);
  }

  public function add_buku()
  {
    $this->form_validation->set_rules('judul', 'Judul buku', 'required');
    $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
    $this->form_validation->set_rules('isbn', 'ISBN', 'required');
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
    $this->form_validation->set_rules('halaman', 'Halaman', 'required');
    $this->form_validation->set_rules('thTerbit', 'Tahun Terbit', 'required');
    $this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required');
    
    if($this->form_validation->run() === FALSE) {
      $this->load->admin_template('admin/agreement/create');
    } else {
      $data['kode_baru'] = $this->kode_baru->generate_code('buku', 'B');

      $data = [
        'kd_buku'   => $data['kode_baru'],
        'judul'     => $this->input->post('judul'),
        'pengarang' => $this->input->post('pengarang'),
        'isbn'      => $this->input->post('isbn'),
        'jumlah'    => $this->input->post('jumlah'),
        'halaman'   => $this->input->post('halaman'),
        'th_terbit' => $this->input->post('thTerbit'),
        'sinopsis'  => $this->input->post('sinopsis'),
        'kd_penerbit' => $this->input->post('kd_penerbit'),
        'kd_kategori' => $this->input->post('kd_kategori')
      ];

      $this->buku_model->create_buku($data);
      redirect(base_url('buku'));
    }
  }

  public function delete_buku()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->buku_model->delete_buku($id);
    echo json_encode($query);
  }

  public function update_buku()
  {
    $id = $this->input->post('kd_buku');
    $this->form_validation->set_rules('nm_buku', 'Nama buku', 'required');

    if($this->form_validation->run() === TRUE) {
      $query = $this->buku_model->update_buku($id);
      redirect(base_url('buku'));
    }
  }
}