<?php

class Pengadaan extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan_model');
    $this->load->model('penerbit_model');
    $this->load->model('kategori_model');
    $this->load->model('buku_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data pengadaan';
    $data['session']  = $this->session->userdata();
    $data['pengadaan'] = $this->pengadaan_model->get_pengadaan();
    $data['header']   = 'Data pengadaan';

    $data['penerbit'] = $this->penerbit_model->get_penerbit();
    $data['buku']     = $this->buku_model->get_buku();
    $data['kategori'] = $this->kategori_model->get_kategori();

    $data['kode_baru'] = $this->kode_baru->generate_code('pengadaan', 'PB');

    $this->load->template('Pages/pengadaan-data', $data);
  }

  public function add_pengadaan()
  {
    $this->form_validation->set_rules('judul', 'Judul pengadaan', 'required');
    $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
    $this->form_validation->set_rules('isbn', 'ISBN', 'required');
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
    $this->form_validation->set_rules('halaman', 'Halaman', 'required');
    $this->form_validation->set_rules('thTerbit', 'Tahun Terbit', 'required');
    $this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required');
    
    if($this->form_validation->run() === FALSE) {
      $this->load->admin_template('admin/agreement/create');
    } else {
      $data['kode_baru'] = $this->kode_baru->generate_code('pengadaan', 'B');

      $data = [
        'kd_pengadaan'   => $data['kode_baru'],
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

      $this->pengadaan_model->create_pengadaan($data);
      redirect(base_url('pengadaan'));
    }
  }

  public function delete_pengadaan()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->pengadaan_model->delete_pengadaan($id);
    echo json_encode($query);
  }

  public function update_pengadaan()
  {
    $id = $this->input->post('kd_pengadaan');
    $this->form_validation->set_rules('nm_pengadaan', 'Nama pengadaan', 'required');

    if($this->form_validation->run() === TRUE) {
      $query = $this->pengadaan_model->update_pengadaan($id);
      redirect(base_url('pengadaan'));
    }
  }
}