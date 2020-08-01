
<link href="<?= base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/summernote/summernote.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Atualizar perfil</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url()?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item active">
						Perfil
					</li>

					<li class="breadcrumb-item active">
						Atualizar
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="profile-detail card-box">
				<div>
					<img src="<?=convertImage($data->avatar);?>" class="img-circle" alt="profile-image" />

					<div class="permission m-t-20">
						<button type="button" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light" style="text-transform: uppercase">
							<?= $permission->titulo ?>
						</button>
					</div>

					<div class="text-center m-t-20">
						<p class="text-muted font-13">
							<?= $data->nomeCompleto ?>
						</p>

						<p class="text-muted font-13">
							<?= $data->telefone ?>
						</p>

						<p class="text-muted font-13">
							<?= $data->email ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8">
			<div class="card-box">
				<h4 class="m-b-30 header-title">
					<b>Atualizar Perfil</b>
				</h4>

				<form id="wizard-validation-form" method="post" enctype="multipart/form-data">
					<div>
						<h3 class="">
							<span class="hidden-xs hidden-sm">Senha</span>
						</h3>

						<section style="padding-bottom: 40px">
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Observação:</strong> Para alterar sua senha, altere o campo `Alterar Senha`.

											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">
													<i class="fas fa-times" style="margin-top: 2px"></i>
												</span>
											</button>
										</div>
									</div>

									<div class="col-md-12 error_msg hidden">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Error:</strong> Os campos `Nova Senha` e `Confirmar Senha` devem ser correspondentes.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label class="control-label" for="pergunta">
											Alterar Senha *
										</label>

										<select name="pergunta" id="pergunta" class="selectpicker required form-control" data-style="btn-white" data-size="3">
											<option value="1">Sim</option>
											<option value="0" selected>Não</option>
									 	</select>
									</div>

									<div class="col-md-6">
										<label class="control-label" for="senha_atual">
									   		Senha Atual *
										</label>

										<input id="senha_atual" name="senha_atual" type="password" class="required form-control" />
									</div>
								</div>

								<div class="row new_password hidden">
									<div class="col-md-6">
										<label class="control-label" for="senha">
									   		Nova Senha *
										</label>

										<input id="senha" name="senha" type="password" class="required form-control" />
									</div>

									<div class="col-md-6">
										<label class="control-label" for="confirma_senha">
									   		Confirmar Senha *
										</label>

										<input id="confirma_senha" name="confirma_senha" type="password" class="required form-control" />
									</div>
								</div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Avatar</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Observação:</strong> Caso não deseje alterar seu avatar, não selecione um arquivo.
										</div>
									</div>

									<div class="col-md-6 col-md-offset-3">
										<div class="form-file">
											<input id="avatar" name="avatar" type="file" class="input-file" />

											<label for="avatar">
												<strong>Selecione o Arquivo </strong>
												<span class="drap">ou Arraste</span>.
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div id="img-preview" class="col-md-6 col-md-offset-3 text-center"></div>
								</div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Dados...</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Observação:</strong> Nesta área encontram-se alguns de seus dados pessoais.

											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">
													<i class="fas fa-times" style="margin-top: 2px"></i>
												</span>
											</button>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<label class="control-label" for="telefone">
											Telefone *
										</label>

										<input id="telefone" name="telefone" type="text" class="required form-control" value="<?= $data->telefone ?>" />
									</div>

									<div class="col-md-8">
										<label class="control-label" for="email">
											E-mail *
										</label>

										<input id="email" name="email" type="email" class="required form-control" value="<?= $data->email ?>" />
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

<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-mask/jquery.mask.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	var FormWizard = function() {};

	FormWizard.prototype.createValidatorForm = function($form_container)
	{
		$form_container.validate({
			errorPlacement: function errorPlacement(error, element)
			{
				element.after(error);
			}
		});
		$form_container.children("div").steps({
			headerTag: "h3",
			bodyTag: "section",
			transitionEffect: "slideLeft",
			onStepChanging: function (event, currentIndex, newIndex)
			{
				if ($('#pergunta option:selected').val() == 1 ) {
					if ($("#senha").val() !== $("#confirma_senha").val()) {
						$(".error_msg").removeClass('hidden').delay(8000).queue(
						function(n){
							$(this).addClass('hidden');
							n();
						});

						return false;
					}
				}

				$form_container.validate().settings.ignore = ":disabled,:hidden";
				return $form_container.valid();
			},
			onFinishing: function (event, currentIndex)
			{
				$form_container.validate().settings.ignore = ":disabled,:hidden";
				return $form_container.valid();
			},
			onFinished: function (event, currentIndex)
			{
				$form_container.validate().settings.ignore = ":disabled,:hidden";
				return $form_container.submit();
			}
		});

		return $form_container;
	},
	FormWizard.prototype.init = function()
	{
		this.createValidatorForm($("#wizard-validation-form"));
	},
	$.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard;
	$.FormWizard.init();

	//=========

	$('#telefone').mask('+99 (99) 9999-9999?9');

	//=========

	$('.form-file .input-file').on('change',function(e)
	{
		$('label[for=file]').html(
			'<strong>'+e.target.files[0].name+'</strong>'
		);

		imgPreview(this);
	});

	//=========

	$('#pergunta').on('change', function(e)
	{
		if ($('#pergunta option:selected').val() == 1 ) {
			$('.new_password').removeClass('hidden');
		} else {
			$('.new_password').addClass('hidden');
		}
	});

	//=========

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

	$('.passw').inputFilter(function(value){
		return /^-?\d*$/.test(value);
	});
});

//=========

function imgPreview(img)
{
	var reader = new FileReader();

	reader.onload = function(e)
	{
		$('#img-preview').html(
			'<img id="preview" class="img-circle" src="#" height="120" width="120" style="margin-top:20px" />'
		);

		$('#img-preview img').attr('src', e.target.result);
	}
		
	reader.readAsDataURL(img.files[0]);
}
</script>
