<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateAreaAluno {

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

   //Topo Site	
   public function Teste2()
   {
		
   }
}
?>
