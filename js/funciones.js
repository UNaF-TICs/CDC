function cargar_menu(){
	$(".ui-layout-west").append( "<p id='cargando'><img src='media/iconos/loading.gif' class='mimage'> Cargando Menú </p>" );
	
	cargar_post2('modulos/menu/php/ver_menu.php','menu_acordion','',function(){
		$("#menu_acordion").css('display', '') 
		$("#cargando").css('display', 'none') 

			var icons = {
				header: "ui-icon-circle-arrow-e",
				headerSelected: "ui-icon-circle-arrow-s"
			};
			$("#menu_acordion").accordion({ 
				header: "h3", 
				fillSpace: false,
				autoHeight: false,
				navigation: false,
				icons: icons
			});
		 });
}
function login(){
	
	//$( "#dialog:ui-dialog" ).dialog( "destroy" );
		 
		var user = $( "#user" ),
			pass = $( "#pass" ),
			allFields = $( [] ).add( user ).add( pass ),
			tips = $( ".validateTips" );


		var toogCheck = $('#toogle-check');
		var inputText = $('#password-show');
		inputText.hide();
        inputText.keyup(function() { pass.attr('value', inputText.attr('value')); });
        pass.keyup(function() { inputText.attr('value', pass.attr('value')); });
		 $(toogCheck).click(function() {
			  if( toogCheck.is(':checked') ) {
				   inputText.show(); pass.hide();
			  } else {
				   inputText.hide(); pass.show();
			  }
		 });


		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Longitud de " + n + " debe ser entre " +
					min + " y " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 280,
			width: 350,
			modal: true,
			draggable: false,
			closeOnEscape: false,
			resizable: false,
			open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },

			buttons: {
				"Ingresar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( user, "Usuario", 3, 16 );
					bValid = bValid && checkLength( pass, "Contraseña", 3, 16 );

					bValid = bValid && checkRegexp( user, /^[a-z]([0-9a-z_])+$/i, "Nombre de usuario puede consistir de az, 0-9, guiones bajos, comenzar con una letra." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( pass, /^([0-9a-zA-Z])+$/, "Contraseña solo permite : a-z 0-9" );

					if ( bValid ) {
						validar_login()
										
					}
				}
			}
		});
		
		$("#pass").keypress(function(event) {
		  if ( event.which == 13 ) {
			 var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( user, "Usuario", 3, 16 );
					bValid = bValid && checkLength( pass, "Contraseña", 3, 16 );

					bValid = bValid && checkRegexp( user, /^[a-z]([0-9a-z_])+$/i, "Nombre de usuario puede consistir de az, 0-9, guiones bajos, comenzar con una letra." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( pass, /^([0-9a-zA-Z])+$/, "Contraseña solo permite : a-z 0-9" );

					if ( bValid ) {
						validar_login()
										
					}
		   }
		});

		
		$("#dialog-form").dialog('open');
}


function crear_menu(path,id,titulo){
	if ($('#tabs-' + id).length) {
		$('[href=#tabs-'+id+']').trigger('click');
		cargar_post(path,"tabs-" +id,'id_tablamodulo='+id);		
	}else{
		var tab_title = titulo;
		var $tabs = $( "#tabs").tabs();
		$tabs.tabs( "add", "#tabs-" + id, tab_title );
		cargar_post(path,"tabs-" +id,'id_tablamodulo='+id);		
		var cantidad_tab=($('.ui-tabs-nav li').length);
		$("#tabs").tabs({selected: cantidad_tab-1});
	}
}

function updateTips( t ) {
	$( ".validateTips" )
		.text( t )
		.addClass( "ui-state-highlight" );
	setTimeout(function() {
		$( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
	}, 500 );
}

function enter2tab(e) {
   if (e.keyCode == 13) {
	   cb = parseInt($(this).attr('tabindex'));

	   if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
		   $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
		   $(':input[tabindex=\'' + (cb + 1) + '\']').select();
		   e.preventDefault();

		   return false;
	   }
   }
}

function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
$.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}