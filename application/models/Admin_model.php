<?php

class Admin_model extends My_model
{
	public function getAllUsers()
	{
		// $this->db->select('user.username, user.nama, user_role.deskripsi')->from('user')->join('user_role', 'user.role_id = user_role.role_id');
		// return $query = $this->db->get()->result_array();
		// $this->db->order_by('id', 'desc');
		return $this->db->query('SELECT us.username, us.nama, ur.deskripsi FROM user us, user_role ur WHERE us.role_id = ur.role_id ORDER BY us.id DESC');
	}

	public function delUserByUname($username)
	{
		if ($username == 'superAdmin') {
			return 1;  //superAdmin tidak dapat dihapus
		} elseif ($username == $this->session->userdata('username')) {
			return 1;
		} else {
			$this->db->delete('user', ['username' => $username]); //DELETE FROM user WHERE username = username
			return $this->db->get_where('user', ['username' => $username])->num_rows();
		}
	}

	public function searchUserData()
	{
		$nama = $this->input->post('keyword', true);
		$this->db->select('us.username, us.nama, ur.deskripsi');
		$this->db->from('user us, user_role ur');
		$this->db->like('us.nama', $nama);
		$this->db->where('us.role_id = ur.role_id');
		return $this->db->get();
		//SELECT us.username, us.nama, ur.deskripsi FROM user us, user_role ur WHERE us.nama LIKE '%nama%' AND us.role_id = ur.role_id
		//return $this->db->select('us.username, us.nama, ur.deskripsi')->from('user us')->join('user_role ur', 'us.role_id = ur.role_id')->like('us.nama', $nama)->get();
	}

	public function getCriteriaCode()
	{
		$kode = $this->db->select_max('kode')->get('kriteria')->row_array();
		if (is_null($kode['kode'])) {
			$kdKriteria = "K" . "01";
		} else {
			$id = substr($kode['kode'], 1);
			$nilai = (int) $id;
			$nilai += 1;
			$kdKriteria = "K" . str_pad($nilai, 2, "0", STR_PAD_LEFT);
		}
		return $kdKriteria;
	}

	public function searchDataCriteria()
	{
		$nama = $this->input->post('keyword', true);
		$this->db->like('nama', $nama);
		return $this->db->get('kriteria');
		//SELECT * FROM kriteria WHERE nama LIKE %nama%
	}


	public function getAraCode()
	{
		$kode = $this->db->select_max('kode')->get('alternatif')->row_array();
		if (is_null($kode['kode'])) {
			$kdAra = "A". "01";
		} else {
			$id = substr($kode['kode'], 1);
			$nilai = (int) $id;
			$nilai += 1;
			$kdAra = "A" . str_pad($nilai, 2, "0", STR_PAD_LEFT);
		}
		// var_dump($kdAra); die;
		return $kdAra;
		
	}


	public function searchDataAra()
	{
		$nama = $this->input->post('keyword', true);
		$this->db->like('nama', $nama);
		return $this->db->get('alternatif');
	}
	
	public function addValueAlternative()
	{
		$this->db->select('kode');
		$data['kriteria'] = $this->db->get('kriteria')->result_array();
		// var_dump($data['kriteria']); die;
		foreach ($data['kriteria'] as $kriteria  ) {
			$data = [
				'id' => '',
				'kd_alt' => $this->input->post('kd_alt', true),
				'kd_ktr' => $this->input->post('kd_ktr_' . $kriteria['kode'], true),
				'nilai' => $this->input->post('nilai_' . $kriteria['kode'], true)
			];
			$this->db->insert('penilaian', $data);
		}
	}

	public function checkValueAlt()
	{
		$this->db->select('kode');
		$data['kode'] = $this->db->get('alternatif')->result_array();
		// var_dump($data['kode']); die;
		foreach ($data['kode'] as $alternatif) {
			$cekKd[$alternatif['kode']] = $this->db->get_where('penilaian', ['kd_alt' => $alternatif['kode']])->num_rows();
		}
		return $cekKd;
		// var_dump($cekKd); die;
	}

