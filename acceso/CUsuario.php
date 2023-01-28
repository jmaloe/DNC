<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
require_once('../db/ConexionDB.php');

class CUsuario extends ConexionDB{
 var $idUsuario=-1,
 	 $usuario, 
 	 $password,
 	 $nombre,
 	 $email,
 	 $esVigente=-1,
 	 $fecha_alta;

 function __construct($db)
 {
    parent::__construct($db); /*invocar el constructor de la clase padre*/
 }

 function setIdUsuario($idU){
 	$this->idUsuario = $idU;
 }

 function setUsuario($usr){
 	$this->usuario = $this->scapeString($usr);
 }

 function setPassword($passwd){
 	if($passwd!="******")
 		$this->password = md5($this->scapeString($passwd));
 	else
 		$this->password =  false;
 }

 function setNombre($nom){
 	$this->nombre = $this->scapeString($nom);
 }

 function setEmail($correo){
 	$this->email = $this->scapeString($correo);
 }

 function setActivo($tf){
 	$this->esVigente = $tf;
 }

 function setFechaAlta($fa){
 	$this->fecha_alta = $fa;
 }

 function getIdUsuario(){
 	return $this->idUsuario;
 }

 function getUsuario(){
 	return $this->usuario;
 }

 function getPassword(){
 	return $this->password;
 }

 function getNombre(){
 	return $this->nombre;
 }

 function getEmail(){
 	return $this->email;
 }

 function isActivo(){
 	if($this->esVigente==1)
 		return true;
 	else
 		return false; 	
 }

 function getFechaAlta(){
 	return $this->fecha_alta;
 }

 function autenticar(){
 	$sql = "SELECT nombre, email, vigente, fechaCaptura FROM usuarios_sistema WHERE user='".$this->usuario."' AND password='".$this->password."';";
 	$resultado = $this->query($sql);
 	 if($dato = mysqli_fetch_assoc($resultado)){
 	 	$this->setNombre($dato['nombre']);
 	 	$this->setEmail($dato['email']);
 	 	$this->setActivo($dato['vigente']);
 	 	$this->setFechaAlta($dato['fechaCaptura']); 	 	
 	 	return true;
 	 }
 	 return false; 	 
 }

 function guardar(){
 	$sql = "INSERT INTO usuarios_sistema(user,password,nombre,email) VALUES('".$this->usuario."','".$this->password."','".$this->nombre."','".$this->email."');";
 	if($this->update($sql)){
 		return true;
 	}
 	return false;
 }

 function actualizar(){
 	if($this->password!=false)
 	{
 		if($this->esVigente!=-1)
 			$sql = "UPDATE usuarios_sistema SET password='".$this->password."', nombre='".$this->nombre."', email='".$this->email."', vigente=".$this->esVigente." WHERE user='".$this->usuario."';";
 		else
 			$sql = "UPDATE usuarios_sistema SET password='".$this->password."', nombre='".$this->nombre."', email='".$this->email."' WHERE user='".$this->usuario."';";
 	}
 	else
 	{
 		if($this->esVigente!=-1)
 			$sql = "UPDATE usuarios_sistema SET nombre='".$this->nombre."', email='".$this->email."', vigente=".$this->esVigente." WHERE user='".$this->usuario."';";
 		else
 			$sql = "UPDATE usuarios_sistema SET nombre='".$this->nombre."', email='".$this->email."' WHERE user='".$this->usuario."';";
 	} 	
 	if($this->update($sql)){
 		return true;
 	}
 	return false;
 }

 function eliminar(){
 	$sql = "DELETE FROM usuarios_sistema WHERE user='".$this->usuario."';";
 	if($this->update($sql)){
 		return true;
 	}
 	return false;
 }

 function buscarById(){
 	$sql = "SELECT idUser,user,password,nombre,email,vigente,fechaCaptura FROM usuarios_sistema WHERE idUser=".$this->getIdUsuario().";";
 	$resultado = $this->query($sql); 	
 	if($this->loadUser($resultado))
 	{
 		return true;
 	}
 	return false;
 }

 function buscarByUser(){
 	$sql = "SELECT idUser,user,password,nombre,email,vigente,fechaCaptura FROM usuarios_sistema WHERE user='".$this->usuario."';";
 	$resultado = $this->query($sql); 	
 	if($this->loadUser($resultado))
 	{
 		return true;
 	}
 	return false;
 }

 function buscarByNombre(){
 	$sql = "SELECT idUser,user,password,nombre,email,vigente,fechaCaptura FROM usuarios_sistema WHERE nombre like '%".$this->nombre."%';";
 	$resultado = $this->query($sql);
 	if($this->loadUser($resultado))
 	{
 		return true;
 	}
 	return false;
 }

 function buscarByEmail(){
 	$sql = "SELECT idUser,user,password,nombre,email,vigente,fechaCaptura FROM usuarios_sistema WHERE email='".$this->email."';";
 	$resultado = $this->query($sql);
 	if($this->loadUser($resultado))
 	{
 		return true;
 	}
 	return false;
 }

 function loadUser($result){
 	if($data = mysqli_fetch_assoc($result)){
 		$this->setIdUsuario($data['idUser']);
 		$this->setUsuario($data['user']);
 		$this->setPassword($data['password']);
 		$this->setNombre($data['nombre']);
 		$this->setEmail($data['email']);
 		$this->setActivo($data['vigente']);
 		$this->setFechaAlta($data['fechaCaptura']);
 		return true;
 	}
 	return false;
 }

}
?>