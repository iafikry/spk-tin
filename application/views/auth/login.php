	<div class="content-login">
		<div class="box-login" id="box-login">
			<div class="form-login">
				<div class="row mb-3">
					<img src="<?= base_url('assets/img/title-ara-new-5.png'); ?>" class="title-login" width="200">
				</div>
				<form id="form-login" method="POST" action="<?= base_url('auth'); ?>">
					<div class="form-group">
						<h3 class="judul-login">Login</h3>
					</div>
					<?= $this->session->flashdata('message'); ?>
					<div class="form-group">
						<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
						<input type="text" class="input-login" id="username" name="username" placeholder="Username" autocomplete="off" value="<?= set_value('username'); ?>">
					</div>
					<div class="form-group">
						<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						<input type="password" class="input-login" id="password" name="password" placeholder="Password">
					</div>
					<div class="form-group">
						<small class="form-text txt-login">Belum punya akun? <a class="txt-link" href="<?= base_url() ?>auth/registrasi">Klik di sini!</a> </small>
					</div>
					<button type="submit" class="btn tombol-login" id="tombol-login">Masuk</button>
				</form>
			</div>
		</div>
	</div>
