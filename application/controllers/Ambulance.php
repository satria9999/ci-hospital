<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambulance extends CI_Controller {

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
	$this->load->model('M_Ambulance');
	$this->load->model('M_Rumahsakit');
	}

	public function add_data()
	{
		// $this->form_validation->set_rules('id_layanan', 'id_layanan', 'required|trim|is_unique[layanan.nama_layanan]');
	$data ['id_rumahsakit'] = $this->input->post('id_rumahsakit');
	$data ['nama_rumahsakit'] = $this->input->post('nama_rumahsakit');
	$data ['nomor_telepon'] = $this->input->post('nomor_telepon');
    // Menggabungkan waktu mulai dan waktu selesai menjadi rentang waktu
   
   
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
	// if($this->form_validation->run() == TRUE) {
		$this->M_Ambulance->add_data('ambulance',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Well done!</strong> Successful Create Data Ambulance </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
	  
	  redirect('Dashboard/lihat_ambulance','refresh');
	// }
	// 	else{
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
	// 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 	  <span aria-hidden="true">&times;</span>
	// 	</button>
	// 	<div class="d-flex align-items-center justify-content-start">
	// 	  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
	// 	  <span><strong>ID Ambulance error or is already available </span>
	// 	</div><!-- d-flex -->
	//   </div><!-- alert -->');
	//   redirect('Dashboard/form_ambulance','refresh');
	// 	}
	}

	public function edit_data($id_ambulance){
		$where = array('id_ambulance' => $id_ambulance);
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['ambulance'] = $this->M_Ambulance->edit_data('ambulance', $where)->result();
		$data['content']='Ambulance/edit_ambulance';
		$this->load->view('template',$data);
		}

		public function update($id_layanan)
{
    
    // Mendapatkan data yang diinputkan oleh pengguna
    $data = array(
        'id_rumahsakit' => $this->input->post('id_rumahsakit'),
        'nama_rumahsakit' => $this->input->post('nama_rumahsakit'),
        'lokasi' => $this->input->post('lokasi'),
		'nama_layanan' => $this->input->post('nama_layanan')
    );

    // Tentukan nilai default untuk atribut-atribut yang tidak diubah
    if ($data['nama_layanan'] == "") {
        unset($data['nama_layanan']); // Hapus atribut jika input kosong
    }

    // Lakukan pembaruan dengan data yang disiapkan
    $where = array('id_layanan' => $id_layanan);
    $this->M_Layanan->update($where, $data, 'layanan');

    // Set pesan sukses
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-flex align-items-center justify-content-start">
            <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i> 
            <span><strong>Well done!</strong> Successful Update Data Layanan </span>
        </div><!-- d-flex -->
    </div><!-- alert -->');

    // Redirect kembali ke halaman lihat dokter
    redirect('Dashboard/lihat_layanan','refresh');
}

	public function delete($id_ambulance)
	{
		// Menggunakan $this->input->is_ajax_request() untuk memeriksa apakah permintaan adalah AJAX
		if ($this->input->is_ajax_request()) {
			$where = array('id_ambulance' => $id_ambulance);
	
			// Tampilkan konfirmasi alert menggunakan JavaScript
			echo json_encode([
				'confirm' => true,
				'title' => 'Konfirmasi Penghapusan',
				'message' => 'Apakah Anda yakin ingin menghapus data ini?'
			]);			
		} else {
			$data['ambulance'] = $this->M_Ambulance->show_data()->result();
			$data['content'] = 'Ambulance/lihat_ambulance';
			$this->load->view('template', $data);
		}
	}

	public function aksi_hapus_ambulance($id_ambulance)
	{
		$where = array('id_ambulance' => $id_ambulance);
		$this->M_Ambulance->delete($where);
		
		// Set pesan sukses
		$this->session->set_flashdata('message', 'Data Ambulance berhasil dihapus.');
	
		// Redirect kembali ke halaman lihat_penduduk
		redirect('Dashboard/lihat_ambulance', 'refresh');
	}		

	public function change_status() {
		$id_ambulance = $this->input->post('id_ambulance');
		$new_status = $this->input->post('new_status');
	
		// Panggil model untuk memperbarui status ambulance
		$this->load->model('M_Ambulance');
		$result = $this->M_Ambulance->update_status($id_ambulance, $new_status);
	
		// Berikan respons berdasarkan hasil dari model
		if ($result) {
			echo 'success';
		} else {
			echo 'error';
		}
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
