		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
				<a class="nav-item nav-link  txt-menu garis-biru-menu" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
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

		<!-- ============================================================================================ 
			AKHIR NAVBAR
================================================================================================= -->

		<!-- <div class="bg-main-frame"> -->
		<div class="container-fluid container-fluid-custom">
			<div class="container cont-main-frame">
				<div class="forAlert"></div>
				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Ubah Kriteria</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>

				<div class="card bg-main-card">
					<div class="card-header card-header-custom">
						Form <strong>Ubah Data</strong> Kriteria
					</div>

					<div class="card-body">
						<form method="POST" action="" class="form-custom">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Kode Kriteria</label>
								<div class="col-sm-10">
									<input type="text" readonly class="form-control-plaintext" id="kode" name="kode" value="<?= $criteria['kode']; ?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nama Kriteria</label>
								<div class="col-sm-10">
									<input type="text" class="form-control input-custom" id="nama" name="nama" autocomplete="off" value="<?= $criteria['nama']; ?>">
									<?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Tipe Kriteria</label>
								<div class="col-sm-10">
									<select class="custom-select select-custom" name="tipe">
										<option disabled selected>Pilih tipe kriteria..</option>
										<option value="benefit" <?= $criteria['tipe'] == 'benefit' ? 'selected' : null ?>>Benefit</option>
										<option value="cost" <?= $criteria['tipe'] == 'cost' ? 'selected' : null ?>>Cost</option>
									</select>
									<?= form_error('tipe', '<small class="text-danger">', '</small>'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Skala Kepentingan Kriteria</label>
								<div class="col-sm-10">
									<select class="custom-select select-custom" name="bobot">
										<option disabled selected>Pilih skala kepentingan..</option>
										<option value="1" <?= $criteria['bobot'] == 1 ? 'selected' : null ?>>Sangat tidak penting</option>
										<option value="2" <?= $criteria['bobot'] == 2 ? 'selected' : null ?>>Tidak penting</option>
										<option value="3" <?= $criteria['bobot'] == 3 ? 'selected' : null ?>>Cukup penting</option>
										<option value="4" <?= $criteria['bobot'] == 4 ? 'selected' : null ?>>Penting</option>
										<option value="5" <?= $criteria['bobot'] == 5 ? 'selected' : null ?>>Sangat penting</option>
									</select>
									<?= form_error('bobot', '<small class="text-danger">', '</small>'); ?>
								</div>
							</div>
							<div class="form-group" style="float: right;">
								<button type="submit" class="btn btn-md btn-primary"><i class="far fa-save"></i>&nbsp; Simpan</button>
								<a href="<?= base_url('admin/criteria'); ?>"><button type="button" class="btn btn-md btn-danger"><i class="fas fa-undo"></i>&nbsp; Batal</button></a>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
