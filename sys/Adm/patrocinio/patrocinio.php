<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'Patrocinio.php');
include_once($path['controller'].'PatrocinioController.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['template'].'Template.php');
$cidade = $_SESSION['CIDADE'];
$template = new Template();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Categoria</title> 
<link href="../../../css/jquery.tabs-ie.css" rel="stylesheet" type="text/css" />
</head>
<body id="adm">
	<div id="topo"></div>
    <div id="menu">
    	<ul>
        	<li><a href="../categoria/categoria.php">Categoria</a></li>
            <li><a href="../evento/evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="patrocinio.php">Patrocinios</a></li>
            <li><a href="../pontoTuristico/pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
	<div id="corpo">
   	<p><a href="novoPatrocinador.php">Cadastrar novo Patrocinador</a></p>
    <?php 
		$template->listaPatrocinadorByCidade($cidade);
	?>
</div>        
</div>	 
</body>
</html>