<?php

class Peminjaman_Model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'peminjaman';
		$this->data['primary_key']	= 'no_pinjam';
  }

  public function get_peminjaman()
  {
    $this->db->join('siswa', 'peminjaman.kd_siswa = siswa.kd_siswa', 'inner');
    $this->db->join('peminjaman_detil', 'peminjaman.no_pinjam = peminjaman_detil.no_pinjam', 'inner');
    $this->db->join('pengembalian', 'peminjaman.no_pinjam = pengembalian.no_pinjam', 'inner');
    $query = $this->db->get('peminjaman');
    return $query;
  }

  public function get_peminjaman_detil()
  {
    $this->db->select('*')->from('peminjaman_detil');
    $this->db->join('buku', 'peminjaman_detil.kd_buku = buku.kd_buku', 'inner');
    return $this->db->get();
  }

  public function count_peminjaman()
  {
    return $this->db->get_where('peminjaman', array('status' => 'Pinjam'))->num_rows();
  }

  public function count_dikembalikan()
  {
    return $this->db->get_where('peminjaman', array('status' => 'Kembali'))->num_rows();
  }

  public function nota_pinjam($id)
  {
    $this->db->select('*')->from('peminjaman')->where('peminjaman.no_pinjam', $id);
    $this->db->join('siswa', 'peminjaman.kd_siswa = siswa.kd_siswa', 'left');
    $this->db->join('peminjaman_detil', 'peminjaman.no_pinjam = peminjaman_detil.no_pinjam', 'inner');
    $this->db->join('buku', 'peminjaman_detil.kd_buku = buku.kd_buku', 'inner');
    return $this->db->get();
  }

  public function tabel_siswa($id)
  {
    $this->db->select('*')->from('peminjaman')->where('peminjaman.no_pinjam', $id);
    $this->db->join('siswa', 'peminjaman.kd_siswa = siswa.kd_siswa', 'left');
    return $this->db->get();
  }

  public function create_peminjaman($data_transaksi)
  {
    return$this->insert($data_transaksi);
  }

  public function get_book_by_category($kd_kategori)
  {
    $this->db->where('kd_kategori', $kd_kategori);
    $result = $this->db->get('buku')->result();
    return $result;
  }

  public function get_book_by_publisher($kd_penerbit)
  {
    $this->db->where('kd_penerbit', $kd_penerbit);
    $result = $this->db->get('buku')->result();
    return $result;
  }

  public function delete_peminjaman($id)
  {
    return $this->delete($id);
  }

  public function update_peminjaman($data, $id)
  {
    $query = $this->db->where('no_pinjam', $id);
    return $this->db->update('peminjaman', $data);
  }

  public function tmp_pinjam($data) {
    return $this->db->insert('tmp_pinjam', $data);
  }

  public function get_tmp_peminjaman()
  {
    $this->db->select('*')->from('tmp_pinjam');
    $this->db->join('buku', 'buku.kd_buku = tmp_pinjam.kd_buku');
    return $query = $this->db->get();
  }

  public function delete_tmp_peminjaman($kd)
  {
    return $this->db->delete('tmp_pinjam', array('id' => $kd));
  }

  public function delete_all_tmp_peminjaman($kd)
  {
    return $this->db->empty_table('tmp_pinjam');
  }

  public function get_tmp_pinjam()
  {
    $tmpQuery = $this->db->select('*')->from('tmp_pinjam')->get();
    $result = $tmpQuery->result();
    return $result;
  }

  public function move_tmp_to_detail($databuku)
  {
    return $this->db->insert('peminjaman_detil', $databuku);
  }
}