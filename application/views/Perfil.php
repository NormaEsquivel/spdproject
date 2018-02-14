<?php
include('Header.php');
?>
<script type="text/javascript">
	function Confirma(){
		var respuesta=confirm("He revisado la información y confirmo que mis datos son correctos");
		if(respuesta==true)

		else
			return 0;
	}
</script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Perfil del Usuario</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<form action="<?php echo $raiz.'up'?>" method="post"  enctype="multipart/form-data" onSubmit="if(!confirm('He revisado la información y confirmo que mis datos son correctos')){return false;}">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="x_panel">
						<div class="x_title">
							<h3>Foto de Perfil</h3>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="col-md-6 col-sm-6 col-xs-6 ">
								<div class="profile_img">
									<div id="crop-avatar">
									<!-- Current avatar -->
										<img class="img-responsive avatar-view" src="<?php echo $raiz.'resources/profile/'.$img?>" alt="Avatar" title="Change the avatar">
									</div>
								</div>
								<div>
									<h3>Cambiar Imagen:</h3>
									<input type="file" name="file"></input>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="x_panel">
						<div class="x_title">
							<h3>Mis Datos</h3>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="alert alert-warning alert-dismissible fade in" role="alert">
								</button>
								<strong>Estimado docente, favor de revisar sus datos y si es necesario realizar los cambios pertinentes. En caso de detectar que el RFC y/o CURP son incorrectos, favor de acudir a su nivel educativo, con los documentos probatorios correspondientes, para realizar la modificaci&oacute;n.
Una vez realizados los ajustes presionar el bot&oacute;n de "Actualizar informaci&oacute;n" o si los datos son correctos, presionar el bot&oacute;n de "Guardar".</strong>
							</div>
							<i class="fa fa-user user-profile-icon"></i>
							<label>Primer Apellido:</label> <input type="text" name="Apaterno" class="form-control" required="required" value="<?php echo $primerApellido;?>" maxlength="15">
							<i class="fa fa-user user-profile-icon"></i>
							<label>Segundo Apellido:</label> <input type="text" name="AMaterno" class="form-control" required="required" value="<?php echo $segundoApellido;?>" maxlength="100">
							<i class="fa fa-user user-profile-icon"></i>
							<label>Nombre(s):</label> <input type="text" name="Nombre" class="form-control" required="required" value="<?php echo $primerNombre;?>" maxlength="15">

							<ul class="list-unstyled user_data">
								<li>
									<i class="fa fa-barcode user-profile-icon"></i>
									<label>CURP:</label> <input type="text" name="Curp" class="form-control" value="<?php echo $curp ?>" maxlength="18" disabled>
									<input type="hidden" name="Curp" value="<?php echo $curp ?>">
								</li>

								<li class="m-top-xs">
									<i class="fa fa-building user-profile-icon"></i> 
									<label>R.F.C.:</label> <input type="text" name="rfc" class="form-control" value="<?php echo $rfc?>" maxlength="13" disabled>
									<input type="hidden" name="rfc" value="<?php echo $rfc?>">
								</li>
								<li class="m-top-xs">
									<i class="fa fa-envelope-o user-profile-icon"></i> 
									<label>Correo Electr&oacute;nico:</label> <input type="email" name="email" class="form-control" required="required" value="<?php echo $correoElectronico?>" required="required">
								</li>
								<li class="m-top-xs">
									<i class="fa fa-phone user-profile-icon"></i> 
									<label>Tel&eacute;fono:</label> <input type="text" name="phone" class="form-control" required="required" value="<?php echo $telefonoCelular?>">
								</li>
							</ul>
							<br />
							<br>
							<div class="text-center">
								<button type="submit" class="btn btn-app">
									<i class="fa fa-save"></i> Guardar
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</div>
</div>
	<!-- /page content -->
<?php
include('Footer.php');
?>