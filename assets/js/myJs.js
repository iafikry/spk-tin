// ====================================================================================================================
	//LOGIN
	// document.getElementById('tombol-login').addEventListener('click', () =>{
	// 	document.getElementById('tombol-login').style.marginTop="-3px";
	// });

// ====================================================================================================================

// ====================================================================================================================
	// NAVBAR MENU
	function garisBiru1(){
		document.getElementById('nav-home').addEventListener("click", () => {
			if (document.getElementById('nav-pengguna').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-pengguna').classList.remove('garis-biru-menu', 'txt-menu');
			}
			if (document.getElementById('nav-kriteria').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-kriteria').classList.remove('garis-biru-menu', 'txt-menu');
			}
			document.getElementById('nav-home').classList.add('garis-biru-menu', 'txt-menu');
		});

	}

	function garisBiru2(){
		document.getElementById('nav-pengguna').addEventListener("click", () => {
			if (document.getElementById('nav-home').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-home').classList.remove('garis-biru-menu', 'txt-menu');
			}
			if (document.getElementById('nav-kriteria').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-kriteria').classList.remove('garis-biru-menu', 'txt-menu');
			}
			document.getElementById('nav-pengguna').classList.add('garis-biru-menu', 'txt-menu');
		});
	}

	function garisBiru3(){
		document.getElementById('nav-kriteria').addEventListener('click', () => {
			if (document.getElementById('nav-home').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-home').classList.remove('garis-biru-menu', 'txt-menu');
			}

			if (document.getElementById('nav-pengguna').classList.contains('garis-biru-menu', 'txt-menu')) {
				document.getElementById('nav-pengguna').classList.remove('garis-biru-menu', 'txt-menu');
			}
			document.getElementById('nav-kriteria').classList.add('garis-biru-menu', 'txt-menu');
		});

	}	
// ===========================================================================================================================
