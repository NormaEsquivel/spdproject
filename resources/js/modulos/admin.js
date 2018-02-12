function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0,12);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function obtenerselects()
{
	var selected = '';
	$( "select").each(function() {
        selected += $(this).attr("name") + '|' + $(this).val() + ',';
    });

   	return selected;
}

function obtenerinputext()
{
	var selec = '';
	$( "input:text").each(function() {
	 	  selec += $(this).attr("name") + '|' + $(this).val() + ',';
    });
    return selec;
}


function buscar()
{
	var uri = getAbsolutePath();
	var selectes = obtenerselects();
	var inputext = obtenerinputext();
	var datos = {
    	'selectes':selectes,
    	'inputext':inputext
    };

	$.ajax({
    url : uri + "resultados",
    data : datos,
    cache: false,
		beforeSend: function(){
			
		},
	    success: function()
	    {
	    	location.reload();
	    	
	    	/*if (data != '')
	    	{
				$(".contenido_aviso").html(data);
	    	}
	    	else
	    	{
	    		$(".contenido_aviso").html('<span class="btn btn-danger">Ocurrió un error durante el proceso.</span>');
	    	}
	    	var theDialog = $("#dialog_aviso").dialog({
										        autoOpen: false,
										        modal: true,
										        width:900,
										        height:550
												});
	    	theDialog.dialog("open");*/

	    },
	    error: function ()
	    {
	    	console.log("ERROR captcha");
	    }
	});
}

function buscarparti() {
	var uri = getAbsolutePath();
	var selectes = obtenerselects();
	var inputext = obtenerinputext();
	var datos = {
    	'selectes':selectes,
    	'inputext':inputext
    };

	$.ajax({
    url : uri + "participantes",
    data : datos,
    cache: false,
		beforeSend: function(){
			
		},
	    success: function()
	    {
	    	location.reload();
	    	
	    	/*if (data != '')
	    	{
				$(".contenido_aviso").html(data);
	    	}
	    	else
	    	{
	    		$(".contenido_aviso").html('<span class="btn btn-danger">Ocurrió un error durante el proceso.</span>');
	    	}
	    	var theDialog = $("#dialog_aviso").dialog({
										        autoOpen: false,
										        modal: true,
										        width:900,
										        height:550
												});
	    	theDialog.dialog("open");*/

	    },
	    error: function ()
	    {
	    	console.log("ERROR captcha");
	    }
	});
}

function GuardarCatalogo()
{
	var URLactual = getAbsolutePath();
	var uri= URLactual;
	var obtinputs = obtenerinputesx();
	var obtselect = obtenerselects();
	var datos = {
    	'obtinputs':obtinputs,
		'obtselect':obtselect
    };

	$.ajax({
    url : uri + "ajax/catalogo",
    data : datos,
    cache: false,
		beforeSend: function(){
			
		},
	    success: function(data)
	    {
	    	if (data != '')
	    	{
				$(".contenido_aviso").html(data);
	    	}
	    	else
	    	{
	    		$(".contenido_aviso").html('<span class="btn btn-danger">Ocurrió un error durante el proceso.</span>');
	    	}
	    	var theDialog = $("#dialog_aviso").dialog({
										        autoOpen: false,
										        modal: true,
										        width:900,
										        height:550
												});
	    	theDialog.dialog("open");
	    },
	    error: function ()
	    {
	    	console.log("ERROR captcha");
	    }
	});
}