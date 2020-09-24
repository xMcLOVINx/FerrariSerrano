
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/apexcharts/apexcharts.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Simulação de preço</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						<a href="<?= base_url('simulation') ?>">Simulações</a>
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
		<div class="col-lg-12">
			<ul class="nav nav-tabs tabs">
				<li class="active tab tab1">
					<a href="#tab1" data-toggle="tab" aria-expanded="false">
						<span class="">ÍNDICES</span>
					</a>
				</li>

				<li class="tab tab2 hidden">
					<a href="#tab2" data-toggle="tab" aria-expanded="false">
						<span class="">SIMULAÇÃO</span>
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<form id="indices" class="form" method="post">
					<div class="tab-pane active" id="tab1">
						<div class="row">
							<div class="form-group col-md-6">
								<label class="control-label" for="i-faturamento">
									Faturamento (R$) *
								</label>

								<input id="i-faturamento" name="i-faturamento" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money" value="<?= @$index->faturamento ?>" required />
							</div>

							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-impostos-real">
									Impostos (R$)
								</label>

								<input id="i-impostos-real" name="i-impostos-real" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money i-taxes" data-similar="percents" value="<?= @$index->impostosR ?>" />
							</div>

							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-impostos-percent">
									Impostos (%)
								</label>

								<input id="i-impostos-percent" name="i-impostos-percent" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control percents i-taxes" maxlength="5" data-similar="money" value="<?= @$index->impostosP ?>" />
							</div>
						</div>
	
						<div class="row">
							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="i-comissao-real">
									Comissão (R$)
								</label>

								<input id="i-comissao-real" name="i-comissao-real" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money" data-similar="percents" value="<?= @$index->comissaoR ?>" />
							</div>

							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="i-comissao-percent">
									Comissão (%)
								</label>

								<input id="i-comissao-percent" name="i-comissao-percent" type="text" inpus-tmode="numeric" pattern="[0-9]+" class="form-control percents" maxlength="5" data-similar="money" value="<?= @$index->comissaoP ?>" />
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-custos-real">
									Custos Fixos (R$) *
								</label>

								<input id="i-custos-real" name="i-custos-real" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money i-costs" data-similar="percents" value="<?= @$index->custosFixosR ?>" required />
							</div>

							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-custos-percent">
									Custos Fixos (%)
								</label>

								<input id="i-custos-percent" name="i-custos-percent" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control percents i-costs" maxlength="5" data-similar="money" value="<?= @$index->custosFixosP ?>" />
							</div>

							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-lucro-real">
									Lucro Desejado (R$)
								</label>

								<input id="i-lucro-real" name="i-lucro-real" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money" value="<?= @$index->lucroDesejadoR ?>" />
							</div>

							<div class="form-group col-md-3 col-xs-6">
								<label class="control-label" for="i-lucro-percent">
									Lucro Desejado (%)
								</label>

								<input id="i-lucro-percent" name="i-lucro-percent" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control percents" maxlength="5" value="<?= @$index->lucroDesejadoP ?>" />
							</div>
						</div>

					<?php if ($segments[2] !== "view"): ?>
						<div class="row m-t-20">
							<div class="form-group col-md-6 col-md-offset-6">
								<button id="atualizar-indices" class="btn btn-success col-xs-12" type="button" style="font-weight: bold">
										SALVAR
								</button>
							</div>
						</div>
					<?php endif; ?>
					</div>
				</form>

				<form id="simulacao" class="form" method="post">
					<div class="tab-pane" id="tab2">
						<div class="row">
						<?php if ($segments[2] == 'edit') { ?>
							<div class="form-group col-md-6">
						<?php } else { ?>
							<div class="form-group col-md-12">
						<?php } ?>
								<label class="control-label" for="produto">
									Produto
								</label>

								<input id="produto" name="produto" type="text" class="form-control step-1" maxlength="30" value="<?= @$item->produto ?>" />
							</div>

						<?php if ($segments[2] == 'edit'): ?>
							<div class="form-group col-md-6">
								<label class="control-label" for="fornecedor">
									Fornecedor
								</label>

								<input id="fornecedor" name="fornecedor" type="text" class="form-control step-1" minlength="5" maxlength="60" value="<?= @$item->fornecedor ?>" />
							</div>
						<?php endif; ?>
						</div>

						<div class="row">
							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="precoCompra">
									Preço Compra *
								</label>

								<input id="precoCompra" name="precoCompra" inputmode="numeric" pattern="[0-9]+" type="text" class="form-control money" value="<?= @$item->precoCompra ?>" required />
							</div>

							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="precoEmpate">
									Preço de Empate
								</label>

								<input id="precoEmpate" name="precoEmpate" inputmode="numeric" pattern="[0-9]+" type="text" class="form-control money" value="<?= @$simulationIndex->precoEmpate ?>" readonly />

								<input id="markup" name="markup" type="hidden" value="<?= @$simulationIndex->markup ?>" />
							</div>
						</div>

						<div class="row step-3 hidden">
							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="comissaoPercent">
									Comissão (%)
								</label>

								<input id="comissaoPercent" name="comissaoPercent" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control percents s-comission" maxlength="5" data-similar="money" value="<?= @$simulationIndex->comissaoP ?>" />
							</div>

							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="comissaoReal">
									Comissão (R$)
								</label>

								<input id="comissaoReal" name="comissaoReal" type="text" inputmode="numeric" pattern="[0-9]+" class="form-control money s-comission" data-similar="percents" value="<?= @$simulationIndex->comissaoR ?>" />
							</div>
						</div>

						<div class="row step-3 hidden">
							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="lucroPercent">
									Lucro/Prejuízo (%)
								</label>

								<input id="lucroPercent" name="lucroPercent" inputmode="numeric" pattern="[0-9]+" type="text" class="form-control percents" maxlength="5" value="<?= @$simulationIndex->lucroDesejadoP ?>" />
							</div>

							<div class="form-group col-md-6 col-xs-6">
								<label class="control-label" for="lucroReal">
									Lucro/Prejuízo (R$)
								</label>

								<input id="lucroReal" name="lucroReal" inputmode="numeric" pattern="[0-9]+" type="text" class="form-control money" value="<?= @$simulationIndex->lucroDesejadoR ?>" />
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6 col-xs-6 step-3 hidden">
								<label class="control-label" for="precoVenda">
									Preço Venda
								</label>

								<input id="precoVenda" name="precoVenda" inputmode="numeric" pattern="[0-9]+" type="text" class="form-control money" value="<?= @$item->precoVenda ?>" />
							</div>
						</div>

						<div class="row hidden">
							<input id="tipo" name="tipo" type="hidden" value="<?= @$item->tipo ?>" required />
						</div>

						<div class="row">
							<div class="form-group col-md-4 col-xs-4" style="margin-top: 1px">
								<label class="control-label">&nbsp;</label>

								<button id="simular" class="btn btn-danger col-xs-12" type="button" style="font-weight: bold">
									CALCULAR
								</button>
							</div>

							<div class="form-group col-md-4 col-xs-4" style="margin-top: 1px">
								<label class="control-label">&nbsp;</label>

								<button id="resetar" class="btn btn-danger col-xs-12" type="button" style="font-weight: bold">
									LIMPAR
								</button>
							</div>

						<?php if ($segments[2] !== "view"): ?>
							<div class="form-group col-md-4 col-xs-4" style="margin-top: 1px">
								<label class="control-label">&nbsp;</label>

								<button id="salvar" class="btn btn-success col-xs-12" type="button" style="font-weight: bold" disabled>
									SALVAR
								</button>
							</div>
						<?php endif; ?>
						</div>

						<div class="step-3 hidden">
							<div class="row">
								<div class="col-md-12 bit-progress" style="padding: 20px">
									<h3 class="progress-title" style="text-align: left">Lucro(+)/Prejuizo(-)</h3>

									<div class="bit progress red">
										<div id="bar-lucro" class="progress-bar" style="width:0%; background:#c0392b;">
											<div class="progress-value">0%</div>
										</div>
									</div>

									<h3 class="progress-title" style="text-align: left">Custos Fixos</h3>

									<div class="bit progress blue">
										<div id="bar-cf" class="progress-bar" style="width:0%; background:#3485ef;">
											<div class="progress-value">0%</div>
										</div>
									</div>

									<h3 class="progress-title" style="text-align: left">Comissões</h3>

									<div class="bit progress yellow">
										<div id="bar-comissao" class="progress-bar" style="width:0%; background:#e8d324;">
											<div class="progress-value">0%</div>
										</div>
									</div>

									<h3 class="progress-title" style="text-align: left">Tributos</h3>

									<div class="bit progress green">
										<div id="bar-tributos" class="progress-bar" style="width:0%; background:#5fad56;">
											<div class="progress-value">0%</div>
										</div>
									</div>

									<h3 class="progress-title" style="text-align: left">
										Preço de Compra
									</h3>

									<div class="bit progress pink">
										<div id="bar-pa" class="progress-bar" style="width:0%; background:#ff4b7d;">
											<div class="progress-value">0%</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/simple.mask/simple.mask.js') ?>"></script>

<script src="<?= base_url('assets/pages/product/mask.js') ?>"></script>
<script src="<?= base_url('assets/pages/product/logic.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
<?php if ($index && !isset($segments[3])): ?>
	execStep2();
<?php endif; ?>

<?php if (isset($segments[3])): ?>
	execStep2(true, <?= $segments[3] ?>);

<?php if ($segments[2] == "create"): ?>
	$('#lucro').val($('#i-lucro-percent').val());
<?php endif; ?>

	$('#simular').trigger('click');
<?php endif; ?>
});
</script>

