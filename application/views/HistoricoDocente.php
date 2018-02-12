<?php
include('Header.php');
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Datos de docentes</h2>
            <ul class="nav navbar-right panel_toolbox">              
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            Fechas pr&oacute;ximas a presentar:
            <a href="<?php echo $raiz.'resources/calendario-SPD-2018.pdf'?>" class="btn btn-success" target="_blank">Calendario</a>
            <?php
            /*$exa="";
            foreach ($resultExamen as $keyres => $valueres) {
              $exa=$resultExamen[$keyres]['resulta'];
            }
            if($exa != "NO IDONEO")
            {
              echo "Evaluación de Desempeño";
            }*/
            ?>
          </div>
        </div>

         <div class="x_panel">
          <div class="x_title">
            <h2>Datos de docentes</h2>
            <ul class="nav navbar-right panel_toolbox">              
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Filtros:
              <div class="form-group col-md-4 col-sm-4 col-xs-4">
                <label class="control-label">Tipo de Evaluaci&oacute;n</label>
                <div>
                  <select class="form-control" name="Estados" id="Estados">
                    <option value="">Seleccione una opci&oacute;n</option>
                    <option value="Insuficiente">Ingreso</option>
                    <option value="Suficiente">Desempe&ntilde;o</option>
                    <option value="Bueno">Diagn&oacute;stica</option>
                    <option value="Destacado">Promoci&oacute;n</option>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-4">
                <label class="control-label">A&ntilde;o</label>
                <div>
                  <select class="form-control" name="Anios" id="Anios">
                    <option value="">Seleccione una opci&oacute;n</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-4">
                <a href="Javascript:;" onclick="buscar()" class="btn btn-round btn-success"><i class="fa fa-search"></i></a>
              </div>
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CURP</th>
                  <th>RFC</th>
                  <th>RESULTADO</th>
                  <th>A&Ntilde;O</th>
                </tr>
              </thead>

              <tbody>
              <?php
              if (is_array($resultExamen) || is_object($resultExamen))
                {
                  foreach ($resultExamen as $keyres => $valueres) {
                    echo '
                    <tr>
                      <td>'.$resultExamen[$keyres]['idPersona'].'</td>
                      <td>'.$resultExamen[$keyres]['CURP'].'</td>
                      <td>'.$resultExamen[$keyres]['RFC'].'</td>
                      <td>'.$resultExamen[$keyres]['resulta'].'</td>
                      <td>2016</td>
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
<!-- /page content -->
<script type="text/javascript" src="<?php echo $raiz?>resources/js/modulos/admin.js"></script>
<script type="text/javascript">
  $("li#resultados").css("background-color", "#056453");
  var ah = $("li#resultados").find("a");
  ah.css("color", "#fff");
</script>

<?php
include('Footer.php');
?>