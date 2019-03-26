<?php

class Kode_baru extends CI_Model {
  function generate_code($table, $initial)
  {
    $field = $this->db->list_fields($table);
    
    $this->db->select_max($field[0]);
    $query = $this->db->get($table);

    $row = $query->result_array();

    if ($row[0] == '') {
      $angka = 0;
    } else {
      $angka = substr(implode("", reset($row)), strlen($initial));
    }

    $angka++;
    $angka = strval($angka);
    
    $tmp = '';
    
    for($i = 1; $i <= (strlen(implode("", reset($row)))-strlen($initial)-strlen($angka)); $i++)
    {
      $tmp = $tmp . "0";
    }
    return $initial.$tmp.$angka; exit;
  }
}