<?php 
include('Header.php');
$len = count($Persona);
// echo "<pre>"; 
// print_r($selStatus);
// die;
//echo substr($_SERVER['PATH_INFO'],1);
//echo $this->session->userdata('idTipoPersona');


if ($len>0) {
    $Personadat = $Persona[0];
    //echo "<pre>"; print_r($Personadat);die();
}

?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Formulario de registro de docentes</h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-lg-12">
                    <form action="<?= $raiz.'agregaUsuario'?>" method="post">
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
                <div class="col-lg-12">
                    <form action="<?= $raiz.'agregaUsuario'?>" method="post">
                        <?php
                        if($len>0){
                        echo "<input type='hidden' name='idPersona' value='".base64_encode($Personadat['idPersona'])."' class='BusID form-control'>";
                        }
                        ?>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Estatus:</label>                            
                            <select name="Status" class='form-control text-uppercase'>
                                <?php foreach ($selStatus as $m) {?>
                                    <option value="<?=base64_encode($m['idStatus'])?> " <?=(@$Personadat['idStatus']==$m['idStatus']?"Selected":"")?>><?=$m['StatusNombre']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Tipo de persona:</label>
                            <?php 
                            if ($len>0) {
                                $TipoPersona="
                                <select name='TipoPersona' class='form-control'>
                                <option value='".base64_encode($Personadat['idTipoPersona'])."'>".$Personadat['TipoPersona']."</option>
                                </select>
                                ";
                                echo $TipoPersona;
                            } else {
                                echo $selTipoPersona;
                            } 
                            ?>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Tipo de funcion:</label>
                            <?php 
                            if ($len>0) {
                                $TipoFuncion="
                                <select name='TipoFuncion' class='form-control'>
                                <option value='".base64_encode($Personadat['idTipoFuncion'])."'>".$Personadat['TipoFuncion']."</option>
                                </select>
                                ";
                                echo $TipoFuncion;
                            } else {
                                echo $selTipoFuncion;
                            } 
                            ?>
                        </div>
                        <div class='form-group col-lg-6'>
                            <label class='control-label'>Curp:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['CURP']?>"  name='Curp' placeholder='Ingrese Curp' value="" minlength="18" maxlength="18" required>
                        </div>
                        <div class='form-group col-lg-6'>
                            <label class='control-label'>RFC:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['RFC']?>"  name='RFC' placeholder='Ingrese RFC' value="" minlength="12" maxlength="13" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Apellido Paterno:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['primerApellido']?>" name='ApellidoPaterno' placeholder='Ingrese Apellido Paterno' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Apellido Materno:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['segundoApellido']?>" name='ApellidoMaterno' placeholder='Ingrese Apellido Materno' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Nombres:</label>
                            <input type='text' class='form-control  text-uppercase' value="<?=@$Personadat['primerNombre']." ".@$Personadat['segundoNombre']?>" name='Nombres' placeholder='Ingrese Nombre(s)' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Correo:</label>
                            <input type='email' class='form-control' value="<?=@$Personadat['correoElectronico']?>" name='Correo' placeholder='Ingrese Correo' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Contraseña:</label>
                            <input type='password' <?=($len > 0 ? "readonly":"")?> class='form-control' value="<?=@$Personadat['contrasena']?>" name='Contrasena' placeholder='************' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Telefono:</label>
                            <input type='number' class='form-control text-uppercase' value="<?=@$Personadat['telefono']?>" name='telefono' placeholder='Ingrese telefono' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Celular:</label>
                            <input type='number' class='form-control text-uppercase' value="<?=@$Personadat['telefonoCelular']?>" name='telefonoCelular' placeholder='Ingrese Celular' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Funcion desempeñada:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['tipoFuncionDesempeña']?>" name='tipoFuncionDesempeña' placeholder='Ingrese Funcion desempeñada' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Fecha de contrato:</label>
                            <input type='date' class='form-control text-uppercase' value="<?= explode(" ",@$Personadat['dtFechaContrato'])[0]?>" name='dtFechaContrato' value="" required>
                        </div>
                        <div class='form-group col-lg-4'>
                            <label class='control-label'>Consideraciones Especiales:</label>
                            <select name="ConsideracionID" class='form-control text-uppercase'>
                                <?php foreach ($con as $ce) {?>
                                    <option value="<?=$ce['ConcideracionID']?>" <?=(@$Personadat['ConsideracionID']==$ce['ConcideracionID']?" Selected":"")?>><?=$ce['Descripcion']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class='form-group col-lg-12'>
                            <label class='control-label'>Direccion:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Calle</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['Calle']?>" name='Calle' placeholder='Calle' required>
                                <span class="input-group-addon">#Ext</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['NumeroExt']?>" name='NumeroExt' placeholder='Exterior' required>
                                <span class="input-group-addon">#Int</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['NumeroInt']?>" name='NumeroInt' placeholder='Interior' required>
                                <span class="input-group-addon">x</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['Cruzamiento1']?>" name='Cruzamiento1' placeholder='Cruzamiento1' required>
                                <span class="input-group-addon">y</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['Cruzamiento2']?>" name='Cruzamiento2' placeholder='Cruzamiento2' required>
                            </div>
                            <div class="input-group">
                                
                                <span class="input-group-addon">Colonia</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Personadat['Colonia']?>" name='Colonia' placeholder='Colonia/Localidad' required>
                                <span class="input-group-addon">Municipio</span>
                                <select name="Municipio" class='form-control text-uppercase'>
                                    <?php foreach ($mun as $m) {?>
                                        <option value="<?=$m['idMunicipio']?> " <?=(@$Personadat['MunicipioID']==$m['idMunicipio']?"Selected":"")?>><?=$m['nombreMunicipio']?></option>
                                    <?php }?>
                                </select>
                                <span class="input-group-addon">C.P.</span>
                                <input type='number' class='form-control text-uppercase' value="<?=@$Personadat['CodigoPostal']?>" name='CodigoPostal' placeholder='Codigo Postal' required>
                            </div>
                        </div>

                        <div class='form-group col-lg-12'>
                            <?php                            
                            $add="<button type='submit' class='btn btn-success' name='DocentesAct' value='agregar' ><span class='fa fa-plus'></span>&nbsp Agregar</button>";
                            $mod="<button type='submit' class='btn btn-info' name='DocentesAct' value='modificar' ><span class='fa fa-pencil'></span>&nbsp Modificar</button>";
                            
                            echo($len>0?($Personadat['idStatus'] == 3 ? "<h3>No disponible para modificación</h3>" : $mod):$add);
                            ?>                     
                        </div>
                    </form>
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
        url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_catdocentes/listaPersonas",
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