<?php

if(!defined('web'))
	exit('No puedes estar aqui');

class db extends datos{
	
	private $mysqli;
	
	function __construct(){
	
		//Conexion
			$this->mysqli= mysqli_connect($this->db_server, $this->db_user, $this->db_passwd, $this->db_name);
			
		//verificar conexion
			if (mysqli_connect_errno()) {
				echo 'Error enconexion';
				exit();
			}else
				$this->db_query("SET NAMES '".$this->db_character_set."'");
				
		
	}
	
	function db_query($query){
		
				$result=mysqli_query($this->mysqli,$query);
				
				return $result;
	}
		
	function db_real_escape_string($str){
		
			$result=mysqli_real_escape_string($this->mysqli,$str);
			
			return $result;
	}
		
	function db_insert_id(){
		
			return mysqli_insert_id($this->mysqli);
			
	}
		
	//No Inyeccion
	function escape($texto){
		
			return $this->db_real_escape_string(htmlspecialchars(trim($texto)));
			
	}
		
	//No Inyeccion ni tag html
	function escape2($texto){
		
		return $this->db_real_escape_string(htmlspecialchars(trim(strip_tags($texto))));
		
	}


}


class funciones extends db{

	public $tema_activo;
	
	function __construct(){
	
	global $default;
	
		parent::__construct();
		
		//Cargamos directorio del tema activo
		
		$this->tema_activo=$default['carpeta_temas'].'/'.$this->dir_tema();
		
		
	}
	
	
	private function dir_tema(){
	
		$result=$this->db_query("SELECT valor FROM settings WHERE variable='tema_activo' LIMIT 1");
		
		if($row=mysqli_fetch_assoc($result)){
			
			mysqli_free_result($result);
			
				$result=$this->db_query("SELECT nombre_tema FROM temas WHERE id_tema='{$row['valor']}'");
				
				$row=mysqli_fetch_assoc($result);
		}else
			die('No Existe tema activo');
			
		mysqli_free_result($result);
		
		return $row['nombre_tema'];
		
	}
	
	
	function cargar_theme($url){
	
		require ($url);
		
		$this->load('index');		
			
	}
	
	 function load($funcion){
	 
		global $sa,$act,$default;
		
				
		$code=new codigo();
		
		if(!empty($sa))
				$funcion=$sa;
		
		if(@$code->sub_seccion['requiere_vista'] && !empty($sa) || $funcion=='index'){
			require $this->tema_activo."/".$act.".tema.php";
			$theme=new template();
		}	


//Codigos php		
		if(@$code->sub_seccion['requiere_funcion'] && !empty($sa) || $funcion=='index')
			$code->{$funcion}();

	//Head	
		if(!AJAX && (@$code->sub_seccion['requiere_vista'] || $funcion=='index'))
			head($code->sub_seccion['title']);

			
	//Body
		if(@$code->sub_seccion['requiere_vista'] && !empty($sa) || $funcion=='index'){
			$theme->{$funcion.'_vista'}();
			
		if(AJAX && (@$code->sub_seccion['requiere_vista'] || $funcion=='index'))
			echo'<script>$("title").html("'.$default['webname'].' '.($code->sub_seccion['title']!=''? '- '.$code->sub_seccion['title']:'').'");</script>';
			
			}
	//Footer
		if(!AJAX && (@$code->sub_seccion['requiere_vista'] || $funcion=='index'))
			footer();
	}
	
	


	
}

function bbc($str){
	global $carateres_raros;
   if (empty($carateres_raros)){
      $todas = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
      $etiquetas = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES);
      $carateres_raros= array_diff($todas, $etiquetas);
   }
   $str = strtr($str, $carateres_raros);
   return $str;
}






?>