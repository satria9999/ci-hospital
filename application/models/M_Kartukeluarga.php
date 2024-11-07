<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Kartukeluarga extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('kartu_keluarga');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function edit_data($table,$id_penduduk)
        {
        $edit = $this->db->get_where($table,$id_penduduk);
        return $edit;
        }
        public function update($where,$data,$table)
        {
        $this->db->where($where);
        $this->db->update($table,$data);
        }

    public function detail_kartukeluarga($table,$id_kartukeluarga)
        {
        $edit = $this->db->get_where($table,$id_kartukeluarga);
        return $edit;
        }

    public function delete($where)
    {
    $this->db->delete('kartu_keluarga',$where);
    }

    public function hitungJumlahKartuKeluarga() {
        $this->db->select('COUNT(*) as jumlah_kartukeluarga');
        $this->db->from('kartu_keluarga');
    
        $result = $this->db->get();
    
        if ($result) {
            $row = $result->row();
            $jumlah_kartukeluarga = $row-> jumlah_kartukeluarga;
            return $jumlah_kartukeluarga;
        } else {
            // Tambahkan log error
            log_message('error', 'Gagal mengambil data penduduk dari database.');
            echo 'Error in model'; // Tambahkan echo untuk debugging
            return 0; // Return 0 if there are no records
        }
    }
}
?>