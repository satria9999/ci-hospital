<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sliderimage extends CI_Controller {

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
	$this->load->model('M_Sliderimage');
	}

	public function add_data()
{
    // Upload a picture
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '500000';
    $config['file_name'] = time();

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('image')) {
        $error_image = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error_image);
        redirect('Dashboard/lihat_sliderimage');
    } else {
        $img = $this->upload->data();
        // Image uploaded successfully, now store the data to the database
        $data ['image'] = './uploads/' . time() . $img['file_ext'];
        $data['alamat_image'] = './uploads/' . $img['file_name'];
        $this->M_Sliderimage->add_data('sliderimage', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-flex align-items-center justify-content-start">
                <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                <span><strong>Well done!</strong> Successful Create Data Slider Image </span>
            </div><!-- d-flex -->
        </div><!-- alert -->');

        redirect('Dashboard/lihat_sliderimage', 'refresh');
    }
}

	public function edit_data($id_image){
		$where = array('id_image' => $id_image);
		$data['image'] = $this->M_Sliderimage->edit_data('sliderimage', $where)->result();
		$data['content']='Sliderimage/edit_sliderimage';
		$this->load->view('template',$data);
		}

        public function update_data($id_image)
        {
            // Konfigurasi upload gambar baru (jika diperlukan)
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = TRUE; // Mengaktifkan overwrite jika file dengan nama yang sama sudah ada
            $config['max_size'] = '500000';
            $config['file_name'] = time(); // Nama file menggunakan timestamp saat ini
        
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
        
            if (!$this->upload->do_upload('image')) {
                // Jika gagal mengupload gambar baru, tampilkan pesan kesalahan
                $error_image = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error_image);
                redirect('Dashboard/lihat_sliderimage');
            } else {
                // Jika berhasil mengupload gambar baru, lanjutkan dengan proses pengeditan
        
                // Dapatkan informasi gambar yang baru diupload
                $img = $this->upload->data();
                $image_path = './uploads/' . $img['file_name'];
                $data['alamat_image'] = './uploads/' . $img['file_name'];
        
                // Persiapkan data untuk diupdate
                $data = array(
                    'image' => $image_path // Simpan alamat file gambar baru ke dalam database
                );
        
                // Panggil model untuk melakukan pengeditan data gambar
                $this->M_Sliderimage->update_data(array('id_image' => $id_image), $data, 'sliderimage');
        
                // Set flash message untuk menampilkan pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Well done!</strong> Successful Update Data Slider Image </span>
                    </div><!-- d-flex -->
                </div><!-- alert -->');
        
                // Redirect ke halaman lihat_sliderimage
                redirect('Dashboard/lihat_sliderimage', 'refresh');
            }
        }                
        
public function delete($id_image)
{
    // Menggunakan $this->input->is_ajax_request() untuk memeriksa apakah permintaan adalah AJAX
    if ($this->input->is_ajax_request()) {
        $image = $this->M_Sliderimage->get_image_by_id($id_image);

        // Tampilkan konfirmasi alert menggunakan JavaScript
        echo json_encode([
            'confirm' => true,
            'title' => 'Konfirmasi Penghapusan',
            'message' => 'Apakah Anda yakin ingin menghapus data ini?',
            'id_image' => $id_image
        ]);			
    } else {
        $data['image'] = $this->M_Sliderimage->show_data()->result();
        $data['content'] = 'Sliderimage/lihat_sliderimage';
        $this->load->view('template', $data);
    }
}

public function aksi_hapus_image($id_image)
{
    // Panggil model untuk mendapatkan path gambar
    $image = $this->M_Sliderimage->get_image_by_id($id_image);

    // Cek apakah gambar ada
    if (!empty($image)) {
        // Hapus file gambar dari folder uploads
        if (unlink($image['image'])) {
            // Panggil model untuk menghapus data gambar dari database
            $this->M_Sliderimage->delete_data('sliderimage', $id_image);
            
            // Kirim respon JSON berhasil
            echo json_encode(['success' => true]);
            return;
        }
    }

    // Jika gambar tidak ditemukan atau gagal dihapus
    // Kirim respon JSON gagal
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus gambar.']);
}
}