
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>" rel="stylesheet"/>

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
		<?php if ($segments[2] == 'update') { ?>
			<h4>Modificar parcelamento</h4>
		<?php } else { ?>
			<h4>Cadastrar parcelamento</h4>
		<?php } ?>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						<a href="<?= base_url('installments') ?>">Parcelamentos</a>
					</li>

				<?php if ($segments[2] == 'update') { ?>
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
				<?php if ($segments[2] == 'update') { ?>
					<b>Modificar Parcelamento</b>
				<?php } else { ?>
					<b>Cadastrar Parcelamento</b>
				<?php } ?>
				</h4>

				<form id="wizard-validation-form" method="post" enctype="multipart/form-data">
					<div>
						<h3 class="">
							<span class="hidden-xs hidden-sm">Detalhes</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-8">
										<label class="control-label" for="titulo">
											Título *
										</label>

										<input id="titulo" name="titulo" type="text" class="required form-control" value="<?= @$item->titulo ?>" maxlength="45" minlength="5" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="valor-servico">
											Valor Serviço *
										</label>

										<input id="valor-servico" ;name="valor-servico" ;type="text" class="required form-control price" value="<?= $configurations->valorServico ?>" disabled />
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<label class="control-label" for="parcelas">
											Quantidade Parcelas *
										</label>

										<input id="parcelas" name="parcelas" type="text" class="required form-control quantity" value="<?= @$item->parcelas ?? "1" ?>" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="desconto">
											Desconto *
										</label>

										<input id="desconto" name="desconto" type="text" class="required form-control discount" value="<?= @$item->desconto ?? "0.00" ?>" />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="valor-parcela">
											Valor Parcela *
										</label>

										<input id="valor-parcela" name="valor-parcela" type="text" class="required form-control price" value="0.00" disabled />
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
											<input id="image" name="image" type="file" class="input-file" />

											<label for="image">
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
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.js')?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	(function($)
	{
		$.fn.decimalFormat = function()
		{
			this.each( function(i)
			{
				$(this).change(function(e)
				{
					if(isNaN(parseFloat(this.value))) return;
					
					this.value = parseFloat(this.value).toFixed(2);
				});
			});

			return this;
		}
	})(jQuery);

	$('.discount').TouchSpin({
		min: 0,
		max: 100,
		boostat: 5,
		postfix: '%',
		maxboostedstep: 10,
		forcestepdivisibility: 'none'
    }).decimalFormat();

	$('.quantity').TouchSpin({
		min: 1,
		boostat: 5
	});

	//=========

	$('.form-file .input-file').on('change',function(e)
	{
		$('label[for=file]').html(
			'<strong>'+e.target.files[0].name+'</strong>'
		);

		imgPreview(this);
	});

	//=========

	$('#parcelas, #desconto').on('change', function()
	{
		setInstallmentPrice();
	});
});

//=========

function setInstallmentPrice()
{
	let serviceValue = Number($('#valor-servico').val());
	let installment = Number($('#parcelas').val());
	let discount = Number($('#desconto').val());

	$('#valor-parcela').val((
		(serviceValue - ((serviceValue * discount) / 100)) /
		(installment)
	).toFixed(2));
}

//=========

function imgPreview(img)
{
	var reader = new FileReader();

	reader.onload = function(e){
		$('#img-preview').html(
			'<img id="preview" class="img-circle" src="#" height="100" width="100" style="margin-top:20px" />'
		);

		$('#img-preview img').attr('src', e.target.result);
	}
		
	reader.readAsDataURL(img.files[0]);
}

<?php if ($segments[2] == 'update'): ?>
	setInstallmentPrice();
<?php endif; ?>
</script>