<?php
include('Header.php');
?>
<script>
$( function() {    
    $( "#clavect" ).autocomplete({
        minLength: 3,
        source: function(request, response) {
          $.ajax({
              url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_admin/listaCCTs",
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
                  <label class="control-label">Estados</label>
                  <div>
                    <select class="form-control" name="Estados" id="Estados">
                      <option value="">Seleccione una opci&oacute;n</option>
                      <?php
                      if(is_array($ListaResPrela) || is_object($ListaResPrela))
                      {
                        foreach ($ListaResPrela as $keylrp => $valuelrp) {
                          echo '<option value="'.$ListaResPrela[$keylrp]['nombreResultado'].'">'.$ListaResPrela[$keylrp]['nombreResultado'].'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">A&ntilde;o</label>
                  <div>
                    <select class="form-control" name="Anios" id="Anios">
                      <option value="">Seleccione una opci&oacute;n</option>
                      <?php
                      if(is_array($ListaCicloEscolar) || is_object($ListaCicloEscolar))
                      {
                        foreach ($ListaCicloEscolar as $keyce => $valuece) {
                          echo '<option value="'.$ListaCicloEscolar[$keyce]['nombreCicloEscolar'].'">'.$ListaCicloEscolar[$keyce]['nombreCicloEscolar'].'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">Clave CT</label>
                  <div>
                    <input type="text" name="clavect" id="clavect" class="form-control" value="" />
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">Grado</label>
                  <div>
                    <select class="form-control" name="Grado" id="Grado">
                      <option value="">Seleccione una opci&oacute;n</option>
                      <?php
                        foreach ($listaGrados as $keylg => $valuelg) {
                          echo '<option value="'.$listaGrados[$keylg]['idGrados'].'">'.$listaGrados[$keylg]['gradosClave'].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">Grupo</label>
                  <div>
                    <select class="form-control" name="Grupo" id="Grupo">
                      <option value="">Seleccione una opci&oacute;n</option>
                      <?php
                        foreach ($listaGrupos as $keylgs => $valuelgs) {
                          echo '<option value="'.$listaGrupos[$keylgs]['idGrupo'].'">'.$listaGrupos[$keylgs]['Grupo'].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <label class="control-label">Nombre Completo</label>
                  <div>
                    <input type="text" name="nombreCompleto" class="form-control" value="" />
                  </div>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                  <a href="Javascript:;" onclick="buscar()" class="btn btn-round btn-success"><i class="fa fa-search"></i></a>
                </div>
              </div>
            </p>
            <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CURP</th>
                  <th>RFC</th>
                  <th>FUNCI&Oacute;N</th>
                  <th>NOMBRE COMPLETO</th>
                  <th>CORREO ELECTR&Oacute;NICO</th>
                  <th>RESULTADO</th>
                  <th>CCT</th>
                  <th>CT</th>
                  <th>A&Ntilde;O</th>
                  <th>PROCESO</th>
                  <th>TIPO EVALUACION</th>
                  <th>MODIFICACION</th>
                </tr>
              </thead>

              <tbody>
              
              <?php
              if (is_array($ListaResultados) || is_object($ListaResultados))
                {
                  foreach ($ListaResultados as $keyliRe => $valuelire) {
                  	echo '
                    <tr>
                      <td>'.$ListaResultados[$keyliRe]['idPersona'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['CURP'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['RFC'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['nombreTipoFuncion'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['nombrefull'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['correoElectronico'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['nombreResultado'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['CCT'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['nombreCT'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['nombreCicloEscolar'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['Proceso'].'</td>
                      <td>'.$ListaResultados[$keyliRe]['TipoEvaluacion'].'</td>
                      <td><button onmouseover="onhover(this)" id="modificar" type="button" value="'.$ListaResultados[$keyliRe]['idRegistroResultado'].'" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Modificar</button></td>
                      
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

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Formato de modificación</h4>
                        </div>
                        <form action="<?= $raiz.'modresultados'?>" method="post">
                        <div class="modal-body">
                          <h4>Seleccione el resultado y llene el motivo</h4>
                          <div class='form-group col-lg-12'>
                            <label class='control-label'>Grupo de desempeño:</label>
                            <select name="GrupoDesempeño" id="GrupoDesempeño" class="form-control" required>
                              <option value="1">Insuficiente</option>
                              <option value="2">Suficiente</option>
                              <option value="3">Bueno</option>
                              <option value="4">Destacado</option>
                              <option value="5">No Idoneo</option>
                            </select>
                          </div>
                          <div class='form-group col-lg-12'>
                            <label class='control-label'>Motivo:</label>
                            <input type='text' name="Motivo" id="Motivo" class='form-control' required>
                          </div>
                          
                          <input type='hidden' name="ResultadoID" id="ResultadoID" value="" class='form-control'>
                          <input type='hidden' name="ModID" id="ModID" value="<?=$this->session->userdata('idPersona')?>" class='form-control'>
                        </div>
                        <div class="modal-footer">
                          <div class='form-group col-lg-12'>
                            <button type="button" onClick="limpiar()" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" name="ResultadosAct" value='modificar' class="btn btn-primary">Guardar cambios</button>
                          </div>
                        </div>
                        </form>

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

<script>
function onhover(comp) {
  $("#ResultadoID").val(comp.value);
  //alert('Ha hecho click sobre el boton: ' + comp.name+', de valor:'+comp.value);  
  return true;
}
</script>

<script>
function limpiar(){
  $("#ResultadoID").val("");
  $("#Motivo").val("");
  $("#GrupoDesempeño").val(1);
}
</script>

<?php
include('Footer.php');
?>