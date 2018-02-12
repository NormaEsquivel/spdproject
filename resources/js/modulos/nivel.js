function getPath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0,12);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function obtenerinputs()
{
	var selec = '';
	$( "form input:text").each(function() {
	 	  selec +=$(this).val() + '|' + $(this).attr("name") + ',';
    });
    return selec;
}

function actualizacion(typein, idPersona)
{
	var uri = getPath();
	var inputs = obtenerinputs();
	var datos = {
    	'inputs':inputs,
    	'typein':typein,
    	'idPersona':idPersona
    };

	$.ajax({
    url : uri + "ajax/aceptacambios",
    data : datos,
    cache: false,
		beforeSend: function(){
			
		},
	    success: function(data)
	    { 	
	    	if(typein == 1)
	    	{
	    		new PNotify({
	                title: 'Atención',
	                text: 'En un momento será redireccionado a la página principal',
	                type: 'warning',
	                styling: 'bootstrap3'
	            });
	    	}
	    	else if(typein == 2)
	    	{
	    		new PNotify({
	                title: 'Proceso Exitoso',
	                text: 'Las modificaciones se han realizado de manera correcta',
	                type: 'success',
	                styling: 'bootstrap3'
	            });
	    	}
	    	setTimeout(window.location = getPath() + 'modificaciones',3000);
	    },
	    error: function ()
	    {
	    	console.log("ERROR captcha");
	    }
	});
}
