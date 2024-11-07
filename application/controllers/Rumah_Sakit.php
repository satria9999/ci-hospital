<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah_sakit extends CI_Controller {

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
	$this->load->model('M_Rumahsakit');
	}

	public function add_data()
	{
		$this->form_validation->set_rules('nama_rumahsakit', 'nama_rumahsakit', 'required|trim|is_unique[rumah_sakit.nama_rumahsakit]');
	$data ['nama_rumahsakit'] = $this->input->post('nama_rumahsakit');
	$data ['lokasi'] = $this->input->post('lokasi');


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
		$this->M_Rumahsakit->add_data('rumah_sakit',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Well done!</strong> Successful Create Data Rumah Sakit </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
	  
	redirect('Dashboard/lihat_rs','refresh');
	}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Nama Rumah Sakit error or is already available </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
	  redirect('Dashboard/form_rs','refresh');
		}
	}

	public function edit_data($id_rumahsakit){
		$where = array('id_rumahsakit' => $id_rumahsakit);
		$data['rumah_sakit'] = $this->M_Rumahsakit->edit_data('rumah_sakit', $where)->result();
		$data['content']='Data_rs/edit_rs';
		$this->load->view('template',$data);
		}

		public function update($id_rumahsakit)
		{
			$data ['nama_rumahsakit'] = $this->input->post('nama_rumahsakit');
			$data ['lokasi'] = $this->input->post('lokasi');
		// upload a picture
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
		$where = array('id_rumahsakit' => $id_rumahsakit);
		$this->M_Rumahsakit->update($where, $data, 'rumah_sakit');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Well done!</strong> Successful Update Data Rumah Sakit </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
		redirect('Dashboard/lihat_rs','refresh');
	}

	public function delete($id_rumahsakit)
	{
		// Menggunakan $this->input->is_ajax_request() untuk memeriksa apakah permintaan adalah AJAX
		if ($this->input->is_ajax_request()) {
			$where = array('id_rumahsakit' => $id_rumahsakit);
	
			// Tampilkan konfirmasi alert menggunakan JavaScript
			echo json_encode([
				'confirm' => true,
				'title' => 'Konfirmasi Penghapusan',
				'message' => 'Apakah Anda yakin ingin menghapus data ini?'
			]);			
		} else {
			$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
			$data['content'] = 'Data_rs/lihat_rs';
			$this->load->view('template', $data);
		}
	}

	public function aksi_hapus_rs($id_rumahsakit)
	{
		$where = array('id_rumahsakit' => $id_rumahsakit);
		$this->M_Rumahsakit->delete($where);
		
		// Set pesan sukses
		$this->session->set_flashdata('message', 'Data Rumah Sakit berhasil dihapus.');
	
		// Redirect kembali ke halaman lihat_penduduk
		redirect('Dashboard/lihat_rs', 'refresh');
	}		
		
	public function get_nama() {
		$id_rumahsakit = $this->input->get('id');

		// Mengambil data nama dari model (gantikan dengan logika Anda)
		$nama_rumahsakit = $this->M_Rumahsakit->getNamaById($id_rumahsakit);
		$lokasi_rumahsakit = $this->M_Rumahsakit->getLokasiById($id_rumahsakit);

        // Mengembalikan data dalam format JSON
        $response = array('nama_rumahsakit' => $nama_rumahsakit, 'lokasi' => $lokasi_rumahsakit);

		echo json_encode($response);
	}
	
		public function export_pdf()
		{
		$this->load->library('mypdfgenerator');
		$data['title'] = "Data Penduduk";
		$data['penduduk'] = $this->M_penduduk->show_data()->result();
		$this->mypdfgenerator->generate('penduduk/print_penduduk',$data);
		}
		
		public function print_mahasiswa($id_mhs)
		{
		$this->load->library('mypdfgenerator');
		$data['title'] = "Detail Mahasiswa";
		$where = array('id_mhs' => $id_mhs);
		$data['tbl_mahasiswa'] = $this->M_mahasiswa->edit_data('tbl_mahasiswa', $where)->result();
		$this->mypdfgenerator->generate('admin/print_mahasiswa',$data);
		}

		public function export_excelall(){
			$data = array( 'title' => 'Laporan Data Excel Penduduk');
			$data['penduduk'] = $this->M_penduduk->show_data()->result();
			$this->load->view('penduduk/print_excel',$data);
			}
	}

