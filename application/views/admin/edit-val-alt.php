<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav ml-auto">
		<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
		<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
		<a class="nav-item nav-link" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
		<a class="nav-item nav-link" id="nav-ara" href="<?= base_url('admin/ara'); ?>">ara</a>
		<a class="nav-item nav-link  txt-menu garis-biru-menu" id="nav-penilaian" href="<?= base_url('admin/penilaian'); ?>">keputusan</a>
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
				<h1 class="main-title">Ubah Nilai Alternatif Ara</h1>
				<hr class="title-line">
			</div>
			<!-- akhir header title -->
		</div>
		<!-- tempat untuk konten utama -->
		<div class="card bg-main-card">
			<div class="card-header card-header-custom">
				Form <strong>Ubah Nilai</strong> Alternatif
			</div>

			<div class="card-body">
				<form method="POST" action="" class="form-custom">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Kode Alternatif</label>
						<div class="col-sm-10">
							<input type="text" readonly class="form-control-plaintext" name="kd_alt" value="<?= $ara['kode']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Alternatif</label>
						<div class="col-sm-10">
							<input type="text" readonly class="form-control-plaintext" name="nama" value="<?= $ara['nama']; ?>">
						</div>
					</div>

					<!-- UNTUK MENAMPILKAN NAMA DAN KODE KRITERIA -->
					<?php foreach ($criteria->result_array() as $criteria) : ?>


						<?php if ($criteria['kode'] == 'K03') : ?>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"><?= $criteria['nama']; ?></label>
								<div class="col-sm-10">
									<select name="nilai_<?= $criteria['kode']; ?>" class="select-custom custom-select">
										<option value="" class="custom-option" disabled selected>Pilih nilai..</option>
										<option class="custom-option" value="3" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 3) ? 'selected' : null ?>>Banyak</option>
										<option class="custom-option" value="2" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 2) ? 'selected' : null ?>>Sedang</option>
										<option class="custom-option" value="1" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 1) ? 'selected' : null ?>>Sedikit</option>
									</select>
									<!-- <small>
											<?php //echo 'nilai_' . $criteria['kode']; 
											?>
										</small> -->
									<?= form_error('nilai_' . $criteria['kode'], '<small class="text-danger">', '</small>'); ?>
								</div>
							</div>
							<?php //echo $criteria['kode']; 
							?>
							<input type="hidden" name="kd_ktr_<?= $criteria['kode']; ?>" value="<?= $value[$criteria['kode']]['kd_ktr']; ?>">

						<?php elseif ($criteria['kode'] == 'K04') : ?>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"><?= $criteria['nama'] ?></label>
								<div class="col-sm-10">
									<select name="nilai_<?= $criteria['kode']; ?>" class="select-custom custom-select">
										<option value="" class="custom-option" disabled selected>Pilih nilai..</option>
										<option class="custom-option" value="3" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 3) ? 'selected' : null ?>>Pupuk kandang</option>
										<option class="custom-option" value="2" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 2) ? 'selected' : null ?>>Pupuk kompos</option>
										<option class="custom-option" value="1" <?= ($criteria['kode'] == $value[$criteria['kode']]['kd_ktr'] && $value[$criteria['kode']]['nilai'] == 1) ? 'selected' : null ?>>Pupuk organik</option>
									</select>
									<!-- <small>
											<?php //echo 'nilai_' . $criteria['kode']; 
											?>
										</small> -->
									<?= form_error('nilai_' .  $criteria['kode'], '<small class="text-danger">', '</small>'); ?>
								</div>
							</div>
							<?php //echo $criteria['kode']; 
							?>
							<input type="hidden" name="kd_ktr_<?= $criteria['kode']; ?>" value="<?= $value[$criteria['kode']]['kd_ktr']; ?>">

						<?php else : ?>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"><?= $criteria['nama'] ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control input-custom" name="nilai_<?= $criteria['kode']; ?>" autocomplete="off" value="<?= $value[$criteria['kode']]['nilai']; ?>">
									<?= form_error('nilai_' . $criteria['kode'], '<small class="text-danger">', '</small>'); ?>
									<!-- <small>
											<?php //echo 'nilai_' . $criteria['kode']; 
											?>
										</small> -->
								</div>
							</div>
							<?php //echo $criteria['kode']; 
							?>
							<input type="hidden" name="kd_ktr_<?= $criteria['kode']; ?>" value="<?= $criteria['kode']; ?>">
						<?php endif; ?>

					<?php endforeach; ?>
					<div class="form-group mt-4" style="float: right;">
						<button type="submit" class="btn btn-md btn-primary"><i class="far fa-save"></i>&nbsp; Simpan</button>
						<a href="<?= base_url('admin/penilaian'); ?>"><button type="button" class="btn btn-md btn-danger"><i class="fas fa-undo"></i>&nbsp; Batal</button></a>
					</div>
				</form>
			</div>

		</div>
		<!-- akhir tempat konten utama  -->
	</div>
</div>

<!-- </div> -->
