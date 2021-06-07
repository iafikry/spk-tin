<?php

class User_model extends My_model
{
	public function checkTotalData()
	{
		$alternatif = $this->db->get('alternatif')->num_rows();
		$kriteria = $this->db->get('kriteria')->num_rows();
		return $jumlah = $alternatif * $kriteria;
	}

	public function hitungWP()
	{
		//inisialisasi waktu awal
		$waktuAwal = microtime(true);

		//NORMALISASI BOBOT

		//ambil kode dan tipe dari kriteria
		// $dataKriteria  = $this->db->select('kode, tipe')->get('kriteria');
		$dataKriteria  = $this->getAllData($table = 'kriteria');

		//hitung total bobot kriteria
		$totalBobot = $this->db->select_sum('bobot')->get('kriteria')->row_array();
		// var_dump($totalBobot); die;

		foreach($dataKriteria->result_array() as $ktr){
			// $bobot = $this->db->select('bobot')->get_where('kriteria', ['kode' => $ktr['kode']])->row_array();
			$bobot = $this->getDataById($table = 'kriteria', $where = ['kode' => $ktr['kode']]);
			$nilaiNormalisasi[$ktr['kode']]['nilai'] = (float)$bobot['bobot'] / (float)$totalBobot['bobot'];
			$nilaiNormalisasi[$ktr['kode']]['kode'] = $ktr['kode'];

		}
		$value['normalisasi'] = $nilaiNormalisasi;
		// var_dump($value); die;
		//AKHIR MENGHITUNG NORMALISASI

		//MENGHITUNG NILAI VEKTOR S
		//mengambil data alternatif
		// $dataAlternatif = $this->db->select('kode, nama')->get('alternatif');
		$dataAlternatif = $this->getAllData($table = 'alternatif');

		foreach ($dataAlternatif->result_array() as $alt) {
			$wadah = 1;
			foreach($dataKriteria->result_array() as $k){
				// $data = $this->db->get_where('penilaian', [
				// 	'kd_alt' => $alt['kode'],
				// 	'kd_ktr' => $k['kode']
				// ])->row_array();
				$data = $this->getDataById('penilaian', [
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
		// var_dump($value['vektor S']); die;
		//AKHIR MENGHITUNG NILAI VEKTOR S

		//MENGHITUNG VEKTOR V

		//hitung nilai total vektor S
		$totalVektorS = 0;
		foreach ($dataAlternatif->result_array() as $a) {
			$totalVektorS += $vektorS[$a['kode']]['nilai'];
		}

		foreach ($dataAlternatif->result_array() as $alternatif) {
			$vektorV[$alternatif['kode']]['nilai'] = $vektorS[$alternatif['kode']]['nilai'] / $totalVektorS;
			$vektorV[$alternatif['kode']]['kode'] = $alternatif['kode'];
		}
		$value['vektor V'] = $vektorV;
		// var_dump($vektorV); die;
		//AKHIR MENGHITUNG VEKTOR V

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
		//ambil tipe dan kode kriteria
		// $dataKriteria = $this->db->select('kode, tipe')->get('kriteria');
		$dataKriteria = $this->getAllData('kriteria');

		//ambil total jumlah bobot
		$totalBobot = $this->db->select_sum('bobot')->get('kriteria')->row_array();

		foreach ($dataKriteria->result_array() as $ktr) {

			//ambil nilai bobot kriteria
			// $bobot = $this->db->select('bobot')->get_where('kriteria', ['kode' => $ktr['kode']])->row_array();
			$bobot = $this->getDataById('kriteria', ['kode' => $ktr['kode']]);


			$nilaiNormalisasi[$ktr['kode']]['nilai'] = (float)$bobot['bobot'] / (float)$totalBobot['bobot'];
			$nilaiNormalisasi[$ktr['kode']]['kode'] = $ktr['kode'];
		}
		$value['normalisasi'] = $nilaiNormalisasi;
		// var_dump($value['normalisasi']); die;
		//BATAS AKHIR NORMALISASI BOBOT

		//MENGHITUNG NILAI UTILITY
		// $dataAlternatif = $this->db->get('alternatif');
		$dataAlternatif = $this->getAllData('alternatif');

		foreach ($dataAlternatif->result_array() as $a) {
			foreach ($dataKriteria->result_array() as $k) {

				//ambil nilai Cout
				// $cout = $this->db->get_where('penilaian', [
				// 	'kd_alt' => $a['kode'],
				// 	'kd_ktr' => $k['kode']
				// ])->row_array();
				$cout = $this->getDataById('penilaian', [ 'kd_alt' => $a['kode'],'kd_ktr' => $k['kode'] ]);

				$cmax = $this->db->select_max('nilai')->get_where('penilaian', ['kd_ktr' => $k['kode']])->row_array();
				$cmin = $this->db->select_min('nilai')->get_where('penilaian', ['kd_ktr' => $k['kode']])->row_array();
				// var_dump($cmin); die;

				// $nilaiUtility[$a['kode']]['nilai' . $k['kode']] = ($k['tipe'] == 'benefit') ? ( (float)$cout['nilai'] - (float)$cmin['nilai'] ) / ( (float)$cmax['nilai'] - (float)$cmin['nilai'] ) : ( (float)$cmax['nilai'] - (float)$cout['nilai'] ) / ( (float)$cmax['nilai'] - (float)$cmin['nilai'] ) ;
				if ($k['tipe'] == 'benefit') {
					$nilaiUtility[$a['kode']]['kode' . $k['kode']] = $k['kode'];
					$nilaiUtility[$a['kode']]['nilai' . $k['kode']] = ( (float)$cout['nilai'] - (float)$cmin['nilai'] ) / ( (float)$cmax['nilai'] - (float)$cmin['nilai'] );
				} else {
					$nilaiUtility[$a['kode']]['kode' . $k['kode']] = $k['kode'];
					$nilaiUtility[$a['kode']]['nilai' . $k['kode']] = ( (float)$cmax['nilai'] - (float)$cout['nilai'] ) / ( (float)$cmax['nilai'] - (float)$cmin['nilai'] );
				}
			}
		}
		$value['nilai utility'] = $nilaiUtility;
		// var_dump($value['nilai utility']); die;
		//AKHIR MENHITUNG NILAI UTILITY

		//MENGHITUNG NILAI AKHIR
		foreach ($dataAlternatif->result_array() as $alter) {
			$temp = 0;
			foreach ($dataKriteria->result_array() as $kriter) {
				$temp += ( $nilaiUtility[$alter['kode']]['nilai' . $kriter['kode']] * $nilaiNormalisasi[$kriter['kode']]['nilai'] );
			}
			$nilaiAkhir[$alter['kode']]['nilai'] = $temp;
			$nilaiAkhir[$alter['kode']]['kode'] = $alter['kode'];
		}
		$value['nilai akhir'] = $nilaiAkhir;
		// var_dump($value['nilai akhir']); die;
		//BATAS MENGHITUNG NILAI AKHIR

		//inisialisasi waktu akhir
		$waktuAkhir = microtime(true);

		//waktu eksekusi script
		$waktuTempuh = $waktuAkhir - $waktuAwal;
		$value['waktu'] = $waktuTempuh;
		// var_dump($value); die;
		return $value;
	}

}
