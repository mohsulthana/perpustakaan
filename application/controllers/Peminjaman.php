<?php

class Peminjaman extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('peminjaman_model');
    $this->load->model('siswa_model');
    $this->load->model('kategori_model');
    $this->load->model('buku_model');

    $this->load->library('kode_baru');
  }

  public function index()
  {
    $data['title']          = 'Data peminjaman';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('peminjaman', 'PJ');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['peminjaman']     = $this->peminjaman_model->get_peminjaman()->result();
    $data['peminjaman_detil']     = $this->peminjaman_model->get_peminjaman_detil()->result();
    $data['buku']           = $this->buku_model->get_buku();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $this->load->template('Pages/peminjaman-data', $data);
  }

  public function add()
  {
    $data['title']          = 'Tambah Data peminjaman';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('peminjaman', 'PJ0');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['peminjaman']     = $this->peminjaman_model->get_peminjaman();
    $data['tmp_pinjam']     = $this->peminjaman_model->get_tmp_peminjaman();
    $data['kategori']       = $this->kategori_model->get_kategori();

    $this->load->template('Pages/add_peminjaman-data', $data);
  }

  public function listBuku()
  {
    $kd_kategori = $this->input->post('kd_kategori');

    $buku = $this->peminjaman_model->get_book_by_category($kd_kategori);
    
    $lists = "<option value=''>Pilih</option>";

    foreach($buku as $bukus) {
      $lists .= "<option value='" . $bukus->kd_buku . "'>" . $bukus->judul . "</option>";
    }
    $callback = array('list_buku' => $lists);
    echo json_encode($callback);
  }

  public function insert()
  {
    $data['title']          = 'Data peminjaman';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('peminjaman', 'PJ');

    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['peminjaman']     = $this->peminjaman_model->get_peminjaman();
    $data['buku']           = $this->buku_model->get_buku();
    $data['tmp_pinjam']     = $this->peminjaman_model->get_tmp_peminjaman();
    $data['kategori']       = $this->kategori_model->get_kategori();
    
    $jumlah = $this->post('jumlah') ? $this->post('jumlah') : '1';
    $lama_pinjam = $this->post('lama_pinjam') ? $this->post('lama_pinjam') : '6';

    $kd = $this->input->post('siswa');
    $data_transaksi = [
      'no_pinjam'           => $data['kode_baru'],
      'tgl_pinjam'          => $this->post('tgl_pinjam'),
      'kd_siswa'            => $kd,
      'keterangan'          => $this->post('keterangan'),
      'lama_pinjam'         => $lama_pinjam,
      'status'              => 'Pinjam'
    ];

    $move = $this->peminjaman_model->get_tmp_peminjaman()->result();
    foreach($move as $moves) {
        $kode_buku = $moves->kd_buku;
        $jumlah    = $moves->jumlah;
    }

    $data = [
      'no_pinjam'   => $data['kode_baru'],
      'kd_buku'     => $kode_buku,
      'jumlah_bk'   => $jumlah
    ];

    $this->peminjaman_model->move_tmp_to_detail($data);
    $this->peminjaman_model->create_peminjaman($data_transaksi);
    $this->peminjaman_model->delete_all_tmp_peminjaman($kd);
    redirect(base_url('peminjaman'));
  }

  public function delete_peminjaman()
  {
    $data['title']     = 'Delete data';
    $id = $this->input->post('id');

    echo $this->session->set_flashdata('success_delete', 'Your data has successfully deleted');
    $query = $this->peminjaman_model->delete_peminjaman($id);
    echo json_encode($query);
  }

  public function update_peminjaman()
  {
    $id = $this->input->post('no_pinjam');
    $jumlah = $this->post('jumlah') ? $this->post('jumlah') : '1';
    $lama_pinjam = $this->post('lama_pinjam') ? $this->post('lama_pinjam') : '6';
    $kd = $this->input->post('siswa');

    $data = [
      'tgl_pinjam'          => $this->post('tgl_pinjam'),
      'kd_siswa'            => $kd,
      'keterangan'          => $this->post('keterangan'),
      'lama_pinjam'         => $lama_pinjam,
      'status'              => 'Pinjam'
    ];
    $query = $this->peminjaman_model->update_peminjaman($data, $id);
    redirect(base_url('peminjaman'));
  }

  public function nota_pinjam($id)
  {
    $data['title']          = 'Nota Peminjaman';
    $data['session']        = $this->session->userdata();
    $data['kode_baru']      = $this->kode_baru->generate_code('peminjaman', 'PJ0');
    $data['siswa']          = $this->siswa_model->get_siswa();
    $data['nota']           = $this->peminjaman_model->nota_pinjam($id)->result();
    $data['tabel_siswa']    = $this->peminjaman_model->tabel_siswa($id)->result();
    $data['buku']           = $this->buku_model->get_buku();
    $data['peminjaman']     = $this->peminjaman_model->get_peminjaman();

    $this->load->template('Pages/nota_pinjam', $data);
  }

  public function add_book_queue()
  {
    $id = $this->input->post('id');

    $data = [
      'kd_buku'     => $this->post('judul'),
      'jumlah'      => $this->post('jumlah'),
      'kd_user'     => $this->post('siswa')
    ];
    
    $query = $this->peminjaman_model->tmp_pinjam($data);
    echo json_encode($query);
  }

  public function delete_book_queue()
  {
    $kd = $this->input->post('id');

    $query = $this->peminjaman_model->delete_tmp_peminjaman($kd);
    echo json_encode($query);
  }
}