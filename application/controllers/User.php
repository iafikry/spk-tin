<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//cek session
		if (!$this->session->userdata('username')) {
			redirect('auth');
		} elseif ($this->session->userdata('role_id') != 2) {
			redirect('auth/blocked');
		}

		$this->load->model('User_model', 'user_model');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		// echo 'selamat datang user ' . $this->session->userdata('nama') . ', mau ngapain?';
		$data['judul'] = 'Dashboard User Page';
		$data['ara'] = $this->user_model->getAllData('alternatif');
		$data['criteria'] = $this->user_model->getAllData('kriteria');
		$this->load->view('template/header-user', $data);
		$this->load->view('user/index');
		$this->load->view('template/footer-user');
	}

	public function tentang()
	{
		$data['judul'] = 'Tentang Program';
		$this->load->view('template/header-user', $data);
		$this->load->view('user/tentang');
		$this->load->view('template/footer-user');
	}

	public function panduan()
	{
		$data['judul'] = 'Panduan';
		$this->load->view('template/header-user', $data);
		$this->load->view('user/panduan');
		$this->load->view('template/footer-user');
	}


	public function myProfile($username)
	{
		$data['judul'] = 'Edit Profil';
		$data['user'] = $this->user_model->getDataById($table = 'user', $where = ['username' => $username]);
		$data['role'] = $this->user_model->getAllData($table = 'user_role');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
			'required' => 'Nama harus diisi'
		]);
		$this->form_validation->set_rules('password1', 'Password 1', 'trim|required|min_length[6]|matches[password2]', [
			'required' => 'Password 1 harus diisi',
			'min_length' => 'Password minimal berisikan 6 karakter',
			'matches' => 'Password tidak sama'
		]);
		$this->form_validation->set_rules('password2', 'Password 2', 'trim|required|min_length[6]', [
			'required' => 'Password harus diisi',
			'min_length' => 'Password minimal berisikan 6 karakter'
		]);
		$this->form_validation->set_rules('role_id', 'Role Id', 'required', [
			'required' => 'Role harus dipilih'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-user', $data);
			$this->load->view('user/myprofil', $data);
			$this->load->view('template/footer-user');
		} else {
			$this->user_model->updateData($table = 'user', $data = [
				'nama' => $this->input->post('nama', true),
				'password' => $this->input->post('password1'),
				'role_id' => $this->input->post('role_id')
			], $where = ['username' => $username]);

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data pengguna <strong>berhasil diperbarui</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('user');
		}
	}

	public function penilaian()
	{
		$data['judul'] = 'Penilaian';
		$data['criteria'] = $this->user_model->getAllData($table = 'kriteria');
		$data['ara'] = $this->user_model->getAllData($table = 'alternatif');
		$data['TotalData'] = $this->user_model->checkTotalData();
		$data['nilai'] = $this->user_model->getAllData($table = 'penilaian');
		// var_dump($data['nilai']->result_array()); die;
		$this->load->view('template/header-user', $data);
		$this->load->view('user/user-penilaian', $data);
		$this->load->view('template/footer-user');
	}

	public function calculateWP()
	{
		$data['judul'] = 'Hasil Keputusan WP';
		$data['ara'] = $this->user_model->getAllData($table = 'alternatif');
		$data['criteria'] = $this->user_model->getAllData($table = 'kriteria');
		$data['hasil'] = $this->user_model->hitungWP();
		rsort($data['hasil']['vektor V']);
		$data['keputusan'] = $this->user_model->getDataById($table = 'alternatif', $where = ['kode' => $data['hasil']['vektor V'][0]['kode']]);
		// var_dump($data['hasil']); die;
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Selamat! keputusan 	<strong>berhasil dibuat</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		$this->load->view('template/header-user', $data);
		$this->load->view('user/user-hasil-wp', $data);
		$this->load->view('template/footer-user');
		
	}
	
	public function calculateSMART()
	{
		$data['judul'] = 'Hasil Keputusan SMART';
		$data['ara'] = $this->user_model->getAllData($table = 'alternatif');
		$data['criteria'] = $this->user_model->getAllData($table = 'kriteria');
		$data['hasil'] = $this->user_model->hitungSMART();
		rsort($data['hasil']['nilai akhir']);
		$data['keputusan'] = $this->user_model->getDataById('alternatif', ['kode' => $data['hasil']['nilai akhir'][0]['kode']]);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Selamat! keputusan 	<strong>berhasil dibuat</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
			</div>');
		$this->load->view('template/header-user', $data);
		$this->load->view('user/user-hasil-smart', $data);
		$this->load->view('template/footer-user');
	}

}
