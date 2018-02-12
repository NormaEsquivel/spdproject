<?php 
include('Header.php');
$len = count($Fechas);
$fecha = date("Y-m-d");
// echo "<pre>";
// print_r($Fechas);
// die;
?>
<!-- page content -->


<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Formulario de registro de <strong>Fechas</strong></h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
                <?php                
                if ($ok == 2) {
                    echo "
                        <div class='alert alert-danger alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                            </button>
                            <span class='fa fa-info-circle'></span>
                            <strong>Alerta!</strong> No se registró la fecha de evaluación, verifique los datos puede que exista una fecha similar...
                        </div>
                    ";
                }                
                ?>
            </div>
            <div class="x_content">
                <div class="col-lg-12">
                    <form action="<?= $raiz.'Fechas'?>" method="post">
                        <!-- <input type='hidden' name="CedeID" id="CedeID" value="<?=base64_encode(@$Cede['CedeID'])?>" class='form-control'> -->
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Fecha de evaluación:</label>
                            <input type='date' class='form-control text-uppercase' name='Fecha' required min="<?=$fecha?>">
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Hora de evaluación:</label>
                            <input type='time' class='form-control text-uppercase' name='Hora' required min="<?=$fecha?>">
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Ciclo escolar:</label>
                            <input type='number' readonly class='form-control' value="<?=date("Y")?>"  name='CicloEscolar' minlength="4" maxlength="4" required>
                        </div>

                        <div class="form-group col-lg-4 col-lg-offset-2 col-md-offset-0 col-sm-offset-0">
                        <label class='control-label'>Proceso:</label>
                            <select name="Proceso" id="Proceso" class="form-control">                                    
                                <?php
                                foreach ($Procesos as $p) {
                                    echo "<option value='".$p['EtapaID']."'>".$p['Descripcion']."</option>";
                                }                                    
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                        <label class='control-label'>Turno:</label>
                            <select name="Turno" id="Turno" class="form-control">                                    
                                <?php
                                foreach ($Turnos as $t) {
                                    echo "<option value='".$t['TurnoID']."'>".$t['Turno']."</option>";
                                }                                    
                                ?>
                            </select>
                        </div>

                        <div class='form-group col-lg-12 text-center'>
                            <label class='control-label'></label>
                            <?php                            
                            $add="<button type='submit' class='btn btn-success' name='FechasAct' value='agregar' ><span class='fa fa-plus'></span>&nbsp Agregar</button>";
                            // $mod="<button type='submit' class='btn btn-info' name='CedesAct' value='modificar' ><span class='fa fa-pencil'></span>&nbsp Modificar</button>";
                            // echo($len>0?$mod:$add);
                            echo $add;
                            ?>                     
                        </div>
                    </form>
                    <br>
                </div>
                
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Fechas activas<small>Lista de fechas que aun no se han aplicado</small></h2>
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
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Etapa</th>
                                <th>Turno</th>
                                <th>Ciclo Escolar</th>
                            </tr>
                        </thead>
                    <?php
                    if ($len > 0) {
                    ?>
                        <tbody>
                        <?php
                        $cont=0;
                        foreach ($Fechas as $d) {
                            $cont++;
                            $row = " <tr><th scope='row'>".$cont."</th>
                            <td>".date("d/m/Y", strtotime($d['Fecha']))."</td>
                            <td>".$d['Hora']."</td>
                            <td>".$d['Etapa']."</td>
                            <td>".$d['Turno']."</td>
                            <td>".$d['Ciclo']."</td>
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
                    <!-- <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Mostrando los ultimos 10 registros</div> -->
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