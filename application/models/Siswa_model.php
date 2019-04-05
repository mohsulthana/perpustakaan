<?php

class Siswa_model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'siswa';
		$this->data['primary_key']= 'kd_siswa';
  }

  public function get_siswa()
  {
    return $this->get_by_order($this->data['primary_key'], 'ASC', $cond = '');
  }

  public function create_siswa($data)
  {
    return $this->insert($data);
  }

  public function delete_siswa($id)
  {
    return $this->db->delete('siswa', array('kd_siswa' => $id));
  }

  public function update_siswa($id, $data)
  {
    $query = $this->db->where('kd_siswa', $id);
    return $this->db->update('siswa', $data);
  }

  public function count_siswa()
  {
    return $this->db->get('siswa')->num_rows();
  }
}