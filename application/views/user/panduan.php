	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav ml-auto">
			<a class="nav-item nav-link" id="nav-home" href="<?= base_url('user'); ?>">beranda</a>
			<a class="nav-item nav-link" id="nav-penilaian" href="<?= base_url('user/penilaian'); ?>">Keputusan</a>
			<div class="nav-item dropdown">
				<button class="btn btn-md dropdown-toggle btn-navbar" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp; <?= $this->session->userdata('username'); ?></button>
				<div class="dropdown-menu">
					<h6 class="dropdown-header">Utilitas</h6>
					<a class="dropdown-item" href="<?= base_url('user/myProfile/' . $this->session->userdata('username')); ?>"><i class="fas fa-user-circle"></i>&nbsp; profil</a>
					<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp; keluar</a>
					<div class="dropdown-divider" style="border-top:1px solid #707070;"></div>
					<h6 class="dropdown-header">Bantuan</h6>
					<a href="<?= base_url('user/panduan'); ?>" class="dropdown-item"><i class="far fa-question-circle"></i>&nbsp; Panduan Sistem</a>
					<a href="<?= base_url('user/tentang'); ?>" class="dropdown-item"><i class="fas fa-info-circle"></i>&nbsp; Tentang</a>
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
					<h1 class="main-title">Panduan</h1>
					<hr class="title-line">
				</div>
				<!-- akhir header title -->

			</div>
			<iframe src="<?= base_url('assets/pdf/2.pdf'); ?>" width="1100" height="700" frameborder="0"></iframe>
			<!-- akhir tempat konten utama  -->
		</div>
	</div>
	<!-- </div> -->
