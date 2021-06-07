	<div class="content-login">
		<div class="box-login-2">
			<div class="form-login">
				<div class="row mb-3">
					<img src="<?= base_url('assets/img/title-ara-new-5.png');  ?>" class="title-login" width="200">
				</div>
				<form method="POST" action="">
					<h4 class="judul-login">Buat akun</h4>
					<div class="form-group">
						<?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
						<input type="text" class="form-control" id="nama" name="nama" autocomplete="off" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
					</div>
					<div class="form-group">
						<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
						<input type="text" placeholder="Username" class="form-control" autocomplete="off" id="username" name="username" value="<?= set_value('username'); ?>">
					</div>
					<div class="form-group">
						<?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
						<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password2" name="password2" placeholder="Ketik ulang password">
						<small class="form-text txt-login">Sudah punya akun? <a class="txt-link" href="<?= base_url('auth') ?>">Masuk!</a> </small>
					</div>
					<button type="submit" class="btn tombol-login">Daftar</button>
				</form>
			</div>
		</div>
	</div>
