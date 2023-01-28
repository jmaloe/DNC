<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
session_start();
if(!isset($_SESSION['USER']))
	header("Location:../acceso/login.php");

header('Content-type: text/html; charset=utf-8');

require_once("../db/AccessDB.php");
require_once('../acceso/CRoles.php');
require_once("Utilidades.php");

if(!$db->connect())
	echo "Error de conexión a la base de datos";


$roles = new CRoles($db);
$roles->setUsuario($_SESSION['USER']);
$roles->buscarByUser();  
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sistema de Diagóstico de Necesidades de Capacitación</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
	<meta name="description" content="Formulario principal">
	<meta name="author" content="Jesús Malo Escobar">
	<?php  
		getStyles();
		getScripts(); /*para darle estilos al formulario*/
	?>
</head>
<body class="todo-contenido">
	<div class="container" style="margin-top:5px">
		<script>
			$( document ).ready(function(){
				$("#ajustar").on('click',function(){
					var form=$("<form/>").attr({
						method: "post",
						action: "FAdminUsuarios.php"					    
					});
					form.append($("<input/>").attr({name:"accion",value:'Ajustar'}));
					form.append($("<input/>").attr({name:"usuario",value:$("#usuario").val()}));		
					form.submit();
				});

			});
		</script>
		<section id="acciones">
			<form id="form_principal" method="POST" action="FActividad.php">	
				<div class="logout">
					<span>Usuario: <?php echo $_SESSION['USER']; ?></span>
					<b>rol:</b>					
					<select name="roles" onChange='submit()' class="form-control dos" id="roles">
						<?php
						if(isset($_POST['roles']))
						{
							$_SESSION['rol_usuario'] = $_POST['roles'];
							echo $roles->getRolesByUser($_POST['roles']);
						}
						else
						{
							if(isset($_SESSION['rol_usuario'])){
								echo $roles->getRolesByUser($_SESSION['rol_usuario']);
							}
							else
							{
								echo $roles->getRolesByUser(-1); /*-1 indica el rol por default, al iniciar sesion*/
								$_SESSION['rol_usuario'] = $roles->getDefaultRol();
							}
						}
						/*Si no es superusuario o administrador entonces lo redirigimos al diagnostico DNC*/
						if($_SESSION['rol_usuario']>2)
							header("location:DNC.php");
						/*Una vez definido el rol solicitamos CPermisos.php*/
						require_once("../acceso/CPermisos.php");							
						?>
					</select>					
					<input type="hidden" name="usuario" id="usuario" <?php echo 'value="'.$_SESSION['USER'].'"'; ?>>
					<input type="button" class="btn btn-info" name="accion" id="ajustar" value="Ajustar">					
					<a href="../acceso/logout.php" class="btn btn-danger">Salir</a>
				</div>
			</form>
		</section>
		<?php
		$permiso_recurso = $permiso->getPermisos('FDiagnostico');
		if($permiso_recurso['w'])
		{
			?>
			<section id="administracion">
				<fieldset>
					<legend>Diagnóstico de Necesidades de Capacitación <a href="../manual/" target="_blank"><img src="../imagenes/manual_usuario.png" width="30" height="30" title="Manual de usuario"></a></legend>
					<form action="DNC.php" method="POST" accept-charset="UTF-8"
					enctype="application/x-www-form-urlencoded" autocomplete="off" novalidate>
						<label for="admin" class="btn btn-info">
							<div class="imgbutton diagnostico_icon"></div>
							<input type="submit" id="admin" name="admin" value="Diagnóstico" class="btnsinfondo" />
						</label>
					</form>				
				</fieldset>
			</section>		
		
		<?php
	}
	$permiso_recurso = $permiso->getPermisos('FAdminUsuarios');
	if($permiso_recurso['w'])
	{
		?>
		<section id="administracion_usuarios">	
			<div>		
				<fieldset>
					<legend>Administración de usuarios y permisos</legend>
					<form class="adm_users" action="FAdminUsuarios.php" method="POST" accept-charset="UTF-8"
					enctype="application/x-www-form-urlencoded" autocomplete="off" novalidate>		  		
						<label for="admin_users" class="btn btn-default">
							<div class="imgbutton admin_users"></div>
							<input type="submit" id="admin_users" name="admin_users" value="Usuarios" class="btnsinfondo" />
						</label>
					</form>
					<form class="adm_users" action="FAdminPermisos.php" method="POST">
						<label for="permisos_users" class="btn btn-default">
							<div class="imgbutton permisos_users"></div>
							<input type="submit" id="permisos_users" name="permisos_users" value="Permisos" class="btnsinfondo" />
						</label>
					</form>
					<form class="adm_users" action="FAdminRoles.php" method="POST">
						<label for="roles_users" class="btn btn-default">
							<div class="imgbutton roles_users"></div>
							<input type="submit" id="roles_users" name="roles_users" value="Roles y recursos" class="btnsinfondo" />
						</label>
					</form>
			</fieldset>
		</div>
	</section>
	<?php
}
$permiso_recurso = $permiso->getPermisos('FReportes');
if($permiso_recurso['w'])
{
	?>
	<section id="reportes">
		<fieldset>
			<legend>Informes</legend>		  		
			<form action="FReportes.php" method="POST" accept-charset="UTF-8"
			enctype="application/x-www-form-urlencoded" autocomplete="off" novalidate>
			<label for="informe" class="btn btn-success">
				<div class="imgbutton informes_icon"></div>
				<input type="submit" id="informe" name="informe" value="ver reporte" class="btnsinfondo" />
			</label>
		</form>
	</fieldset>			
</section>
<?php
}
?>
<footer>Universidad Virtual UNACH 2015 - By: jesus.malo@unach.mx</footer>
</div>
</body>
</html>