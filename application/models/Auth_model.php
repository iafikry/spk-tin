<?php

class Auth_model extends My_model
{
	
	public function tambahDataUser()
	{
		$data = [
			'id' => NULL,
			'username' => strtolower($this->input->post('username', true)),
			'nama' => $this->input->post('nama', true),
			'password' => $this->input->post('password1'),
			'role_id' => 2
		];
		$this->db->insert('user', $data);
		return $this->db->get_where('user', ['username' => $data['username']])->num_rows();
		//$masuk = $this->db->get_where('user', ['username' => $data['username']])->num_rows();
		//var_dump($masuk); die;
		
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//mengambil satu baris data yang username-nya sesuai dengan username yang diinput
		$user = $this->db->get_where('user', ['username' => $username])->row_array(); 

		//jika ada usernya
		if($user){
			//jika passwordnya sama
			if ($user['password'] == $password){
				//pemberian session
				$data = [
					'username' => $user['username'],
					'nama' => $user['nama'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				return $this->db->get_where('user', ['username' => $username])->num_rows();
			} else{
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Password <strong>salah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
				);
				return $data = 0;
			}
		} else{
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Pengguna <strong>tidak</strong> ditemukan
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
		}
	}
}
