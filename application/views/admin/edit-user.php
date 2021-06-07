		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link txt-menu garis-biru-menu" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
				<a class="nav-item nav-link" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
				<a class="nav-item nav-link" id="nav-ara" href="<?= base_url('admin/ara'); ?>">ara</a>
				<a class="nav-item nav-link" id="nav-penilaian" href="<?= base_url('admin/penilaian'); ?>">keputusan</a>
				<div class="nav-item dropdown">
					<button class="btn btn-md dropdown-toggle btn-navbar btn-outline-secondary" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp; <?= $this->session->userdata('username'); ?></button>
					<div class="dropdown-menu">
						<h6 class="dropdown-header">Utilitas</h6>
						<a class="dropdown-item" href="<?= base_url('admin/myProfile/' . $this->session->userdata('username')); ?>"><i class="fas fa-user-circle"></i>&nbsp; profil</a>
						<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp; keluar</a>
						<div class="dropdown-divider" style="border-top:1px solid #707070;"></div>
						<h6 class="dropdown-header">Bantuan</h6>
						<a href="<?= base_url('admin/panduan'); ?>" class="dropdown-item"><i class="far fa-question-circle"></i>&nbsp; Panduan Sistem</a>
						<a href="<?= base_url('admin/tentang'); ?>" class="dropdown-item"><i class="fas fa-info-circle"></i>&nbsp; Tentang</a>
					</div>
				</div>
			</div>
		</div>
		</div>
		</nav>

		<!-- ==========================================================================
			AKHIR NAVBAR
================================================================================-->

		<!-- <div class="bg-main-frame"> -->
		<div class="container-fluid container-fluid-custom">
			<div class="container cont-main-frame">
				<div class="forAlert"></div>
				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Ubah Pengguna</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>
				<!-- tempat untuk konten utama -->
				<div class="card bg-main-card">
					<div class="card-header card-header-custom">
						Form <strong>Ubah Data</strong> Pengguna
					</div>

					<div class="card-body">

						<form method="POST" action="" class="form-custom">
							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Username</label>
									<input type="text" class="form-control input-custom" id="username" name="username" autocomplete="off" value="<?= $user['username']; ?>" readonly>
									<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Nama</label>
									<input type="text" class="form-control input-custom" id="nama" name="nama" value="<?= $user['nama']; ?>" autocomplete="off">
									<?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group col-md-2">
									<label>Role</label>
									<?php if ($user['username'] == 'superAdmin') : ?>
										<select id="role_id" name="role_id" class="custom-select select-custom" disabled>
											<?php foreach ($role->result_array() as $role) : ?>
												<option value="<?= $role['role_id'] ?>" <?= ($user['role_id'] == $role['role_id']) ? 'selected' : null ?>> <?= $role['deskripsi']; ?> </option>
											<?php endforeach; ?>
										</select>
									<?php else : ?>
										<select id="role_id" name="role_id" class="custom-select select-custom">
											<?php foreach ($role->result_array() as $role) : ?>
												<option value="<?= $role['role_id'] ?>" <?= ($user['role_id'] == $role['role_id']) ? 'selected' : null ?>> <?= $role['deskripsi']; ?> </option>
											<?php endforeach; ?>
										</select>
										<?= form_error('role_id', '<small class="text-danger">', '</small>'); ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="form-group">
								<label>Password 1</label>
								<input type="password" class="form-control input-custom" id="password1" name="password1" value="<?= $user['password']; ?>">
								<?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Password 2</label>
								<input type="password" class="form-control input-custom" id="password2" name="password2" value="<?= $user['password']; ?>">
								<?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group" style="float: right;">
								<button type="submit" class="btn btn-md btn-primary"><i class="far fa-save"></i>&nbsp; Simpan</button>
								<a href="<?= base_url('admin/pengguna'); ?>"><button type="button" class="btn btn-md btn-danger"><i class="fas fa-undo"></i>&nbsp; Batal</button></a>
							</div>
						</form>

					</div>
				</div>
				<!-- akhir tempat konten utama  -->
			</div>
		</div>

		<!-- </div> -->
