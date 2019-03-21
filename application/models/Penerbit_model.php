<?php

class Penerbit_model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'penerbit';
		$this->data['primary_key']	= 'kd_penerbit';
  }

  public function get_penerbit()
  {
    return $this->get_by_order($this->data['primary_key'], 'ASC', $cond = '');
  }

  public function create_penerbit($data)
  {
    return $this->insert($data);
  }

  public function delete_penerbit($id)
  {
    return $this->db->delete('penerbit', array('kd_penerbit' => $id));
  }

  public function update_penerbit($id)
  {
    $data = [
      'nm_penerbit'   => $this->input->post('nm_penerbit')
    ];
    $query = $this->db->where('kd_penerbit', $id);
    return $this->db->update('penerbit', $data);
  }
}