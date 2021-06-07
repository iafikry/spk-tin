		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?= base_url('user'); ?>">beranda</a>
				<a class="nav-item nav-link txt-menu garis-biru-menu" id="nav-penilaian" href="<?= base_url('user/penilaian'); ?>">Keputusan</a>
				<div class="nav-item dropdown">
					<button class="btn btn-md dropdown-toggle btn-navbar btn-outline-secondary" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp; <?= $this->session->userdata('username'); ?></button>
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
		</nav>

		<!-- =============================================================================================================
			AKHIR NAVBAR
================================================================================================================== -->

		<!-- <div class="bg-main-frame"> -->
		<div class="container-fluid container-fluid-custom">
			<div class="container cont-main-frame">
				<div class="forAlert"></div>
				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Nilai alternatif ara</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>
				<div class="card bg-main-card">
					<div class="card-body">

						<!--tempat untuk menyimpan button tambah data dan search  -->
						<!--display:flex -->
						<div class="content-inline">

							<div class="inline-first">
								<?php if ($nilai->num_rows() < $TotalData) : ?>
									<!-- disabled button -->
									<a href="<?= base_url('user/calculateWP'); ?>"><button type="button" class="btn btn-main-frame btn-md" style="cursor: not-allowed;" disabled><i class="fas fa-balance-scale"></i>&nbsp; Ambil keputusan metode WP</button></a>
								<?php else : ?>
									<a href="<?= base_url('user/calculateWP'); ?>"><button type="button" class="btn btn-main-frame btn-md"><i class="fas fa-balance-scale"></i>&nbsp; Ambil keputusan metode WP</button></a>
								<?php endif; ?>
							</div>

							<div class="inline-second">
								<?php if ($nilai->num_rows() < $TotalData) : ?>
									<!-- disabled button -->
									<a href="<?= base_url('user/calculateSMART'); ?>"><button type="button" class="btn btn-main-frame btn-md" style="cursor: not-allowed;" disabled><i class="fas fa-balance-scale"></i>&nbsp; Ambil keputusan metode SMART</button></a>
								<?php else : ?>
									<a href="<?= base_url('user/calculateSMART'); ?>"><button type="button" class="btn btn-main-frame btn-md"><i class="fas fa-balance-scale"></i>&nbsp; Ambil keputusan metode SMART</button></a>
								<?php endif; ?>
							</div>

						</div>
						<!-- akhir tempat untuk menyimpan button tambah dan search -->
					</div>
				</div>

				<!-- tempat untuk konten utama -->
				<div class="main-content">

					<div class="card rounded">
						<div class="card-body rounded" style="color: #1e272e;">
							<p class="card-title">Keterangan: </p>
							<!-- <ul class="list-group list-group-horizontal-sm justify-content-center">
									<li class="list-group-item list-custom">Keterangan :</li>
									<?php //foreach ($criteria->result_array() as $c) : 
									?>
										<li class="list-group-item list-custom"><?php //echo $c['kode'] . ' = ' . $c['nama']; 
																				?></li>
									<?php //endforeach; 
									?>
								</ul> -->
							<?php foreach ($criteria->result_array() as $c) : ?>
								<?= $c['kode'] . ' = ' . $c['nama']; ?> &nbsp;
							<?php endforeach; ?>
							<br>
							<small style="color: #424242;">*Keterangan K03: 1 = Sedikit (1 lt - 1.5 lt) &nbsp; | &nbsp; 2 = Sedang (1.5 lt - 2 lt) &nbsp; | &nbsp; 3 = Banyak( > 2 lt)</small>
							<br>
							<small style="color: #424242;">*Keterangan K04: 1 = Organik &nbsp; | &nbsp; 2 = Kompos &nbsp; | &nbsp; 3 = Kandang</small>
						</div>
					</div>

					<table class="table mt-3">
						<thead class="thead-blue">
							<tr>
								<th class="thead-custom" scope="col">Kode alternatif</th>
								<th class="thead-custom" scope="col">Nama alternatif</th>
								<?php foreach ($criteria->result_array() as $ctr) : ?>
									<th class="thead-custom" scope="col"><?= $ctr['kode'] ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody class="tbody-custom">
							<?php if ($ara->num_rows() > 0) : ?>
								<?php foreach ($ara->result_array() as $ara) : ?>
									<tr class="tr-striped">
										<th class="border-custom" scope="row"><?= $ara['kode']; ?></th>
										<td class="border-custom"><?= $ara['nama']; ?></td>

										<?php foreach ($nilai->result_array() as $n) : ?>
											<?php if ($ara['kode'] == $n['kd_alt']) : ?>
												<td class="border-custom"><?= $n['nilai']; ?></td>
											<?php endif; ?>
										<?php endforeach; ?>

									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<tr class="tr-striped">
									<td colspan="4" class="border-custom">
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
