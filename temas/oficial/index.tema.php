<?php

function head($title){
global $default,$act;
?>
<!doctype html>
<html>
	<head>
	<title><?php echo $default['webname'].' '.($title!=''? '- '.$title:''); ?></title>
	<meta name="description" content="<?php echo $default['webdescripcion']; ?>" />
	<meta name="robots" content="all" />
	<meta name="keywords" content="all" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script>
		var def={
				
				weburl:'<?php echo $default['weburl']; ?>',
				webname:'<?php echo $default['webname']; ?>',
				
		}
	</script>
	<link href='http://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo $default['tema_activo']; ?>/css/base.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $default['tema_activo']; ?>/css/style.css"/>
	<link rel="shortcut icon" href="<?php echo $default['weburl']; ?>/favicon.png" type="image/x-icon">
	<script src="<?php echo $default['tema_activo']; ?>/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo $default['tema_activo']; ?>/js/autoresize.js" type="text/javascript"></script>
	<script src="<?php echo $default['tema_activo']; ?>/js/KsvtDialog.js" type="text/javascript"></script>
	
	<!--Js Final-->
	<script src="<?php echo $default['tema_activo']; ?>/js/ajax.js" type="text/javascript"></script>

	
	</head>
	<body>
	<div id="Back" style="display:none;"></div>
	<div style="display:none;" id="Modal"></div>
	<div id="cargando">
		<div id="carg">
		</div>
	</div>
	
	

	<div class="body_top">
		<div id="logo" class="floatL"></div>
		<div class="logo"><?php echo $default['webname']; ?></div>
			<div class="menu">
			<ul>
				<li><a href="<?php echo $default['weburl']; ?>/" onclick="seccion(this.href); return false;">Inicio</a></li>
				
			</ul>
		</div>	

		<div class="candado"></div>
	</div>
	
	
	<div id="cuerpo">
		<div id="contenido">


<?php
}


function footer(){
global $default;
?>

		</div>
	</div>
		<div class="body_footer"></div>
		<div class="pie">
		
			<div class="cuerpo floatL" id="pie1">
				<li><?php echo $default['webname']; ?> - Todos los derechos reservados</li>
				
			</div>
			
			
			<div class="cuerpo floatR">
				<li>CMS Programado por Nicol&aacute;s Cedr&oacute;n</li>
			</div>
		</div>
		
	</body>
</html>

<?php
}

?>