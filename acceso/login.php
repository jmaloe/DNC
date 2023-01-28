<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION['USERNAME']))
	header("Location:../formularios/FActividad.php");
$msj = "";
if(isset($_POST['accion'])){
	require_once("../db/AccessDB.php");
	require_once("CUsuario.php");
	global $db;	
	$usuario = new CUsuario($db); 	
	$usuario->setUsuario($_POST['usuario']);
	$usuario->setPassword($_POST['password']);
	if($usuario->autenticar()){
		if($usuario->isActivo())
		{
			$_SESSION["USER"] = $usuario->getUsuario();
			$_SESSION['USERNAME'] = $usuario->getNombre();
			header("Location:../formularios/FActividad.php");
		}
		else{
			$msj = "Este usuario no está activo";
		}
	}
	else{
		$msj = "Usuario y/o contraseña incorrectos";
	}
	$db->close_conn();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login DNC</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
	<meta name="description" content="Login">
	<meta name="author" content="Jesús Malo Escobar">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="../css/login.css">
</head>
<body>	
	<div class="contenedor">
		<div class="img seccion-header">		
			<div class="header-login">
				<div class="header-content">
					<div class="img escudo-unach"></div>
					<div class="header-texto">
						<div class="header-title">
							¿BUSCAS CAPACITAR A TU PERSONAL?
						</div>
						<hr/>
						<div class="header-description">
							<p class="texto">
								La UNACH Virtual, a través de Educación Continua, te ayuda a identificar las necesidades de capacitación y te brinda las alternativas de formación continua que se requieran, ya que contamos con un amplio padrón de formadores de diversas áreas de conocimiento.
							</p>
							<p class="texto">
								Solicita una clave acceso para aplicar la encuesta de Diagnóstico de Necesidades de Capacitación (DNC) en tu empresa o institución, para saber qué tipo de formación requiere tu personal.
							</p>							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="seccion-contactanos borde-seccion">
			<div class="contacts-content">
				<div class="contacts-col1">
					<div class="titulo-seccion">CONTÁCTANOS</div>
					<div class="contacts-seccion">
						<div class="izq">						
							<p class="texto titulo">
								Tuxtla Gutiérrez
							</p>
							<p class="texto txtcontacto">
								Biblioteca Central Universitaria "Carlos Maciel Espinosa", 2º piso, oficinas del SINED. 
								Blvd. Belisario Domínguez Km. 1081, Sin Número.
								Teléfono 01 (961) 61 78000 extensión 1355 
							</p>
						</div>
						<div class="der">
							<p class="texto titulo">
								Tapachula
							</p>
							<p class="texto txtcontacto">
								Sede de Universidad Virtual, Centro de Estudios Avanzados y Extensión (CEAyE). 
								Pista principal esquina pista secundaria-antiguo aeropuerto, colonia solidaridad 2000.
								Teléfono 01 (962) 62 811 33
							</p>
						</div>
					</div>
				</div>
				<div class="contacts-col2">
					<div class="img phone-seccion"></div>
				</div>
			</div>			
		</div>
		<div class="seccion-email borde-seccion">			
			<div class="content-email">		
				<div class="contacts-col1">
					<div class="img logo_email"></div>
					<p class="texto txtemail"><a href="mailto:educacion.continua@unach.mx" style="text-decoration:none; color:white">educacion.continua@unach.mx</a></p>
				</div>
				<div class="contacts-col2"></div>
			</div>
		</div>
		<div class="img seccion-login borde-seccion">
			<div class="content-login">									
				<div class="login-form">
					<div class="login-title">INICIO DE SESIÓN</div>
					<form action="login.php" method="POST" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="off">				
						<div class="login panel panel-primary">
							<!--<div class="panel-heading border">Inicio de sesión</div>-->									
							<div class="form-group">																			
								<div class="form-group">
									<div class="txtlogin">Nombre de usuario:</div>											
									<div class="input-login">
										<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
									</div>
								</div>
								<div class="form-group">	
									<div class="txtlogin">Contraseña:</div>
									<div class="input-login">
										<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
									</div>
								</div>
								<div class="form-group">												
									<input type="submit" name="accion" id="accion" value="Entrar" class="btn btn-primary btn-entrar"/>
								</div>
							</div>
							<?php
							if($msj != "")
							{
								echo '<div class="form-group error border"><label>'.$msj.'</label></div>';				 	
							}
							?>
						</div>
					</form>
				</div>							
			</div>
		</div>
		<div class="footer-login">
			<p class="texto">Sitio desarrollado en la UNACH<br>
			Derechos Reservados Universidad Autónoma de Chiapas</p>
		</div>
</div>	

<script src="../js/jquery-1.11.2.min.js"></script>
<script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>