<?php
include('Header.php');
$len = count($cts);
if ($len > 0) {
	// echo "<pre>";
	// print_r($cts);
	// die;
}
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
				<div class="col-md-6 col-xs-12">
	                <div class="x_panel">
		                <div class="x_title">
		                    <h2>Cambios hechos por el Usuario</h2>
		                    <div class="clearfix"></div>
		                </div>
	                    <div class="x_content">
	                    <br />
						
		                    <form class="form-horizontal form-label-left input_mask">

		                    	<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="nombreant" name="nombreant" disabled="disabled" placeholder="Nombre (s)" value="<?php echo $primernombreant ?>">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="apellidopant" name="apellidopant" disabled="disabled" placeholder="Apellido Paterno" value="<?php echo $primerapellidoant ?>">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="apellidomant" name="apellidomant" disabled="disabled" placeholder="Apellido Materno" value="<?php echo $segundoapellidoant ?>">
		                        	<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control has-feedback-left" id="correoelectronicoant" name="correoelectronicoant" disabled="disabled" placeholder="Correo Electronico" value="<?php echo $emailant ?>">
		                        	<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="telefonoant" name="telefonoant" disabled="disabled" placeholder="Telefono" value="<?php echo $telefonoant ?>">
		                        	<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control has-feedback-left" id="curpant" name="curpant" disabled="disabled" placeholder="CURPant" value="<?php echo $curpant ?>">
		                        	<span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="rfcant" name="rfcant" disabled="disabled" placeholder="R.F.C." value="<?php echo $rfcant ?>">
		                        	<span class="fa fa-building form-control-feedback right" aria-hidden="true"></span>
		                      	</div>
	                      		<div class="ln_solid"></div>
		                    </form>
	                    </div>
	                </div>
	            </div>

              	<div class="col-md-6 col-xs-12">
	                <div class="x_panel">
	                  	<div class="x_title">
	                    	<h2>Datos Originales</h2>
	                    	<div class="clearfix"></div>
	                  	</div>
	                  	<div class="x_content">
	                    <br />
		                    <form class="form-horizontal form-label-left">

		                      	<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="nombre" name="nombre" disabled="disabled" placeholder="Nombre (s)" value="<?php echo $primernombre ?>">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="apellidop" name="apellidop" disabled="disabled" placeholder="Apellido Paterno" value="<?php echo $primerapellido ?>">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="apellidom" name="apellidom" disabled="disabled" placeholder="Apellido Materno" value="<?php echo $segundoapellido ?>">
		                        	<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control has-feedback-left" id="correoelectronico" name="correoelectronico" disabled="disabled" placeholder="Correo Electronico" value="<?php echo $email ?>">
		                        	<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="telefono" name="telefono" disabled="disabled" placeholder="Telefono" value="<?php echo $telefono ?>">
		                        	<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control has-feedback-left" id="curp" name="curp" placeholder="CURP" value="<?php echo $curp ?>">
		                        	<span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                        	<input type="text" class="form-control" id="rfc" name="rfc" placeholder="R.F.C." value="<?php echo $rfc ?>">
		                        	<span class="fa fa-building form-control-feedback right" aria-hidden="true"></span>
		                      	</div>

		                      	<div class="ln_solid"></div>
		                    </form>
	                  	</div>
	                </div>
              	</div>
				  
				<div class="col-md-12 col-xs-12">
	                <div class="x_panel">
	                    <div class="x_content">
							<div class="col-lg-9">
								<h4 class="text-center">Centros de trabajo &nbsp<span class="fa fa-building-o"></span></h4>
								<div class="ln_solid"></div>

								<?php if($len > 0){ 
								foreach ($cts as $c) {?>
								<form class="form-horizontal form-label-left input_mask" style="<?=($c['Activo']==1?"background-color:#00ffbf;":"")?>padding-top:10px" action="<?=$raiz."formulario/".$id?>" method="POST">
									<div class="form-group col-lg-1">
										<?=($c['Activo']==0?"<button type='submit' class='btn btn-primary' name='ctAct' value='activar'><span class='fa fa-check'></span></button>":"")?>										
									</div>
									<div class="form-group col-lg-3">
										<input type="text" readonly disabled="disabled" class="form-control" name="CCT" value="<?=$c['CCT']?>">  
									</div>
									<div class="form-group col-lg-7">
										<input type="text" readonly disabled="disabled" class="form-control" name="NombreCT" value="<?=$c['nombreCT']?>"> 
									</div>
									<div class="form-group col-lg-1">
										<button class="btn btn-danger" name='ctAct' value='eliminar'><span class="fa fa-trash"></span></button> 
										<input type="hidden" class="form-control" name="pctID" value="<?=$c['idPersonaCCT']?>">
									</div>									
								</form>
								<?php } } else {?>
								<h4 class="text-center">No tiene centros de trabajo disponibles</h4>
								<?php } ?>
							</div>
							<div class="form-group col-lg-3">
								<h4 class="text-center">Agregar CT &nbsp<span class="fa fa-building-o"></span></h4>
								<div class="ln_solid"></div>
								<div class="col-lg-12">
									<form action="<?= $raiz."formulario/".$id?>" method="post">
										<div class="col-lg-12">
										<div class="input-group">
											<input type='text' id="Bus" class='form-control'   placeholder='Ingrese CCT...' required>
											<span class="input-group-btn">
												<button type="submit" class="btn btn-info submit" name="ctAct" value="agregar"><span class="fa fa-plus"></span></button>
											</span>
										</div>
										<input type='hidden' name="BusID" id="BusID" value="" class='BusID form-control'>
									</form>
								</div>
							</div>
						</div>							
	                </div>
	            </div>

				<div class="col-lg-12 col-md-12 col-xs-12">
	                <div class="x_panel">
						<h2 class="text-center">Directores &nbsp <span class="fa fa-gavel"></span></h2>
	                    <div class="x_title">
							<div class="clearfix"></div>
	                  	</div>
	                    <div class="x_content">
							<?php
							if($len > 0){ 
								foreach ($cts as $c) {
									if(count(@$c[0]) > 0){
							?>
		                    <div class="col-lg-6">
								<h4 class="text-center">Clave: <?=@$c['CCT']?> &nbsp<span class="fa fa-building-o"></span></h4>
								<h5 class="text-center"><?=@$c['nombreCT']?></h5>
								<div class="ln_solid"></div>
								<div class="col-lg-12">
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-user"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[0]['Maestro']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon">CURP &nbsp <li class="fa fa-quote-left"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[0]['CURP']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-map-marker"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[0]['Direccion']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-7 col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">RFC &nbsp <li class="fa fa-quote-left"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[0]['RFC']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-5 col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-phone-square"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[0]['Telefono']?>" disabled="disabled">										
										</div>
									</div>
								</div>
							</div>
							<?php } } } else {?>
							<h4 class="text-center">No tiene directores a cargo</h4>
							<?php } ?>
	                    </div>
	                </div>
	            </div>

				<div class="col-lg-12 col-md-12 col-xs-12">
	                <div class="x_panel">
						<h2 class="text-center">Supervisores &nbsp <span class="fa fa-graduation-cap"></span></h2>
	                    <div class="x_title">
							<div class="clearfix"></div>
	                  	</div>
	                    <div class="x_content">
							<?php
							if($len > 0){ 
								foreach ($cts as $c) {
									if(count(@$c[1]) > 0){
							?>
		                    <div class="col-lg-6">
								<h4 class="text-center">Nivel: <?=@$c[1]['Nivel']?>&nbsp|&nbspClave: <?=@$c[1]['CCT']?> &nbsp<span class="fa fa-building-o"></span></h4>
								<?php if ($c[1]['Nivel'] != "N/A") { ?>
									<h5 class="text-center">Subsistema: <?=@$c[1]['Subsistema']?>&nbsp<span class="fa fa-caret-square-o-down"></h5>
								<?php } ?>
								<h5 class="text-center"><?=@$c[1]['nombreCT']?>&nbsp-&nbsp Zona <?=@$c[1]['zona']?>&nbsp<span class="fa fa-globe"></h5>
								<div class="ln_solid"></div>
								<div class="col-lg-12">
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-user"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[1]['Supervisor']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon">CURP &nbsp <li class="fa fa-quote-left"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[1]['CURP']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-map-marker"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[1]['Direccion']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-7 col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">RFC &nbsp <li class="fa fa-quote-left"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[1]['RFC']?>" disabled="disabled">										
										</div>
									</div>
									<div class="form-group col-lg-5 col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><li class="fa fa-phone-square"></li></span>							
											<input type="text" class="form-control"placeholder="Nombre" value="<?=@$c[1]['Telefono']?>" disabled="disabled">										
										</div>
									</div>
								</div>
							</div>
							<?php } } } else {?>
							<h4 class="text-center">No tiene Supervisores a cargo <span class="fa fa-frown-o"></span></h4>
							<?php } ?>
	                    </div>
	                </div>
	            </div>

              	<div class="col-md-12 col-xs-12">
	                <div class="x_panel">
	                    <div class="x_content">
		                    <form class="form-horizontal form-label-left input_mask">
	                      		<div class="ln_solid"></div>
	                      		<div class="form-group text-center">
	                        		<div class="col-md-12 col-sm-12 col-xs-12">
	                          			<a href="Javascritp:;" onclick="actualizacion(1,<?php echo $id;?>)" type="button" class="btn btn-danger btn-lg"><span class="fa fa-close"></span>&nbsp Rechazar</a>
		                          		<a href="Javascritp:;" onclick="actualizacion(2,<?php echo $id;?>)" type="submit" class="btn btn-success btn-lg"><span class="fa fa-check"></span>&nbsp Aceptar</a>
	                        		</div>
	                      		</div>
		                    </form>
	                    </div>
	                </div>
	            </div>	


			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<script type="text/javascript" src="<?php echo $raiz.'resources/js/modulos/nivel.js';?>"></script>
<script>
$( function() {    
    $( "#Bus" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
        $.ajax({
        type:'POST',
        url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_nivel/listarCTs",
        dataType: "json",
        data: {Bus:request.term,BusID:$("#BusID").val()}, 
        success: function (data) {
        response(data);
        }
        });      
        },
        focus: function(e,ui){
            e.preventDefault();
            $(this).val(ui.item.label);
        },
        select: function(e,ui){ 
            e.preventDefault();
            $(".BusID").val(ui.item.value);
        }    
    });  
});
</script>

<?php
include('Footer.php');
?>