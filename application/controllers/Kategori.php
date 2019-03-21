<?php

class Kategori extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('kategori_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data kategori';
    $data['session']  = $this->session->userdata();
    $data['kategori'] = $this->kategori_model->get_kategori();

    $data['kode_baru'] = $this->kode_baru->generate_code('kategori', 'P');

    $this->load->template('Pages/kategori-data', $data);
  }

  public function add_kategori()
  {
    $this->form_validation->set_rules('nm_kategori', 'Nama kategori', 'required');
    
    if($this->form_validation->run() === FALSE) {
      $this->load->admin_template('admin/agreement/create');
    } else {
      $data['kode_baru'] = $this->kode_baru->generate_code('kategori', 'P');

      $data = [
        'kd_kategori'   => $data['kode_baru'],
        'nm_kategori'   => $this->input->post('nm_kategori')
      ];

      $this->kategori_model->create_kategori($data);
      redirect(base_url('kategori'));
    }
  }

  public function delete_kategori()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('kd_kategori');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->kategori_model->delete_kategori($id);
    echo json_encode($query);
  }

  public function update_kategori()
  {
    $id = $this->input->post('kd_kategori');
    $this->form_validation->set_rules('nm_kategori', 'Nama kategori', 'required');

    if($this->form_validation->run() === TRUE) {
      $query = $this->kategori_model->update_kategori($id);
      redirect(base_url('kategori'));
    }
  }
}