<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_RumahSakit extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('rumah_sakit');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function edit_data($table,$id_rumahsakit)
        {
        $edit = $this->db->get_where($table,$id_rumahsakit);
        return $edit;
        }
        public function update($where,$data,$table)
        {
        $this->db->where($where);
        $this->db->update($table,$data);
        }

    public function delete($where)
    {
    $this->db->delete('rumah_sakit',$where);
    }
    // In your M_penduduk model
//     public function getAnggotaByIdKartukeluarga($id_kartukeluarga) {
//     $this->db->where('id_kartukeluarga', $id_kartukeluarga);
//     return $this->db->get('kartu_keluarga')->result();
// 

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


    public function getDataForPieChart() {
        $this->db->select('YEAR(CURDATE()) - YEAR(tanggal_lahir) as usia');
        $query = $this->db->get('penduduk'); // Ganti "nama_tabel_penduduk" dengan nama tabel yang sesuai

        $categories = [
            'kategori1' => 0,
            'kategori2' => 0,
            'kategori3' => 0,
            'kategori4' => 0,
        ];

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->usia >= 1 && $row->usia <= 17) {
                    $categories['kategori1']++;
                } elseif ($row->usia >= 18 && $row->usia <= 40) {
                    $categories['kategori2']++;
                } elseif ($row->usia >= 41 && $row->usia <= 60) {
                    $categories['kategori3']++;
                } elseif ($row->usia >= 61 && $row->usia <= 90) {
                    $categories['kategori4']++;
                }
            }
        }

        return $categories;
    }

    public function countUnemployed() {
        // Query untuk menghitung jumlah pengangguran (pekerjaan = '-')
        $this->db->where('pekerjaan', '-');
        $query = $this->db->get('penduduk');

        // Mengembalikan jumlah hasil query
        return $query->num_rows();
    }

}
?>