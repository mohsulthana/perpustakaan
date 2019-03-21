<?php

class Kategori_model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'kategori';
		$this->data['primary_key']	= 'kd_kategori';
  }

  public function get_kategori()
  {
    return $this->get_by_order($this->data['primary_key'], 'ASC', $cond = '');
  }

  public function create_kategori($data)
  {
    return $this->insert($data);
  }

  public function delete_agreement($id)
  {
    return $this->delete($id);
  }

  public function update_kategori($id)
  {
    $data = [
      'nm_kategori'   => $this->input->post('nm_kategori')
    ];
    $query = $this->db->where('kd_kategori', $id);
    return $this->db->update('kategori', $data);
  }
}