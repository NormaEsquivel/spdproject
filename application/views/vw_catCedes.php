<?php 
include('Header.php');
$len = count($CedeDat);
if ($len>0) {
    $Cede = $CedeDat[0];
    //echo "<pre>"; print_r($Personadat);die();
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Formulario de registro de Sedes</h2>
                <!-- <ul class="nav navbar-right panel_toolbox">              
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-lg-12">
                    <form action="<?= $raiz.'Catcedes'?>" method="post">
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
                    <form action="<?= $raiz.'Catcedes'?>" method="post">
                    <input type='hidden' name="CedeID" id="CedeID" value="<?=base64_encode(@$Cede['CedeID'])?>" class='form-control'>
                    <div class='form-group col-lg-6'>
                            <label class='control-label'>Nombre:</label>
                            <input type='text' class='form-control text-uppercase' value="<?=@$Cede['Nombre']?>"  name='Nombre' placeholder='Ingrese Nombre' required>
                        </div>
                        <div class='form-group col-lg-6'>
                            <label class='control-label'>Telefono:</label>
                            <input type='tel' class='form-control' value="<?=@$Cede['Telefono']?>"  name='Telefono' placeholder='Ingrese Telefono' minlength="7" maxlength="10" required>
                        </div>
                        <div class='form-group col-lg-12'>
                            <label class='control-label'>Direccion:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Calle</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['Calle']?>" name='Calle' placeholder='Calle' required>
                                <span class="input-group-addon">#Ext</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['NumeroExt']?>" name='NumeroExt' placeholder='Exterior' required>
                                <span class="input-group-addon">#Int</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['NumeroInt']?>" name='NumeroInt' placeholder='Interior' required>
                                <span class="input-group-addon">x</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['Cruzamiento1']?>" name='Cruzamiento1' placeholder='Cruzamiento1' required>
                                <span class="input-group-addon">y</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['Cruzamiento2']?>" name='Cruzamiento2' placeholder='Cruzamiento2' required>
                            </div>
                            <div class="input-group">
                                
                                <span class="input-group-addon">Colonia</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['Colonia']?>" name='Colonia' placeholder='Colonia/Localidad' required>
                                <span class="input-group-addon">Municipio</span>
                                <select name="Municipio" class='form-control text-uppercase'>
                                    <?php foreach ($mun as $m) {?>
                                        <option value="<?=$m['idMunicipio']?> " <?=(@$Cede['MunicipioID']==$m['idMunicipio']?"Selected":"")?>><?=$m['nombreMunicipio']?></option>
                                    <?php }?>
                                </select>
                                <span class="input-group-addon">C.P.</span>
                                <input type='text' class='form-control text-uppercase' value="<?=@$Cede['CodigoPostal']?>" name='CodigoPostal' placeholder='Codigo Postal' required>
                            </div>
                        </div>

                        <div class='form-group col-lg-12'>
                            <?php                            
                            $add="<button type='submit' class='btn btn-success' name='CedesAct' value='agregar' ><span class='fa fa-plus'></span>&nbsp Agregar</button>";
                            $mod="<button type='submit' class='btn btn-info' name='CedesAct' value='modificar' ><span class='fa fa-pencil'></span>&nbsp Modificar</button>";
                            echo($len>0?$mod:$add);
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
        url: "http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>Controller_catCedes/listaCedes",
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