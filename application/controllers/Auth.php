<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$this->load->library('form validation');
class Auth extends CI_Controller
{
public function __construct()
{
parent::__construct();
$this->load->library('form_validation');
$this->load->model('M_auth');
}
public function index()
{
$this->form_validation->set_rules('nama','nama','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
if ($this->form_validation->run('login') == false) {
$this->load->view('auth/login');
} else {
$nama = $this->input->post('nama');
$password = $this->input->post('password');
$user = $this->M_auth->get_user_data($nama);
if ($user) {
if (password_verify($password, $user['password'])) {
$data = [
'nama' => $user['nama'],
'email' => $user['email'],
'role_id' => $user['role_id'],
'id_user' => $user['id_user']
];
$this->session->set_userdata($data);
if ($user['role_id'] == 1) {
echo "halaman admin ";
} elseif($user['role_id'] == 2) {
// echo "halaman Mahasiswa ";
$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center justify-content-start">
		  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
		  <span><strong>Well done!</strong> Successful Login  </span>
		</div><!-- d-flex -->
	  </div><!-- alert -->');
redirect('Dashboard/Dashboard');
}
$this->session->set_userdata($data);
echo 'berhasil login';
} else {
$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
redirect('auth');
}
} else {
$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">nama is not registered!</div>');
redirect('auth');
}
}
}

public function register()
	{
	$this->form_validation->set_rules('nama', 'nama', 'required|trim');
	$this->form_validation->set_rules('email', 'email',
	'required|trim|valid_email|is_unique[account.email]',
	[
	'is_unique' => 'This email has already registered!'
	]
	);
$this->form_validation->set_rules('password', 'password','required|trim|min_length[8]|matches[password]',['matches' => 'Password dont match!','min_length' => 'Password too short!'
]
);

$this->form_validation->set_rules('password','password','required|trim|matches[password]');

	if($this->form_validation->run('register') == false) { //kalau gagal
	$this->load->view('auth/register');
	} else { //kalau berhasil
	$data = [

		'nama' => htmlspecialchars($this->input->post('nama', true)),
		'email' => htmlspecialchars($this->input->post('email', true)),
		'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
		'role_id' =>2
		];
		$this->M_auth->insert_user_data($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created.</div>');
		redirect('auth');
		}
	}

public function logout()
{
$this->session->sess_destroy();
redirect('Auth','refresh');
}
}