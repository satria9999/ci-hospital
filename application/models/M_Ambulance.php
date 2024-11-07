<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Ambulance extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('ambulance');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function edit_data($table,$id_ambulance)
        {
        $edit = $this->db->get_where($table,$id_ambulance);
        return $edit;
        }
        public function update($where,$data,$table)
        {
        $this->db->where($where);
        $this->db->update($table,$data);
        }

    public function delete($where)
    {
    $this->db->delete('ambulance',$where);
    }
   
    public function update_status($id_ambulance, $new_status) {
        // Lakukan operasi untuk mengubah status dalam database
        $data = array(
            'hotline' => $new_status
        );
    
        $this->db->where('id_ambulance', $id_ambulance);
        $this->db->update('ambulance', $data);
    
        // Periksa apakah pengubahan berhasil
        if ($this->db->affected_rows() > 0) {
            return true; // Berhasil mengubah status
        } else {
            return false; // Gagal mengubah status
        }
    }    

    public function hitungJumlahambulance() {
        $this->db->select('COUNT(*) as ambulance');
        $this->db->from('ambulance');
    
        $result = $this->db->get();
    
        if ($result) {
            $row = $result->row();
            $ambulance = $row->ambulance;
            return $ambulance;
        } else {
            // Tambahkan log error
            log_message('error', 'Gagal mengambil data Ambulance dari database.');
            echo 'Error in model'; // Tambahkan echo untuk debugging
            return 0; // Return 0 if there are no records
        }
    }

 
}
?>