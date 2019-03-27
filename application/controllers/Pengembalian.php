<?php

class Pengembalian extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengembalian_model');
    $this->load->model('siswa_model');
    $this->load->model('kategori_model');
    $this->load->model('buku_model');

    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']          = 'Data belum dikembalikan';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('pengembalian', 'KB');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['pengembalian']     = $this->pengembalian_model->get_pengembalian()->result();
    $data['buku']           = $this->buku_model->get_buku();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $this->load->template('Pages/pengembalian-data', $data);
  }

  public function kembalikan($id)
  {
    $data['title']          = 'Tambah Data pengembalian';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('pengembalian', 'KB');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['pengembalian']   = $this->pengembalian_model->get_pengembalian();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $this->load->template('Pages/pengembalian-baru', $data);
  }

  public function dikembalikan()
  {
    $data['title']          = 'Data dikembalikan';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('pengembalian', 'KB');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['pengembalian']   = $this->pengembalian_model->get_dikembalikan()->result();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $this->load->template('Pages/dikembalikan', $data);
  }

  public function listBuku()
  {
    $kd_kategori = $this->input->post('kd_kategori');

    $buku = $this->pengembalian_model->get_book_by_category($kd_kategori);
    
    $lists = "<option value=''>Pilih</option>";

    foreach($buku as $bukus) {
      $lists .= "<option value='" . $bukus->kd_buku . "'>" . $bukus->judul . "</option>";
    }
    $callback = array('list_buku' => $lists);
    echo json_encode($callback);
  }

  public function insert()
  {
    $data['title']          = 'Data pengembalian';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('pengembalian', 'KB');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['pengembalian']     = $this->pengembalian_model->get_pengembalian();
    $data['buku']           = $this->buku_model->get_buku();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $no_pinjam = $this->post('no_pinjam');
    
    $data = [
      'no_kembali'        => $this->post('no_kembali'),
      'tgl_kembali'       => $this->post('tgl_kembali'),
      'no_pinjam'         => $no_pinjam,
      'denda'             => $this->post('denda'),
      'kd_siswa'          => $this->post('siswa')
    ];
    
    $this->pengembalian_model->create_pengembalian($data);
    $this->pengembalian_model->update_status_peminjaman($no_pinjam);
    redirect(base_url('pengembalian'));
  }

  public function delete_pengembalian()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->pengembalian_model->delete_pengembalian($id);
    echo json_encode($query);
  }

  public function update_pengembalian()
  {
    $id = $this->input->post('kd_pengembalian');
    $this->form_validation->set_rules('nm_pengembalian', 'Nama pengembalian', 'required');

    if($this->form_validation->run() === TRUE) {
      $query = $this->pengembalian_model->update_pengembalian($id);
      redirect(base_url('pengembalian'));
    }
  }

  public function pengembalian_baru($id)
  {
    $data['title']          = 'Data pengembalian baru';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('pengembalian', 'KB');
    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['pengembalian']   = $this->pengembalian_model->pengembalian_baru($id)->result();
    $data['buku']           = $this->buku_model->get_buku();

    $this->load->template('Pages/pengembalian_baru', $data);
  }
}