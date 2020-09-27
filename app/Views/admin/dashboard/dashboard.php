
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet"/>
<link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet"/>
<link href="<?= base_url('assets/plugins/morris/morris.css') ?>" rel="stylesheet"/>

<style type="text/css">
.morris-hover.morris-default-style {
	background-color: #36404a;
	border-radius: 5px;
	padding: 10px 12px;
	color: #ffffff;
	border: none;
}
</style>

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Inicio do sistema</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="javascript:void(0)">Inicio do Sistema</a>
					</li>

					<li class="breadcrumb-item active">
						Inicio do Sistema
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-handshake text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">321</b>
					</h3>

					<p class="text-muted">Mensalidades Pagas</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-hourglass-half text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">23</b>
					</h3>

					<p class="text-muted">Mensalidades Vencendo</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-users text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter"><?= $count['clients'] ?></b>
					</h3>

					<p class="text-muted">Total de Clientes</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark text-uppercase">
						Mensalidades Vencendo
					</h3>

					<div class="clearfix"></div>
				</div>

				<div id="portlet2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered datatable">
								<thead>
									<tr>
										<th>#</th>
										<th>Cliente</th>
										<th>Data Vencimento</th>
										<th>Valor</th>
										<th class="actions">
											<i class="fas fa-cog"></i>
										</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>1</td>

										<td>Henrique Maquinas de Lavar LTDA</td>

										<td>01/01/2015</td>

										<td>R$ 300,00</td>

										<td class="actions" width="100">
											<a href="<?= base_url('assetstas/viagem/1') ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Visualizar">
												<i class="md md-remove-red-eye"></i>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">Preço das Moedas em Real Nos Últimos 7 Dias</h3>

					<div class="clearfix"></div>
				</div>

				<div id="bg-default2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<div class="text-center">
							<ul class="list-inline chart-detail-list">
								<li>
									<h5>
										<i class="fa fa-circle m-r-5" style="color: #1e88e5"></i>Dólar
									</h5>
								</li>

								<li>
									<h5>
										<i class="fa fa-circle m-r-5" style="color: #ff3321"></i>Euro
									</h5>
								</li>
							</ul>
						</div>

						<div id="morris-currency-flag" style="height: 300px;"></div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
			jQuery(document).ready(function()
			{
				window.onload = async () => {
					const dollarResponse = await fetch(
						'https://economia.awesomeapi.com.br/json/daily/USD-BRL/7'
					);
					const euroResponse = await fetch(
						'https://economia.awesomeapi.com.br/json/daily/EUR-BRL/7'
					);
					const dollar = await dollarResponse.json();
					const euro = await euroResponse.json();

					let chartValues = [];
					let day = new Date();

					for(let i = 0; i < 7; i++) {
						chartValues.push({
							y: await day.toLocaleString('pt-BR', {
								day: 'numeric',
								month: 'numeric'
							}).split(' ').join('/'),
							a: dollar[i].bid,
							b: euro[i].bid
						});

						day.setDate(day.getDate() - 1);
					}

					let graph = window.areaChart = Morris.Line({
						element: 'morris-currency-flag',
						data: chartValues.sort().reverse(),
						xkey: 'y',
						ykeys: ['a', 'b'],

						lineColors: ['#1e88e5','#ff3321'],
						labels: ['Dólar', 'Euro'],
						hideHover: 'auto',
						parseTime: false,
						lineWidth: '3px',
						resize: true,
						redraw: true
					});
				};
			});
			</script>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?= base_url('assets/plugins/raphael/raphael-min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/morris/morris.min.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('.datatable').dataTable();
});
</script>
