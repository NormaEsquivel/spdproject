<?php
include('Header.php');
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<div class="bs-example" data-example-id="simple-jumbotron">
					<div class="jumbotron">
						<h1>Sistema de Gesti&oacute;n para el Servicio Profesional Docente.</h1>
						<h3>¡Bienvenido(a)!</h3>
						<br/>
						<br/>

						<!--<h4>Instrucciones</h4>-->
						<ul>
						<?php
						$txt="";
						if($this->session->userdata('idTipoPersona')=="3")
						{
							$txt= "A continuaci&oacute;n como usuario de nivel, usted podr&aacute; validar la informaci&oacute;n del usuario que ya haya verificado previamente su informaci&oacute;n personal, es decir, que puede tener la seguidad que la informaci&oacute;n que s est&aacute; trabajando es 100% confiable pues viene de mano del docente.";
						}
						if($this->session->userdata('idTipoPersona')=="2")
						{
							$txt= "Para nosotros, es muy importante tener un acercamiento con usted, es por eso que esta plataforma nos ayudar&aacute; a mantenerlo actualizado sobre su informaci&oacute;n hist&oacute;rica sobre los proesos que se realizan y/o se han realizado.";
						}
						?>
							<li><?php echo $txt; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<script type="text/javascript">
  $("li#inicio").css("background-color", "#056453");
  var ah = $("li#inicio").find("a");
  ah.css("color", "#fff");
</script>

<?php
include('Footer.php');
?>