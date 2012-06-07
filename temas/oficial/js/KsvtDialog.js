var ksvtDialog ={
esta_abierto:false,
back_close:true,
btn_cerrar:true,
abrir:function(titulo,cuerpo,width,position){
$('.tipsy').remove();
//PREGUNTAMOS SI ESTA ABIERTO PARA NO ABRIR 2 DIALOGS AL MISMO TIEMPO
				if(this.esta_abierto)
						return;
				else
					this.esta_abierto = true;
if(width!=undefined)
width=width+'px';
else
width='auto';

$('#Modal').css('width',width).html('<div id="dialog"><div class="titulo">'+titulo+'<span class="cerrar" title="Cerrar Ventana"></span></div><div class="cuerpo">'+cuerpo+'</div></div>');

			
	if(this.back_close==true)
			$('#Back').css('cursor','pointer').click(function(){ksvtDialog.cerrar();});
		else
			$('#Back').unbind('click').css('cursor','default');
	if(this.btn_cerrar)
			$('#Modal .cerrar').click(function(){ksvtDialog.cerrar();});
		else
			$('#Modal .cerrar').remove();
			
$('#Back').css('width',$(document).width()).css('height',$(document).height()).show();
this.center(position);
$('#Modal').show();
},
center:function(position){
$('.tipsy').remove();
scrll=window.scrollY;
//verificamos si el dialog es mas grande que nuestra ventana, de esa manera cambiamos a position absolute para que sea visualizada completa
if($('#Modal').height() > $(window).height()-60 || position=='top')
        $('#Modal').css({'position':'absolute', 'top':scrll+20}).css('left',$(window).width()/2-$('#Modal').width()/2);
else
$('#Modal').css('top',$(window).height()/2-$('#Modal').height()/2).css('left',$(window).width()/2-$('#Modal').width()/2);

},
recargar:function(){
$('.tipsy').remove();
this.esta_abierto = false;

},
cerrar:function(){

$('.tipsy').remove();
//Indicamos que el dialog esta cerrado
this.esta_abierto = false;
this.btn_cerrar = true;
this.back_close = true;
//Ocultamos el dialog y el fondo
$('#Back').fadeOut('fast');
$('#Modal').css('display','none');
//Borramos el contenido del dialog
$('#Modal').html('');
},
cargando_inicio:function(titulo){
$('.tipsy').remove();
this.abrir(titulo,'<center>'+carg4+'</center>');

},
cargando_fin:function(){
$('.tipsy').remove();
this.esta_abierto = false;
},
alerta:function(titulo,msj){
$('.tipsy').remove();
ksvtDialog.back_close=false;
ksvtDialog.btn_cerrar=false;
ksvtDialog.abrir(titulo,msj);
setTimeout(function(){ksvtDialog.cerrar();},2800);
}
}
