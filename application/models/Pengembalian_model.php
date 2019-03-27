<?php

class Pengembalian_Model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'pengembalian';
		$this->data['primary_key']	= 'no_pinjam';
  }

  public function get_pengembalian()
  {
    $this->db->select('*')->from('peminjaman');
    $this->db->join('siswa', 'peminjaman.kd_siswa = siswa.kd_siswa', 'left');
    $this->db->where('peminjaman.status', 'pinjam');
    $query = $this->db->get();
    return $query;
  }

  public function get_dikembalikan()
  {
    $this->db->join('siswa', 'pengembalian.kd_siswa = siswa.kd_siswa', 'left');
    $this->db->join('peminjaman', 'pengembalian.no_pinjam = pengembalian.no_pinjam', 'left');
    $query = $this->db->get('pengembalian');
    return $query;
  }

  public function pengembalian_baru($id)
  {
    $this->db->join('siswa', 'siswa.kd_siswa = peminjaman.kd_siswa', 'left');
    return $this->db->get('peminjaman');
  }

  public function create_pengembalian($data)
  {
    return $this->insert($data);
  }

  public function update_status_peminjaman($id)
  {
    $this->db->where('no_pinjam', $id);
    return $this->db->update('peminjaman', array('status' => 'kembali'));
  }
}