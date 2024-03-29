<?php

class Siswa extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model');
    $this->load->model('penerbit_model');
    $this->load->model('kategori_model');
    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']    = 'Data Siswa';
    $data['session']  = $this->session->userdata();
    $data['siswa']    = $this->siswa_model->get_siswa();

    $data['penerbit'] = $this->penerbit_model->get_penerbit();
    $data['kategori'] = $this->kategori_model->get_kategori();

    $data['kode_baru'] = $this->kode_baru->generate_code('siswa', 'S');

    $this->load->template('Pages/siswa-data', $data);
  }

  public function add_siswa()
  {
    // $this->form_validation->set_rules('nm_siswa', 'Nama siswa', 'required');
    // $this->form_validation->set_rules('nisn', 'nisn', 'required');
    // $this->form_validation->set_rules('kelamin', 'kelamin', 'required');
    // $this->form_validation->set_rules('agama', 'Agama', 'required');
    // $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
    // $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
    // $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    // $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
    
      $data['kode_baru'] = $this->kode_baru->generate_code('siswa', 'S');

      $config['upload_path']          = './photo/siswa/';
      $config['allowed_types']        = 'jpeg|gif|jpg|png';
      $config['max_size']             = 100;

      $namafoto     = $_FILES['photo']['name'];
      $ukuranFile   = $_FILES['photo']['size'];
      $error        = $_FILES['photo']['error'];
      $tmpNama      = $_FILES['photo']['tmp_name'];

      // cek apakah tidak ada gambar yang diupload
      if($error === 4) {
        echo "<script>
                alert('pilih gambar yang akan diupload');
              </script>";
        redirect(base_url('siswa'));
      }

      // cek apakah yang diupload adalah gambar
      $extension = explode('.', $namafoto);
      $extension = strtolower(end($extension));

      if( ! in_array($extension, explode('|', $config['allowed_types'])) ) {
        echo "<script>
                alert('Yang diupload bukan gambar');
              </script>";
        redirect(base_url('siswa'));
      }

      $file = move_uploaded_file($tmpNama, './assets/photo/siswa/' . $namafoto);

      $data = [
        'kd_siswa'  => $data['kode_baru'],
        'nm_siswa'  => $this->input->post('nm_siswa'),
        'nisn'      => $this->input->post('nisn'),
        'kelamin'   => $this->input->post('kelamin'),
        'agama'     => $this->input->post('agama'),
        'tempat_lahir'    => $this->input->post('tempat_lahir'),
        'tanggal_lahir'   => $this->input->post('tgl_lahir'),
        'alamat'    => $this->input->post('alamat'),
        'no_telepon'=> $this->input->post('no_telp'),
        'foto'      => $namafoto
      ];

      if($file === TRUE) {
        $this->siswa_model->create_siswa($data);
        $this->session->set_userdata('news_success', 'Your data has successfully created');
        redirect(base_url('siswa'));
      }
  }

  public function delete_siswa()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->siswa_model->delete_siswa($id);
    echo json_encode($query);
  }

  public function edit_siswa($id)
  {
    $data['session']  = $this->session->userdata();
    $data['siswa']    = $this->siswa_model->get_siswa_by_id($id);
    $data['title']     = 'Edit Profil Siswa';
    $this->load->template('Pages/profil_siswa', $data);    
  }

  public function update_siswa()
  {
    $id = $this->input->post('kd_siswa');
    $siswa    = $this->siswa_model->get_siswa_by_id($id);
    $data = [
      'nm_siswa'  => $this->input->post('nm_siswa'),
      'nisn'      => $this->input->post('nisn'),
      'kelamin'   => $this->input->post('kelamin'),
      'agama'     => $this->input->post('agama'),
      'tempat_lahir'    => $this->input->post('tempat_lahir'),
      'tanggal_lahir'   => $this->input->post('tgl_lahir'),
      'alamat'    => $this->input->post('alamat'),
      'no_telepon'=> $this->input->post('no_telp')
    ];
    $config['upload_path']          = './photo/siswa/';
    $config['allowed_types']        = 'jpeg|gif|jpg|png';
    $config['max_size']             = 100;

    $namafoto     = $_FILES['photo']['name'];
    $ukuranfoto   = $_FILES['photo']['size'];
    $error        = $_FILES['photo']['error'];
    $tmpNama      = $_FILES['photo']['tmp_name'];

    foreach ($siswa->result() as $siswas) {
        if ($namafoto != $siswas->foto) {
            // cek apakah tidak ada gambar yang diupload
            if ($error === 4) {
                echo "<script>
                alert('pilih gambar yang akan diupload');
              </script>";
                redirect(base_url('siswa'));
            }

            // cek apakah yang diupload adalah gambar
            $extension = explode('.', $namafoto);
            $extension = strtolower(end($extension));

            if (! in_array($extension, explode('|', $config['allowed_types']))) {
                echo "<script>
                alert('Yang diupload bukan gambar');
              </script>";
                redirect(base_url('siswa'));
            }

            $file = move_uploaded_file($namafoto, './assets/photo/siswa/' . $namafoto);

            if ($file === true) {
                $this->db->where('kd_siswa', $id);
                $this->db->update('siswa', ['foto' => $namafoto]);
            }
        }
    }
    
    
    $query = $this->siswa_model->update_siswa($id, $data);
    $this->session->set_flashdata('message', 'Profil berhasil diperbaharui');
    redirect(base_url('siswa'));
  }
}