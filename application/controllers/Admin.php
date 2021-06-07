<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model'); 
		$this->load->library('form_validation');

		//cek session
		if(!$this->session->userdata('username'))
		{
			redirect('auth');
		}
		elseif($this->session->userdata('role_id') != 1)
		{
			redirect('auth/blocked');
		}

	}
	
	public function index()
	{
		$data['judul'] = 'Beranda';
		$data['ara'] = $this->Admin_model->getAllData('alternatif');
		$data['criteria'] = $this->Admin_model->getAllData('kriteria');
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer-admin');
	}

	public function tentang()
	{
		$data['judul'] = 'Tentang Program';
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/tentang');
		$this->load->view('template/footer-admin');
	}

	public function panduan()
	{
		$data['judul'] = 'Panduan';
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/panduan');
		$this->load->view('template/footer-admin');
		
	}

	public function myProfile($username)
	{
		$data['judul'] = 'Profil';
		$data['user'] = $this->Admin_model->getDataById($table = 'user', $where = ['username' => $username]);
		$data['role'] = $this->Admin_model->getAllData($table = 'user_role');

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
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/my-profil', $data);
			$this->load->view('template/footer-admin');
		} else {
			$this->Admin_model->updateData($table = 'user', $data = [
				'nama' => $this->input->post('nama', true), 
				'password' => $this->input->post('password1'), 
				'role_id' => $this->input->post('role_id')
			], $where = ['username' => $username]);

			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data pengguna <strong>berhasil diperbarui</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/pengguna');
		}
	}

	public function pengguna()
	{
		$data['judul'] = 'Pengguna';
		$data['users'] = $this->Admin_model->getAllUsers();
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/users-list', $data);
		$this->load->view('template/footer-admin');
	}

	public function addUser()
	{
		$data['judul'] = 'Tambah Pengguna';
		$data['judulForm'] = 'Form tambah pengguna';
		// var_dump($data); die;
		$data['role'] = $this->Admin_model->getAllData($table = 'user_role');
		// var_dump($data['role']); die;
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', [
			'required' => 'Username harus diisi',
			'is_unique' => 'Username tersebut telah digunakan'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
			'required' => 'Nama harus diisi'
		]);
		$this->form_validation->set_rules('role_id', 'Role', 'required', [
			'required' => 'Role harus dipilih'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]|min_length[6]', [
			'required' => 'Password harus diisi',
			'matches' => 'Password tidak sama',
			'min_length' => 'Password minimal berisikan 6 karakter'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required', [
			'required' => 'Password harus diisi'
		]);
		

		if ( $this->form_validation->run() == FALSE ) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/add-user', $data);
			$this->load->view('template/footer-admin');
		} else {
			$this->Admin_model->insertData($table = 'user', $data = [
				'id' => NULL,
				'username' => strtolower($this->input->post('username', true)), 
				'nama' => $this->input->post('nama', true),
				'password' => $this->input->post('password1'),
				'role_id' => $this->input->post('role_id')
			]);
			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Pengguna baru <strong>berhasil dibuat</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/pengguna'); //pindah ke controller 'Admin', method 'pengguna'
		}
		
	}

	public function editUser($username)
	{
		$data['judul'] = 'Ubah Profil';
		$data['role'] = $this->Admin_model->getAllData($table = 'user_role');
		$data['user'] = $this->Admin_model->getDataById($table='user', $where = ['username' => $username]);

		//set rules buat form validation
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
			'required' => 'Nama harus diisi'
		]);
		$this->form_validation->set_rules('role_id', 'Role', 'trim|required', [
			'required' => 'Role harus dipilih'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', [
			'required' => 'Password harus diisi',
			'min_length' => 'Password berisikan minimal 6 karakter',
			'matches' => 'Password harus sama'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[6]', [
			'required' => 'Password harus diisi',
			'min_length' => 'Password berisikan minimal 6 karakter'
		]);
		
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/edit-user', $data);
			$this->load->view('template/footer-admin');
			
		} else {
			$this->Admin_model->updateData($table = 'user', $data = [
				'nama' => $this->input->post('nama', true),
				'password' => $this->input->post('password1'),
				'role_id' => $this->input->post('role_id')
			], $where = ['username' => $username]);
			$this->session->set_flashdata( 'message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data pengguna <strong>berhasil diperbarui</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/pengguna');
		}
		

		
	}

	public function deleteUser($username)
	{
		if ( $this->Admin_model->delUserByUname($username) > 0 ) {
			//data gagal dihapus
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Data <strong>tidak dapat dihapus</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
			);
		} else {
			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data pengguna <strong>berhasil dihapus</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
			);	
		}
		
		redirect('admin/pengguna');
	}

	public function searchUser()
	{
		$data['judul'] = 'User Page';
		$data['users'] = $this->Admin_model->searchUserData();
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/users-list', $data);
		$this->load->view('template/footer-admin');
	}

	public function criteria()
	{
		$data['judul'] = 'Kriteria';
		$data['criteria'] = $this->Admin_model->getAllData($table = 'kriteria');
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/criteria-lists', $data);
		$this->load->view('template/footer-admin', $data);
		
	}

	public function addCriteria()
	{
		$data['judul'] = 'Tambah Kriteria';
		$data['kode'] = $this->Admin_model->getCriteriaCode();

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[20]', [
			'required' => 'Nama kriteria harus diisi',
			'max_length' => 'Maksimal 20 karakter'
		]);
		$this->form_validation->set_rules('bobot', 'Bobot', 'required', [
			'required' => 'Pilih skala kepentingan'
		]);

		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required', [
			'required' => 'Pilih tipe kriteria'
		]);
		
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/add-criteria', $data);
			$this->load->view('template/footer-admin');

		} else {
			$this->Admin_model->insertData($table = 'kriteria', [
				'kode' => $this->input->post('kode'),
				'nama' => $this->input->post('nama', true),
				'tipe' => $this->input->post('tipe'),
				'bobot' => $this->input->post('bobot')
			]);

			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Kriteria baru <strong>berhasil dibuat</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/criteria');
		}
		
		
	}

	public function editCriteria($kode)
	{
		$data['judul'] = 'Ubah Kriteria';
		$data['criteria'] = $this->Admin_model->getDataById($table = 'kriteria', $where = ['kode' =>$kode]);

		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[20]', [
			'required' => 'Nama kriteria harus diisi',
			'max_length' => 'Maksimal 20 karakter'
		]);
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required', [
			'required' => 'Pilih skala kepentingan'
		]);
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required', [
			'required' => 'Pilih tipe kriteria'
		]);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/edit-criteria', $data);
			$this->load->view('template/footer-admin');

		} else {
			$this->Admin_model->updateData($table = 'kriteria', $data = [
				'nama' => $this->input->post('nama', true),
				'tipe' => $this->input->post('tipe'),
				'bobot' => $this->input->post('bobot')
			], $where = ['kode' => $kode]);

			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data kriteria <strong>berhasil diperbarui</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
			redirect('admin/criteria');
		}
		
	}

	public function deleteCriteria($kode)
	{
		$this->Admin_model->deleteData($table = 'kriteria', $where = ['kode' => $kode]);
		$this->session->set_flashdata('message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data kriteria <strong>berhasil dihapus</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>');
		redirect('admin/criteria');
	}

	public function searchCriteria()
	{
		$data['judul'] = 'Criteria List';
		$data['criteria'] = $this->Admin_model->searchDataCriteria();
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/criteria-lists', $data);
		$this->load->view('template/footer-admin');
		
	}

	public function ara()
	{
		$data['judul'] = 'Varietas Ara';
		$data['ara'] = $this->Admin_model->getAllData($table = 'alternatif');
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/ara-list', $data);
		$this->load->view('template/footer-admin');
		
	}

	public function addAra()
	{
		$data['judul'] = 'Tambah Ara';
		$data['kode'] = $this->Admin_model->getAraCode();

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[25]', [
			'required' => 'Nama ara harus diisi',
			'max_length' => 'Maksimal 25 karakter'
		]);
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/add-ara', $data);
			$this->load->view('template/footer-admin');
			
		} else {
			$this->Admin_model->insertData($table = 'alternatif', $data = [
				'kode' => $this->input->post('kode'),
				'nama' => $this->input->post('nama', true)
			]);
			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Alternatif baru <strong>berhasil dibuat</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/ara');
		}
		
	}

	public function editAra($kode)
	{
		$data['judul'] = 'Ubah Ara';
		$data['ara'] = $this->Admin_model->getDataById($table='alternatif', $where = ['kode' => $kode]);

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[25]', [
			'required' => 'Nama alternatif harus diisi',
			'max_length' => 'Maksimal 25 karakter'
		]);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/edit-ara', $data);
			$this->load->view('template/footer-admin');
			
		} else {
			$this->Admin_model->updateData($table = 'alternatif', $data = ['nama' => $this->input->post('nama', true)], $where = ['kode' =>$kode]);
			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data alternatif <strong>berhasil diperbarui</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('admin/ara');
		}
		
	}

	public function deleteAra($kode)
	{
		$this->Admin_model->deleteData($table = 'alternatif', $where = ['kode' => $kode]);
		$this->session->set_flashdata('message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data alternatif <strong>berhasil dihapus</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('admin/ara');
	}

	public function searchAra()
	{
		$data['judul'] = 'Ara List';
		$data['ara'] = $this->Admin_model->searchDataAra();
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/ara-list', $data);
		$this->load->view('template/footer-admin');
		
	}

	public function penilaian()
	{
		$data['judul'] = 'Penilaian';
		$data['ara'] = $this->Admin_model->getAllData($table = 'alternatif');
		$data['cekNilai'] = $this->Admin_model->checkValueAlt();
		$data['cekData'] = $this->Admin_model->checkData();
		$data['jumlahData'] = $this->Admin_model->getAllData($table = 'penilaian');
		// var_dump($data); die;
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/penilaian', $data);
		$this->load->view('template/footer-admin');
		
	}

	public function addValueAlt($kode)
	{
		$data['judul'] = 'Tambah Nilai';
		$data['ara'] = $this->Admin_model->getDataById($table = 'alternatif', $where = ['kode' => $kode]);
		$data['criteria'] = $this->Admin_model->getAllData($table = 'kriteria');
		$jml_kriteria = $data['criteria']->num_rows();
		for($count=1 ; $count <= $jml_kriteria; $count++){

			$this->form_validation->set_rules('nilai_K0' . $count, 'Nilai', 'trim|required|numeric', [
				'required' => 'Field ini harus diisi',
				'numeric' => 'Field ini harus diisi angka'
			]);
		}
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('template/header-admin', $data);
				$this->load->view('admin/add-val-alt', $data);
				$this->load->view('template/footer-admin');
				
			} else {
				$this->Admin_model->addValueAlternative();
				$this->session->set_flashdata('message',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Nilai alternatif <strong>berhasil dimasukan</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('admin/penilaian');
			}
	}

	public function editValueAlt($kode)
	{
		$data['judul'] = 'Ubah Nilai';
		$data['ara'] = $this->Admin_model->getDataById($table = 'alternatif', $where = ['kode' => $kode]);
		$data['criteria'] = $this->Admin_model->getAllData($table='kriteria');
		$data['value'] = $this->Admin_model->getValueAltByCode($kode);
		
		$jml_kriteria = $data['criteria']->num_rows();
		for ($i=1; $i <= $jml_kriteria ; $i++) { 
			$this->form_validation->set_rules('nilai_K0' . $i, 'Nilai', 'trim|required|numeric', [
				'required' => 'Field ini harus diisi',
				'numeric' => 'Field ini harus berisikan angka'
			]);
		}
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header-admin', $data);
			$this->load->view('admin/edit-val-alt', $data);
			$this->load->view('template/footer-admin');
			
		} else {
			$this->Admin_model->updateValueAlt($kode);
			$this->session->set_flashdata('message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Nilai alternatif <strong>berhasil diperbarui</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
			);
			redirect('admin/penilaian');
			
		}
	}

	public function deleteValueAlt($kode)
	{
		$this->Admin_model->deleteData($table = 'penilaian', $where = ['kd_alt' => $kode]);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data nilai alternatif <strong>berhasil dihapus</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('admin/penilaian');
	}

	public function calculateWP(){
		$data['judul'] = 'Hasil Keputusan WP';
		$data['hasil'] = $this->Admin_model->hitungWP();
		rsort($data['hasil']['vektor V']);
		$data['keputusan'] = $this->Admin_model->getDataById($table = 'alternatif', $where = [ 'kode' => $data['hasil']['vektor V'][0]['kode'] ]);
		$data['ara'] = $this->Admin_model->getAllData($table = 'alternatif');
		$data['criteria'] = $this->Admin_model->getAllData($table = 'kriteria');
		$this->session->set_flashdata(
			'decision',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Selamat! keputusan 	<strong>berhasil dibuat</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/hasil-wp', $data);
		$this->load->view('template/footer-admin');
		
	}

	public function calculateSMART(){
		$data['judul'] = 'Hasil Keputusan SMART';
		$data['hasil'] = $this->Admin_model->hitungSMART();
		rsort($data['hasil']['nilai akhir']);
		// var_dump($data['hasil']); die;
		$data['keputusan'] = $this->Admin_model->getDataById('alternatif', ['kode' => $data['hasil']['nilai akhir'][0]['kode']]);
		$data['ara'] = $this->Admin_model->getAllData('alternatif');
		$data['criteria'] = $this->Admin_model->getAllData('kriteria');
		$this->session->set_flashdata(
			'decision',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Selamat! keputusan 	<strong>berhasil dibuat</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		$this->load->view('template/header-admin', $data);
		$this->load->view('admin/hasil-smart', $data);
		$this->load->view('template/footer-admin');
	}

	// public function assessment()
	// {
	// 	$data['judul'] = 'Hasil Keputusan';
	// 	$data['hasil'] = $this->Admin_model->takeDecision();
	// 	$data['criteria'] = $this->Admin_model->getAllData($table = 'kriteria');
	// 	$data['ara'] = $this->Admin_model->getAllData($table = 'alternatif');
	// 	// var_dump($data['hasil']); die;
	// 	$this->session->set_flashdata('keputusan',
	// 		'<div class="alert alert-success alert-dismissible fade show" role="alert">
	// 					Selamat! keputusan 	<strong>berhasil dibuat</strong>
	// 					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 						<span aria-hidden="true">&times;</span>
	// 					</button>
	// 				</div>'
	// 	);
	// 	$this->load->view('template/header-admin', $data);
	// 	$this->load->view('admin/hasil-keputusan', $data);
	// 	$this->load->view('template/footer-admin');
	// }

}
