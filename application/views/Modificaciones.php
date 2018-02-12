<?php
include('Header.php');
// echo "<pre>";
// print_r($listaModificacion);
// die;
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Evaluaci&oacute;n del Desempe&ntilde;o al T&eacute;rmino del Segundo A&ntilde;o y al T&eacute;rmino de su Periodo de Inducci&oacute;n</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="datatable-keytable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>CURP</th>
							<th>RFC</th>
							<th>TEL&Eacute;FONO</th>
							<th>NOMBRE COMPLETO</th>
							<th>CORREO ELECTR&Oacute;NICO</th>
							<th>CCT</th>
							<th>NOMBRE CT</th>
							<th>ACCIONES</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if (is_array($listaModificacion) || is_object($listaModificacion))
						{
							foreach ($listaModificacion as $keymod => $valuemod) {
								echo "
									<tr style='color: black; ".($listaModificacion[$keymod]['Modificacion']==0?"background-color:#d4f5d4;'":"background-color:#FE2E2E;'").'>
										<td>'.$listaModificacion[$keymod]['CURP'].'</td>
										<td>'.$listaModificacion[$keymod]['RFC'].'</td>
										<td>'.$listaModificacion[$keymod]['telefono'].'</td>
										<td>'.$listaModificacion[$keymod]['primerNombre'].' '.$listaModificacion[$keymod]['primerApellido'].' '.$listaModificacion[$keymod]['segundoApellido'].'</td>
										<td>'.$listaModificacion[$keymod]['correoElectronico'].'</td>
										<td>'.$listaModificacion[$keymod]['CCT'].'</td>
										<td>'.$listaModificacion[$keymod]['nombreCT'].'</td>
										<td><a href="'.$raiz.'formulario/'.$listaModificacion[$keymod]['idPersona'].'" type="button" class="btn btn-round btn-success"><i class="fa fa-pencil"></i> Modificaciones</a></td>
									</tr>';
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php
include('Footer.php');
?>