	public function checkData()
	{
		$alternatif = $this->db->get('alternatif')->num_rows();
		$kriteria = $this->db->get('kriteria')->num_rows();
		return $totalData = $alternatif * $kriteria;
		// var_dump($totalData); die; 
	}

	public function getValueAltByCode($kode)
	{
		$this->db->select('kd_ktr');
		$data['kd_ktr'] = $this->db->get_where('penilaian', ['kd_alt' => $kode])->result_array();
		foreach ($data['kd_ktr'] as $data) {
			$this->db->select('kd_alt, kd_ktr, nilai');
			$array = [
				'kd_alt' => $kode,
				'kd_ktr' => $data['kd_ktr']
			];
			$this->db->where($array);
			$nilai[$data['kd_ktr']] = $this->db->get('penilaian')->row_array();
		}
		return $nilai;
	}

	public function updateValueAlt($kode)
	{
		$this->db->select('kd_ktr');
		$kriteria['kode'] = $this->db->get_where('penilaian', ['kd_alt' => $kode])->result_array();
		foreach ($kriteria['kode'] as $kriteria) {
			$data = [
				'nilai' => $this->input->post('nilai_' . $kriteria['kd_ktr'], true)
			];
			
			$this->db->update('penilaian', $data, [
				'kd_alt' => $kode, 
				'kd_ktr' => $kriteria['kd_ktr']
			]);
		}
	}

	public function hitungWP()
	{

		//inisialisasi waktu awal
		$waktuAwal = microtime(true);

		//NORMALISASI BOBOT

		//ambil kode dan tipe dari kriteria
		$dataKriteria = $this->getAllData($table = 'kriteria');

		//hitung total bobot kriteria
		$totalBobot = $this->db->select_sum('bobot')->get('kriteria')->row_array();
		//var_dump($totalBobot); die;

		foreach ($dataKriteria->result_array() as $ktr) {
			//ambil nilai bobot dari masing-masing kriteria
			$bobot = $this->getDataById($table = 'kriteria', $where = ['kode' => $ktr['kode']]);
			
			$nilaiNormalisasi[$ktr['kode']] ['nilai'] = (float)$bobot['bobot']/(float)$totalBobot['bobot'];
			$nilaiNormalisasi[$ktr['kode']] ['kode'] = $ktr['kode'];
		}
		$value['normalisasi'] = $nilaiNormalisasi;
		// var_dump($value); die;
		//AKHIR PROSES NORMALISASI

		//MENGHITUNG NILAI VEKTOR S
		//ambil data alternatif
		$dataAlternatif = $this->getAllData($table = 'alternatif');

		foreach($dataAlternatif->result_array() as $alt){
			$wadah = 1;
			foreach($dataKriteria->result_array() as $k){
				//ambil nilai alternatif dari setiap kriteria
				$data = $this->getDataById($table = 'penilaian', [
					'kd_alt' => $alt['kode'],
					'kd_ktr' => $k['kode']
				]);

				if ($k['tipe'] == 'benefit') {
					$wadah *= (float)$data['nilai'] ** $nilaiNormalisasi[$k['kode']]['nilai']; // tanda ** artinya pangkat, 2**3 = 2^3
				} else {
					$wadah *= (float)$data['nilai'] ** -$nilaiNormalisasi[$k['kode']]['nilai'];
				}
			}
			$vektorS[$alt['kode']]['nilai'] = $wadah;
			$vektorS[$alt['kode']]['kode'] = $alt['kode'];
		}
		$value['vektor S'] = $vektorS;
		// var_dump($value); die;
		//AKHIR PROSES HITUNG NILAI VEKTOR S

		//MENGHITUNG NILAI VEKTOR V

		//hitung nilai total vektor S
		$totalVektorS = 0;
		foreach($dataAlternatif->result_array() as $a){
			$totalVektorS += $vektorS[$a['kode']]['nilai'];
		}

		foreach($dataAlternatif->result_array() as $alternatif){
			$vektorV[$alternatif['kode']]['nilai'] = $vektorS[$alternatif['kode']]['nilai'] / $totalVektorS;
			$vektorV[$alternatif['kode']]['kode'] = $alternatif['kode'];
		}
		$value['vektor V'] = $vektorV;
		// var_dump($value); die;
		//AKHIR PROSES MENGHITUNG NILAI VEKTOR V

		//inisialisasi waktu akhir
		$waktuAkhir = microtime(true);

		//waktu eksekusi script
		$waktuTempuh = $waktuAkhir - $waktuAwal;
		$value['waktu'] = $waktuTempuh;
		// var_dump($value); die;
		return $value;
	}

