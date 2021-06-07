		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
				<a class="nav-item nav-link" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
				<a class="nav-item nav-link" id="nav-ara" href="<?= base_url('admin/ara'); ?>">ara</a>
				<a class="nav-item nav-link txt-menu garis-biru-menu" id="nav-penilaian" href="<?= base_url('admin/penilaian'); ?>">keputusan</a>
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
			<!-- tempat untuk konten utama -->
			<div class="container cont-main-frame">
				<!-- tempat untuk menyimpan alert -->
				<div class="forAlert">
					<?= $this->session->flashdata('decision'); ?>
				</div>
				<!-- akhir tempat untuk menyimpan alert -->

				<div class="main-box">
					<!--Tempat untuk title  -->
					<div class="header-title">
						<h1 class="main-title">Hasil Keputusan oleh <p style="text-transform: uppercase; display:inline;">WP</p>
						</h1>
						<hr class="title-line">
					</div>
					<!-- akhir header title -->
				</div>

				<div class="accordion" id="accordionExample">
					<div class="card bg-main-card">
						<div class="card-header card-header-custom" id="headingOne">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<strong>Hasil Normalisasi</strong> Bobot Kriteria
								</button>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								<table class="table">
									<thead class="thead-blue">
										<tr>
											<th class="thead-custom" scope="col">Kode</th>
											<th class="thead-custom" scope="col">Kriteria</th>
											<th class="thead-custom" scope="col">Bobot</th>
											<th class="thead-custom" scope="col">Normalisasi</th>
										</tr>
									</thead>
									<tbody class="tbody-custom">
										<?php if ($criteria->num_rows() > 0) : ?>
											<?php $count = 1; ?>
											<?php foreach ($criteria->result_array() as $cr) : ?>
												<tr class="tr-striped">
													<th class="border-custom" scope="row"><?= $cr['kode']; ?></th>
													<td class="border-custom"><?= $cr['nama']; ?></td>
													<td class="border-custom"><?= $cr['bobot']; ?></td>

													<?php if ($cr['kode'] == $hasil['normalisasi'][$cr['kode']]['kode']) : ?>
														<td class="border-custom"><?= $hasil['normalisasi'][$cr['kode']]['nilai']; ?></td>
													<?php endif; ?>

												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr class="tr-striped">
												<td class="border-custom" colspan="4">
													<center>
														<i class="fas fa-exclamation-triangle" style="font-size: 30px; color:#fc5c65;"></i><br>
														<h3 style="font-style: italic;">No Data Found!</h3>
													</center>
												</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card bg-main-card">
						<div class="card-header card-header-custom" id="headingTwo">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Hasil <strong>Nilai Vektor S</strong>
								</button>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">
								<table class="table">
									<thead class="thead-blue">
										<tr>
											<th class="thead-custom" scope="col">Kode</th>
											<th class="thead-custom" scope="col">Nilai Vektor S</th>
										</tr>
									</thead>
									<tbody class="tbody-custom">
										<?php if ($ara->num_rows() > 0) : ?>
											<?php $count = 1; ?>
											<?php foreach ($ara->result_array() as $ar) : ?>
												<tr class="tr-striped">
													<th class="border-custom" scope="row"><?= $hasil['vektor S'][$ar['kode']]['kode']; ?></th>
													<td class="border-custom"><?= $hasil['vektor S'][$ar['kode']]['nilai']; ?></td>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr class="tr-striped">
												<td class="border-custom" colspan="2">
													<center>
														<i class="fas fa-exclamation-triangle" style="font-size: 30px; color:#fc5c65;"></i><br>
														<h3 style="font-style: italic;">No Data Found!</h3>
													</center>
												</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card bg-main-card">
						<div class="card-header card-header-custom" id="headingThree">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Hasil <strong>Vektor V</strong>
								</button>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							<div class="card-body">
								<table class="table">
									<thead class="thead-blue">
										<tr>
											<th class="thead-custom" scope="col">Kode</th>
											<th class="thead-custom" scope="col">Nama</th>
											<th class="thead-custom" scope="col">Nilai Vektor V</th>
											<th class="thead-custom" scope="col">Ranking</th>
										</tr>
									</thead>
									<tbody class="tbody-custom">
										<?php $count = 0; ?>
										<?php foreach ($ara->result_array() as $a) : ?>
											<?php foreach ($ara->result_array() as $alter) : ?>
												<?php if ($alter['kode'] === $hasil['vektor V'][$count]['kode']) : ?>
													<tr class="tr-striped">
														<th class="border-custom" scope="row"><?= $hasil['vektor V'][$count]['kode']; ?></th>
														<td class="border-custom"><?= $alter['nama']; ?></td>
														<td class="border-custom"><?= $hasil['vektor V'][$count]['nilai']; ?></td>
														<td class="border-custom"><?= $i = $count + 1; ?></td>
													</tr>
												<?php endif; ?>
											<?php endforeach; ?>
											<?php ++$count; ?>
										<?php endforeach; ?>
									</tbody>
								</table>

								<div class="card card-kesimpulan">
									<div class="card-header card-header-kesimpulan">
										<strong>Kesimpulan:</strong>
									</div>
									<div class="card-body">
										<p class="card-text">Berdasarkan hasil perhitungan metode Weight Product (WP) maka alternatif tanaman ara varietas <strong><?= $keputusan['nama'] . " (" . $keputusan['kode'] . ")" ?></strong> merupakan alternatif tanaman ara yang tepat untuk ditanam dengan nilai akhir <?= $hasil['vektor V'][0]['nilai'] ?>. </p>
									</div>
								</div>

							</div>
							<div class="card-footer">
								<small class="text-muted">Waktu pengambilan keputusan <?= round($hasil['waktu'], 2, PHP_ROUND_HALF_UP);  ?> detik</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- akhir tempat konten utama  -->
		</div>
		<!-- </div> -->
