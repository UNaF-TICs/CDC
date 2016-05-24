var session_tabla02_imagen=0;
function enviar_iconos_modulos()
{
	var browserName=navigator.appName;
	id = document.getElementById('estado_carga');
	id.innerHTML="Cargando archivo ...";
	session_tabla02_imagen=1;
	if (browserName=="Microsoft Internet Explorer")
 	{
		abm.submit();
	}
	else
	{
		abm = document.getElementById('abm');
		abm.submit();
	}
}

function resultado_carga_icono_modulo(mensaje)
{
	id = document.getElementById('estado_carga');
	if (mensaje=="Ok")
	{
		id.innerHTML='Imagen cargada correctamente';
		session_tabla02_imagen=2;
	}
	else
	{
		id.innerHTML='ERROR al cargar la Imagen';
		session_tabla02_imagen=3;
	}
}