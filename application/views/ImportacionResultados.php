<?php
include('Header.php');
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
        <div class="page-title">
			<div class="title_left">
				<h3>Importar Datos</h3>
			</div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Carga de archivos</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<p>Seleccione un archivo para subir a la plataforma.</p>
						<form action="<?php echo $raiz;?>importando" class="dropzone">
							<div class="fallback">
								<input name="file" type="file" multiple />
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">
  $("li#importacionresult").css("background-color", "#056453");
  var ah = $("li#importacionresult").find("a");
  ah.css("color", "#fff");
</script>
<?php
include('Footer.php');
?>