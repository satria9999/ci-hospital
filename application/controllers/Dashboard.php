<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	$this->load->model('M_Dokter');
	$this->load->model('M_Layanan');
	$this->load->model('M_Ambulance');
	$this->load->model('M_Sliderimage');
	}


	public function Dashboard()
	{
		$data['jumlah_rumahsakit'] = $this->M_Rumahsakit->hitungJumlahrumahsakit();
	
		if ($data['jumlah_rumahsakit'] === false || $data['jumlah_rumahsakit'] === 0) {
			log_message('error', 'Gagal mendapatkan jumlah rumah sakit dari model.');
		}
	
		$data['jumlah_dokter'] = $this->M_Dokter->hitungJumlahdokter();
	
		if ($data['jumlah_dokter'] === false || $data['jumlah_dokter'] === 0) {
			log_message('error', 'Gagal mendapatkan jumlah dokter dari model.');
		}

		$data['poli'] = $this->M_Layanan->hitungJumlahpoli();
	
		if ($data['poli'] === false || $data['poli'] === 0) {
			log_message('error', 'Gagal mendapatkan jumlah POLI dari model.');
		}
		$data['ambulance'] = $this->M_Ambulance->hitungJumlahambulance();
	
		if ($data['ambulance'] === false || $data['ambulance'] === 0) {
			log_message('error', 'Gagal mendapatkan jumlah Ambulance dari model.');
		}
	
		
		// $dataForPieChart = $this->M_penduduk->getDataForPieChart();
		// $data['pieChart'] = $this->load->view('content', ['dataForPieChart' => $dataForPieChart], true);
	
		$data['content'] = 'content';
		$this->load->view('template', $data);
	}
	
	// public function lihat_penduduk()
	// {
	// 	$data['content']='penduduk/lihat_penduduk';
	// 	$this->load->view('template',$data);
	// }
	public function form_rs()
	{
		$data['content']='Data_rs/form_rs';
		$this->load->view('template',$data);
	}

	public function form_dokter()
	{
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['content']='Dokter/form_dokter';
		$this->load->view('template',$data);
	}

	public function form_layanan()
	{
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['content']='Layanan/form_layanan';
		$this->load->view('template',$data);
	}

	public function form_ambulance()
	{
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['content']='Ambulance/form_ambulance';
		$this->load->view('template',$data);
	}

	public function form_sliderimage()
	{
		// $data['image'] = $this->M_Rumahsakit->show_data()->result();
		$data['content']='Sliderimage/form_sliderimage';
		$this->load->view('template',$data);
	}

	public function lihat_rs()
	{
		$data['rumah_sakit'] = $this->M_Rumahsakit->show_data()->result();
		$data['content']='Data_rs/lihat_rs';
		$this->load->view('template',$data);
	}

	public function lihat_dokter()
	{
		$data['dokter'] = $this->M_Dokter->show_data()->result();
		$data['content']='Dokter/lihat_dokter';
		$this->load->view('template',$data);
	}
	public function lihat_sliderimage()
	{
		$data['image'] = $this->M_Sliderimage->show_data()->result();
		$data['content']='Sliderimage/lihat_sliderimage';
		$this->load->view('template',$data);
	}
    public function lihat_layanan()
    {
        // Panggil metode model yang hanya mengambil data layanan 'IGD' dan 'UGD'
        $data['layanan'] = $this->M_Layanan->get_igd_ugd_data()->result();
        // Set view dan data yang akan dikirim ke view
        $data['content'] = 'Layanan/lihat_layanan';
        $this->load->view('template', $data);
    }
	public function lihat_jantung()
    {
        // Panggil metode model yang hanya mengambil data layanan 'Jantung'
        $data['jantung'] = $this->M_Layanan->get_jantung_data()->result();
    
        // Set view dan data yang akan dikirim ke view
        $data['content'] = 'Layanan/lihat_jantung';
        $this->load->view('template', $data);
    }
	public function lihat_ambulance()
	{
		$data['ambulance'] = $this->M_Ambulance->show_data()->result();
		$data['content']='Ambulance/lihat_ambulance';
		$this->load->view('template',$data);
	}
}
