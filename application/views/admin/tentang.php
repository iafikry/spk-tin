		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
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

		<!-- ============================================================================================ 
			AKHIR NAVBAR
================================================================================================= -->

		<!-- <div class="bg-main-frame"> -->
		<div class="container-fluid container-fluid-custom">
			<div class="container cont-main-frame">
				<!-- tempat untuk menyimpan alert -->
				<div class="forAlert">
				</div>
				<!-- akhir tempat untuk menyimpan alert -->

				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Tentang Program</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>

				<div class="tempat-logo">
					<img src="<?= base_url('assets/img/STMIK HD.png'); ?>" width="150" height="150" class="logo-kampus" alt="logo STMIK Kharisma Karawang">
					<h1 class="separator">X</h1>
					<img src="<?= base_url('assets/img/LOGO_AGATHIS-big.png'); ?>" width="200" height="190" class="logo-agathis" alt="logo AGATHIS T-Farm Karawang">
				</div>

				<div class="text-tentang">
					<h4 style="text-transform: capitalize; font-weight: bold; text-align: center;">Aplikasi ini merupakan hasil skripsi mahasiswa SMTIK Kharisma Karawang tahun akademik 2019/2020 </h4>
				</div>

				<hr>

				<div class="biodata" style="font-size: 20px;">
					<div class="card" style="border: none;">
						<div class="card-body">
							<table style="border: none;">
								<tbody>
									<tr>
										<td>Nama</td>
										<td>&nbsp; : &nbsp;</td>
										<td>Ibnu Ahsanul Fikry</td>
									</tr>
									<tr>
										<td>NPM</td>
										<td>&nbsp; : &nbsp;</td>
										<td>43E570172715014</td>
									</tr>
									<tr>
										<td>Prodi</td>
										<td>&nbsp; : &nbsp;</td>
										<td>Sistem Informasi</td>
									</tr>
									<tr>
										<td>Pembimbing I</td>
										<td>&nbsp; : &nbsp;</td>
										<td>Arif Budimansyah Purba, M.Kom.</td>
									</tr>
									<tr>
										<td>Pembimbing II</td>
										<td>&nbsp; : &nbsp;</td>
										<td>Dedih, M.Kom.</td>
									</tr>
									<tr>
										<td>Pembimbing di tempat penelitian</td>
										<td>&nbsp; : &nbsp;</td>
										<td>Dede Abdul Halim</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<hr>

				<div class="thanks">
					<p class="txt-dashboard">Terima kasih kepada Agathis T-Farm Karawang yang telah mengizinkan saya untuk melakukan penelitian di Agathis T-Farm Karawang.</p>
				</div>

			</div>
		</div>
		<!-- </div> -->
