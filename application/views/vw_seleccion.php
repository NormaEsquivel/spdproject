<?php
include('Header.php');
//echo "<pre>"; print_r($Asistencias); die;
$len = 0;//count($Asistencias['Datos']);
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Catalogo de asistencias</h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">       
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="<?= $raiz.'catAsistencia'?>" method="POST">
                        <div class='form-group col-lg-10 col-lg-offset-1 text-center'>
                            <label class='control-label'>Seleccione un los fitros para obtener una lista de candidatos:</label>
                            <div class="input-group">
                                <select name="Proceso" id="Proceso" class="form-control">                                    
                                    <?php
                                    foreach ($Procesos as $p) {
                                        echo "<option value='".$p['EtapaID']."' ".($Asistencias['Sel'] == $p['EtapaID'] ? "Selected" : "").">".$p['Descripcion']."</option>";
                                    }                                    
                                    ?>
                                </select>
                            </div><!-- /input-group -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" name="action" value="buscar"><span class="fa fa-search">&nbsp Buscar</span></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Accesos al sistema<small>Ingrese una busqueda para mostrar registros</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                        <th>Docente</th>
                                        <th>Proceso</th>
                                        <th>Fecha</th>
                                        <th>Turno</th>
                                        <th>Sede</th>                          
                                        <th>Asistio</th>
                                        <th>Entrada</th>
                                        <th>Salida</th>
                                    </tr>
                                </thead>
                            <?php
                            if ($len > 0) {
                            ?>
                                <tbody>
                                <?php
                                $cont=0;
                                foreach ($Asistencias['Datos'] as $d) {
                                    $cont++;
                                    $row = " <tr><th scope='row'>".$cont."</th>
                                    <td>".$d['Docente']."</td>
                                    <td>".$d['Etapa']."</td>
                                    <td>".$d['Fecha']."</td>
                                    <td>".$d['Turno']."</td>
                                    <td>".$d['Sede']."&nbsp ".($d['CambioCede']=="No" ? "<span class='fa fa-check'>" : "<span class='fa fa-close'>")."</Span></td>
                                    <td>".$d['Asistio']."</td>
                                    <td>".$d['Entrada']."</td>
                                    <td>".$d['Salida']."</td>
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
                            <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Mostrando los ultimos <?=$len?> registros</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
	</div>
</div>
<!-- /page content -->
<?php 
include_once 'Footer.php';
?>