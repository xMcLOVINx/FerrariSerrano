
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/summernote/summernote.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
    <div class="row page-breadcrumb v-align">
        <div class="col-md-5">
            <h4>Cadastro de pacote</h4>
        </div>

        <div class="col-md-7 text-right">
            <div class="d-flex justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('pacotes') ?>">Pacotes</a>
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
					<b>Formulário do Pacote</b>
				</h4>

				<form id="wizard-validation-form" action="#" method="post" enctype="multipart/form-data">
					<div>
						<h3 class="">
							<span class="hidden-xs hidden-sm">Informações</span>
						</h3>

						<section>
							<div class="form-group clearfix">
	                        	<div class="row">
	                        		<div class="col-md-6">
	                                    <label class="control-label" for="titulo">
	                                    	Título *
	                                    </label>

                                        <input id="titulo" name="titulo" type="text" class="form-control" required />
	                                </div>

			                        <div class="col-md-6">
			                        	<label class="control-label" for="pontos">
	                                    	Pontos *
	                                    </label>

	                                    <input id="pontos" name="pontos" type="text" class="form-control numeric" value="1" required />
			                        </div>
	                            </div>
		                    </div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Descrição</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
	                                <div class="col-md-12">
	                                    <label class="control-label" for="descricao">
	                                    	Descrição
	                                    </label>

                                        <textarea id="descricao" name="descricao" class="form-control summernote"></textarea>
	                                </div>
	                            </div>
							</div>
						</section>

						<h3 class="">
							<span class="hidden-xs hidden-sm">Imagem</span>
						</h3>

						<section>
							<div class="form-group clearfix">
								<div class="row">
	                                <div class="col-md-6 col-md-offset-3">
	                                	<div class="form-file">
											<input id="capa" name="capa" type="file" class="input-file" />

											<label for="capa">
												<strong>Selecione o Arquivo </strong>
												<span class="drap">ou Arraste</span>.
											</label>
										</div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div id="img-preview" class="col-md-6 col-md-offset-3"></div>
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
<script src="<?= base_url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.js') ?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
    $('.summernote').summernote({
        height: 150,
        minHeight: null,
        maxHeight: null,
        toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']]
		]
    });

    //=========

	$('.numeric').TouchSpin({
        min: 1,
        step: 1,
        boostat: 5,
        max: 100000000,
        maxboostedstep: 10
    });

	//=========

	$('.form-file #capa').on('change',function(e){
		$('label[for=capa]').html(
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
			'<img id="preview" class="col-md-12" src="#" height="250" style="margin-top:20px"/>'
		);

    	$('#img-preview img').attr('src', e.target.result);
    }

    reader.readAsDataURL(img.files[0]);
}
</script>
