<?php

class Buku_model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'buku';
		$this->data['primary_key']	= 'kd_buku';
  }

  public function get_buku()
  {
    return $this->get_by_order($this->data['primary_key'], 'ASC', $cond = '');
  }

  public function create_buku($data)
  {
    return $this->insert($data);
  }

  public function delete_buku($id)
  {
    return $this->db->delete('buku', array('kd_buku' => $id));
  }

  public function update_buku($id)
  {
    $data = [
      'judul'   => $this->input->post('nm_buku')
    ];
    $query = $this->db->where('kd_buku', $id);
    return $this->db->update('buku', $data);
  }

  public function count_book()
  {
    return $this->db->get('buku')->num_rows();
  }
}