<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
	parent ::__construct();
	$this->load->model('M_Dokter');
	$this->load->model('M_Rumahsakit');
	}

	public function add_data()
	{
		$this->form_validation->set_rules('nomer_dokter', 'nomer_dokter', 'required|trim|is_unique[dokter.nomer_dokter]');
	$data ['nomer_dokter'] = $this->input->post('nomer_dokter');
	$data ['id_rumahsakit'] = $this->input->post('id_rumahsakit');
	$data ['nama_rumahsakit'] = $this->input->post('nama_rumahsakit');
	$data ['lokasi'] = $this->input->post('lokasi');
	$data ['nama_dokter'] = $this->input->post('nama_dokter');
	$data ['spesialis'] = $this->input->post('spesialis');
	$data ['gender'] = $this->input->post('gender');
	$data ['waktu_mulai'] = $this->input->post('waktu_mulai');
    $data ['waktu_selesai'] = $this->input->post('waktu_selesai');
	// // upload a picture
	// $config['upload_path'] = './uploads/';
	// $config['allowed_types'] = 'gif|jpg|jpeg|png';
	// $config['overwrite'] = TRUE;
	// $config['max_size'] = '500000';
	// $config['file_name'] = time();

	// $this->load->library('upload', $config);
	// $this->upload->initialize($config);
	// if(!$this->upload->do_upload('image')) {
	// $error_image = $this->upload->display_errors();
	// $this->session->set_flashdata('error', $error_image);
	// redirect('dashboard/data_mhs');
	// } else {
	// $img = $this->upload->data();
	// }
	// $data ['foto'] = './uploads/' . time() . $img['file_ext'];
	if($this->form_validation->run() == TRUE) {
		$this->M_Dokter->add_data('dokter',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Well done!</strong> Successful Create Data Dokter </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
	  
	  redirect('Dashboard/lihat_dokter','refresh');
	}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Nomer Dokter error or is already available </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
	  redirect('Dashboard/form_dokter','refresh');
		}
	}

	public function edit_data($nomer_dokter){
		$where = array('nomer_dokter' => $nomer_dokter);
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['dokter'] = $this->M_Dokter->edit_data('dokter', $where)->result();
		$data['content']='Dokter/edit_dokter';
		$this->load->view('template',$data);
		}

		public function update($nomer_dokter)
{
    
    // Mendapatkan data yang diinputkan oleh pengguna
    $data = array(
        'nama_dokter' => $this->input->post('nama_dokter'),
        'id_rumahsakit' => $this->input->post('id_rumahsakit'),
        'nama_rumahsakit' => $this->input->post('nama_rumahsakit'),
        'gender' => $this->input->post('gender'),
        'lokasi' => $this->input->post('lokasi'),
        'spesialis' => $this->input->post('spesialis'),
        'waktu_mulai' => $this->input->post('waktu_mulai'),
		'waktu_selesai' => $this->input->post('waktu_selesai'),// Menggunakan rentang waktu yang telah dibuat
    );

    // Tentukan nilai default untuk atribut-atribut yang tidak diubah
    if ($data['gender'] == "") {
        unset($data['gender']); // Hapus atribut jika input kosong
    }

    // Lakukan pembaruan dengan data yang disiapkan
    $where = array('nomer_dokter' => $nomer_dokter);
    $this->M_Dokter->update($where, $data, 'dokter');

    // Set pesan sukses
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-flex align-items-center justify-content-start">
            <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i> 
            <span><strong>Well done!</strong> Successful Update Data Dokter </span>
        </div><!-- d-flex -->
    </div><!-- alert -->');

    // Redirect kembali ke halaman lihat dokter
    redirect('Dashboard/lihat_dokter','refresh');
}

	public function delete($nomer_dokter)
	{
		// Menggunakan $this->input->is_ajax_request() untuk memeriksa apakah permintaan adalah AJAX
		if ($this->input->is_ajax_request()) {
			$where = array('nomer_dokter' => $nomer_dokter);
	
			// Tampilkan konfirmasi alert menggunakan JavaScript
			echo json_encode([
				'confirm' => true,
				'title' => 'Konfirmasi Penghapusan',
				'message' => 'Apakah Anda yakin ingin menghapus data ini?'
			]);			
		} else {
			$data['dokter'] = $this->M_Dokter->show_data()->result();
			$data['content'] = 'Dokter/lihat_dokter';
			$this->load->view('template', $data);
		}
	}

	public function aksi_hapus_dokter($nomer_dokter)
	{
		$where = array('nomer_dokter' => $nomer_dokter);
		$this->M_Dokter->delete($where);
		
		// Set pesan sukses
		$this->session->set_flashdata('message', 'Data Dokter berhasil dihapus.');
	
		// Redirect kembali ke halaman lihat_penduduk
		redirect('Dashboard/lihat_dokter', 'refresh');
	}		

	public function detail_kartukeluarga($id_kartukeluarga){
		$where = array('id_kartukeluarga' => $id_kartukeluarga);
		$data['kartu_keluarga'] = $this->M_Kartukeluarga->detail_kartukeluarga('kartu_keluarga', $where)->result();
		$data['content']='kartu_keluarga/detail_kartukeluarga';
		$this->load->view('template',$data);
		}

		public function tambah_anggota($id_kartukeluarga){		
			if(isset($id_kartukeluarga)) {
				$where = array('id_kartukeluarga' => $id_kartukeluarga);
				$data['penduduk'] = $this->M_penduduk->show_data('kartu_keluarga', $where)->result();
				$data['kartu_keluarga'] = $this->M_Kartukeluarga->detail_kartukeluarga('kartu_keluarga', $where)->result();
				$data['content'] = 'kartu_keluarga/tambah_anggota';
				$this->load->view('template', $data);
			} else {
				redirect('Kartu_keluarga/detail_kartukeluarga');
			}
		}
		
		public function tambah_anggota_process($id_kartukeluarga){
			// Periksa apakah id_kartukeluarga sudah ada di tabel kartu_keluarga
			$where = array('id_kartukeluarga' => $id_kartukeluarga);
			$kartu_keluarga_exists = $this->M_penduduk->cek_data_exists('kartu_keluarga', $where);
		
			if($kartu_keluarga_exists) {
				$data ['id_kartukeluarga'] = $this->input->post('id_kartukeluarga');
				// Selanjutnya, masukkan data penduduk ke tabel penduduk
				$data_penduduk = array(
					'id_kartukeluarga' => $id_kartukeluarga,
					// Tambahkan kolom-kolom lain yang perlu dimasukkan
				);
				$this->M_penduduk->add_data('penduduk', $data_penduduk);
		
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Data has been created.</div>');
				redirect('Dashboard/lihat_kartukeluarga', 'refresh');
			} else {
				// Jika id_kartukeluarga tidak ditemukan di tabel kartu_keluarga
				redirect('Kartu_keluarga/detail_kartukeluarga');
			}
		}

}
