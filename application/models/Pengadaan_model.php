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
    $query = $this->db->get();
    return $query;
  }

  public function create_pengadaan($databuku, $data_transaksi)
  {
    $this->db->insert('pengadaan_detil', $databuku);
    $this->insert($data_transaksi);
    return true;
  }

  public function delete_pengadaan($id)
  {
    return $this->delete($id);
  }

  public function update_pengadaan($id)
  {
    $data = [
      'nm_pengadaan'   => $this->input->post('nm_pengadaan')
    ];
    $query = $this->db->where('kd_pengadaan', $id);
    return $this->db->update('pengadaan', $data);
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