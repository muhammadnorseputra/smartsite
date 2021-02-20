<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome, Sistem Informasi Website BKPPD</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?= base_url('assets/intro/css/main.css'); ?>" />
	</head>
	<body>
		<?php
		// $ip = $this->input->ip_address();
		function get_client_ip()
		{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
		}
		$string = exec('getmac');
		$mac = substr($string, 0, 17);
		$mc = $mac;
		$ip = get_client_ip();
		$os = $this->agent->platform();
		?>
		<!-- Main -->
		<div id="main">
				<div class="logo">
					<?php echo '<img class="animated fadeIn" src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="145"/>'; ?>	
				</div>
			<!-- Intro -->
			<section id="top">
				<div class="container">
					<header>
						<h2 class="alt">WELCOME,<br> <strong>Sistem Informasi Website BKPPD</strong></h2>
					</header>
					<footer>
						<a href="<?= base_url('login'); ?>" class="btn">
							<svg width="277" height="62">
								<defs>
								<linearGradient id="grad1">
									<stop offset="0%" stop-color="#FF8282"/>
									<stop offset="100%" stop-color="#E178ED" />
								</linearGradient>
								</defs>
								<rect x="5" y="5" rx="25" fill="none" stroke="url(#grad1)" width="266" height="50"></rect>
							</svg>
					<i class="fas fa-lock"></i>	Login adminpanel</a>
					</footer>
					<a href="<?= base_url('beranda') ?>" class="backToHome"><i class="far fa-arrow-left"></i> Beranda</a>
				</div>
			</section>
			<!-- Footer -->
			<div id="footer">
				<!-- Copyright -->
				<ul class="copyright">
					<li>&copy; <?= date('Y') ?>, Bkppd Kabupaten Balangan. All rights reserved.</li>
					<li class="ip">IP. <?= $ip ?></li>
				</ul>
			</div>
		</div>
		<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/blockUI/jquery.blockUI.js') ?>"></script>
		<script>
			<?php if($this->session->flashdata('error')){ ?>
				alert('<?= $this->session->flashdata('error') ?>');
			<?php } ?>
			$(document).ready(function() {
				$("a.btn").unbind().bind("click", function(e) {
					e.preventDefault();
					$.blockUI({
                        message: '<center><img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/three-dots.svg'); ?>"></center>',
                        css: {
                            border: '',
                            width: '100%',
                            left: 0,
                            backgroundColor: 'transparent',
                            opacity: 1
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.9,
                        },
                        fadeIn: 500,
                        onBlock: function() { 
                        	setTimeout(() => {
			                	window.location.href = $("a.btn").attr('href'); 
                        	}, 1000);
			            }
                    });
				})
			})
		</script>
	</body>
</html>