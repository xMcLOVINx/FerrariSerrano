
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Adicionar venda</h4>
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

					<li class="breadcrumb-item active">
						Adicionar
					</li>
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
					<b>Atualizar Mensalidade</b>
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

										<input id="cliente" name="cliente" type="text" class="form-control" required />
									</div>

									<div class="col-md-4">
										<label class="control-label" for="lancamento">
											Data Lançamento *
										</label>

										<input id="lancamento" name="lancamento" type="text" class="required form-control datepicker" placeholder="dia/mes/ano" value="<?= date('d/m/Y') ?>" />
									</div>
								</div>

								<div id="client-details" class="row hidden">
									<div class="col-md-3">
										<label class="control-label" for="cliente-id">
											ID *
										</label>

										<input id="cliente-id" name="cliente-id" type="text" class="form-control" disabled />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-cnpj">
											CNPJ *
										</label>

										<input id="cliente-cnpj" name="cliente-cnpj" type="text" class="form-control" disabled />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-telefone">
											Telefone *
										</label>

										<input id="cliente-telefone" name="cliente-telefone" type="text" class="form-control" disabled />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="cliente-cadastro">
											Data Cadastro *
										</label>

										<input id="cliente-cadastro" name="cliente-cadastro" type="text" class="form-control" disabled />
									</div>
								</div>
							</div>
						</section>

						<h3>Parcelas</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
									<div class="col-md-12 error_msg_parcela hidden">
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
															<div class="col-md-6">
																<label class="control-label" for="parcelamento">
																	Parcelamento *
																</label>

																<input id="parcelamento" type="text" class="form-control" placeholder="Autocomplete..." />
															</div>

															<div class="col-md-3">
																<label class="control-label" for="meses-parcelamento">
																	Mêses *
																</label>

																<input id="meses-parcelamento" name="meses-parcelamento" type="text" class="form-control quantity" value="1" disabled />
															</div>

															<div class="col-md-3">
																<label class="control-label" for="parcelamento-desconto">
																	Desconto *
																</label>

																<input id="parcelamento-desconto" name="parcelamento-desconto" type="text" class="form-control discount" value="0" disabled />
															</div>
														</div>

														<div class="row">
															<div class="col-md-3 col-md-offset-9">
																<label class="control-label">
																	&nbsp;
																</label>

																<button class="form-control col-sm-12 btn btn-success adicionar" type="button">
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

								<div class="row">
									<div class="col-md-12 parcelas">
										<table id="datatable" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th></th>
													<th>Data Vencimento</th>
													<th>Valor Parcela</th>
													<th class="text-center">Situação</th>
													<th class="text-center">
														<i class="fas fa-cog"></i>
													</th>
												</tr>
											</thead>

											<tbody>
												<tr>
													<td class="text-center" width="50">
														<div class="custom-checkbox">
															<input type="checkbox" id="checkbox_" name="faturar[]" value="" />
															<label for="checkbox_"></label>
														</div>
													</td>

													<td></td>

													<td>
														R$ <span class="valor"></span>
													</td>

													<td class="text-center">
														<span class="label label-table label-success" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
															Pago
														</span>

														<span class="label label-table label-danger" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
															Pendente
														</span>
													</td>

													<td class="text-center actions">
														<a href="javascript:void(0);" data-id="" class="table-action-btn btn-remove-parcela" data-toggle="tooltip" data-placement="top" title="Deletar">
															<i class="md md-close"></i>
														</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</section>

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

									<div class="col-md-12 error_msg_selecionado hidden">
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

		<h4 class="custom-modal-title">Faturar Venda</h4>
	</div>

	<div class="modal-form">
		<form class="form">
			<div class="modal-body">
				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações da Fatura</b>
					</h4>

					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label" for="descricao">
								Descrição
							</label>

							<input id="descricao" name="descricao" type="text" class="required form-control" />
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="vencimento">
								Data Vencimento *
							</label>

							<input id="vencimento" name="vencimento" type="text" class="required form-control picker" placeholder="dia/mes/ano" disabled />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="valor">
								Valor *
							</label>

							<input id="valor" name="valor" type="text" class="form-control price" value="1" />
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="desconto">
								Desconto *
							</label>

							<input id="desconto" name="desconto" type="text" class="form-control discount" value="0" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group" style="position: relative; z-index: 1">
							<label class="control-label" for="recebido">
								Recebido *
							</label>

							<select name="recebido" id="recebido" class="selectpicker required form-control" data-style="btn-white" data-size="3">
								<option value="1">Sim</option>
								<option value="0" selected>Não</option>
							</select>
						</div>
					</div>

					<div class="col-md-6 billed hidden">
						<div class="form-group">
							<label class="control-label" for="recebimento">
								Data Recebimento *
							</label>

							<input id="recebimento" name="recebimento" type="text" class="required form-control picker" placeholder="dia/mes/ano" />
						</div>
					</div>

					<div class="col-md-6 billed hidden" style="position: relative; z-index: -1">
						<div class="form-group">
							<label class="control-label" for="metodo">
								Método Pagamento *
							</label>

							<select name="metodo" id="metodo" class="selectpicker required form-control" data-style="btn-white" data-size="3">
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
		min: 1,
		step: 1,
		max: 100,
		boostat: 5,
		suffix: '%',
		maxboostedstep: 10
	});

	$('.quantity').TouchSpin({
		min: 1,
		boostat: 5
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

	$('#faturar').on('click', function(e)
	{
		Custombox.open({
			target: '#bill-modal',
			overlayColor: '#36404a',
			overlaySpeed: '100',
			effect: 'flash'
		});

		e.preventDefault();
	});

	$('#bill-modal #recebido').on('change', function(e)
	{
		if ($('#bill-modal #recebido option:selected').val() == 1) {
			$('#bill-modal .billed').removeClass('hidden');
		} else {
			$('#bill-modal .billed').addClass('hidden');
		}

		e.preventDefault();
	});
});
</script>
