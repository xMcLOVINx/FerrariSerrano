<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="shortcut icon" href="<?= base_url('assets/images/favicon_1.ico') ?>"/>

		<title>FerrariSerrano | Àrea de Login</title>

		<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/css/core.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/css/components.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/css/pages.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet" type="text/css"/>

		<link href="<?= base_url('assets/css/login.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?= base_url('assets/plugins/custombox/css/custombox.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/plugins/fontawesome/css/all.css') ?>" rel="stylesheet" />

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/waves.js') ?>"></script>
		<script src="<?= base_url('assets/js/modal.js') ?>"></script>

		<script src="<?= base_url('assets/plugins/custombox/js/custombox.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/custombox/js/legacy.min.js') ?>"></script>
	</head>

	<body>
		<?php if (!session()->has('success')): ?>
		<div class="loading">
			<img src="<?= base_url('uploads/logo_2.gif') ?>" />
		</div>
		<?php endif; ?>

		<div class="wrapper-page hidden">
			<div class="card-box">
				<div class="panel-heading"> 
					<h3 class="text-center">
						<img src="<?= base_url('uploads/logo_2.gif') ?>" height="50" />
					</h3>
				</div>

				<div class="panel-body">
					<form class="form-horizontal m-t-20" method="post">
						<div class="form-group">
							<div class="col-xs-12">
								<input id="cnpj" class="form-control" name="cnpj" type="text" inputmode="numeric" pattern="[0-9]+" placeholder="CNPJ" required />
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input id="senha" class="form-control" name="senha" type="text" inputmode="numeric" pattern="[0-9]+" placeholder="Senha" required />
							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit" style="font-weight: bold">Entrar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="success-modal" class="modal-demo">
			<div class="header">
				<button type="button" class="close" onclick="Custombox.close()">
					<i class="fas fa-times"></i>
				</button>

				<h4 class="custom-modal-title">
					Status da Operação
				</h4>
			</div>

			<div class="modal-form">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="flash-spin">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
									<circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
									<polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5"/>
								</svg>
							</div>

							<div class="message" style="text-transform: uppercase">
							<?php
								if (!is_null(session()->message)) {
									echo session()->message;
								} else {
									echo "Operação realizada com sucesso!!";
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="error-modal" class="modal-demo">
			<div class="header">
				<button type="button" class="close" onclick="Custombox.close()">
					<i class="fas fa-times"></i>
				</button>

				<h4 class="custom-modal-title">
					Status da Operação
				</h4>
			</div>

			<div class="modal-form">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="flash-spin">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                    <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                                </svg>
							</div>

							<div class="message" style="text-transform: uppercase">
							<?php
								if (!is_null(session()->message)) {
									echo session()->message;
								} else {
									echo "Falha durante a execução do processo!";
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
		var resizefunc = [];

		// ================

		$(window).on('load', function()
		{
			setTimeout(function()
			{
				$('.loading').fadeToggle("slow");
				$('.wrapper-page').removeClass('hidden');
			}, 5000);
		});

		// ================

		<?php if (session()->has('success')): ?>
			<?php if (session()->success == true): ?>
				showSuccess();
			<?php endif; ?>

			<?php if (session()->success == false): ?>
				showError();
			<?php endif; ?>
		<?php endif; ?>

		// ================

		(function($)
		{
			$.fn.inputFilter = function(inputFilter)
			{
				return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function()
				{
					if (inputFilter(this.value)) {
						this.oldValue = this.value;
						this.oldSelectionStart = this.selectionStart;
						this.oldSelectionEnd = this.selectionEnd;
					} else if (this.hasOwnProperty("oldValue")) {
						this.value = this.oldValue;
						this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
					} else {
						this.value = "";
					}
				});
			};
		}(jQuery));

		// ================

		jQuery(document).ready(function()
		{
			$('form').validate();

			// ================

			$('#cnpj').mask('00.000.000/0000-00', {
				clearIfNotMatch: true
			});

			// ================

			$("#senha").inputFilter(function(value)
			{
				return /^-?\d*$/.test(value);
			});
		});
		</script>

		<script src="<?= base_url('assets/js/detect.js') ?>"></script>
		<script src="<?= base_url('assets/js/fastclick.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.slimscroll.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.blockUI.js') ?>"></script>
		<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>

		<script src="<?= base_url('assets/js/jquery.core.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.app.js') ?>"></script>

		<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/simple.mask/simple.mask.js') ?>"></script>
	</body>
</html>