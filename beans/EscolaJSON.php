<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EscolaJSON
 *
 * @author Lucas
 */
class EscolaJSON {
	private $esj_id;
	private $esj_escola;
	private $esj_string;

	public function EscolaJSON() {}

	public function getEsj_id() {
		return $this->esj_id;
	}

	public function getEsj_escola() {
		return $this->esj_escola;
	}

	public function getEsj_string() {
		return $this->esj_string;
	}


	public function setEsj_id($id) {
		$this->esj_id = $id;
	}

	public function setEsj_escola($escola) {
		$this->esj_escola = $escola;
	}

	public function setEsj_string($string) {
		$this->esj_string = $string;
	}
}

?>