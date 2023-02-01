<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Selamat Datang di Aplikasi SPP</title>
    <link rel="icon" href="{{asset('./assetslog/images/logo2.png')}}" />
	<link rel="stylesheet" href="{{asset('./assetslog/css/style.min.css')}}">
	<link rel="stylesheet" href="{{asset('./assetslog/css/custome.css')}}">
	<link rel="stylesheet" href="{{asset('./assetslog/css/material-design-iconic-font.min.css')}}">
    <script type="text/javascript" src="{{asset('./assetslog/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('./assetslog/js/origin.js')}}"></script>
    <script type="text/javascript" src="{{asset('./assetslog/js/home.js')}}"></script>
    <script type="text/javascript" src="{{asset('./assetslog/js/all.js')}}"></script>
    <script type="text/javascript">
		$(document).on('click', '.showpass', function() {
			var type = $('.password').attr('type');
			if(type == 'password'){
				$('.password').attr('type','text');
				$(this).html('<i class="fa fa-eye-slash"></i>');
			}else{
				$('.password').attr('type','password');
				$(this).html('<i class="fa fa-eye"></i>');
			}
		});
	</script>
  </head>
  <body>
    <div class="box-lds" style="display: block;">
        <div class="lds-ripple"><div></div><div></div></div>
        <span class="lds-loading" style = "margin-left:-12px;">Loading halaman...</span>
    </div>
	<section class="hero is-gradient is-fullheight">
	  <div class="hero-body">
		<div class="container">
		  <div class="columns is-centered">
			<div class="column is-5-tablet is-6-desktop is-5-widescreen">
			  <form action="" class="box loginform">
				<div>
				  <article class="media" style = "border-bottom: 3px solid #119ebb;">
					<div class="media-left">
					  <figure class="image is-96x96 lgo">
						<img src="{{asset('./assetslog/images/logo2.png')}}" alt="Logo">
					  </figure>
					</div>
					<div class="media-content">
					  <div class="content desk" id="s">
						<p>
						  <strong>Aplikasi SPP</strong>
						  <br />
						  Selamat Datang di Aplikasi Pembayaran SPP Madrasah Ibtidaiyah Al-Istiqomah
						</p>
					  </div>
					  <div class="content deskmin">
						<p>
						  <strong>Aplikasi SPP</strong>
						  <br />
						  Silahkan masukkan details login anda pada form.
						</p>
					  </div>
					</div>
				  </article>
				</div>
				<br />
				<div class="field">
				  <label for="" class="label">Username</label>
				  <div class="control has-icons-left">
					<input type="text" placeholder="Masukkan Username" class="input username" required>
					<span class="icon is-small is-left">
					  <i class="fa fa-user"></i>
					</span>
				  </div>
				</div>
				<div class="field">
				  <label for="" class="label">Password</label>
				  <div class="control has-icons-left">
					  <div class="showpass" style="position: absolute;z-index: 10;margin: 10px;cursor: pointer;">
						<i class="fa fa-eye"></i>
					  </div>
					<input type="password" placeholder="Password" class="input password" required>
					<span class="icon is-small is-left">
					</span>
				  </div>
				</div>
				<div class="field is-grouped is-grouped-right">
				  <button class="button is-app level-right login">
					<i class="fa fa-unlock"></i> &nbsp; Login
				  </button>
				</div>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<div class="modal info">
	  <div class="modal-background"></div>
	  <div class="modal-content">
		<article class="message is-primary">
		  <div class="message-header">
			<p><i class="fa fa-info-circle"></i> &nbsp; Informasi</p>
			<button class="delete" aria-label="delete"></button>
		  </div>
		  <div class="message-body">
		  </div>
		</article>
	  </div>
	</div>
  </body>
</html>