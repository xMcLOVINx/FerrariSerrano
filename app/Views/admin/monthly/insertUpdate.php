
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
		<?php if ($segments[2] == 'update') { ?>
			<h4>Modificar mensalidade</h4>
		<?php } else { ?>
			<h4>Cadastrar mensalidade</h4>
		<?php } ?>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						<a href="<?= base_url('mensalidades') ?>">Mensalidades</a>
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
					<b>Modificar Mensalidade</b>
				<?php } else { ?>
					<b>Cadastrar Mensalidade</b>
				<?php } ?>
				</h4>

				<form id="wizard-validation-form" method="post">
					<div>
						<h3>Detalhes</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-8">
										<label class="control-label" for="cliente">
											Cliente *
										</label>

										<input id="cliente" name="cliente" type="text" class="form-control" value="<?= @$client->razaoSocial ?>" <?= ($segments[2] !== 'update') ?: "readonly" ?> required />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="lancamento">
											Data Lançamento *
										</label>

										<input id="lancamento" name="lancamento" type="text" class="required form-control datepicker" placeholder="dia/mes/ano" value="<?= ($segments[2] == 'update') ? convertDate($item->dataLancamento) : date('d/m/Y') ?>" <?= ($segments[2] !== 'update') ?: "readonly" ?> />
									</div>
								</div>

								<div id="client-details" class="row <?= ($segments[2] == 'update') ?: "hidden" ?>">
									<div class="col-md-3">
										<label class="control-label" for="cliente-id">
											ID *
										</label>

										<input id="cliente-id" name="cliente-id" type="text" class="form-control" value="<?= @$client->idUsuario ?>" readonly />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-cnpj">
											CNPJ *
										</label>

										<input id="cliente-cnpj" name="cliente-cnpj" type="text" class="form-control" value="<?= @$client->cnpj ?>" readonly />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-telefone">
											Telefone *
										</label>

										<input id="cliente-telefone" name="cliente-telefone" type="text" class="form-control" value="<?= @$client->telefone ?>" readonly />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-cadastro">
											Data Cadastro *
										</label>

										<input id="cliente-cadastro" name="cliente-cadastro" type="text" class="form-control" value="<?= @convertDate($client->dataCadastro) ?>" readonly />
									</div>
								</div>
							</div>
						</section>

						<h3>Parcelas</h3>

						<section>
							<div class="form-group clearfix">
							<?php if ($segments[2] !== 'update') : ?>
								<div class="row">
									<div class="col-md-12 installment-error hidden">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Error:</strong> Obrigatório preencher todos os campos.
										</div>
									</div>

									<div class="col-md-12">
										<div class="portlet">
											<div class="portlet-heading">
												<h3 class="portlet-title text-dark text-uppercase">
													ADICIONAR PARCELA
												</h3>

												<div class="clearfix"></div>
											</div>

											<div id="portlet2" class="panel-collapse collapse in">
												<div class="portlet-body">
													<div class="form-group clearfix">
														<div class="row">
															<div class="col-md-12 error_msg_parcela hidden">
																<div class="alert alert-danger alert-dismissible" role="alert">
																	<strong style="color: #000">Error:</strong> Obrigatório selecionar o parcelamento.
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-8">
																<label class="control-label" for="parcelamento">
																	Parcelamento *
																</label>

																<input id="parcelamento" name="parcelamento" type="text" class="form-control" placeholder="Autocomplete..." />
																<input id="parcelamento-id" name="parcelamento-id" type="hidden" />
															</div>

															<div class="col-md-4">
																<label class="control-label" for="valor-servico">
																	Valor Serviço *
																</label>

																<input id="valor-servico" name="valor-servico" type="text" class="form-control price" readonly />
															</div>

															<div class="col-md-4">
																<label class="control-label" for="parcelamento-parcelas">
																	Mêses *
																</label>

																<input id="parcelamento-parcelas" name="parcelamento-parcelas" type="text" class="form-control quantity" value="1" readonly />
															</div>

															<div class="col-md-4">
																<label class="control-label" for="parcelamento-desconto">
																	Desconto *
																</label>

																<input id="parcelamento-desconto" name="parcelamento-desconto" type="text" class="form-control discount" value="0.00" readonly />
															</div>

															<div class="col-md-4">
																<label class="control-label" for="parcelamento-valor">
																	Valor Parcelas *
																</label>

																<input id="parcelamento-valor" name="parcelamento-valor" type="text" class="form-control price" value="1.00" readonly />
															</div>
														</div>

														<div class="row">
															<div class="col-md-3 col-md-offset-9">
																<label class="control-label">
																	&nbsp;
																</label>

																<button type="button" class="form-control col-sm-12 btn btn-success insert">
																	<i class="fas fa-plus"></i> ADICIONAR
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif ?>

							<?php if (isset($invoices)) : ?>
								<div class="row">
									<div class="col-md-12 parcelas">
										<table id="datatable" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th></th>
													<th>Data Vencimento</th>
													<th>Valor Parcela</th>
													<th class="text-center">Situação</th>
												</tr>
											</thead>

											<tbody class="parcelas">
											<?php foreach ($invoices as $item) : ?>
												<tr>
													<td class="text-center" width="50">
														<div class="custom-checkbox">
															<input type="checkbox" id="checkbox_<?= $item->idMensalidadeParcela ?>" name="parcela[]" value="<?= $item->idMensalidadeParcela ?>" <?= ($item->pago == 0) ?: "checked disabled" ?> />
															<label for="checkbox_<?= $item->idMensalidadeParcela ?>"></label>
														</div>
													</td>

													<td>
														<?= date('d/m/Y', strtotime($item->dataVencimento)) ?>
													</td>

													<td>
														R$ <span class="valor"><?= number_format($item->valorParcela, 2, ',', '.') ?></span>
													</td>

													<td class="text-center">
													<?php
														if (
															$item->pago == 0 &&
															date('Y-m-d') >
															strtotime($item->dataVencimento)
														) {
													?>
														<span class="label label-table label-danger" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
															Atrasado
														</span>
													<?php } else if ($item->pago == 0) { ?>
														<span class="label label-table label-primary" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
															Pendente
														</span>
													<?php } else { ?>
														<span class="label label-table label-success" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
															Concluído
														</span>
													<?php } ?>
													</td>
												</tr>
											<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							<?php endif ?>
							</div>
						</section>

					<?php if ($segments[2] == 'update') : ?>
						<h3>Faturar</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Observação:</strong> Caso deseje faturar as parcelas selecionadas, clique no botão abaixo e preencha corretamente os campos.

											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">
													<i class="fas fa-times" style="margin-top: 2px"></i>
												</span>
											</button>
										</div>
									</div>

									<div class="col-md-12 payment-error hidden">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<strong style="color: #000">Error:</strong> Obrigatório selecionar pelo menos uma parcela.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12" style="font-weight: bold">
										<h2 class="text-center">ATENÇÃO</h2>
										<h4 class="text-center">
											ESTÁ É UMA OPERAÇÃO IRREVERSÍVEL!
										</h4>
									</div>
								</div>

								<br />

								<div class="row">
									<div class="col-md-4 col-md-offset-4">
										<button id="faturar" type="button" class="btn btn-danger col-md-12" style="padding: 15px; font-weight: bold; border-radius: 0">
											FATURAR
										</button>
									</div>
								</div>
							</div>
						</section>
					<?php endif ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="bill-modal" class="modal-demo">
	<div class="header">
		<button type="button" class="close" onclick="Custombox.close()">
			<i class="fas fa-times"></i>
		</button>

		<h4 class="custom-modal-title">Faturar Parcela</h4>
	</div>

	<div class="modal-form">
		<form id="faturar-parcela" class="form">
			<div class="modal-body">
				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações da Fatura</b>
					</h4>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="valor">
								Valor Total *
							</label>

							<input id="valor" name="valor" type="text" class="form-control price" value="1" disabled />
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="recebimento">
								Data Recebimento *
							</label>

							<input id="recebimento" name="recebimento" type="text" class="required form-control datepicker" placeholder="dia/mes/ano" value="<?= date('d/m/Y') ?>" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6" style="position: relative; z-index: -1">
						<div class="form-group">
							<label class="control-label" for="metodo">
								Método Pagamento *
							</label>

							<select id="metodo" name="metodo" class="selectpicker required form-control" data-style="btn-white" data-size="3">
								<option value="1">Cartão</option>
								<option value="0" selected>Dinheiro</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer" style="position: relative; z-index: -1">
				<button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" onclick="Custombox.close()">
					<i class="fas fa-times"></i> Fechar
				</button>

				<button type="submit" class="btn btn-success waves-effect waves-light">
					<i class="fas fa-check"></i> Faturar
				</button>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.js') ?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('.datepicker').datepicker({
	   	format: "dd/mm/yyyy"
	});

	//=========

	$('.discount').TouchSpin({
		min: 0,
		step: 1,
		max: 100,
		boostat: 5,
		postfix: '%',
		maxboostedstep: 10
	});

	$('.quantity').TouchSpin({
		min: 1,
		boostat: 5
	});

	//=========

	$(document).ready(function()
	{
		$.ajax(
		{
			url: '<?= base_url('admin/configurations/get/price') ?>',
			dataType: 'json',
			success:function(data)
			{
				$('#valor-servico').val(
					data.success ? data.price : 1.00
				);
			}
		});
	});

	//=========

	$('#cliente').autocomplete(
	{
		source:function(request, response)
		{
			$.ajax ({
				url: '<?= base_url('admin/clients/search') ?>',
				type: 'post',
				dataType: 'json',
				data: {
					search: request.term
				},
				success:function(data)
				{
					if (!data.success) {
						return false;
					}

					response(data.results.slice(0, 3));
				}
			});
		},
		select:function(event, ui)
		{
			$('#client-details').removeClass('hidden');
			$('#cliente-id').val(ui.item.value);
			$('#cliente').val(ui.item.label);

			$('#cliente-cnpj').val(ui.item.extras.cnpj);
			$('#cliente-telefone').val(ui.item.extras.phone);
			$('#cliente-cadastro').val(ui.item.extras.registerDate);

			return false;
		},
		change:function(event, ui)
		{
			if (ui.item === null) {
				$('#client-details').addClass('hidden');
				$('#client-details input').val('');
			}

			return false;
		}
	});

	//=========

	$('#parcelamento').autocomplete(
	{
		source:function(request, response)
		{
			$.ajax ({
				url: '<?= base_url('admin/installments/search') ?>',
				type: 'post',
				dataType: 'json',
				data: {
					search: request.term
				},
				success:function(data)
				{
					if (!data.success) {
						return false;
					}

					response(data.results.slice(0, 3));
				}
			});
		},
		select:function(event, ui)
		{
			let serviceValue = $("#valor-servico").val();

			$('#parcelamento-id').val(ui.item.value);
			$('#parcelamento').val(ui.item.label);

			$('#parcelamento-parcelas').val(ui.item.extras.installment);
			$('#parcelamento-desconto').val(ui.item.extras.discount);

			$('#parcelamento-valor').val((
				(serviceValue - ((serviceValue * ui.item.extras.discount) / 100)) /
				(ui.item.extras.installment)
			).toFixed(2));

			return false;
		},
		change:function(event, ui)
		{
			if (ui.item === null) {
				$('#parcelamento').val('');
				$('#parcelamento-id').val('');

				$('#parcelamento-parcelas').val('1');
				$('#parcelamento-desconto').val('0.00');
				$('#parcelamento-valor').val('1.00');
			}

			return false;
		}
	});

	//=========

	$('.btn.insert').on('click', function()
	{
		var installment = $('#parcelamento-id');

		if (installment.val() == '') {
			$('.installment-error')
			   .removeClass('hidden')
			   .delay(8000)
			   .queue(function(n)
		   	{
				$(this).addClass('hidden');
				n();
			});

			return false;
		}

		return $('form#wizard-validation-form').submit();
	});

	//=========

	$('#faturar').on('click', function()
	{
		var totalSelecionado = 0;

		$.each($('.parcelas input'), function(index)
		{
			if (this.checked && !this.disabled) {
				totalSelecionado += (Number(
					$('.parcelas span.valor')
						.eq(index)
						.text()
						.replace('.', '')
						.replace(',', '.')
				));
			}
		});

		if(totalSelecionado <= 0)
		{
			$('.payment-error')
			   .removeClass('hidden')
			   .delay(8000)
			   .queue(function(n)
		   	{
				$(this).addClass('hidden');
				n();
			});

			return;
		}

		$('#valor').val(totalSelecionado.toFixed(2));

		Custombox.open({
			target: '#bill-modal',
			overlayColor: '#36404a',
			overlaySpeed: '100',
			effect: 'flash'
		});
	});

	//=========

<?php if ($segments[2] == 'update') : ?>
	$('form#faturar-parcela').on('submit', function(e)
	{
		e.preventDefault();

		if (!$('form#faturar-parcela').valid()) {
			return false;
		}

		$.ajax ({
			url: '<?= base_url('admin/monthly/pay/' . $segments[3]) ?>',
			type: 'post',
			dataType: 'json',
			data: {
				parcelas: $('input[name="parcela[]"]').serialize(),
				dataRecebimento: $('#recebimento').val(),
				metodoPgd: $('#metodo').val()
			},
			success:function(data)
			{
				if (data.success == true) {
					location.reload();
				}
			}
		});
	});
<?php endif ?>
});
</script>
