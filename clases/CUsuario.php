<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com 04/09/2015*/
require_once("../acceso/CUsuario.php");

class CUsuariosDNC extends CUsuario{

	var $id_usuario,
		$id_usuario_sistema,
		$id_nivel_estudios,
		$edad,
		$sexo,
		$puesto,
		$telefono,
		$estado_civil,
		$discapacidad="Ningúna";

	function __construct($db)
	{
		parent::__construct($db); /*invocar el constructor de la clase padre*/		
	}

 	/*Setters*/

 	function setIdUsuarioDNC($id){
 		$this->id_usuario = $id;
 	} 	

 	function setIdUsuarioSistema($idus){
 		$this->id_usuario_sistema = $idus;
 	}

 	function setIdNivelEstudios($idne){
 		$this->id_nivel_estudios = $idne;
 	}

 	function setEdad($e){
 		$this->edad = $e;
 	}

 	function setSexo($s){
 		$this->sexo = $s;
 	}

 	function setPuesto($p){
 		$this->puesto = $this->scapeString($p);
 	} 	

 	function setTelefono($tel){
 		$this->telefono = $this->scapeString($tel);
 	}

 	function setEstadoCivil($id){
 		$this->estado_civil = $id;
 	}

 	function setDiscapacidad($dis){
 		$this->discapacidad = $dis;
 	}

 	/*Getters*/
 	function getIdUsuarioDNC(){
 		return $this->id_usuario;
 	}

 	function getIdUsuarioSistema(){
 		return $this->id_usuario_sistema;
 	}

 	function getIdNivelEstudios(){
 		return $this->id_nivel_estudios;
 	}

 	function getEdad(){
 		return $this->edad;
 	}

 	function getSexo(){
 		return $this->sexo;
 	}

 	function getPuesto(){
 		return $this->puesto;
 	} 	

 	function getTelefono(){
 		return $this->telefono;
 	}

 	function getEstadoCivil(){
 		return $this->estado_civil;
 	}

 	function getDiscapacidad(){
 		return $this->discapacidad;
 	}
	
	/*método para registro*/
	function insertar(){
		$sql = "INSERT INTO usuarios(idUser,id_ne,id_ec,edad,sexo,puesto,email,telefono,discapacidad) VALUES(".$this->getIdUsuario().",".$this->id_nivel_estudios.",1,".$this->edad.",'".$this->sexo."','".$this->puesto."','".$this->email."','".$this->telefono."','".$this->discapacidad."')";
		if($this->update($sql))
		{
			$this->setIdUsuarioDNC($this->getInsertID());
			return true;
		}
	 return false;
	}

	/*método para actualización*/
	function actualizar(){

	}

	/*método para eliminación*/
	function eliminar(){

	}	
}
?>