<?php

class Penerbit extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('penerbit_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data Penerbit';
    $data['session']  = $this->session->userdata();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $data['kode_baru'] = $this->kode_baru->generate_code('penerbit', 'P');

    $this->load->template('Pages/penerbit-data', $data);
  }

  public function add_penerbit()
  {
    $this->form_validation->set_rules('nm_penerbit', 'Nama penerbit', 'required');
    
    if($this->form_validation->run() === FALSE) {
      $this->load->admin_template('admin/agreement/create');
    } else {
      $data['kode_baru'] = $this->kode_baru->generate_code('penerbit', 'P');

      $data = [
        'kd_penerbit'   => $data['kode_baru'],
        'nm_penerbit'   => $this->input->post('nm_penerbit')
      ];

      $this->penerbit_model->create_penerbit($data);
      redirect(base_url('penerbit'));
    }
  }

  public function delete_penerbit()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->penerbit_model->delete_penerbit($id);
    echo json_encode($query);
  }

  public function update_penerbit()
  {
    $id = $this->input->post('kd_penerbit');
    $this->form_validation->set_rules('nm_penerbit', 'Nama penerbit', 'required');

    if($this->form_validation->run() === TRUE) {
      $query = $this->penerbit_model->update_penerbit($id);
      redirect(base_url('penerbit'));
    }
  }
}