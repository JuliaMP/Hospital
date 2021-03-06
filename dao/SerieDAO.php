<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Serie.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerieDAO
 *
 * @author Kevyn
 */
class SerieDAO extends DAO{
    //put your code here
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($ser)
     {
         $sql  = "insert into serie (sri_serie) values ";
         $sql .= "('".$ser->getSri_serie()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ser)
     {
         $sql  = "update serie set sri_serie = '".$ser->getSri_serie()."',";
         $sql .= "where sri_id = ".$ser->getSri_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idser)
     {
        $sql = "delete from serie where sri_id = ".$idser."";
    	return $this->execute($sql);   
     }
     
      public function select($idser)
     {
        $sql = "select * from serie where sri_id = ".$idser." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $ser = new Serie();
                $ser->setSri_id($qr["sri_id"]);
                $ser->setSri_serie($qr["sri_serie"]);
                	
    	return $adm;
     }
     
     public function selectFull()
     {
        $sql = "select * from serie";
    	$result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $ser = new Serie();
                $ser->setSri_id($qr["sri_id"]);
                $ser->setSri_serie($qr["sri_serie"]);
                array_push($lista, $ser);   
        }
    	return $lista;
     }

     public function listarDisponiveisProfessorSemGrupo($idProfessor)
     {
        $sql = "SELECT * from serie s WHERE 
                (s.sri_id NOT IN (SELECT s2.sri_id FROM serie s2
                    JOIN grupo g ON g.grp_serie = s2.sri_id
                    WHERE g.grp_professor = ".$idProfessor." AND g.grp_periodo = 1)
                OR
                s.sri_id NOT IN (SELECT s2.sri_id FROM serie s2
                    JOIN grupo g ON g.grp_serie = s2.sri_id
                    WHERE g.grp_professor = ".$idProfessor." AND g.grp_periodo  = 2))";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
                $ser = new Serie();
                $ser->setSri_id($qr["sri_id"]);
                $ser->setSri_serie($qr["sri_serie"]);
                array_push($lista, $ser);   
        }
        return $lista;
     }

     public function listarDisponiveisProfessor($idProfessor)
     {
        $sql = "SELECT * FROM serie s
                    JOIN grupo g ON g.grp_serie = s.sri_id
                    WHERE g.grp_professor = ".$idProfessor;
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
                $ser = new Serie();
                $ser->setSri_id($qr["sri_id"]);
                $ser->setSri_serie($qr["sri_serie"]);
                array_push($lista, $ser);   
        }
        return $lista;
     }
}
?>