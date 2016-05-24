	var myLayout; 
	$(document).ready(function () {
		$("#menu_acordion").css('display', 'none');
		$("#dialog-form,#dialog-confirm,#popup,#dialog-message").hide();
		$.blockUI({ 
			theme:     true, 
			title:    'Procesando Informaci&oacute;n', 
			message:  '<p><img src="media/iconos/loading.gif" class="mimage"/> Cargando Sistema...</p>'
		}); 
	
		$( ".demo2" ).button().click(function() { 
									logout(); 
		});
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		//$( "#usuario_bienvenida" ).tooltip();

		var $tab_title_input = $( "#tab_title"),
			$tab_content_input = $( "#tab_content" );
		var tab_counter = 2;

		// tabs init with a custom tab template and an "add" callback filling in the content
		
		var $tabs = $( "#tabs").tabs({
			tabTemplate: "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Cerrar</span></li>",
			add: function( event, ui ) {
				var tab_content = $tab_content_input.val() || " Cargando Módulo ...";
				$( ui.panel ).append( "<p><img src='media/iconos/loading.gif' class='mimage'>" + tab_content + "</p>" );
			}
		});

		// close icon: removing the tab on click
		// note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
		$( "#tabs span.ui-icon-close" ).live( "click", function() {
			var index = $( "li", $tabs ).index( $( this ).parent() );
			$tabs.tabs( "remove", index );
		});


		myLayout = $('#contenedor_layout').layout({
			west__maxSize : 250,
			west__size:	200,	
			west__spacing_closed:5,	
			west__togglerLength_closed:	100,
			west__togglerAlign_closed:	"center",
			west__togglerTip_closed:"Abrir y Esconder Menu",	
			west__sliderTip:"Ocultar/Mostrar Menú",
			west__slideTrigger_open:"mouseover"
		});
		
		 $.unblockUI();
 	});