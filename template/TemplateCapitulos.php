<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'ExercicioDAO.php');
include_once($path['controller'].'ExercicioController.php');
include_once($path['controller'].'UsuarioController.php');

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateCapitulos{

	public static $path;
	
	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
        
	public function listaExercicios()
	{	
		$logado= unserialize($_SESSION['USR']);		   
		if($logado['perfil'] == "Aluno"){
			
		}
	}
}
?>
