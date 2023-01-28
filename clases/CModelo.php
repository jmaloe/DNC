<?php
require_once('../db/ConexionDB.php');

class CModelo extends ConexionDB{

	var $tabla="",
		$campos="",
		$valores="",
		$clausulas="";

	var $resultado = array();

	function __construct($db)
	{
		parent::__construct($db); /*invocar el constructor de la clase padre*/
	}

 	/*Setters*/

 	function setTabla($t){
 		$this->tabla = $t;
 	}

 	function setCampos($camposx){
 		$this->campos = $camposx;
 	}

 	function setValores($params){
 		$this->valores = $params;
 	}

 	function setClausulas($c){
 		$this->clausulas = $c;
 	}

 	function setResultado($res){
 		if($fila = mysqli_fetch_assoc($res)){
 			$aux = null;
 			$aux = array();
 			foreach ($fila as $key => $value) {
 				$aux["'".$key."'"] = $value;
 			}
 			array_push($this->resultado,$aux);
 		}
 		else
 			return false;
 	}

 	/*Getters*/
 	function getTabla(){
 		return $this->tabla;
 	}

 	function getCampos(){
 		return $this->campos;
 	}

 	function getValores(){
 		return $this->valores;
 	}

 	function getClausulas(){
 		return $this->clausulas;
 	}

	function getValor($criterio){
		foreach ($this->resultado as $fila) {
			foreach ($fila as $key => $value){
				if($key==$criterio){
					return $value;
				}
			}
		}
	}

	/*método de busqueda, require campos, nombre de tabla y restricciones*/
	function buscar(){
		$sql = "SELECT ".$this->getCampos()." FROM ".$this->getTabla()." ".$this->getClausulas();
		$resultado = $this->query($sql);
		if($this->setResultado($resultado))
			return true;
		else
			return false;
	}

	/*retorna los items para un select, require item por default*/
	function getColeccion($params){
	   $sql = "SELECT ".$this->getCampos()." FROM ".$this->getTabla()." ".$this->getClausulas();
         $resultado = $this->query($sql);
         switch ($params['tiporetorno'])
         {
         	case 'checkbox':
         		return $this->getCheckboxItems($resultado,$params['nombre'],$params["columnas"]);
         	break;

         	case 'select':
         		return $this->getSelectItems($resultado,$params['defaultselect']);
         	break;
         }
         
	}

	/*método para registro*/
	function insertar(){
		$sql = "INSERT INTO ".$this->tabla."(".$this->campos.") VALUES(".$this->valores.");";
		if($this->query($sql))
			return $this->getInsertId();
	 return false;	
	}	

	/*método para actualización*/
	function actualizar(){
		$sql = "INSERT INTO ".$this->tabla."(".$this->campos.") VALUES(".$this->valores.") ".$this->clausulas;
		if($this->update($sql))
			return true;
	  return false;
	}

	/*método para eliminación*/
	function eliminar(){

	}	
}
?>