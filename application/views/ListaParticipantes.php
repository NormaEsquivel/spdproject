<?php
include('Header.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {    
    $( "#CURP" ).autocomplete({
        minLength: 4,
        source: function(request, response) {
          $.ajax({
              url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_admin/listaCURP",
              dataType: "json", 
              data: request, 
              success: function (data) {
                if (data.length == 0) {
                    alert('No entries found!');              
                }else {                
                    response(data);
                }
              }
          });      
        },    
    });

    $( "#RFC" ).autocomplete({
        minLength: 4,
        source: function(request, response) {
          $.ajax({
              url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_admin/listaRFC",
              dataType: "json", 
              data: request, 
              success: function (data) {
                if (data.length == 0) {
                    alert('No entries found!');              
                }else {                
                    response(data);
                }
              }
          });      
        },    
    });  
});
</script>
<!-- page content -->
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
            <p class="text-muted font-13 m-b-30">

              Filtros:
              <div class="row">
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">CURP</label>
                  <div>
                    <input type="text" name="CURP" id="CURP" class="form-control" value="" />
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">R.F.C.</label>
                  <div>
                    <input type="text" name="RFC" id="RFC" class="form-control" value="" />
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                 
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <a href="Javascript:;" onclick="buscarparti()" class="btn btn-round btn-success"><i class="fa fa-search"></i></a>
                </div>
              </div>
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>CURP</th>
                  <th>RFC</th>
                  <th>NOMBRE COMPLETO</th>
                  <th>CORREO ELECTR&Oacute;NICO</th>
                  <th>TEL&Eacute;FONO</th>
                  <th>CELULAR</th>
                </tr>
              </thead>

              <tbody>
              <?php
              if (is_array($listaparticipantes) || is_object($listaparticipantes))
                {
                  foreach ($listaparticipantes as $keypar => $valuepar) {
                  	echo '
                  	<tr>
                      <td>'.$listaparticipantes[$keypar]['CURP'].'</td>
                      <td>'.$listaparticipantes[$keypar]['RFC'].'</td>
                      <td>'.$listaparticipantes[$keypar]['nombre'].'</td>
                      <td>'.$listaparticipantes[$keypar]['correoElectronico'].'</td>
                      <td>'.$listaparticipantes[$keypar]['telefono'].'</td>
                      <td>'.$listaparticipantes[$keypar]['telefonoCelular'].'</td>
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
  $("li#participantes").css("background-color", "#056453");
  var ah = $("li#participantes").find("a");
  ah.css("color", "#fff");
</script>

<?php
include('Footer.php');
?>