<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/a9b5ac602b.js" crossorigin="anonymous"></script>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Hind+Madurai&family=Open+Sans:wght@400;700;800&family=Roboto+Slab:wght@400;900&family=Roboto:wght@400;700;900&family=Source+Sans+Pro:wght@400;700;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Buda:wght@300&family=Lancelot&display=swap" rel="stylesheet">

	<!-- my css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/mystyle.css">

	<!-- icon -->
	<link rel="icon" href="<?= base_url(); ?>/assets/img/planting.ico">
	<title><?= $judul; ?> - SPK Ara</title>
</head>

<body>
	<!-- ========================================================================================================================================================== 
			AWAL NAVBAR
================================================================================================================================================================ -->

	<nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
		<div class="container-fluid container-navbar">
			<a class="navbar-brand txt-title" href="<?= base_url('user'); ?>">
				<img src="<?= base_url('assets/img/title-ara-blue-inter-2.png'); ?>" width="175" height="40" class="logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto">
					<a class="nav-item nav-link" id="nav-home" onclick="garisBiru1()" href="<?php //echo base_url('admin'); 
																							?>"><i class="fas fa-globe-asia"></i>&nbsp; home</a>
					<a class="nav-item nav-link" id="nav-pengguna" onclick="garisBiru2()" href="<?php //echo base_url('admin/pengguna'); 
																								?>"><i class="fas fa-users"></i>&nbsp; pengguna</a>
					<a class="nav-item nav-link" id="nav-kriteria" onclick="garisBiru3()" href="#"><i class="fas fa-seedling"></i>&nbsp; kriteria</a>
					<div class="nav-item dropdown">
						<button class="btn btn-md dropdown-toggle btn-navbar" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp; <?= $this->session->userdata('nama'); ?></button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i>&nbsp; my profile</a>
							<a class="dropdown-item" href="<?php //echo base_url('auth/logout'); 
															?>"><i class="fas fa-sign-out-alt"></i>&nbsp; logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav> -->
