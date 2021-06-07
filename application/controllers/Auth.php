<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
	}
	

	public function index()
	{
		$data['judul'] = 'Login page';
		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
			'required' => 'Nama harus diisi'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', [
			'required' => 'Password harus diisi',
			'min_length' => 'Password minimal berisikan 6 karakter'
		]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-login', $data);
			$this->load->view('auth/login');
			$this->load->view('template/footer-login');
		} else{
			if ($this->Auth_model->login() > 0){
				if ( $this->session->userdata('role_id') == 2 ) {
					redirect('user');
				}else{
					redirect('admin');
				}
			}else{
				redirect('auth');
			}
		}
	}
	
	public function registrasi()
	{
		$data['judul'] = 'Registration page';
		$this->form_validation->set_rules('nama', 'Name', 'required|trim', [
			'required' => 'Nama harus diisi'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Username tersebut telah terdaftar',
			'required' => 'Username harus diisi'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]|min_length[6]|trim', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password minimal 6 karakter',
			'required' => 'Password harus diisi'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]|trim', [
			'required' => 'Password harus diisi'
		]);

		if ($this->form_validation->run() == FALSE ) {
			//jika form_validation nya gagal, maka akan menjalankan script yang ini
			$this->load->view('template/header-login', $data);
			$this->load->view('auth/regis');
			$this->load->view('template/footer-login');
		} else {
			if ($this->Auth_model->tambahDataUser() > 0 ){
				//echo 'masuk brooo';
				$this->session->set_flashdata('message',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Selamat Akun anda <strong>berhasil dibuat</strong>, silakan masuk!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('auth');
			} 
			else{
				echo 'nga masuk :(';
			}
		}
	}

	public function blocked()
	{
		$data['judul'] = "Error Page";
		$this->load->view('template/error-page', $data);
		
		
	}

	public function logout()
	{
		
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Anda <strong>telah berhasil</strong> keluar
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
		);
		redirect('auth');
	}

}
