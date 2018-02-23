<?php
include('Header.php');
?>
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Datos de docentes</h2>
            <ul class="nav navbar-right panel_toolbox">              
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>CURP</th>
                  <th>RFC</th>
                  <th>Apellido Paterno</th>
                  <th>Apellido Materno</th>
                  <th>NOMBRE(s)</th>
                  <th>Fecha de Ingreso</th>
                  <th>Clave Presupuestal</th>
                  <th>TIPO PLAZA</th>
                  <th>DESCRIPCION PLAZA</th>
                  <th>MOVIMIENTO</th>
                  <th>VIGENCIA INCIAL</th>
                  <th>VIGENCIA FINAL</th>
                  <th>HRS DE PLAZA</th>
                  <th>CLAVE CT</th>
                  <th>CT DESCRIPCION</th>
                  <th>TIPO CLAVE</th>
                </tr>
              </thead>

              <tbody>
              
              <?php
               if (is_array($arrNomina) || is_object($arrNomina))
                 {
                   foreach ($arrNomina as $keyNom => $valueNom) {
                   	echo '
                   	<tr>
                       <td>'.$arrNomina[$keyNom]['CURP'].'</td>
                       <td>'.$arrNomina[$keyNom]['RFC'].'</td>
                       <td>'.$arrNomina[$keyNom]['Primer_Apellido'].'</td>
                       <td>'.$arrNomina[$keyNom]['Segundo_Apellido'].'</td>
                       <td>'.$arrNomina[$keyNom]['Nombre'].'</td>
                       <td>'.$arrNomina[$keyNom]['Fecha_Ingreso_Sep'].'</td>
                       <td>'.$arrNomina[$keyNom]['Clave_Presupuestal'].'</td>
                       <td>'.$arrNomina[$keyNom]['Tipo_Plaza'].'</td>
                       <td>'.$arrNomina[$keyNom]['Descrip_Tipo_Plaza'].'</td>
                       <td>'.$arrNomina[$keyNom]['Movimiento'].'</td>
                       <td>'.$arrNomina[$keyNom]['Vig_Ini_Mov'].'</td>
                       <td>'.$arrNomina[$keyNom]['Vig_Final_Mov'].'</td>
                       <td>'.$arrNomina[$keyNom]['hrspla'].'</td>
                       <td>'.$arrNomina[$keyNom]['Cve_CT'].'</td>
                       <td>'.$arrNomina[$keyNom]['Nombre_CT'].'</td>
                       <td>'.$arrNomina[$keyNom]['tipoclve'].'</td>
                     </tr>
                    
                   	';
                   }
                 }
              ?>
              </tbody>
            </table>
          </div>
        </div>
	</div>
</div>
<?php
include('Footer.php');
?>