<?php
if(!isset($_SESSION['PATH_SYS'])){
	require_once ("../_loadPaths.inc.php");
}

$paths = $_SESSION['PATH_SYS'];
require_once ($paths["controller"]."RegistroAcessoController.php");
require_once ($paths["controller"]."RespostaMultiplaController.php");
require_once ($paths["controller"]."RespostaTxtController.php");
require_once ($paths["controller"]."ExercicioController.php");

$registroAcessoController = new RegistroAcessoController(); 
$respostaMultiplaController = new RespostaMultiplaController();
$respostaTxtController = new RespostaTxtController();
$exercicioController = new ExercicioController();

$logado = unserialize($_SESSION['USR']);
$usuario = $logado['id'];

switch ($_REQUEST["acao"]){
	
	case "registraOpcaoResposta":{			

			$exercicio = $exercicioController->selectByIdExercicio($_REQUEST["exercicio"]);

			$retorno = '';

			if($exercicio->getExe_tipo() == 4){
				$verificaRespTxt  = $respostaTxtController->selectAllQuestaoExeAluno($_REQUEST["exercicio"],$usuario,$_REQUEST["questao"]);
				if($verificaRespTxt == 0){
					$respostaTxt = new RespostaTxt();
					$respostaTxt->setRspt_usuario($usuario);
					$respostaTxt->setRspt_exercicio($_REQUEST["exercicio"]);
					$respostaTxt->setRspt_questao($_REQUEST["questao"]);
					$respostaTxt->setRspt_resposta($_REQUEST["resposta"]);
					$retorno = $respostaTxtController->insert($respostaTxt);
				}
			}
			
			if($exercicio->getExe_tipo() == 2){				
				$verificaRespMult = $respostaMultiplaController->selectAllQuestaoExeAluno($_REQUEST["exercicio"],$usuario,$_REQUEST["questao"]);		
				if($verificaRespMult == 0){
					$respostaMultipla = new RespostaMultipla();
					$respostaMultipla->setRspm_usuario($usuario);
					$respostaMultipla->setRspm_exercicio($_REQUEST["exercicio"]);
					$respostaMultipla->setRspm_questao($_REQUEST["questao"]);
					$respostaMultipla->setRspm_resposta($_REQUEST["resposta"]);
					$retorno = $respostaMultiplaController->insert($respostaMultipla);
				}
			}
			print_r($retorno);
		break;
	}
		
	case "iniciaExercicio":{
		print_r($_SESSION["EXERCICIO_ATUAL"]);

		$verifiacaExeAcesso = $registroAcessoController->selectExeByAlunoRegistro($_REQUEST["exercicio"],$usuario);
		if($verifiacaExeAcesso == 0){
			if($_SESSION["EXERCICIO_ATUAL"]){
				$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
			}else{
				$registroAcesso = null;
			}

			if($registroAcesso == null){
				$registroAcesso = new RegistroAcesso();
				$registroAcesso->setRgc_usuario($usuario);
				$registroAcesso->setRgc_exercicio($_POST["exercicio"]);
				$registroAcesso->setRgc_inicio(date("Y-m-d H:i:s"));
				$registroAcesso->setRgc_fim('0000-00-00 00:00:00');
				$id = $registroAcessoController->gravaRegistroAcesso($registroAcesso);
				if($id){
					$_SESSION["EXERCICIO_ATUAL"] = $id;
					$result = Array(
							'erro'=>false
					);
				}else{
					$result = Array(
							'erro'=>true
					);
				}
			}

		}	
		
		break;
	}
	
	case "finalizaExercicio":{	

		$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
		$registroAcesso->setRgc_fim(date("Y-m-d H:i:s"));
		$resultado = $registroAcessoController->editaRegistroAcesso($registroAcesso);
		print_r($resultado);
		if($resultado){
			$result = Array(
					'erro'=>false
			);
			unset($_SESSION["EXERCICIO_ATUAL"]);
		}else{
			$result = Array(
					'erro'=>true
			);
		}


		break;
	}
	
	case "acaoExercicio":{
		$verifiacaExeAcesso = $registroAcessoController->selectExeByAlunoRegistro($_REQUEST["exercicio"],$usuario);
		if($verifiacaExeAcesso == 0){
			if($_REQUEST["tipoacao"] == "iniciou"){
				$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
				print_r($registroAcesso);	
				die();

				if($registroAcesso == null){
					$registroAcesso = new RegistroAcesso();
					$registroAcesso->setRgc_usuario($usuario);
					$registroAcesso->setRgc_exercicio($_POST["exercicio"]);
					$registroAcesso->setRgc_inicio(date("Y-m-d H:i:s"));
					$registroAcesso->setRgc_fim('0000-00-00 00:00:00');



					$id = $registroAcessoController->gravaRegistroAcesso($registroAcesso);
					if($id){
						$_SESSION["EXERCICIO_ATUAL"] = $id;
						$result = Array(
								'erro'=>false
						);
					}else{
						$result = Array(
							'erro'=>true
						);
					}
				}				
				
				if($_REQUEST["tipoacao"] == "finalizou"){
					$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
					$registroAcesso->setRgc_fim(date("Y-m-d H:i:s"));
					die('entrou');
					if($registroAcessoController->editaRegistroAcesso($registroAcesso)){
						$result = Array(
							'erro'=>false
						);
						unset($_SESSION["EXERCICIO_ATUAL"]);
					}else{
						$result = Array(
							'erro'=>true
						);
					}
				}
			}

		}
		break;
	}
	
	case "verificaExercicio":{
		if($_POST["exercicio"]){
			$exercicio = $registroAcessoController->listaRegistroAcessoByUsuarioAndExercicio($usuario,$_POST["exercicio"] );	
		}else{
			$exercicio = null;
		}
		
		if($exercicio!=null){
			$result = Array(
					'erro'=>false,
					'existe'=>'sim',
					'tempoInicial'=>$exercicio->getRgc_inicio(),
					'tempoFinal'=>$exercicio->getRgc_fim());
		}else{
			
			$temp = explode(":", $_POST["tempo"]);
			$data = date("Y-m-d H:i:s");
			$registroAcesso = new RegistroAcesso();
			$registroAcesso->setRgc_usuario($usuario);
			$registroAcesso->setRgc_exercicio($_POST["exercicio"]);
			$registroAcesso->setRgc_inicio($data);
			$registroAcesso->setRgc_fim('00:00');
			if($registroAcessoController->gravaRegistroAcesso($registroAcesso)){
				$result = Array(
						'erro'=>false
				);
			}
		}
		echo json_encode($result);
		break;
	}
	
	case "getUsuario":{
		
		$result = Array(
				'erro'=>false,
				'usuario'=>'1'
				);
		echo json_encode($result);
		break;
	}
	
}

