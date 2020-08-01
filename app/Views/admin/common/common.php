<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="shortcut icon" href="<?= base_url('assets/images/favicon_1.ico') ?>" />

		<title>FerrariSerrano | Foo</title>

		<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/css/components.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/css/pages.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/css/core.css') ?>" rel="stylesheet" />

		<link href="<?= base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
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

		<script type="text/javascript">
		var base_url = "<?= base_url() ?>";
		</script>
	</head>

	<body class="fixed-left">
		<div id="wrapper">
			<div class="topbar">
				<div class="topbar-left">
					<div class="text-center">
						<a href="javascript:void(0);" class="logo">
							<span>
								<img src="<?= base_url('uploads/logo_2.gif') ?>" height="30" />
							</span>
						</a>
					</div>
				</div>

				<div class="navbar navbar-default bg-white" role="navigation">
					<div class="container">
						<div>
							<div class="pull-left">
								<button class="button-menu-mobile open-left waves-effect waves-light">
									<i class="md md-menu"></i>
								</button>

								<span class="clearfix"></span>
							</div>

							<ul class="nav navbar-nav navbar-right pull-right">
								<li class="dropdown top-menu-item-xs">
									<a href="javascript:void(0);" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
										<img src="<?=convertImage(session()->avatar);?>" alt="user-img" class="img-circle" />
									</a>

									<ul class="dropdown-menu">
										<li>
											<a href="<?= base_url('admin/perfil') ?>">
												<i class="ti-user m-r-10 text-custom"></i> Profile
											</a>
										</li>

										<li class="divider"></li>

										<li>
											<a href="<?= base_url('admin/logout') ?>">
												<i class="ti-power-off m-r-10 text-danger"></i> Sair
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="left side-menu">
				<div class="sidebar-inner slimscrollleft">
					<div id="sidebar-menu">
						<ul>
							<li class="text-muted menu-title">MENU</li>

							<li class="">
								<a href="<?= base_url('admin/dashboard') ?>" class="waves-effect">
									<i class="fas fa-home"></i>

									<span> Início </span>
								</a>
							</li>

							<li class="has_sub">
								<a href="javascript:void(0);" class="waves-effect">
									<i class="fas fa-shopping-basket"></i>

									<span> Mensalidades </span>
									<span class="menu-arrow"></span>
								</a>

								<ul class="list-unstyled">
									<li>
										<a href="<?= base_url('admin/mensalidades/inserir') ?>">Adicionar Novo</a>
									</li>

									<li>
										<a href="<?= base_url('admin/mensalidades') ?>">Listar Todos</a>
									</li>
								</ul>
							</li>

							<li class="text-muted menu-title">CRM</li>

							<li class="has_sub">
								<a href="javascript:void(0);" class="waves-effect">
									<i class="fas fa-users-cog"></i>

									<span> Usuários </span>
									<span class="menu-arrow"></span>
								</a>

								<ul class="list-unstyled">
									<li>
										<a href="<?=base_url('admin/administradores/inserir') ?>">Adicionar Novo</a>
									</li>

									<li>
										<a href="<?=base_url('admin/administradores') ?>">Listar Todos</a>
									</li>

									<li class="has_sub">
										<a href="javascript:void(0);" class="waves-effect">
											<span>Permissões</span>
											<span class="menu-arrow"></span>
										</a>

										<ul class="list-unstyled">
											<li>
												<a href="<?=base_url('admin/permissoes/inserir') ?>">Adicionar Novo</a>
											</li>

											<li>
												<a href="<?=base_url('admin/permissoes') ?>">Listar Todos</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>

							<li class="has_sub">
								<a href="javascript:void(0);" class="waves-effect">
									<i class="fas fa-users"></i>

									<span> Clientes </span>
									<span class="menu-arrow"></span>
								</a>

								<ul class="list-unstyled">
									<li>
										<a href="<?= base_url('admin/clientes/inserir') ?>">Adicionar Novo</a>
									</li>

									<li>
										<a href="<?= base_url('admin/clientes') ?>">Listar Todos</a>
									</li>
								</ul>
							</li>
						</ul>

						<div class="clearfix"></div>
					</div>

					<div class="clearfix"></div>
				</div>
			</div>

			<div class="content-page">
				<div class="content">
				<?= (isset($common)) ? view($common, $data) : "" ?>
				</div>

				<footer class="footer text-right">
					<center>
						<div class="copy">
							Copyright &copy; 
							<strong>FerrariSerrano</strong> <?= date('Y') ?> - 
							All rights reserved
						</div>

						<div class="author">
							Made by 
							<i class="fa fa-heart" style="color: #f00"></i> 
							<a href="#">BiTScript Developers</a>
						</div>
					</center>
				</footer>
			</div>
		</div>

		<div id="logical-modal" class="modal-demo">
			<div class="header">
				<button type="button" class="close" onclick="Custombox.close()">
					<i class="fas fa-times"></i>
				</button>

				<h4 class="custom-modal-title">Atualizar Lógica</h4>
			</div>

			<div class="modal-form">
				<form class="form" method="post" action="">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="logical_foo">
										Foo *
									</label>

									<input id="logical_foo" name="cliente" type="text" class="required form-control"/>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" onclick="Custombox.close()">
							<i class="fas fa-times"></i> Fechar
						</button>

						<button type="submit" class="btn btn-success waves-effect waves-light">
							<i class="fas fa-check"></i> Atualuzar
						</button>
					</div>
				</form>
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

		<div id="delete-modal" class="modal-demo">
			<div class="header">
				<button type="button" class="close" onclick="Custombox.close()">
					<i class="fas fa-times"></i>
				</button>

				<h4 class="custom-modal-title">Confirmação de Exclusão</h4>
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
						</div>

						<div class="col-md-12">
							<div style="text-transform: uppercase">
								A operação que está prestes a realizar é irreversível.
								<br>
								Deseja mesmo confirmar a exclusão do registro?
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" onclick="Custombox.close()">
						<i class="fas fa-times"></i> Fechar
					</button>

					<a class="btn btn-danger waves-effect waves-light delete" style="cursor: pointer; font-weight: bold; text-transform: uppercase">
						<i class="fas fa-check"></i> Confirmar
					</a>
				</div>
			</div>
		</div>

		<script type="text/javascript">
		var resizefunc = [];

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

		$('.delete-action').on('click', function()
		{
			$('#delete-modal').find('.delete').attr(
				'href', $(this).data('href')
			);

			Custombox.open({
				target: '#delete-modal',
				overlayColor: '#36404a',
				overlaySpeed: '100',
				effect: 'flash'
			});
		})
		</script>

		<script src="<?= base_url('assets/js/detect.js') ?>"></script>
		<script src="<?= base_url('assets/js/fastclick.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.slimscroll.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.blockUI.js') ?>"></script>
		<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/modal.js') ?>"></script>

		<script src="<?= base_url('assets/js/jquery.core.js') ?>"></script>
		<script src="<?= base_url('assets/js/jquery.app.js') ?>"></script>
	</body>
</html>