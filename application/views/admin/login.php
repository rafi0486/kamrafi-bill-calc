<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="EXAM AWAY">
	<meta name="author" content="Creative Tim">
	<title><?=$this->config->item('app_name')?></title>
	<!-- Favicon -->
	<link rel="icon" href="<?=base_url("assets/admin/")?>img/brand/favicon.png" type="image/png">
	<!-- Fonts -->
	<link rel="stylesheet" href="<?=base_url("assets/admin/")?>fonts/open-sans.css">
	<!-- Icons -->
	<link rel="stylesheet" href="<?=base_url("assets/admin/")?>vendor/nucleo/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url("assets/admin/")?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
	<!-- Argon CSS -->
	<link rel="stylesheet" href="<?=base_url("assets/admin/")?>css/theme.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
	<div class="container">
		<a class="navbar-brand" href="dashboard.html">
			<img src="<?=base_url("assets/admin/")?>img/brand/white.png">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
			<div class="navbar-collapse-header">
				<div class="row">
					<div class="col-6 collapse-brand">
						<a href="dashboard.html">
							<img src="<?=base_url("assets/admin/")?>img/brand/blue.png">
						</a>
					</div>
					<div class="col-6 collapse-close">
						<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>
			<?php
			if(1==2){
				?>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="dashboard.html" class="nav-link">
							<span class="nav-link-inner--text">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="login.html" class="nav-link">
							<span class="nav-link-inner--text">Login</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="register.html" class="nav-link">
							<span class="nav-link-inner--text">Register</span>
						</a>
					</li>
				</ul>
				<hr class="d-lg-none" />
			<?php
			}
			?>

			<?php
			if(1==2){
				?>
				<ul class="navbar-nav align-items-lg-center ml-lg-auto">
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
							<i class="fab fa-facebook-square"></i>
							<span class="nav-link-inner--text d-lg-none">Facebook</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
							<i class="fab fa-instagram"></i>
							<span class="nav-link-inner--text d-lg-none">Instagram</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
							<i class="fab fa-twitter-square"></i>
							<span class="nav-link-inner--text d-lg-none">Twitter</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Star us on Github">
							<i class="fab fa-github"></i>
							<span class="nav-link-inner--text d-lg-none">Github</span>
						</a>
					</li>
					<li class="nav-item d-none d-lg-block ml-lg-4">
						<a href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=ad_upgrade_pro" target="_blank" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-shopping-cart mr-2"></i>
              </span>
							<span class="nav-link-inner--text">Upgrade to PRO</span>
						</a>
					</li>
				</ul>
			<?php
			}
			?>

		</div>
	</div>
</nav>
<!-- Main content -->
<div class="main-content">
	<!-- Header -->
	<div class="header bg-gradient-primary py-6 py-lg-6 pt-lg-8">
		<div class="container">
			<div class="header-body text-center mb-7">
				<div class="row justify-content-center">
					<div class="col-xl-5 col-lg-6 col-md-8 px-5">
						<h1 class="text-white">Welcome!</h1>
						<p class="text-lead text-white"></p>
					</div>
				</div>
			</div>
		</div>
		<div class="separator separator-bottom separator-skew zindex-100">
			<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
				<polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
			</svg>
		</div>
	</div>
	<!-- Page content -->
	<div class="container mt--8 pb-5">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="card bg-secondary border-0 mb-0">
					<div class="card-header bg-transparent">
						<div class="text-muted text-center mt-2">Sign in</div>
					</div>
					<?php
					if(1==2){
						?>
						<div class="card-header bg-transparent pb-5">
							<div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
							<div class="btn-wrapper text-center">
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img src="<?=base_url("assets/admin/")?>img/icons/common/github.svg"></span>
									<span class="btn-inner--text">Github</span>
								</a>
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img src="<?=base_url("assets/admin/")?>img/icons/common/google.svg"></span>
									<span class="btn-inner--text">Google</span>
								</a>
							</div>
						</div>
						<?php
					}
					?>
					<div class="card-body px-lg-5 py-lg-5">
						<?php
						if(1==2){
							?>
							<div class="text-center text-muted mb-4">
								<small>Or sign in with credentials</small>
							</div>
						<?php
						}
						?>

						<form role="form" method="post" action="<?=base_url("login/process")?>">
							<?php
							echo "<p class='text-danger'>".$msg."</p>";
							?>
							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-email-83"></i></span>
									</div>
									<input class="form-control" placeholder="Username" type="text" name="username" required>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
									</div>
									<input class="form-control" placeholder="Password" type="password" name="password" required>
								</div>
							</div>
							<div class="custom-control custom-control-alternative custom-checkbox d-none">
								<input class="custom-control-input" id=" customCheckLogin" type="checkbox">
								<label class="custom-control-label" for=" customCheckLogin">
									<span class="text-muted">Remember me</span>
								</label>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary my-4">Sign in</button>
							</div>
						</form>
					</div>
				</div>
				<div class="row mt-3 d-none">
					<div class="col-6">
						<a href="#" class="text-light"><small>Forgot password?</small></a>
					</div>
					<div class="col-6 text-right">
						<a href="#" class="text-light"><small>Create new account</small></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
	<div class="container">
		<div class="row align-items-center justify-content-xl-between">
			<div class="col-xl-6">
				<div class="copyright text-center text-xl-left text-muted">
					&copy; <?=date('Y')?> <a href="<?=base_url("")?>" class="font-weight-bold ml-1" target="_blank"><?=$this->config->item('app_name')?></a>
				</div>
			</div>
			<?php
			if(1==2){
				?>
				<div class="col-xl-6">
					<ul class="nav nav-footer justify-content-center justify-content-xl-end">
						<li class="nav-item">
							<a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
						</li>
						<li class="nav-item">
							<a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
						</li>
						<li class="nav-item">
							<a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
						</li>
						<li class="nav-item">
							<a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
						</li>
					</ul>
				</div>
			<?php
			}
			?>

		</div>
	</div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?=base_url("assets/admin/")?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url("assets/admin/")?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url("assets/admin/")?>vendor/js-cookie/js.cookie.js"></script>
<script src="<?=base_url("assets/admin/")?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?=base_url("assets/admin/")?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="<?=base_url("assets/admin/")?>js/theme.js?v=1.2.0"></script>
</body>

</html>
