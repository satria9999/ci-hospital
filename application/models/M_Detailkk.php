<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Detailkk extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('detail_kartukeluarga');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function getNamaKepalaKeluarga($table, $id_kartukeluarga) {
        $namaKepalaKeluarga = array(); // Default value if not found
    
        $detail_kartukeluarga = $this->db->get_where($table, $id_kartukeluarga)->result(); // Replace 'detail_kartukeluarga' with your actual table name
    
        foreach ($detail_kartukeluarga as $detail) {
            if ($detail->status == 'Kepala keluarga') {
                $namaKepalaKeluarga[] = $detail->nama; // Assuming the name field is 'nama', replace it with the actual field name
                // Note: We are using [] to append the value to the array
                break; // No need to continue loop once we find the head of the family
            }
        }
    
        if (empty($namaKepalaKeluarga)) {
            $namaKepalaKeluarga[] = 'Nama kepala keluarga (tidak ada)';
        }
    
        return $namaKepalaKeluarga;
    }

    

    public function detail_anggotakk($id_kartukeluarga) {
        $this->db->select('penduduk.*');
        $this->db->from('penduduk');
        $this->db->join('detail_kartukeluarga', 'penduduk.id_penduduk = detail_kartukeluarga.id_penduduk');
        $this->db->where('detail_kartukeluarga.id_kartukeluarga', $id_kartukeluarga);
        return $this->db->get()->result();
    }

    // public function edit_data($table,$id_penduduk)
    //     {
    //     $edit = $this->db->get_where($table,$id_penduduk);
    //     return $edit;
    //     }
    //     public function update($where,$data,$table)
    //     {
    //     $this->db->where($where);
    //     $this->db->update($table,$data);
    //     }

    // public function detail_kartukeluarga($table,$id_kartukeluarga)
    //     {
    //     $edit = $this->db->get_where($table,$id_kartukeluarga);
    //     return $edit;
    //     }

    // public function delete($where)
    // {
    // $this->db->delete('kartu_keluarga',$where);
    // }
}
?>