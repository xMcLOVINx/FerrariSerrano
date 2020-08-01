
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
		<div class="col-md-6">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-handshake text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">321</b>
					</h3>

					<p class="text-muted">Vendas Concluídas</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-hourglass-half text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">23</b>
					</h3>

					<p class="text-muted">Vendas Pendentes</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-boxes text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">22</b>
					</h3>

					<p class="text-muted">Total de Pacotes</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="widget-bg-color-icon card-box">
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fas fa-users text-info"></i>
				</div>

				<div class="text-right">
					<h3 class="text-dark">
						<b class="counter">13321</b>
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
						Vendas Vencendo
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
										<i class="fa fa-circle m-r-5" style="color: #1e88e5"></i>Dollar
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
				window.areaChart = Morris.Line({
					element: 'morris-currency-flag',
					data: [
						{ y: '20/03', a: 3.45, b: 4.10 },
						{ y: '21/03', a: 3.60, b: 4.15 },
						{ y: '22/03', a: 3.20, b: 4.00 },
						{ y: '23/03', a: 4.10, b: 4.30 },
						{ y: '24/03', a: 4.33, b: 4.60 },
						{ y: '25/03', a: 4.56, b: 5.06 },
						{ y: '26/03', a: 4.80, b: 4.83 }
					],
					xkey: 'y',
					ykeys: ['a', 'b'],

					lineColors: ['#1e88e5','#ff3321'],
					labels: ['Dollar', 'Euro'],
					hideHover: 'auto',
					parseTime: false,
					lineWidth: '3px',
					resize: true,
					redraw: true
				});
			});
			</script>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">Vendas Nos Últimos 7 Dias</h3>

					<div class="clearfix"></div>
				</div>

				<div id="bg-default2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<div id="morris-sales" style="height: 300px"></div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
			jQuery(document).ready(function()
			{
				window.areaChart = Morris.Line({
					element: 'morris-sales',
					data: [
						{ y: '20/03', a: 1 },
						{ y: '21/03', a: 75 },
						{ y: '22/03', a: 50 },
						{ y: '23/03', a: 75 },
						{ y: '24/03', a: 50 },
						{ y: '25/03', a: 75 },
						{ y: '26/03', a: 100 }
					],
					xkey: 'y',
					ykeys: ['a'],

					lineColors: ['#1e88e5'],
					labels: ['Quantidade'],
					hideHover: 'auto',
					parseTime: false,
					lineWidth: '3px',
					resize: true,
					redraw: true
				});
			});
			</script>
		</div>

		<div class="col-sm-6">
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">Situação das Vendas</h3>

					<div class="clearfix"></div>
				</div>

				<div id="bg-default2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<div id="morris-my-sales-percent" style="height: 300px"></div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
			jQuery(document).ready(function()
			{
				window.areaChart = Morris.Donut({
					element: 'morris-my-sales-percent',
					data: [
						{label: "Concluídas", value: 70},
						{label: "Pendentes", value: 30}
					],
					formatter: function (x) { return x + "%"},

					colors: ['#1e88e5','#ff3321'],
					resize: true,
				});
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
