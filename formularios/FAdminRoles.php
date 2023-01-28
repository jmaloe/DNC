<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
 header('Content-type: text/html; charset=utf-8');
 session_start();

 if(!isset($_SESSION['USER']))
 	header("Location:../../login.php");
 
 require_once("../db/AccessDB.php");
 require_once("../acceso/CRoles.php");
 require_once("../acceso/CRecursos.php");
 require_once("../acceso/CPermisos.php");

 $rol = new CRoles($db);
 $recurso = new CRecursos($db);
 $msj = "";

 if(isset($_POST['accion']))
 { 	
 	if(isset($_POST['nombrerol']))
 	 $rol->setNombreRol($_POST['nombrerol']);
 	if(isset($_POST['recurso']))
 	  $recurso->setNombreRecurso($_POST['recurso']); 	

 	if($_POST['accion']=="Guardar"){
 		if($rol->getNombreRol()!="")
 		if($rol->guardar()){
 			$msj = "Nuevo rol creado: ".$rol->getNombreRol();
 		}
 		else{
 			$msj = "Error: ".$rol->getError();
 		}
 		if($recurso->getNombreRecurso()!="")
 		if($recurso->guardar()){
 			$msj = "Nuevo recurso creado: ".$recurso->getNombreRecurso();
 		}
 		else{
 			$msj = "Error: ".$recurso->getError();
 		}
 	}
 	else if($_POST['accion']=="Asignar")
 	{
 		$idAsignado=false;
 		$rol->setIdRol($_POST['roles']);
 		$rol->eliminarPermisos(); //borramos todo para asignar lo nuevo
		if(!empty($_POST['permiso']))
		{
 			foreach ($_POST['permiso'] as $permiso_x)
 			{
 			$idRec=0;
 			$lect=0;
 			$escr=0;
 			$act=0;
 			$elim=0;
 				foreach ($permiso_x as $key => $value)
 				{ 					
 					if(!$idAsignado)
 					{
 						$idRec=$value;
 						$idAsignado=true;
 					}

 					if($key==1)
 						$lect=1; 					
 					else if($key==2)
 						$escr=1; 					
 					else if($key==3)
 						$act=1; 					
 					else if($key==4)
 						$elim=1; 					
 					//echo $key." ".$value."<br>";
 				}
 				$idAsignado=false; 				
 				$rol->asignarPermisos(array('idRecurso'=>$idRec,'lect'=>$lect,'escr'=>$escr,'act'=>$act,'elim'=>$elim));
 			}
 		}
 		//recargamos el formulario para aplicar cambios de permisos sobre Roles y Recursos
 		header("Location:FAdminRoles.php");
 	}
 }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Administración de roles</title>
		<meta charset="utf-8" />
		<meta name="description" content="Login">
		<meta name="author" content="Jesús Malo Escobar">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../css/estilo.css">
		<script src="../js/jquery-1.11.2.min.js"></script>
		<script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/admin_users_validaciones.js"></script>
	</head>
	<body class="formularioLogin" style="width:30%; margin:0 auto;">
		<section id="Admin">
			<form action="FAdminRoles.php" method="POST" accept-charset="UTF-8"
enctype="application/x-www-form-urlencoded" autocomplete="off" id="form_users">
			<div class="panel panel-primary">
			    <div class="panel-heading">Administración</div>
				 <div class="panel-body">
				 	<?php
				 	 if($msj!="")
				 	 {
				 	 	echo '<div class="form-group"><label style="color:gray">'.$msj.'</label></div>';				 	
				 	 }				 	 
				 	?>
				 	<div class="form-group">
				 		<fieldset>
				 		<?php
				 		$acceso_rol = $permiso->getPermisos("FAdminRoles");
				 		if($acceso_rol['w'])
				 	 	{
				 		?>
				 		<legend>Roles y recursos</legend>
				 		<div class="doce form-group">
					 		<label class="tres">Nuevo rol:</label>
					 		<div class="nueve">
					 			<input type="text" name="nombrerol" id="nombrerol" class="form-control separador" placeholder="Descripción del rol">
					 			<?php
					 				echo '<input type="submit" class="btn btn-success separador" id="btn_aceptar" name="accion" value="Guardar">';
					 				echo '<input type="submit" class="btn btn-info separador" id="btn_cancelar" name="accion" value="Cancelar">';
					 			?>
					 		</div>
					 	</div>
					 	<hr/>
					 	<?php
				 		}
				 		$acceso_recursos = $permiso->getPermisos("FAdminRecursos");
				 		if($acceso_recursos['w'])
				 		{
				 		?>
					 	<div class="doce form-group">
					 		<label class="tres">Nuevo recurso:</label>
					 		<div class="nueve">
					 			<input type="text" name="recurso" id="recurso" class="form-control separador" placeholder="Nombre del recurso">
					 			<?php
					 				echo '<input type="submit" class="btn btn-success separador" id="btn_aceptar" name="accion" value="Guardar">';
					 				echo '<input type="submit" class="btn btn-info separador" id="btn_cancelar" name="accion" value="Cancelar">';
					 			?>
					 		</div>
					 	</div>
					 	<hr/>
					 	<?php
					 	}
					 	?>
				 		</fieldset>
				 	</div>
				 	<?php
				 	//verificamos si el rol tiene permiso de lectura
				 	if($acceso_rol['r'])
				 	{
				 	?>
				 	<div class="form-group">
				 		<fieldset>
				 			<legend>Permisos</legend>
				 			<div class="doce form-group">
				 				<label class="tres">Rol:</label>
				 				<div class="cinco">
				 					<select name="roles" class="form-control separador">
				 						<?php
				 							echo $rol->getRoles(isset($_POST['roles'])?$_POST['roles']:0);
				 						?>
				 					</select>
				 				</div>
				 				<?php
				 				if($acceso_recursos['r'])
				 				{
				 					echo '<div class="cuatro">
				 					<input type="submit" name="accion" value="Mostrar permisos" class="btn btn-success">
				 				</div>';
				 				}
				 				?>				 				
				 			</div>				 			
				 			<?php
							if(isset($_POST['roles']))							
				 			{
				 			echo '<div class="doce form-group">
				 				<label>Recursos:</label>
				 			</div>
				 			<div class="form-group">
				 				<div class="doce">
				 				<table class="actividades">
				 					<thead>
				 						<tr>
				 							<th>Id</th>
				 							<th>Nombre</th>
				 							<th style="width:10%">Leer</th>
				 							<th style="width:10%">Escribir</th>
				 							<th style="width:10%">Actualizar</th>
				 							<th style="width:10%">Eliminar</th>
				 						</tr>
				 					</thead>
				 					<tbody>';
				 					if($acceso_recursos['w']==0)
				 						$recurso->setDisabled(true);
				 					echo $recurso->getRecursosByRol($_POST['roles']);
				 					echo $recurso->getRecursosNoAsignadosByRol($_POST['roles']);				 							
				 						
				 					echo '</tbody>
				 				</table>
				 				</div>';
				 				if($acceso_recursos['w']){
				 					echo '<div class="doce">
				 							<input type="submit" name="accion" value="Asignar" class="btn btn-primary">
				 						</div>
				 				</div>';
				 				}
				 			}
							?>
				 		</fieldset>
				 	</div>				 	
				 	<?php
				 	}
				 	?>
				 <a href="../formularios/FActividad.php" class="btn btn-default">Página principal</a>
				 </div>
			</div>
			</form>
		</section>		
	</body>
</html>
<?php
	$db->close_conn();
?>