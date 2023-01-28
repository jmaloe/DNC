<?php
/*@Author: Jesus Malo, support: dic.malo@gmail.com*/
/*Use jquery-ui.css y js para datepicker y mas*/
/*
Para Materialice
<script src="../js/material.min.js"></script>
<script src="../js/ripples.min.js"></script>
<script>
	$(document).ready(function(){
		$.material.init()
	});
</script>
<link rel="stylesheet" href="../css/material.min.css">
<link rel="stylesheet" href="../css/ripples.min.css">
*/
 function getScripts(){
	echo '<script src="../js/jquery-1.11.2.min.js"></script>
		<script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>
		<script src="../js/jquery-ui-1.11.3.custom/jquery-ui.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/datepickerconfig.js"></script>
		<script src="../js/utilidades.js"></script>
		<script src="../js/validaciones.js"></script>';
 }

 function getStyles(){
 	echo '<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../js/jquery-ui-1.11.3.custom/jquery-ui.css">		
		<link rel="stylesheet" href="../css/estilo.css">';		
 }

  function getAcciones($isAdd, $isUpdate, $permisos){
 	if($isAdd)
 	{
 		if($permisos['r'])
 			echo '<input type="submit" class="aceptar btn btn-primary separador" id="btn_aceptar" name="accion" value="ACEPTAR">';	
	}
	if($isUpdate)
	{
	 	if($permisos['u'])
		  echo '<input type="submit" name="accion" id="actualizar" class="aceptar btn btn-success separador" value="ACTUALIZAR">'; 		
	}
	else
	{
	 	if($permisos['w'])
			echo '<input type="submit" name="accion" id="guardar" class="btn btn-success separador" value="GUARDAR">';
	}
	 if($permisos['r'])
		echo '<input type="submit" name="accion" class="btn btn-info separador"  value="BUSCAR"/>';	 
	echo '<input type="submit" name="accion" class="btn btn-default separador" value="CANCELAR">';
 }
 
?>