var cargando={

	inicio:function(){

				
			$('#cargando').show('fast');
			$('#carg').addClass('carg3').html('Cargando...');
	},
	
	fin:function(str){

				
		if(str!=undefined){
					$('#carg').css('display','none').removeClass('carg3');
					$('#carg').fadeIn({duration:2000}).html(str);
					setTimeout(function(){$('#cargando').fadeOut('slow');} ,2500);
					setTimeout(function(){$('#carg').html('Cargando...');} ,3000);
					}
	else
	$('#cargando').slideUp('slow');
	
	}

}

function seccion(seccion,cambiar){
$('.tipsy').remove();

		if($.browser.msie && cambiar!='IE')	{
			location.hash=('!'+seccion.replace(def.weburl,""));
			return false;
			}

			
	cargando.inicio();

	$.ajax({
		url:seccion,
		success:function(n){
		
		if(n=='0'){
			cargando.fin('Error al Cargar Seccion');
			return false;
		}
			$('.menu li').removeClass('active');
			$('.menu li a').removeClass('active');
			
			$('.menu li a[href=' +seccion+ ']').addClass('active');
			
			$('#contenido').fadeOut('slow',function(){$('#contenido').fadeIn('fast').html(n); $('.tipsy').remove();});
			
			cargando.fin();
			
			
		if(cambiar!='false')
			history.pushState('estado', 'null', seccion);
			
			
		}
	
	});
	
}


$(document).ready(function(){

//History para IE
	if($.browser.msie)
		$.history.init(function(hash){
		
			if(hash.length > 1 && hash.match("!"))
				seccion(def.weburl+hash.replace('!',""),'IE');
	});
	
//History para todos los NAV HTML5
if(!$.browser.msie){
history.pushState('estado', 'null', location.href);
	 window.onpopstate=function(event) {	
		if(event.state=='estado')
					seccion(location.href,'false');	
		
	 }; 
}	 
//menu
	$('.menu li a').each(function(){
	
	if($(this).attr('href').match(location.href.replace(def.weburl,""))){
		$(this).addClass('active');
		return false;
		}
	});
});