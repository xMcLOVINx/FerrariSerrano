
<link href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/summernote/summernote.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
		<?php if ($segments[2] == 'edit') { ?>
			<h4>Modificar configurações</h4>
		<?php } else { ?>
			<h4>Cadastrar configurações</h4>
		<?php } ?>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						Configurações
					</li>

				<?php if ($segments[2] == 'edit') { ?>
					<li class="breadcrumb-item active">
						Atualizar
					</li>
				<?php } else { ?>
					<li class="breadcrumb-item active">
						Adicionar
					</li>
				<?php } ?>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<h4 class="m-b-30 header-title">
				<?php if ($segments[2] == 'edit') { ?>
					<b>Modificar Configurações</b>
				<?php } else { ?>
					<b>Cadastrar Configurações</b>
				<?php } ?>
				</h4>

				<form id="wizard-validation-form" method="post" enctype="multipart/form-data">
					<div>
						<h3 class="">
							<span class="hidden-xs hidden-sm">Aplicação</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<strong style="color: #000">Observação:</strong> Responsável por alterar o título das páginas. Caso não queira atualizar, não modifique este campo!
										</div>
									</div>

									<div class="col-md-8 col-md-offset-2">
										<input id="titulo" name="titulo" type="text" class="required form-control" value="<?= @$item->tituloPagina ?>" />
									</div>
								</div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Logotipo App</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<strong style="color: #000">Observação:</strong> Responsável por alterar a logo presente no loading do aplicativo. Caso não queira atualizar, não insira nenhuma imagem neste campo!
										</div>
									</div>

									<div class="col-md-6 col-md-offset-3">
										<div class="form-file">
											<input id="app" name="app" type="file" class="input-file" data-location="app" />

											<label for="app">
												<strong>Selecione o Arquivo </strong>
												<span class="drap">ou Arraste</span>.
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div id="img-preview-app" class="col-md-6 col-md-offset-3 text-center"></div>
								</div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Logotipo Painel</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<strong style="color: #000">Observação:</strong> Responsável por alterar a logo presente no topo dos painéis. Caso não queira atualizar, não insira nenhuma imagem neste campo!
										</div>
									</div>

									<div class="col-md-6 col-md-offset-3">
										<div class="form-file">
											<input id="panel" name="panel" type="file" class="input-file" data-location="panel" />

											<label for="panel">
												<strong>Selecione o Arquivo </strong>
												<span class="drap">ou Arraste</span>.
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div id="img-preview-panel" class="col-md-6 col-md-offset-3 text-center"></div>
								</div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Termo & Confições</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<strong style="color: #000">Observação:</strong> Responsável por alterar a logo presente no topo dos painéis. Caso não queira atualizar, não modifique este campo!
										</div>
									</div>

									<div class="col-md-12">
										<textarea id="termos-conficoes" name="termos-conficoes" class="form-control summernote">
											<?= @$item->termosCondicoes ?>
										</textarea>
									</div>
								</div>
							</div>
						</section>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-mask/jquery.mask.js') ?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('.summernote').summernote(
	{
		height: 300,
		focus: false,
		minHeight: null,
		maxHeight: null,
		fontSizes: [
			'8', '9', '10', '11', '12', '14', '18', '24'
		],
		toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['view', ['fullscreen']],
		]
	});

	//=========

	$('.form-file .input-file').on('change', function(e)
	{
		var location = $(this).data('location');

		$('label[for='+location+']').html(
			'<strong>'+e.target.files[0].name+'</strong>'
		);

		imgPreview(this, location);
	});
});

//=========

function imgPreview(img, location)
{
	var reader = new FileReader();

	reader.onload = function(e){
		$('#img-preview-'+location+'').html(
			'<img class="img-resonsive" src="#" height="150" width="300" style="margin-top:20px" />'
		);

		$('#img-preview-'+location+' img').attr('src', e.target.result);
	}
		
	reader.readAsDataURL(img.files[0]);
}
</script>