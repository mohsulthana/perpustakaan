<?php

class Pengadaan_Model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'pengadaan';
		$this->data['primary_key']	= 'no_pengadaan';
  }

  public function get_pengadaan()
  {
    $this->db->select('*')->from('pengadaan');
    $this->db->join('buku', 'pengadaan.kd_buku = buku.kd_buku', 'left');
    $this->db->join('kategori', 'buku.kd_kategori = kategori.kd_kategori', 'left');
    $query = $this->db->get();
    return $query;
  }

  public function create_pengadaan($pengadaan)
  {
    return $this->insert($pengadaan);
  }

  public function delete_pengadaan($id)
  {
    return $this->delete($id);
  }

  public function update_pengadaan($id, $data)
  {
    $query = $this->update($id, $data);
    return  $query;
  }

  public function tmp_pinjam($data) {
    return $this->db->insert('tmp_pinjam', $data);
  }

  public function get_tmp_pengadaan()
  {
    $this->db->select('*')->from('buku');
    $this->db->join('tmp_pinjam', 'tmp_pinjam.kd_buku = buku.kd_buku');
    return $query = $this->db->get();
  }

  public function delete_tmp_pengadaan($id)
  {
    return $this->db->delete('tmp_pinjam', array('kd_buku' => $id));
  }
}