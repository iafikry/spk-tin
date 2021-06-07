		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" id="nav-home" href="<?php echo base_url('admin'); ?>">beranda</a>
				<a class="nav-item nav-link" id="nav-pengguna" href="<?php echo base_url('admin/pengguna'); ?>">pengguna</a>
				<a class="nav-item nav-link" id="nav-kriteria" href="<?= base_url('admin/criteria'); ?>">kriteria</a>
				<a class="nav-item nav-link" id="nav-ara" href="<?= base_url('admin/ara'); ?>">ara</a>
				<a class="nav-item nav-link txt-menu garis-biru-menu" id="nav-penilaian" href="<?= base_url('admin/penilaian'); ?>">keputusan</a>
				<div class="nav-item dropdown">
					<button class="btn btn-md dropdown-toggle btn-navbar" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp; <?php echo $this->session->userdata('username'); ?></button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= base_url('admin/myProfile/' . $this->session->userdata('username')); ?>"><i class="fas fa-user-circle"></i>&nbsp; my profile</a>
						<a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp; logout</a>
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
		<div class="container main-frame">
			<div class="main-box">

				<!--Tempat untuk title  -->
				<div class="header-title">
					<h1 class="main-title">Final Decision</h1>
					<hr class="title-line">
				</div>
				<!-- akhir header title -->


				<!-- tempat untuk menyimpan alert -->
				<div class="forAlert mt-4">
					<?= $this->session->flashdata('keputusan'); ?>
				</div>
				<!-- akhir tempat untuk menyimpan alert -->

				<!-- tempat untuk konten utama -->
				<div class="main-content">
					<div class="accordion" id="accordionExample">

						<div class="card card-custom-accordion" style="border-bottom: 3px solid #e7dcf5; border-radius: 5px;">
							<div class="card-header card-header-custom" id="headingOne">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Hasil Normalisasi Bobot Kriteria
									</button>
								</h2>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body card-body-custom">
									<table class="table">
										<thead class="thead-blue">
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Kriteria</th>
												<th scope="col">Bobot</th>
												<th scope="col">Normalisasi</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($criteria->num_rows() > 0) : ?>
												<?php $count = 1; ?>
												<?php foreach ($criteria->result_array() as $cr) : ?>
													<tr class="tr-striped">
														<th scope="row"><?= $cr['kode']; ?></th>
														<td><?= $cr['nama']; ?></td>
														<td><?= $cr['bobot']; ?></td>
														<?php if ($cr['kode'] == $hasil['normalisasi'][$cr['kode']]['kode']) : ?>
															<td><?= $hasil['normalisasi'][$cr['kode']]['nilai']; ?></td>
														<?php endif; ?>
													</tr>
												<?php endforeach; ?>
											<?php else : ?>
												<tr class="tr-striped">
													<td colspan="4">
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

						<div class="card card-custom-accordion mt-2" style="border-bottom: 3px solid #e7dcf5; border-radius: 5px;">
							<div class="card-header card-header-custom" id="headingTwo">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Hasil Nilai Vektor S
									</button>
								</h2>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
								<div class="card-body card-body-custom">
									<table class="table">
										<thead class="thead-blue">
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Nilai Vektor S</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($ara->num_rows() > 0) : ?>
												<?php $count = 1; ?>
												<?php foreach ($ara->result_array() as $ar) : ?>
													<tr class="tr-striped">
														<th scope="row"><?= $hasil['vektor S'][$ar['kode']]['kode']; ?></th>
														<td><?= $hasil['vektor S'][$ar['kode']]['nilai']; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else : ?>
												<tr class="tr-striped">
													<td colspan="2">
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

						<div class="card card-custom-accordion mt-2" style="border-bottom: 3px solid #e7dcf5; border-radius: 5px;">
							<div class="card-header card-header-custom" id="headingThree">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Hasil Vektor V
									</button>
								</h2>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
								<div class="card-body card-body-custom">
									<table class="table">
										<thead class="thead-blue">
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Nilai Vektor V</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($ara->result_array() as $a) : ?>
												<tr class="tr-striped">
													<th scope="row"><?= $hasil['vektor V'][$a['kode']]['kode']; ?></th>
													<td><?= $hasil['vektor V'][$a['kode']]['nilai']; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="card card-custom-accordion mt-2" style="border-bottom: 3px solid #e7dcf5; border-radius: 5px;">
							<div class="card-header card-header-custom" id="headingFour">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										Hasil Nilai Utility
									</button>
								</h2>
							</div>
							<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body card-body-custom">
									<table class="table">
										<thead class="thead-blue">
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Alternatif</th>
												<?php foreach ($criteria->result_array() as $ctr) : ?>
													<td><?= $ctr['kode'] ?></td>
												<?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($ara->result_array() as $aa) : ?>
												<tr class="tr-striped">
													<th scope="row"><?= $aa['kode']; ?></th>
													<td><?= $aa['nama']; ?></td>
													<?php foreach ($criteria->result_array() as $c) : ?>
														<td><?= $hasil['nilai utility'][$aa['kode']]['nilai' . $c['kode']]; ?></td>
													<?php endforeach; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="card card-custom-accordion mt-2" style="border-bottom: 3px solid #e7dcf5; border-radius: 5px;">
							<div class="card-header card-header-custom" id="headingFive">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										Hasil Nilai Akhir
									</button>
								</h2>
							</div>
							<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
								<div class="card-body card-body-custom">
									<table class="table">
										<thead class="thead-blue">
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Alternatif</th>
												<th scope="col">Nilai Akhir</th>
												<th scope="col">Rangking</th>
											</tr>
										</thead>
										<tbody>
											<?php rsort($hasil['nilai akhir']);
											$count = 0; ?>
											<?php foreach ($ara->result_array() as $alternatif) : ?>
												<?php foreach ($ara->result_array() as $at) : ?>
													<?php if ($at['kode'] == $hasil['nilai akhir'][$count]['kode']) : ?>
														<tr class="tr-striped">
															<th scope="row"><?php echo $hasil['nilai akhir'][$count]['kode'];  ?></th>
															<td><?php echo $at['nama']; ?></td>
															<td><?php echo $hasil['nilai akhir'][$count]['nilai']; ?></td>
															<td><?php echo $i = $count + 1; ?></td>
														</tr>
													<?php endif; ?>
												<?php endforeach; ?>
												<?php ++$count; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- akhir tempat konten utama  -->

			</div>
		</div>
		<!-- </div> -->
