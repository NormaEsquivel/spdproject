<?php 
include('Header.php');
$len = count($logs);
if ($len>0) {
    //echo "<pre>"; print_r($logs);die();
}
//echo "<pre>"; print_r($Personadat);die();
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Registro de acceso por usuarios</h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-lg-12">
                    <form action="<?= $raiz.'Vistalogs'?>" method="post">
                        <div class="col-lg-8 col-lg-offset-2">
                        <div class="input-group">
                            <input type='text' id="Bus" class='form-control'   placeholder='Ingrese el nombre...' required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default submit" name="action" value="Buscar"><span class="fa fa-search"></span>&nbsp Buscar</button>
                            </span>
                        </div>
                        <input type='hidden' name="BusID" id="BusID" value="" class='BusID form-control'>
                    </form>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accesos al sistema<small>Ingrese una busqueda para mostrar registros</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Navegador</th>
                                <th>Accion</th>
                                <th>Fecha Hora</th>
                            </tr>
                        </thead>
                    <?php
                    if ($len > 0) {
                    ?>
                        <tbody>
                        <?php
                        $cont=0;
                        foreach ($logs as $d) {
                            $cont++;
                            $row = " <tr><th scope='row'>".$cont."</th>
                            <td>".$d['Persona']."</td>
                            <td>".$d['nombreNavegador']."</td>
                            <td>".$d['accion']."</td>
                            <td>".$d['dtLogUsuarioFechaMod']."</td>
                            </tr>";
                            echo $row;
                        }                            
                        ?>
                        </tbody>
                    <?php
                    } else {
                    ?>
                        <tbody>
                            <tr><th scope="row"></th><td>No se encontraron registros de acceso</td></tr>
                        </tbody>
                    <?php
                    }
                    ?>
                    </table>
                    <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Mostrando los ultimos 10 registros</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
	</div>
</div>
<!-- /page content -->
<!-- Busqueda autocomplete -->
<script>
$( function() {    
    $( "#Bus" ).autocomplete({
        minLength: 3,
        source: function(request, response) {
        $.ajax({
        type:'POST',
        url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_logUsuarios/listarlogs",
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
<!-- /Busqueda autocomplete -->
<?php 
include_once 'Footer.php';
?>