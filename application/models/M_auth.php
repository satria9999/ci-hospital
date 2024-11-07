<?php

class M_auth extends CI_Model
{
public function get_user_data($nama)
{
return $this->db->get_where('account', ['nama' => $nama])->row_array();
}
public function insert_user_data($data)
{
$this->db->insert('account', $data);
}
}
?>