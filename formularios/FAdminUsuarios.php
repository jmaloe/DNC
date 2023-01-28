<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
 header('Content-type: text/html; charset=utf-8');
 session_start();

 if(!isset($_SESSION['USER']))
 	header("Location:../../login.php");
 
 require_once("../db/AccessDB.php");
 require_once("../acceso/CPermisos.php");
 $acceso = $permiso->getPermisos("FAdminUsuarios");
 $msj = "";
 $encontrado=false;

 if(isset($_POST['accion']))
 {

 	require_once("../acceso/CUsuario.php");
 	
 	$usuario = new CUsuario($db);
 	if(isset($_POST['usuario']))
 	 $usuario->setUsuario($_POST['usuario']);
 	if(isset($_POST['password']))
 	  $usuario->setPassword($_POST['password']);
 	if(isset($_POST['nombre']))
 	  $usuario->setNombre($_POST['nombre']);
 	if(isset($_POST['correo']))
 	  $usuario->setEmail($_POST['correo']);

 	if($_POST['accion']=="Guardar"){
 		if($usuario->guardar()){
 			$msj = "Usuario registrado correctamente";
 		}
 		else{
 			$msj = "Error: ".$usuario->getError();
 		}
 	}
 	else if($_POST['accion']=="Buscar" | $_POST['accion']=="Ajustar"){
 		if($_POST['usuario']!="")
 		{
 			$encontrado = $usuario->buscarByUser(); 			
 		}
 		else if($_POST['nombre']!="")
 		{
 			$encontrado = $usuario->buscarByNombre(); 			
 		}
 		else if($_POST['correo']!="")
 		{
 			$encontrado = $usuario->buscarByEmail(); 			
 		}
 	}
 	else if($_POST['accion']=="Eliminar"){
 		if($usuario->eliminar()){
 			$msj = "Se eliminó correctamente el usuario ".$usuario->getUsuario();
 		}
 	}
 	else if($_POST['accion']=="Actualizar"){
 		if($acceso['w'])
 		{
 			if(isset($_POST['activo']))
 				$usuario->setActivo(1);
 			else
 				$usuario->setActivo(0);
 		} 		
 		if(!$usuario->actualizar())
 			$msj = $usuario->getError();
 		else
 			$msj = "Usuario actualizado: ".$usuario->getUsuario();
 	}
 }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Administración de usuarios</title>
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
			<form action="FAdminUsuarios.php" method="POST" accept-charset="UTF-8"
enctype="application/x-www-form-urlencoded" autocomplete="off" id="form_users">
			<div class="panel panel-primary">
			    <div class="panel-heading">Administrador</div>
				 <div class="panel-body">
				 	<?php
				 	 if($msj!="")
				 	 {
				 	 	echo '<div class="form-group"><label style="color:gray">'.$msj.'</label></div>';
				 	 }
				 	?>

				 	<div class="form-group">
				 		<fieldset>
				 		<legend>Administración de usuarios</legend>
				 		<div class="doce form-group">
					 		<label class="tres">Usuario:</label>
					 		<div class="nueve">
					 			<input type="text" name="usuario" id="usuario" class="form-control" placeholder="usuario" 
					 			<?php if($encontrado) echo 'value="'.$usuario->getUsuario().'" readonly'; ?>
					 			>
					 		</div>
					 	</div>
					 	<div class="doce form-group">
					 		<label class="tres">Contraseña:</label>
					 		<div class="nueve">
					 			<input type="password" name="password" id="password" class="form-control" placeholder="password" <?php if($encontrado) echo 'value="******"'; ?>>
					 		</div>
					 	</div>
					 	<div class="doce form-group">
					 		<label class="tres">Confirmar contraseña:</label>
					 		<div class="nueve">
					 			<input type="password" name="password2" id="password2" class="form-control" placeholder="confirma password" <?php if($encontrado) echo 'value="******"'; ?>>
					 		</div>
					 	</div>
					 	<div class="doce form-group">
					 		<label class="tres">Nombre:</label>
					 		<div class="nueve">
					 			<input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre completo" <?php if($encontrado) echo 'value="'.$usuario->getNombre().'"'; ?>>
					 		</div>
					 	</div>
					 	<div class="doce form-group">
					 		<label class="tres">Email:</label>
					 		<div class="nueve">
					 			<input type="email" name="correo" id="correo" class="form-control" placeholder="correo@unach.mx" <?php if($encontrado) echo 'value="'.$usuario->getEmail().'"'; ?>>
					 		</div>
					 	</div>
					 	<?php					 	
					 	if($encontrado)
					 	{
					 		if($acceso['w'])
					 		{					 		
					 		$checked = "";
					 		if($usuario->isActivo())
					 			$checked = "checked";
					 		echo '<div class="doce form-group">
					 		<label class="tres">Activo:</label>
					 			<div class="nueve">
					 			<input type="checkbox" name="activo" id="activo" class="uno" '.$checked.'>
					 			</div>
					 		</div>';
					 	 	}
					 	}
					 	?>

					 	<div class="form-group">
					 		<?php
					 		if($acceso['w'])
					 			if(!$encontrado)
					 				echo '<input type="submit" class="btn btn-success separador" id="btn_aceptar" name="accion" value="Guardar">';
					 		if($acceso['u'])
					 			if($encontrado)
					 				echo '<input type="submit" class="btn btn-success separador" id="btn_aceptar" name="accion" value="Actualizar">';
					 		if($acceso['r'])
					 		{
					 			echo '<input type="submit" class="btn btn-primary separador" id="btn_buscar" name="accion" value="Buscar">';
					 		    echo '<input type="submit" class="btn btn-info separador" id="btn_cancelar" name="accion" value="Cancelar">';
					 		}
					 		if($encontrado)
					 			if($acceso['d'])
					 				echo '<input type="submit" class="btn btn-danger separador" id="btn_eliminar" name="accion" value="Eliminar">';
					 		$db->close_conn();
					 		?>
					 		<a href="../formularios/FActividad.php" class="btn btn-default">Página principal</a>
					 	</div>
				 		</fieldset>
				 	</div>
				 </div>
			</div>
			</form>
		</section>		
	</body>
</html>