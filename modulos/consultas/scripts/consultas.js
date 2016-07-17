function enviar_consulta(email,asunto,mensaje)
{
	if (email=='' || asunto=='' || mensaje=='')
	{
			/*$('#popup_mensaje').remove();
			$( "#popup" ).append( "<div id='popup_mensaje'><br><p align='center'>Por favor, complete los campos obligatorios.</p></div>" )
			$( "#popup" ).dialog({
			modal: true,
			draggable: true,
			resizable: false,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});*/
					$.blockUI({
					theme:     true,
					title:    'Procesando Información',
					message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> Por favor, complete los campos obligatorios.</p>'
				});
				setTimeout($.unblockUI, 2000);
	}
	else
	{
		if (validarEmail(email))
		{
			ejecutar_post_enviar_mensaje("modulos/consultas/php/ver_enviar_consultas.php","email="+email+"&asunto="+asunto+"&mensaje="+mensaje)
		}
		else
		{
			/*$('#popup_mensaje').remove();
			$( "#popup" ).append( "<div id='popup_mensaje'><br><p align='center'>Debe ingresar un Correo v�lido.</p></div>" )
			$( "#popup" ).dialog({
			modal: true,
			draggable: true,
			resizable: false,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});*/
				$.blockUI({
					theme:     true,
					title:    'Procesando Información',
					message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> Debe ingresar un Mail v�lido.</p>'
				});
				setTimeout($.unblockUI, 2000);
			//alert('Debe ingresar un email v&aacute;lido');
		}
	}
}

function ejecutar_post_enviar_mensaje(url,vars)
{
        //creamos el objeto XMLHttpRequest
        var ajax=nuevo_ajax();
		// id = document.getElementById("contacto");
        //peticionamos los datos, le damos la url enviada desde el link
        ajax.open("POST", url,true);
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
					//id.innerHTML = '<img src="images/loading.png" width="30" height="30">';
                }else if(ajax.readyState==4){
                        if(ajax.status==200){

							//cargar_post("modulos/consultas/templates/enviado_exitoso.html","listado_consultas","");
							$.blockUI({
								theme:     true,
								title:    'Procesando Información',
								message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> Consulta Enviada Correctamente.</p>'
							});
							$('#formulario_consultas input[type=text],#formulario_consultas textarea').val('');
							$("#asunto").focus();
							setTimeout($.unblockUI, 2000);
						}else if(ajax.status==404){
							//alert('Error: La página no existe');
							 id.innerHTML = "Error: La página no existe";
    					}else{
                            //alert("Error:".ajax.status);
							 id.innerHTML = "Error:".ajax.status;
                        }
                }
        }
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.setRequestHeader("Content-length", vars.length);
      	ajax.setRequestHeader("Connection", "close");
		ajax.send(vars)
}

/* http://javascript.internet.com
*/
function validarEmail(cadena) {
var a = cadena;
var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
if (a.length == 0 )
	return true;

if (filter.test(a))
	return true;
else
	return false;
}