	public function hitungSMART() 
	{
		//inisialisasi waktu awal
		$waktuAwal = microtime(true);

		//NORMALISASI BOBOT
		//ambil data kriteria
		$dataKriteria = $this->getAllData($table = 'kriteria');

		//ambil total bobot kriteria
		$totalBobot = $this->db->select_sum('bobot')->get('kriteria')->row_array();

		foreach($dataKriteria->result_array() as $ktr){
			//ambil nilai bobot dari setiap kriteria
			$bobot = $this->getDataById($table = 'kriteria', ['kode' => $ktr['kode']]);
			$nilaiNormalisasi[$ktr['kode']]['nilai'] = (float)$bobot['bobot'] / (float)$totalBobot['bobot'];
			$nilaiNormalisasi[$ktr['kode']]['kode'] = $ktr['kode'];
		}
		$value['normalisasi'] = $nilaiNormalisasi;
		// var_dump($value); die;
		//AKHIR PROSES HITUNG NORMALISASI

		//MENGHITUNG NILAI UTILITY
		//ambil data alternatif
		$dataAlternatif = $this->getAllData('alternatif');

		foreach ($dataAlternatif->result_array() as $a) {
			foreach($dataKriteria->result_array() as $k){
				//ambil nilai cout
				$cout = $this->getDataById('penilaian', [
					'kd_alt' => $a['kode'],
					'kd_ktr' => $k['kode']
				]);

				//ambil nilai cmax
				$cmax = $this->db->select_max('nilai')->get_where('penilaian', ['kd_ktr' => $k['kode']])->row_array();
				//ambil nilai cmin
				$cmin= $this->db->select_min('nilai')->get_where('penilaian', ['kd_ktr' => $k['kode']])->row_array();

				if ($k['tipe'] == 'benefit') {
					$nilaiUtility[$a['kode']]['kode' . $k['kode']] = $k['kode'];
					$nilaiUtility[$a['kode']]['nilai'. $k['kode']] = ( (float)$cout['nilai'] - (float)$cmin['nilai'] ) / ( (float)$cmax['nilai'] - (float)$cmin['nilai'] );
				} else {
					$nilaiUtility[$a['kode']]['kode' . $k['kode']] = $k['kode'];
					$nilaiUtility[$a['kode']]['nilai'. $k['kode']] = ( (float)$cmax['nilai'] - (float)$cout['nilai'] ) / ( (float)$cmax['nilai'] - $cmin['nilai'] );
				}
				
			}
		}
		$value['nilai utility'] = $nilaiUtility;
		// var_dump($value); die;
		//AKHIR PROSES MENGHITUNG NILAI UTILITY

		//MENGHITUNG NILAI AKHIR
		foreach ($dataAlternatif->result_array() as $alter) {
			$temp = 0;
			foreach ($dataKriteria->result_array() as $kriter) {
				$temp += ($nilaiUtility[$alter['kode']]['nilai'.$kriter['kode']] * $nilaiNormalisasi[$kriter['kode']]['nilai']);
			}
			$nilaiAkhir[$alter['kode']]['nilai'] = $temp;
			$nilaiAkhir[$alter['kode']]['kode'] = $alter['kode'];
		}
		$value['nilai akhir'] = $nilaiAkhir;
		// var_dump($value); die;
		//AKHIR PROSES HITUNG NILAI AKHIR

		//Inisialisasi waktu akhir
		$waktuAkhir = microtime(true);

		//waktu eksekusi sccript
		$waktuTempuh = $waktuAkhir - $waktuAwal;
		$value['waktu'] = $waktuTempuh;
		return $value;
	}



}
