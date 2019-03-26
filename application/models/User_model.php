<?php

class User_model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'pengguna';
		$this->data['primary_key']	= 'kd_user';
  }

  public function get_user()
  {
    return $this->get_by_order($this->data['primary_key'], 'ASC', $cond = '');
  }

  public function create_user($data)
  {
    return $this->insert($data);
  }

  public function delete_user($id)
  {
    return $this->delete($id);
  }

  public function update_user($id)
  {
    $data = [
      'nm_user'   => $this->input->post('nm_user')
    ];
    $query = $this->db->where('kd_user', $id);
    return $this->db->update('pengguna', $data);
  }
}