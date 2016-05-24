function nuevo_ajax(){
        var xmlhttp=false;
        try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

        }catch(e){
                try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						
                }catch(E){
                        xmlhttp = false;
                }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}

function cargar_post(url,id,vars){
	$.ajax({
	   type: "POST",
	   url: url,
	   data: vars,
	   success: function(data){
		   $('#'+id).html(data);
	   },
	   error: function(data){
		   $('#'+id).html('Error al cargar la página');
	   }
	 });	
}

function cargar_get(url,id){
		$.ajax({
		   type: "GET",
		   url: url,
		   data: '',
		   success: function(data){
			   $('#'+id).html(data);
		   },
		   error: function(data){
			   $('#'+id).html('Error al cargar la página');
		   }	   
		 });	
}

function cargar_post2(url,id,vars,callback){
		$.ajax({
		   type: "POST",
		   url: url,
		   data: vars,
		   success: function(data){
			   $('#'+id).html(data);
			   callback();
		   },
		   error: function(data){
			   $('#'+id).html('Error al cargar la página');
		   }
		 });		
}

function guardar_mostrar(url,vars,url_exito,id,vars_exito){
	$.ajax({
	   type: "POST",
	   url: url,
	   data: vars,
	   success: function(data){
		   
				var respuesta_mostrar=data.replace(/(^\s*)|(\s*$)/g,"");
				var respuesta=respuesta_mostrar.substring(0,5);
				if (respuesta=='Error')
				{
				$.blockUI({ 
					theme:     true, 
					title:    'Procesando Información', 
					message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
				}); 
				setTimeout($.unblockUI, 2000); 
				}
				else
				{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 1500); 
					cargar_post(url_exito,id,vars_exito);
				}   
	   },
	   error: function(data){
		   $('#'+id).html('Error al cargar la página');
	   }
	 });	
}

function guardar_mostrar_callback(url,vars,url_exito,id,vars_exito,callback){
	$.ajax({
	   type: "POST",
	   url: url,
	   data: vars,
	   success: function(data){

			var respuesta_mostrar=data.replace(/(^\s*)|(\s*$)/g,"");
			var respuesta=respuesta_mostrar.substring(0,5);
			if (respuesta=='Error')
			{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 2000); 
			}
			else
			{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 1500); 
					cargar_post2(url_exito,id,vars_exito,callback);
			}
	   },
	   error: function(data){
		   $('#'+id).html('Error al cargar la página');
		   $.unblockUI();
	   }
	 });	

}
function eliminar_mostrar(url,vars,url_exito,id,vars_exito,msj){
	
	$("#dialog-confirm").text("").append( "<p>" + msj + "</p>" );
	$( "#dialog-confirm" ).dialog({
	modal: true,
	zIndex: 10000,
	resizable: false,
	buttons: {
		"Aceptar": function() {
		$( this ).dialog( "close" );
		$.ajax({
		   type: "POST",
		   url: url,
		   data: vars,
		   success: function(data){
	
				var respuesta_mostrar=data.replace(/(^\s*)|(\s*$)/g,"");
				var respuesta=respuesta_mostrar.substring(0,5);
				
				if (respuesta=='Error')
				{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 2000); 
				}
				else
				{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 1500); 
					cargar_post(url_exito,id,vars_exito);
				}
	
			},
		   error: function(data){
			   $('#'+id).html('Error al cargar la página');
		   }
		 });	
					//$( this ).dialog( "close" );
			},
			"Cancelar": function() {
					//var eliminar=0;
				$( this ).dialog( "close" );
				
			}
		}
	});
}

function eliminar_mostrar_callback(url,vars,url_exito,id,vars_exito,msj,callback){
	

	
	
	

	var answer = confirm (msj);
	
	if (answer)
	{
		$.ajax({
		   type: "POST",
		   url: url,
		   data: vars,
		   success: function(data){

				var respuesta_mostrar=data.replace(/(^\s*)|(\s*$)/g,"");
				var respuesta=respuesta_mostrar.substring(0,5);
				
				if (respuesta=='Error')
				{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 2000); 
				}
				else
				{
					$.blockUI({ 
						theme:     true, 
						title:    'Procesando Información', 
						message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> ' + respuesta_mostrar + '</p>'
					}); 
					setTimeout($.unblockUI, 1500); 
					cargar_post2(url_exito,id,vars_exito,callback);
					
				}
			},
		   error: function(data){
			   $('#'+id).html('Error al cargar la página');
		   }
		 });	

	}
}

function ejecutar_get(url){
		   $.ajax({
		   type: "GET",
		   url: url,
		   success: function(){
			  // $('#'+id).html(data);
			  location.reload();
		   }	   
		 });	
}

function ejecutar_post(url,vars){

        var ajax=nuevo_ajax(); 
        ajax.open("POST", url,true);
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
	                        alert('ok:' + ajax.responseText);
						}else if(ajax.status==404){
							alert('Error: La página no existe');
    					}else{
                            alert("Error:".ajax.status); 
                        }
                }
        }
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
		ajax.setRequestHeader("Content-length", vars.length);
      	ajax.setRequestHeader("Connection", "close");
		ajax.send(vars)
}
function cargar_inicial(tipo){
	if (tipo=='login')
	{
		//Carga Login y Valida
		login();
	}else{
		//Carga Menu
		cargar_menu();
	}

}

function validar_login()
{
	    var ajax=nuevo_ajax(); 
		usu = $( "#user" ).val();
		cla = $( "#pass" ).val();
        ajax.open("POST", "modulos/login/php/valida.php",true);
		var vars="usu="+ usu + "&cla=" + cla;
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
					
                }else 
				if(ajax.readyState==4){
                        if(ajax.status==200){
							
							$mensaje=ajax.responseText.replace(/(^\s*)|(\s*$)/g,"");
							if ($mensaje=='Error Logueo')
							{
									updateTips( 'Usuario o contraseña inválidos.');
							}
							else
							{
								
 								location.reload();
								login=1;

							}

						}else if(ajax.status==404){
							alert('Error: La página no existe');
    					}else{
                            alert("Error:".ajax.status); 
                        }
                }
        }
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.setRequestHeader("Content-length", vars.length);
      	ajax.setRequestHeader("Connection", "close");
		ajax.send(vars);

	
}
function logout()
{
	
		$( "#dialog-message" ).dialog({
			modal: true,
			//draggable: false,
			resizable: false,
			buttons: {
				"Salir": function() {
					login=0;
					ejecutar_get('php/logout.php');
					$( this ).dialog( "close" );
				},
				"Cancelar": function() {
					//login=0;
					//ejecutar_get('php/logout.php');
					$( this ).dialog( "close" );
				
				}
			}
		});

}
function sin_acceso(msj)
{
	
	$("#dialog-confirm").text("").append( "<p>" + msj + "</p>" );
	$( "#dialog-confirm" ).dialog({
	modal: true,
	zIndex: 10000,
	resizable: false,
	title: "Advertencia",
	buttons: {
		Ok: function() {
				$( this ).dialog( "close" );
			}

				}
		});

}