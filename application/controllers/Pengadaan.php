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
    $data['kode_baru'] = $this->kode_baru->generate_code('pengadaan', 'PB');

    $data = [
      'no_pengadaan'   => $data['kode_baru'],
      'tgl_pengadaan'     => $this->input->post('tgl_pengadaan'),
      'kd_buku'      => $this->input->post('judul'),
      'asal_buku'    => $this->input->post('asal_buku'),
      'jumlah'   => $this->input->post('jumlah'),
      'keterangan' => $this->input->post('keterangan')
    ];

    $this->pengadaan_model->create_pengadaan($data);
    redirect(base_url('pengadaan'));
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
    $id = $this->input->post('no_pengadaan');
    $this->form_validation->set_rules('nm_pengadaan', 'Nama pengadaan', 'required');

    $data = [
      'tgl_pengadaan'     => $this->input->post('tgl_pengadaan'),
      'kd_buku'      => $this->input->post('judul'),
      'asal_buku'    => $this->input->post('asal_buku'),
      'jumlah'   => $this->input->post('jumlah'),
      'keterangan' => $this->input->post('keterangan')
    ];

    $this->dump($data); exit;
    $query = $this->pengadaan_model->update_pengadaan($id, $data);
    redirect(base_url('pengadaan'));
  }
}