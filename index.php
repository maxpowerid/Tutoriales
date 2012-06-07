<?php

error_reporting(E_ALL); //Cambiar E_ALL por 0 para no mostrar errores... se recomienda E_ALL en la etapa de desarrollo
global $default,$funcion,$act,$conexion;

header('Content-Type: text/html; charset=utf-8'); 

define('web',1);


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])== 'xmlhttprequest')
	define('AJAX',TRUE);
else
	define('AJAX',FALSE);
	
//Includes de conexion y funciones
	include "config.php";
	include "funciones.php";
	
//Cargamos las Funciones
	$funcion=new funciones();
	


//Inicializamos secciones
	$seccion=array(
			
			'inicio'=>$default['carpeta_codigo'].'/inicio.class.php',
	
	);
	

$act=isset($_GET['act'])? $funcion->escape2($_GET['act']):'inicio';


if(!array_key_exists($act,$seccion))
	if(!AJAX)
		header('Location: '.$default['weburl']);
	else
		die('0');

$default['tema_activo']=$funcion->tema_activo;
	
//Cargando Header, Cuerpo, y footer

if(!AJAX)
	require $funcion->tema_activo."/index.tema.php";

	$funcion->cargar_theme($seccion[$act]);

			
?>