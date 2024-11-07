<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Sliderimage extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('sliderimage');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function edit_data($table,$id_image)
        {
        $edit = $this->db->get_where($table,$id_image);
        return $edit;
        }
        public function update_data($where, $data, $table)
        {
            // Dapatkan path file gambar lama dari database
            $this->db->select('image');
            $this->db->where($where);
            $old_image = $this->db->get($table)->row()->image;
        
            // Hapus gambar lama dari folder uploads
            if ($old_image != '') {
                $old_image_path = FCPATH . $old_image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        
            // Update data berdasarkan kondisi tertentu
            $this->db->where($where);
            $this->db->update($table, $data);
        }
        
        public function delete_data($table, $id)
        {
            // Hapus data berdasarkan ID
            $this->db->where('id_image', $id);
            $this->db->delete($table);
        }
        
        public function get_image_by_id($id)
        {
            // Ambil data gambar berdasarkan ID
            $query = $this->db->get_where('sliderimage', array('id_image' => $id));
            return $query->row_array();
        }
        
        
    public function getNamaById($id_rumahsakit) {

        $query = $this->db->get_where('rumah_sakit', array('id_rumahsakit' => $id_rumahsakit));
        $row = $query->row();
    
        if ($row) {
            return $row->nama_rumahsakit;
        } else {
            return null;
        }
    }
    public function getLokasiById($id_rumahsakit) {
        $query = $this->db->get_where('rumah_sakit', array('id_rumahsakit' => $id_rumahsakit));
        $row = $query->row();
    
        if ($row) {
            return $row->lokasi;
        } else {
            return null;
        }
    }
    

    public function hitungJumlahPendudukDesa() {
        $this->db->select('COUNT(*) as jumlah_penduduk');
        $this->db->from('penduduk');
    
        $result = $this->db->get();
    
        if ($result) {
            $row = $result->row();
            $jumlahPenduduk = $row->jumlah_penduduk;
            return $jumlahPenduduk;
        } else {
            // Tambahkan log error
            log_message('error', 'Gagal mengambil data penduduk dari database.');
            echo 'Error in model'; // Tambahkan echo untuk debugging
            return 0; // Return 0 if there are no records
        }
    }

    public function hitungJumlahrumahsakit() {
        $this->db->select('COUNT(*) as jumlah_rumahsakit');
        $this->db->from('rumah_sakit');
    
        $result = $this->db->get();
    
        if ($result) {
            $row = $result->row();
            $jumlah_rumahsakit = $row->jumlah_rumahsakit;
            return $jumlah_rumahsakit;
        } else {
            // Tambahkan log error
            log_message('error', 'Gagal mengambil data rumah sakit dari database.');
            echo 'Error in model'; // Tambahkan echo untuk debugging
            return 0; // Return 0 if there are no records
        }
    }

}
?>