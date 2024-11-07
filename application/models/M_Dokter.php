<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dokter extends CI_Model

{
    public function show_data()
    {
    $show_data = $this->db->get('dokter');
    return $show_data;
    }

    public function add_data($table,$data)
    {
    $this->db->insert($table,$data);
    }

    public function edit_data($table,$nomer_dokter)
        {
        $edit = $this->db->get_where($table,$nomer_dokter);
        return $edit;
        }
        public function update($where,$data,$table)
        {
        $this->db->where($where);
        $this->db->update($table,$data);
        }

    public function delete($where)
    {
    $this->db->delete('dokter',$where);
    }


    public function getNamaById($idPenduduk) {

        $query = $this->db->get_where('penduduk', array('id_penduduk' => $idPenduduk));
        $row = $query->row();
    
        if ($row) {
            return $row->nama;
        } else {
            return null;
        }
    }

    public function hitungJumlahdokter() {
        $this->db->select('COUNT(*) as jumlah_dokter');
        $this->db->from('dokter');
    
        $result = $this->db->get();
    
        if ($result) {
            $row = $result->row();
            $jumlah_dokter = $row->jumlah_dokter;
            return $jumlah_dokter;
        } else {
            // Tambahkan log error
            log_message('error', 'Gagal mengambil data dokter dari database.');
            echo 'Error in model'; // Tambahkan echo untuk debugging
            return 0; // Return 0 if there are no records
        }
    }

    public function hitungJumlahPekerja() {
        $this->db->where('pekerjaan !=', '-');
        $query = $this->db->get('penduduk'); // Ganti "nama_tabel_penduduk" dengan nama tabel yang sesuai

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
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