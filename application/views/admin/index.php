		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link txt-menu garis-biru-menu" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
				<a class="nav-item nav-link" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
				<a class="nav-item nav-link" id="nav-ara" href="<?= base_url('admin/ara'); ?>">ara</a>
				<a class="nav-item nav-link" id="nav-penilaian" href="<?= base_url('admin/penilaian'); ?>">Keputusan</a>
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

<!-- =============================================================================================================
			AKHIR NAVBAR
================================================================================================================== -->

		<!-- <div class="bg-main-frame"> -->
		<div class="container-fluid container-fluid-custom">
			<div id="carousel-slide-home" class="carousel slide carousel-slide-home" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item" data-interval="20000">
						<img src="<?= base_url('assets/img/bg-green-jr.jpg') ?>" class="d-block w-100" alt="Gambar 1">
						<div class="carousel-caption d-none d-md-block">
							<h1 class="display-4" style="text-transform: uppercase;">Sikupu <span style="font-weight: bold;">Varietas Ara</span></h1>
							<p class="lead">Terdapat <?= $criteria->num_rows(); ?> kriteria yang dipakai pada sistem pendukung keputusan ini yaitu
								<?php $count = 1;
								$total = $criteria->num_rows(); 
								foreach ($criteria->result_array() as $c) :
									$kata = $c['nama'];
									if ($count < ($total - 1)) :
										echo $kata .  ', ';
									elseif ($count == ($total - 1)) :
										echo $kata . ' dan ';
									else :
										echo $kata . '. ';
									endif;
									$count++;
								endforeach; ?>
								Sedangkan alternatif varietas tanaman ara pada sistem ini terdapat <?= $ara->num_rows(); ?> varietas yakni,
								<?php $count = 1;
								$total = $ara->num_rows();
								foreach ($ara->result_array() as $a) :
									$kata = $a['nama'];
									if ($count < ($total - 1)) :
										echo $kata . ', ';
									elseif ($count == ($total - 1)) :
										echo $kata . ' dan ';
									else :
										echo $kata . '.';
									endif;
									$count++;
								endforeach; ?>
							</p>
							<a class="btn btn-primary btn-lg" style="font-size: 16px;" href="<?= base_url('admin/panduan'); ?>" role="button">Pelajari Lebih Lanjut &nbsp; <i class="far fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
					<div class="carousel-item" data-interval="20000">
						<img src="<?= base_url('assets/img/bg-green-jr-2.jpg') ?>" class="d-block w-100" alt="Gambar 2">
						<div class="carousel-caption d-none d-md-block">
							<h1 class="display-4" style="text-transform: uppercase;">Sikupu <span style="font-weight: bold;">Varietas Ara</span></h1>
							<p class="lead">Sistem Pendukung Keputusan merupakan suatu sistem interaktif yang membantu pengambilan keputusan melalui penggunaan data dan model-model keputusan untuk memecahkan masalah yang sifatnya semi-terstruktur. Adapun tahapan proses pengambilan keputusan meliputi tiga fase utama yaitu fase intelegensi, fase desain dan fase pilihan. Kemudian menambahkan fase ke empat yakni implementasi (Turban dkk., 2005).</p>
							<a class="btn btn-primary btn-lg" style="font-size: 16px;" href="<?= base_url('admin/panduan'); ?>" role="button">Pelajari Lebih Lanjut &nbsp; <i class="far fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
					<div class="carousel-item active" data-interval="20000">
						<img src="<?= base_url('assets/img/bg-purple-ara-2.jpg') ?>" class="d-block w-100" alt="Gambar 3">
						<div class="carousel-caption d-none d-md-block">
							<h1 class="display-4" style="text-transform: uppercase;">Sikupu <span style="font-weight: bold;">Varietas Ara</span></h1>
							<p class="lead">Sikupu Varietas Ara merupakan website sistem pendukung keputusan untuk menentukan varietas ara yang tepat untuk ditanam berdasarkan kriteria-kriteria yang telah ditentukan.</p>
							<a class="btn btn-primary btn-lg" style="font-size: 16px;" href="<?= base_url('admin/panduan'); ?>" role="button">Pelajari Lebih Lanjut &nbsp; <i class="far fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carousel-slide-home" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-slide-home" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<div class="container cont-main-frame" id="div-beranda" style="border: none;">
				<!-- tempat untuk menyimpan alert -->
				<div class="main-box">
					<div class="forAlert">
					</div>
				<!-- akhir tempat untuk menyimpan alert -->

					<!-- Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Beranda</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>

				<div class="card bg-main-card" style="border: none;">
					<div class="card-body">
						
						<div class="main-content">
							<p class="txt-dashboard-subtitle">Website ini adalah website sistem pendukung keputusan untuk menentukan varietas tanaman ara dengan <?= $criteria->num_rows(); ?> kriteria sebagai tolak ukur dan <?= $ara->num_rows(); ?> jenis varietas tanaman ara.</p>

							<p class="txt-dashboard">Sistem pendukung keputusan merupakan suatu sistem interaktif yang membantu pengambilan keputusan melalui penggunaan data dan model-model keputusan untuk memecahkan masalah yang sifatnya semi-terstruktur. Adapun tahapan proses pengambilan keputusan meliputi tiga fase utama yaitu intelegensi, desain dan kriteria. Kemudian menambahkan fase ke empat yakni implementasi (Turban dkk., 2005).</p>
						</div>
						
					</div>
				</div>

			</div>

		</div>

		<!-- </div> -->
