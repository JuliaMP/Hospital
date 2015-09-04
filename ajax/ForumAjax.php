<?php

require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['controller'].'ForumViewController.php');
include_once($path['beans'].'ForumQuestao.php');
include_once($path['beans'].'ForumView.php');
include_once($path['beans'].'ForumResposta.php');
include_once($path['beans'].'Usuario.php');
include_once($path['template'].'TemplateForum.php');
$template = new TemplateForum();
$forumController = new ForumQuestaoController();
$userController = new UsuarioController();
$respostasController = new ForumRespostaController();
$viewController = new ForumViewController();
$questaoController = new ForumQuestaoController();

switch ($_POST["acao"]){

	case "listaQuestoesRecentes":{ 
	  	
	  	if ($_POST['texto'] != ''){
	  		$questoes = $questaoController->selectComleta($_POST['texto']);
	  	}else{
	  		$questoes = $questaoController->selectUltimas(5);
	  	}
	  	

	//	print_r($questoes);
	  	
	  	$html = '';
	  	if (count($questoes)>0){
			foreach ($questoes as $q){
				$viewController = new ForumViewController();
				$totalViews = $viewController->totalByQuestao($q->getFrq_id());
				$totalRespostas = $respostasController->totalByQuestao($q->getFrq_id());
				
				if ($totalViews == 1) $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">1</span> visualização</span>';
                	else $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">'.$totalViews.'</span> visualizaçôes</span>';
                            	
				if ($totalRespostas == 1) $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">1</span> resposta</span>';
                  	else $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">'.$totalRespostas.'</span> respostas</span>';
					
            	
                $data = substr(str_replace(' ',' às ',$q->getFrq_data()),0,-3);
                $html .= '<div class="ln_box ln_box caixaQuestao" style="cursor: pointer" onClick="listaRespostas('.$q->getFrq_id().')" id="'.$q->getFrq_id().'">
						<p class="ln_pergunta">'.utf8_encode($q->getFrq_questao()).'</p>
				        <div class="ln_info row">
				          <p class="col-xs-7 col-md-7 col-lg-7 align-right">Última postagem '.$data.'</p> 
				          <p class="col-xs-3 col-md-3 col-lg-3 align-right"><span class="paipeR">|</span>'.$msgView.' <span class="paipeL">|</span></p>
				          <p class="col-xs-2 col-md-2 col-lg-2 align-right">'.$totalRespostas.'</p>
				        </div>
				        <div style="clear:both"></div>
				      </div>';
             }
        }
        echo $html;
	  	break;
	  } 
	  case "listaRespostaQuestao":{
	  	$l = unserialize($_SESSION['USR']);
	  	$logado = $userController->select($l['id']); //Buscar o usuario certo depois q fizer o login!!!
	  	$id = $logado->getUsr_id();
	  	
	  	$resp = $forumController->select($_POST['resp']);
	  	
	  	if ($viewController->verificaUsuarioByQuestao($id,$_POST['resp']) == 0){
	  		$view = New ForumView();
	  		$view->setFrv_questao($_POST['resp']);
	  		$view->setFrv_usuario($id);
	  		$view->setFrv_data(date('Y-m-d h:i:s'));
	  		$viewController->insert($view);
	  		$htmlJquery = '<script text="<script type="text/javascript">atualizaVisitas('.$_POST['resp'].')</script>'; 
	  	}else $htmlJquery = '';
	  	
	  	$usuario = $userController->select($resp->getFrq_usuario());  	
		$respostas = $respostasController->selectByQuestao($resp->getFrq_id());
		
	  	$data = str_replace(' ',' às ',$resp->getFrq_data());

	  	$html ='<div id="box_topico" class="row">
                 <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                 	<img src="imgp/foto_aluno.png">
                 </p>
              <div class="col-xs-11 col-md-11 col-lg-11">
              	 <p class="dados_aluno">
                 	<span class="aluno_nome">'.utf8_encode($usuario->getUsr_nome()).'</span>
                    <span class="aluno_data">Postado dia '.$data.'</span>
                 </p>
                 <p>
                   <span class="resp_aluno">'.utf8_encode($resp->getFrq_questao()).'</span>
                 </p>
               </div>
              </div>
              <div id="box_Respostas_container">
                <div id="box_Respostas">';
	  	$marginRight="";
	  	if (count($respostas) > 0){
                    if (count($respostas) > 4) {
                        $marginRight = "margin_right";
                    }
	  		foreach($respostas as $r){

	  			$usuarioResposta = $userController->select($r->getFrr_usuario());	  
	  			$dataResposta = substr(str_replace(' ',' às ',$r->getFrr_data()),0,-3);
	  			
		  		$html .= '<div class="box_topico_resp '.$marginRight.'">
	                                <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
	                                    <img src="imgp/foto_aluno2.png">
	                                 </p>
	                                <div class="col-xs-11 col-md-11 col-lg-11">
	                                    <div class="dados_aluno">
	                                        <span class="aluno_nome">'.utf8_encode($usuarioResposta->getUsr_nome()).'</span>
	                                        <span class="aluno_data">Postado dia '.$dataResposta.'</span>
	                                    </div>
	                                    <div>  
	                                        <p class="resp_aluno">'.utf8_encode($r->getFrr_resposta()).'</p>
	                                    </div> 
	                                </div>
	                                <div style="clear:both"></div> 
	                            </div>';
	  		}
	  	}
	  	$html .= ' <button id="btn_responder" class="btn_form btn_form_forum '.$marginRight.'">RESPONDER</button>
                             <div id="campo_resp">
                            	<p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                	<img src="imgp/foto_aluno3.png">
                            	</p>
                            	<div class="col-xs-11 col-md-11 col-lg-11">
                                    <div class="dados_aluno">
                                        <span class="aluno_nome">'.utf8_encode($logado->getUsr_nome()).'</span>
                                        <span class="aluno_data">Postado dia  <span class="dataResposta"></span></span>
                                        <textarea id="resp_forum" placeholder="Digite aqui sua resposta!"></textarea>
                                    	<button class="btn_form btn_form_forum" id="btn_pronto" idAluno="'.$id.'">PRONTO</button>
                                    </div>
                            	</div> 
                       	 	</div>
                        </div>';
       $html .= '</div></div>';
       $html .= $htmlJquery;

		echo $html;
	  	break;
	  } 	
	  
	  case "NovaRespostaQuestao":{
	  	$resp = new ForumResposta();
	  	$resp->setFrr_questao($_POST['questao']);
	  	$resp->setFrr_resposta($_POST['resposta']);
	  	$resp->setFrr_usuario($_POST['usuario']);
	  	$resp->setFrr_data(date('Y-m-d h:i:s'));
	  	
	  	if ($respostasController->insert($resp)){
	  		$result = Array();
	  	}else{
	  		$result = Array('erro'=>true);
	  	}
	  	echo json_encode($result);
	  	break;
	  }
	  
      case "listaQuestao":{
          
          $forum = $forumController->selectAll();
          $cont = 0;
         
          
          foreach ($forum as $key => $value)
           {
            
              	$user = $userController->select(($value->getFrq_usuario()));
				
				if($cont % 2 == 0){
					$caixaGrande  = "cx_rosa"; 	
					$caixaPequena = "cx_brancaP";
				}else{
					$caixaGrande  = "cx_branca"; 	
					$caixaPequena = "cx_rosaP";
				}
                  
				echo '<a href="forumResposta.php?resp='.$value->getFrq_id().'"><div class="perg_box '.$caixaGrande.' row">
						<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">
							<p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
							<p class="perg_aluno">'.$value->getFrq_questao().'</p>
							<p class="nome_aluno">'.$user->getUsr_nome().'</p>
							<p class="post_data">'.$value->getFrq_data().'</p>
						</div>
						<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">
							<p class="qtd_visu '.$caixaPequena.'"><span>8</span> visualizações</p>
							<p class="qtd_resp '.$caixaPequena.'"><span>3</span> respostas</p>
						</div>
					</div></a>';
              
              $cont++;
               
          } 
          
          break;
      }

	case "perguntar":{

		$logado = unserialize($_SESSION['USR']);
		
	 	$texto = $_POST["txt"];
		$anexo = $_POST["anexo"];
		$topico = $_POST["topico"];
		$usuario = $logado['id'];
		$data = date("Y-m-d H:i:s");

		$questao = new ForumQuestao();
		$questao->setFrq_questao(utf8_decode($texto));
		$questao->setFrq_topico($topico);
		
		if($anexo == ''){
			$questao->setFrq_anexo('0');
		}else{
			$questao->setFrq_anexo($anexo);
		}
		
		$questao->setFrq_data($data);
		$questao->setFrq_usuario($usuario);
		$forumController->insert($questao);
		
		break;  
	}
	
	
	case "autoComplete":{
	  $keyword =  $_POST['valor'];
	  if ($keyword != '')
	  	$valores =  $forumController->selectComleta($keyword);
	  else $valores = $forumController->selectAll();
	  $cont = 0;
	
	   foreach ($valores as $key => $value)
	   {
		
		  $user = $userController->select(($value->getFrq_usuario()));
		  
		  
		  if($cont % 2 == 0){
			  
			  echo '<div class="perg_box cx_rosa row">
						<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">
							<p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
							<p class="perg_aluno">'.utf8_encode($value->getFrq_questao()).'</p>
							<p class="nome_aluno">'.utf8_encode($user->getUsr_nome()).'</p>
							<p class="post_data">'.$value->getFrq_data().'</p>
						</div>
						<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">
							<p class="qtd_visu cx_brancaP"><span>8</span> visualizações</p>
							<p class="qtd_resp cx_brancaP"><span>3</span> respostas</p>
						</div>
					</div>';
			  
		  }else{             
	   
			  echo   '<div class="perg_box cx_branca row">
						 <div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">
							 <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
							 <p class="perg_aluno">'.utf8_encode($value->getFrq_questao()).'</p>
							 <p class="nome_aluno">'.utf8_encode($user->getUsr_nome()).'</p>
							 <p class="post_data">'.$value->getFrq_data().'</p>
						 </div>                                
						  <div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">
							<p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
							<p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
						  </div> 
					 </div>';
		  }
		  $cont++;
		   
	  }      
		  break;
	}
}

