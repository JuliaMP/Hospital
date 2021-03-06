<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'EscolaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EscolaController {
    //put your code here
    private $escolaDAO;
    public function __construct()
	{
		$this->escolaDAO =  new EscolaDAO(new DataAccess());
	}
	
	public function insert($esc)
	{
		return $this->escolaDAO->insert($esc);
	}
	
	public function update($esc)
	{
		return $this->escolaDAO->update($esc);
	}
	
	public function delete($idesc)
	{
		return $this->escolaDAO->delete($idesc);
	}
	
	public function select($idesc)
	{
		$esc = $this->escolaDAO->select($idesc);
		return $esc;
	}
	
	public function selectAll()
	{
		$esc = $this->escolaDAO->selectFull();
		return $esc;
	}
	public function selectPendentes()
	{
		$esc = $this->escolaDAO->selectPendentes();
		return $esc;
	}
	public function confirmCadastro($idesc)
	{
		$esc = $this->escolaDAO->confirmCadastro($idesc);
		return $esc;
	}
	public function rejectCadastro($idesc)
	{
		$esc = $this->escolaDAO->rejectCadastro($idesc);
		return $esc;
	}
	public function verificaCnpj($cnpj) {
		return $this->escolaDAO->verificaCnpj($cnpj);
	}
	public function selectAtivas()
	{
		return $this->escolaDAO->selectAtivas();
	}
}
?>