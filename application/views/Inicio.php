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
							$txt= "Estimado(a) docente, para la Secretaría de Educación del Gobierno de Yucatán es necesario disponer de información válida y confiable que garantice la correcta evaluación del personal del Servicio Profesional Docente. El objetivo de esta plataforma es contar con una herramienta tecnológica que permita actualizar la información del personal docente, directivo, de supervisión y asesoría técnica pedagógica del estado de Yucatán.
 
							Para actualizar su información, es necesario seleccionar su nombre, ubicado en la esquina superior derecha de la pantalla, y escoger la opción Perfil.";
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