<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];
$urlSys = $_SESSION['URL_SYS'];

include_once($path['controller'].'UsuarioController.php');
$userController = new UsuarioController();

switch ($_POST["acao"]){

	case "verificaEmail":{ 
		$emailValidacao = $userController->verificaEmail($_POST["email"]);	
		print_r(trim($emailValidacao));   
		break;
	}

	case "enviaEmail":{

		$email_servidor = "criancascomoparceiras@gmail.com";
		$de = $email_servidor;
		$para = $_POST["email"];

		$msg  ='<html>';
		$msg .='<head>';
		$msg .='</head>';
		$msg .='<body>';
		$msg .='<div id="container" style="padding: 15px;background-color: #f7f7f7;">';
		$msg .='<h1 style="margin: 0; margin-bottom: 15px; font-family: arial; font-size: 22px; font-weight: bold; color: #999;">Redefinição de senha</h1>';
		$msg .='<hr style="border: 0; background-color: #ccc; height: 1px;">';
		$msg .='<div id="conteudo_mensagem" style="font-size: 16px; font-family: Arial; font-weight: normal; color: #666">';
		$msg .='<p>Para redefinir sua senha, <a href=/index.php?recup=".$email" style="color: #728C07; font-weight: bold; text-decoration: none;">clique aqui</a></p>';
		$msg .='<p>Caso o link não esteja funcionando, copie e cole a url abaixo em seu navegador:</p>';
		$msg .='<p style="color: #728C07">/index.php?recup=''</p>';
		$msg .='</div>';
		$msg .='<hr style="border: 0; background-color: #ccc; height: 1px;">';
		$msg .='<div id="assinatura" style="text-align: right;">';
		$msg .='<img src="http://187.73.149.26:8080/img/logo/logo_lg.png" height="60px" />';
		$msg .='</div>';
		$msg .='</div>';
		$msg .='</body>';
		$msg .='</html>';

		$assunto = "Recuperar senha";
	 
	 	$headers = "MIME-Version: 1.0\r\n";
	    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
	   	$headers .= "From:HCB:<$email_servidor>\r\n";
	   	$headers .= "Reply-To: $para\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

	    $enviar  = mail($para, $assunto,$msg, $headers,"-f$email_servidor");
	    print_r($enviar);
	}

	// $msg  ='<html>
	// 		<head>
	// 			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	// 		</head>
	// 		<body>
	// 		<div id="container" style="padding: 15px;background-color: #f7f7f7;">
	// 		<h1 style="margin: 0; margin-bottom: 15px; font-family: arial; font-size: 22px; font-weight: bold; color: #999;">Redefinição de senha</h1>
	// 		<hr style="border: 0; background-color: #ccc; height: 1px;">
	// 		<div id="conteudo_mensagem" style="font-size: 16px; font-family: Arial; font-weight: normal; color: #666">
	// 		<p>Para redefinir sua senha, <a href=/index.php?recup=".$email" style="color: #728C07; font-weight: bold; text-decoration: none;">clique aqui</a></p>
	// 		<p>Caso o link não esteja funcionando, copie e cole a url abaixo em seu navegador:</p>
	// 		<p style="color: #728C07">/index.php?recup='.$_POST["email"].'</p>
	// 		</div>
	// 		<hr style="border: 0; background-color: #ccc; height: 1px;">
	// 		<div id="assinatura" style="text-align: right;">
	// 		<img src="http://187.73.149.26:8080/img/logo/logo_lg.png" height="60px" />
	// 		</div>
	// 		</div>
	// 		</body>
	// 		</html>';
}		 
?>