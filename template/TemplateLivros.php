<?php

	if(!isset($_SESSION['PATH_SYS'])){
	   session_start();  
	}

	$path = $_SESSION['PATH_SYS'];
	include_once($path['controller'].'LiberarCapituloController.php');

	/**
	 * Description of Template
	 *
	 * @author MuranoDesign
	 */

	class TemplateLivros{

		public static $path;
		
		function __construct()
		{
			self::$path = $_SESSION['URL_SYS'];
		}
	        
		public function listaCapitulosLiberados() {
			$logado                    = unserialize($_SESSION['USR']);
			$liberarCapituloController = new liberarCapituloController();

			if(($logado['perfil_id'] == 1)){
				$capitulos = $liberarCapituloController->selectCapLiberadoByIdEscola($logado['escola']);				
				$capClass = Array();
				foreach ($capitulos as $i => $value) {
					if ($value->getLbr_status() == 1) {
						$capClass[$i] = $value->getLbr_capitulo();
					}
				}				

				echo '<p class="tema">
		                	<a class="cap_1 '.(in_array('1', $capClass) ? "" : "inativo").'"><img src="img/cap_1.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_2 '.(in_array('2', $capClass) ? "" : "inativo").'"><img src="img/cap_2.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_3 '.(in_array('3', $capClass) ? "" : "inativo").'"><img src="img/cap_3.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_4 '.(in_array('4', $capClass) ? "" : "inativo").'"><img src="img/cap_4.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_5 '.(in_array('5', $capClass) ? "" : "inativo").'"><img src="img/cap_5.png"></a>
		                </p>';

		    }else if($logado['perfil_id'] == 2 || $logado['perfil_id'] == 4){
				$capitulos = $liberarCapituloController->selectCapLiberadoByIdEscola($logado['escola']);				
				$capClass = Array();

				$dominio= $_SERVER['REQUEST_URI'];
				$url = explode('?', $dominio);
				$ano = $url = explode('_', $url[1]);
				
				foreach ($capitulos as $i => $value) {
					if ($value->getLbr_status() == 1) {
						if($value->getLbr_livro() == $ano[1]){
							$capClass[$i] = $value->getLbr_capitulo();
						}
					}
				}	

				echo '<p class="tema">
		                	<a class="cap_1 '.(in_array('1', $capClass) ? "" : "inativo").'"><img src="img/cap_1.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_2 '.(in_array('2', $capClass) ? "" : "inativo").'"><img src="img/cap_2.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_3 '.(in_array('3', $capClass) ? "" : "inativo").'"><img src="img/cap_3.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_4 '.(in_array('4', $capClass) ? "" : "inativo").'"><img src="img/cap_4.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_5 '.(in_array('5', $capClass) ? "" : "inativo").'"><img src="img/cap_5.png"></a>
		                </p>';

		    }else if($logado['perfil_id'] == 3){
		    	echo '<p class="tema">
		                	<a class="cap_1"><img src="img/cap_1.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_2"><img src="img/cap_2.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_3"><img src="img/cap_3.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_4"><img src="img/cap_4.png"></a>
		                </p>
		                <p class="tema">
		                	<a class="cap_5"><img src="img/cap_5.png"></a>
		                </p>';
		    }

		}
	}
?>