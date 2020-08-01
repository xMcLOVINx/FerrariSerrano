
<link href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
		<?php if ($segments[2] == 'atualizar') { ?>
			<h4>Modificar usuário</h4>
		<?php } else { ?>
			<h4>Cadastrar usuário</h4>
		<?php } ?>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						<a href="<?= base_url('users') ?>">Usuários</a>
					</li>

				<?php if ($segments[2] == 'atualizar') { ?>
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
				<?php if ($segments[2] == 'atualizar') { ?>
					<b>Modificar Usuário</b>
				<?php } else { ?>
					<b>Cadastrar Usuário</b>
				<?php } ?>
				</h4>

				<form id="wizard-validation-form" method="post" enctype="multipart/form-data">
					<div>
						<h3 class="">
							<span class="hidden-xs hidden-sm">Dados Pessoais</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-6">
										<label class="control-label" for="nome">
											Nome Completo *
										</label>

										<input id="nome" name="nome" type="text" class="required form-control" value="<?= @$item->nomeCompleto ?>" />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cpf">
											CPF *
										</label>

										<input id="cpf" name="cpf" type="text" class="required form-control" value="<?= @$item->cpf ?>" />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="telefone">
											Telefone *
										</label>

										<input id="telefone" name="telefone" type="text" class="required form-control" value="<?= @$item->telefone ?>" />
									</div>
								</div>

								<div class="row">
   									<div class="col-md-8">
										<label class="control-label" for="email">
											E-mail *
										</label>

										<input id="email" name="email" type="email" class="required form-control" value="<?= @$item->email ?>" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="senha">
									   		Senha *
										</label>

										<input id="senha" name="senha" type="password" class="required form-control" minlength="3" maxlength="20" value="<?= @$item->senha ?>" />
									</div>
								</div>
							</div>
						</section>

						<h3>Endereço</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-4">
										<label class="control-label" for="cidade">
											Cidade *
										</label>

										<input id="cidade" name="cidade" type="text" class="required form-control" value="<?= @$address->cidade ?>" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="cep">
											CEP *
										</label>

										<input id="cep" name="cep" type="text" class="required form-control" value="<?= @$address->cep ?>" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="estado">
											Estado *
										</label>

										<input id="estado" name="estado" type="text" minlength="2" maxlength="2" class="required form-control" style="text-transform: uppercase" value="<?= @$address->estado ?>" />
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label class="control-label" for="rua">
											Rua *
										</label>

										<input id="rua" name="rua" type="text" class="required form-control" value="<?= @$address->logradouro ?>" />
									</div>

									<div class="col-md-6">
										<label class="control-label" for="bairro">
											Bairro *
										</label>

										<input id="bairro" name="bairro" type="text" class="required form-control" value="<?= @$address->bairro ?>" />
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label class="control-label" for="numero">
											Número *
										</label>

										<input id="numero" name="numero" type="number" rangelength="[1,5]" class="required form-control" value="<?= @$address->numero ?>" />
									</div>
								</div>
							</div>
						</section>

						<h3>Imagem</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
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

						<h3>Permissões</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Observação:</strong> Nesta área você deverá selecionar qual o nível de permissão que este usuário irá possuir.

											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">
													<i class="fas fa-times" style="margin-top: 2px"></i>
												</span>
											</button>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<select name="permissao" id="permissao" class="selectpicker required form-control" data-style="btn-white" data-size="3">
										<?php foreach ($permissions as $key) : ?>
											<option value="<?= $key->idPermissao ?>"
											<?=
												(
													$key->idPermissao == 
													$item->idPermissao
												) ? 'selected' : '' 
											?>>
												<?= $key->titulo ?>
									   		</option>
									   	<?php endforeach ?>
									 	</select>
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
<script src="<?= base_url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-mask/jquery.mask.js') ?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('.datepicker').datepicker({
	   	format: "dd/mm/yyyy"
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

	$("#senha").inputFilter(function(value)
	{
		return /^-?\d*$/.test(value);
	});

	//=========

	$('#cpf').mask('999.999.999-99');

	$('#cep').mask('99.999-999');

	$('#estado').mask('aa');

	$('#telefone').mask('+55 (99) 9999-9999?9');

	//=========

	$('.form-file .input-file').on('change',function(e)
	{
		$('label[for=file]').html(
			'<strong>'+e.target.files[0].name+'</strong>'
		);

		imgPreview(this);
	});
});

//=========

function imgPreview(img)
{
	var reader = new FileReader();

	reader.onload = function(e)
	{
		$('#img-preview').html(
			'<img id="preview" class="img-circle" src="#" height="100" width="100" style="margin-top:20px" />'
		);

		$('#img-preview img').attr('src', e.target.result);
	}
		
	reader.readAsDataURL(img.files[0]);
}
</script>