<?php

class User extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data user';
    $data['session']  = $this->session->userdata();
    $data['user']     = $this->user_model->get_user();

    $data['kode_baru'] = $this->kode_baru->generate_code('pengguna', 'U');

    $this->load->template('Pages/user-data', $data);
  }

  public function add_user()
  {
    // $this->form_validation->set_rules('nm_user', 'Nama user', 'required');
    
      $data['kode_baru'] = $this->kode_baru->generate_code('pengguna', 'U');

      $data = [
        'kd_user'   => $data['kode_baru'],
        'nm_user'   => $this->input->post('nm_user'),
        'username'  => $this->input->post('username'),
        'password'  => md5($this->input->post('password'))
      ];

      $this->user_model->create_user($data);
      redirect(base_url('user'));
  }

  public function delete_user()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->user_model->delete_user($id);
    echo json_encode($query);
  }

  public function update_user()
  {
    $id = $this->input->post('kd_user');

      $query = $this->user_model->update_user($id);
      redirect(base_url('user'));
  }
}