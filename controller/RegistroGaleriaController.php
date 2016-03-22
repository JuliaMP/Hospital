<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$paths = $_SESSION['PATH_SYS'];
require_once ($paths["dao"]."RegistroGaleriaDAO.php");

class RegistroGaleriaController {
	
	private $registroGaleriaDao;
	
	public function __construct()
	{
		$this->registroGaleriaDao = new RegistroGaleriaDAO(new DataAccess());
	}
	public function insertRegistroGaleria($registrogaleria)
	{
		return $this->registroGaleriaDao->insertRegistroGaleria($registrogaleria);
	}
	public function updateRegistroGaleria($glr)
	{
		return $this->registroGaleriaDao->updateRegistroGaleria($glr);
	}
	public function deleteRegistroGaleria($idglr)
	{
		return $this->registroGaleriaDao->deleteRegistroGaleria($idglr);
	}
	
	public function selectAllRegistroGaleria()
	{
		$ser = $this->registroGaleriaDao->selectAllRegistroGaleria();
		return $ser;
	}

	public function registroGaleriaCountAcessos($escola)
	{
		if ($escola == 0)
			return $this->registroGaleriaDao->registroGaleriaCountAcessos();
		else
			return $this->registroGaleriaDao->registroGaleriaCountAcessosEscola($escola);
	}

	public function registroGaleriaCountDownload($escola)
	{
		if ($escola == 0)
			return $this->registroGaleriaDao->registroGaleriaCountDownload();
		else
			return $this->registroGaleriaDao->registroGaleriaCountDownloadEscola($escola);
	}
}