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
				<!-- tempat untuk menyimpan alert -->
				<div class="forAlert">
					<?= $this->session->flashdata('message'); ?>
				</div>
				<!-- akhir tempat untuk menyimpan alert -->

				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Daftar Kriteria</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>

				<div class="card bg-main-card">
					<div class="card-body">

						<!--tempat untuk menyimpan button tambah data dan search  -->
						<div class="content-inline">
							<!--display:flex -->
							<div class="inline-first">
								<a href="<?= base_url('admin/addCriteria'); ?>"><button type="button" class="btn btn-main-frame btn-md"><i class="fas fa-tag"></i>&nbsp; Tambah kriteria</button></a>
							</div>

							<div class="inline-second">
								<form class="form-inline" action="<?= base_url('admin/searchCriteria'); ?>" method="POST">
									<div class="input-group">
										<div class="input-group-prepend">
											<button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
										</div>
										<input type="text" class="form-control input-search-custom" id="keyword" name="keyword" autocomplete="off" placeholder="Cari berdasarkan nama..">
									</div>
									<!-- <input class="form-control mr-sm-2 input-custom" type="search" placeholder="Search" aria-label="Search">
										<button class="btn btn-main-frame my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Search</button> -->
								</form>
							</div>
						</div>
						<!-- akhir tempat untuk menyimpan button tambah dan search -->
					</div>
				</div>

				<!-- tempat untuk konten utama -->
				<div class="main-content">
					<table class="table">
						<thead class="thead-blue">
							<tr>
								<th class="thead-custom" scope="col">Kode kriteria</th>
								<th class="thead-custom" scope="col">Nama kriteria</th>
								<th class="thead-custom" scope="col">Tipe</th>
								<th class="thead-custom" scope="col">Bobot</th>
								<th class="thead-custom" scope="col">Aksi</>
							</tr>
						</thead>
						<tbody class="tbody-custom">
							<?php if ($criteria->num_rows() > 0) : ?>
								<?php foreach ($criteria->result_array() as $criteria) : ?>
									<tr class="tr-striped">
										<th class="border-custom" scope="row"><?= $criteria['kode']; ?></th>
										<td class="border-custom"><?= $criteria['nama']; ?></td>
										<td class="border-custom"><?= $criteria['tipe']; ?></td>
										<td class="border-custom"><?= $criteria['bobot']; ?></td>
										<td class="border-custom">
											<a href="<?= base_url('admin/editCriteria/' . $criteria['kode']); ?>"><button type="button" class="btn btn-sm btn-success"><i class="fas fa-user-edit"></i>&nbsp; Ubah</button></a>
											<a href="<?= base_url('admin/deleteCriteria/' . $criteria['kode']); ?>"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah data ini akan dihapus?');"><i class="far fa-trash-alt"></i>&nbsp; Hapus</button></a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<tr class="tr-striped">
									<td class="border-custom" colspan="4">
										<center>
											<i class="fas fa-exclamation-triangle" style="font-size: 30px; color:#fc5c65;"></i><br>
											<h3 style="font-style: italic;">Data Tidak Ditemukan!</h3>
										</center>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<!-- akhir tempat konten utama  -->
			</div>
		</div>

		<!-- </div> -->
