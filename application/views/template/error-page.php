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
	<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
		<div class="container-fluid mr-4 ml-4">
			<a class="navbar-brand txt-title" href="#">
				<img src="<?php //echo base_url('assets/img/title-ara-new.png'); 
							?>" width="175" height="40" class="logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto">
				</div>
			</div>
		</div>
	</nav> -->

	<div class="bg-main-frame" style="height:762px;">
		<div class="container cont-main-frame">
			<div class="card text-center" style="border:none;">
				<img src="<?= base_url('assets/img/404.png'); ?>" class="logo-forbid mx-auto" height="300" width="400" alt="Responsive image">
				<p class="text-card error-text">Anda tidak mempunyai hak akses</p>
				<?php if ($this->session->userdata('role_id') == 1) : ?>
					<a href="<?= base_url('admin'); ?>"><button type="button" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i> Kembali</button></a>
				<?php else : ?>
					<a href="<?= base_url('user'); ?>"><button type="button" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i> Kembali</button></a>
				<?php endif; ?>
			</div>
		</div>
	</div>



	<!-- Optional JavaScript -->
	<!-- my JavaScript -->
	<script src="<?= base_url('assets/js/myJs.js'); ?>"></script>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
