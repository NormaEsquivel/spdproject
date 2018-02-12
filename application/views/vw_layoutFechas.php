<?php 
include('Header.php');
$len = count($fechas);
if ($len>0) {
    //echo "<pre>"; print_r($fechas);die();
}
//echo "<pre>"; print_r($Personadat);die();
?>
<!-- page content -->
<div class="right_col" role="main">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fechas de evaluacion <small>Resultados de los docentes</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Configuración 1</a></li>
                                <li><a href="#">Configuración 2</a></li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    responsiveBlablablablablablablablabla Blablablablablablablablabla Blablablablablablablablabla Blablablablablablablablabla Blablablablabla blablablabla Blablablabla blablablablabla Blablablablablablablablabla Blablablablablabla blablabla Blablablablablablablabla bla
                    </p>
                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <!-- <div class="dt-buttons btn-group">
                            <a class="btn btn-default buttons-copy buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Copy</span></a>
                            <a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>CSV</span></a>
                            <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Print</span></a>
                        </div> -->
                        <!-- <div id="datatable-buttons_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable-buttons"></label>
                        </div> -->
                        <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable-buttons_info" style="width: 877px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">g_examen</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px; display: none;">a_aplica</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 80px; display: none;">fecha_apl</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 80px; display: none;">turno</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px; display: none;">nivel</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px; display: none;">folio_exam</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 50px; display: none;">foliofeder</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 120px; display: none;">curp</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">nombre</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">prim_apell</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">segu_apell</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">grupo_de_desempeño</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 30px; display: none;">ent_proc</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">nombre_ent_proc</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">cct</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">cve_subsis</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">subsistema</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">sostenim</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">ent_sede</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">munic_sede</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">cap</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">sede</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">dir_sede</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">grupo</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">id_exam</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">figura</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">plaza</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">consipart</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">nodo</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">aplicacion</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">mecanismo</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">etapaseval</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 100px; display: none;">correo_elec</th>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1">Airi Satou</td>
                                <td style="display: none;">Accountant</td>
                                <td style="display: none;">Tokyo</td>
                                <td style="display: none;">33</td>
                                <td style="display: none;">2008/11/28</td>
                                <td style="display: none;">$162,700</td>
                                </tr>
                            </tbody> -->
                            <?php
                        if ($len > 0) {
                        ?>
                            <tbody>
                            <?php
                            $cont=0;
                            foreach ($fechas as $d) {
                                $cont++;
                                $row = " <tr class='".($cont % 2 == 0 ? "odd" : "even")."'>
                                <td tabindex='0' class='sorting_1'>".$d['g_examen']."</td>
                                <td style='display: none;'>".$d['a_aplic']."</td>
                                <td style='display: none;'>".$d['fecha_apl1']."</td>
                                <td style='display: none;'>".$d['turno1']."</td>
                                <td style='display: none;'>".$d['nivel']."</td>
                                <td style='display: none;'>".$d['folio_exam']."</td>
                                <td style='display: none;'>".$d['foliofeder']."</td>
                                <td style='display: none;'>".$d['curp']."</td>
                                <td style='display: none;'>".$d['nombre']."</td>
                                <td style='display: none;'>".$d['prim_apell']."</td>
                                <td style='display: none;'>".$d['segu_apell']."</td>
                                <td style='display: none;'>".$d['grupo_de_desempeño']."</td>
                                <td style='display: none;'>".$d['ent_proc']."</td>
                                <td style='display: none;'>".$d['nombre_ent_proc']."</td>
                                <td style='display: none;'>".$d['cct']."</td>
                                <td style='display: none;'>".$d['cve_subsis']."</td>
                                <td style='display: none;'>".$d['subsistema']."</td>
                                <td style='display: none;'>".$d['Descripcio']."</td>
                                <td style='display: none;'>".$d['ent_sede']."</td>
                                <td style='display: none;'>".$d['munic_sede']."</td>
                                <td style='display: none;'>".$d['cap']."</td>
                                <td style='display: none;'>".$d['sede']."</td>
                                <td style='display: none;'>".$d['dir_sede']."</td>
                                <td style='display: none;'>".$d['grupo']."</td>
                                <td style='display: none;'>".$d['id_exam']."</td>
                                <td style='display: none;'>".$d['figura']."</td>
                                <td style='display: none;'>".$d['Plaza']."</td>
                                <td style='display: none;'>".$d['consipart']."</td>
                                <td style='display: none;'>".$d['nodo']."</td>
                                <td style='display: none;'>".$d['aplicacion']."</td>
                                <td style='display: none;'>".$d['mecanismo']."</td>
                                <td style='display: none;'>".$d['etapaseval']."</td>
                                <td style='display: none;'>".$d['correo_elec']."</td>
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
                        <!-- <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> -->
                        <!-- <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous disabled" id="datatable-buttons_previous"><a href="#" aria-controls="datatable-buttons" data-dt-idx="0" tabindex="0">Previous</a></li>
                                <li class="paginate_button active"><a href="#" aria-controls="datatable-buttons" data-dt-idx="1" tabindex="0">1</a></li>
                                <li class="paginate_button "><a href="#" aria-controls="datatable-buttons" data-dt-idx="2" tabindex="0">2</a></li>
                                <li class="paginate_button "><a href="#" aria-controls="datatable-buttons" data-dt-idx="3" tabindex="0">3</a></li>
                                <li class="paginate_button "><a href="#" aria-controls="datatable-buttons" data-dt-idx="4" tabindex="0">4</a></li>
                                <li class="paginate_button "><a href="#" aria-controls="datatable-buttons" data-dt-idx="5" tabindex="0">5</a></li>
                                <li class="paginate_button "><a href="#" aria-controls="datatable-buttons" data-dt-idx="6" tabindex="0">6</a></li>
                                <li class="paginate_button next" id="datatable-buttons_next"><a href="#" aria-controls="datatable-buttons" data-dt-idx="7" tabindex="0">Next</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</div>

<?php 
include_once 'Footer.php';
?>