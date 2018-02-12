<?php 
include('Header.php');
// if (count($info) > 0) {
//     echo "<pre>"; print_r($info); die;
// }
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Importación del registro de asistencia</h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">       
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="<?= $raiz.'ImportarAsistencia'?>" method="POST" enctype="multipart/form-data">
                        <div class='form-group col-lg-6 col-lg-offset-3 text-center'>
                            <label class='control-label'>Archivo de registro de asistencia:</label>
                            <input type='file' class='form-control' accept=".txt" name='file' required>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-info" name="action" value="subirtxt"><span class="fa fa-load">&nbsp Enviar archivo</span></button>
                        </div>
                    </form>
                </div>
                <?php
                if (strlen($info) > 0) {
                    echo "<div class='col-lg-6 col-lg-offset-3 jumbotron'>";
                    echo $info;
                    echo "</div>";
                }
                ?>
            </div>
        </div>
	</div>
</div>
<!-- /page content -->
<?php 
include_once 'Footer.php';
?>