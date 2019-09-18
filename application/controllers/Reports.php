<?php

class Reports extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('penerbit_model');
    $this->load->model('kategori_model');
    $this->load->model('user_model');
    $this->load->model('buku_model');
    $this->load->model('siswa_model');
    $this->load->model('pengadaan_model');
    $this->load->model('peminjaman_model');
    if(empty($this->session->userdata('status') === 'Logged in')) redirect(base_url('auth'));
  }

  public function index()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();

    $this->load->template('Pages/reports/reports', $data);
  }

  public function penerbit_report()
  {
    $data['title']    = 'Laporan Data Penerbit';
    $data['session']  = $this->session->userdata();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();


    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-penerbit', $data);
    $this->load->view('templates/footer');
  }

  public function user_report()
  {
    $data['title']    = 'Laporan Data User';
    $data['session']  = $this->session->userdata();
    $data['user'] = $this->user_model->get_user();


    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-user', $data);
    $this->load->view('templates/footer');
  }

  public function kategori_report()
  {
    $data['title']    = 'Laporan Data Kategori';
    $data['session']  = $this->session->userdata();
    $data['kategori'] = $this->kategori_model->get_kategori();


    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-kategori', $data);
    $this->load->view('templates/footer');
  }

  public function buku_report_by_publisher()
  {
    $data['title']    = 'Laporan Data Buku Per Penerbit';
    $data['session']  = $this->session->userdata();
    $data['buku']     = $this->buku_model->get_buku();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-buku-publisher', $data);
    $this->load->view('templates/footer');
  }

  public function buku_report_by_category()
  {
    $data['title']    = 'Laporan Data Buku Per Kategori';
    $data['session']  = $this->session->userdata();
    $data['buku']     = $this->buku_model->get_buku();
    $data['kategori'] = $this->kategori_model->get_kategori();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-buku-category', $data);
    $this->load->view('templates/footer');
  }

  public function siswa_report()
  {
    $data['title']    = 'Laporan Data Siswa';
    $data['session']  = $this->session->userdata();
    $data['siswa']     = $this->siswa_model->get_siswa();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-siswa', $data);
    $this->load->view('templates/footer');
  }

  public function pengadaan_report()
  {
    $data['title']    = 'Laporan Data Pengadaan';
    $data['session']  = $this->session->userdata();
    $data['pengadaan']= $this->pengadaan_model->get_pengadaan()->result();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-pengadaan', $data);
    $this->load->view('templates/footer');
  }

  public function peminjaman_report()
  {
    $data['title']    = 'Laporan Data Peminjaman';
    $data['session']  = $this->session->userdata();
    $data['peminjaman']= $this->peminjaman_model->get_peminjaman()->result();
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/report-peminjaman', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_penerbit()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header'] = 'Laporan Data Penerbit';
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-penerbit', $data);
  }
  
  public function cetak_user()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header'] = 'Laporan Data User';
    $data['user'] = $this->user_model->get_user();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-user', $data);
  }

  public function cetak_kategori()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header'] = 'Laporan Data Kategori';
    $data['kategori'] = $this->kategori_model->get_kategori();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-kategori', $data);
  }

  public function cetak_buku_by_publisher()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header']   = 'Laporan Data Buku';
    $data['penerbit'] = $this->penerbit_model->get_penerbit();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-buku-publisher', $data);
  }

  public function cetak_buku_by_category()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header']   = 'Laporan Data Buku';
    $data['kategori'] = $this->kategori_model->get_kategori();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-buku-category', $data);
  }

  public function cetak_siswa()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header']   = 'Laporan Data Siswa';
    $data['siswa']    = $this->siswa_model->get_siswa();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-siswa', $data);
  }

  public function cetak_pengadaan()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header']   = 'Laporan Data Pengadaan';
    $data['pengadaan']= $this->pengadaan_model->get_pengadaan();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-pengadaan', $data);
  }

  public function cetak_peminjaman()
  {
    $data['title']    = 'Reports';
    $data['session']  = $this->session->userdata();
    $data['header']   = 'Laporan Data Peminjaman';
    $data['peminjaman']= $this->peminjaman_model->get_peminjaman();

    $this->load->view('templates/header', $data);
    $this->load->view('Pages/reports/print/print-peminjaman', $data);
  }

  public function get_book_by_publisher()
  {
    $kd_penerbit = $this->input->post('kd_penerbit');

    $buku = $this->peminjaman_model->get_book_by_publisher($kd_penerbit);

    if($buku == NULL) {
      $lists = '
      <tr>
        <td><h1>Kosong</h1></td>
      </tr>';
    }
    $no = 1;

    $lists = "
      ";
    foreach($buku as $bukus) {
      $lists .= 
      "<tr>
        <td>" . $no++ . "</td>
        <td>" . $bukus->kd_buku  . "</td>
        <td>" . $bukus->judul . "</td>
        <td>" . $bukus->pengarang . "</td>
        <td>" . $bukus->jumlah . "</td>
      </tr>
      ";
    }
    $callback = array('list_buku' => $lists);
    echo json_encode($callback);
  }

  public function get_book_by_category()
  {
    $kd_kategori = $this->input->post('kd_kategori');

    $buku = $this->peminjaman_model->get_book_by_category($kd_kategori);

    if($buku == NULL) {
      $lists = '
      <tr>
        <td><h1>Kosong</h1></td>
      </tr>';
    }
    $no = 1;

    $lists = "
      ";
    foreach($buku as $bukus) {
      $lists .= 
      "<tr>
        <td>" . $no++ . "</td>
        <td>" . $bukus->kd_buku  . "</td>
        <td>" . $bukus->judul . "</td>
        <td>" . $bukus->pengarang . "</td>
        <td>" . $bukus->jumlah . "</td>
      </tr>
      ";
    }
    $callback = array('list_buku' => $lists);
    echo json_encode($callback);
  }
}