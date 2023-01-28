<?php
session_start();
 if(!isset($_SESSION['USER']))
 	header("Location:../acceso/login.php");
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>Manual DNC</title>
</head>
<body>
<header>
	<h1>Manual de usuario</h1>
</header>
<section class="cd-faq">
	<ul class="cd-faq-categories">
		<li><a class="selected" href="#login">Login</a></li>
		<li><a href="#main">Principal</a></li>
		<li><a href="#item1">Diagnostico DNC</a></li>
		<li><a href="#item3">Usuarios</a></li>
		<li><a href="#item4">Permisos</a></li>
		<li><a href="#item5">Roles y recursos</a></li>
		<li><a href="#item6">Reportes</a></li>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
		<ul id="login" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Login</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">¿Cómo iniciar sesión en el sistema?</a>
				<div class="cd-faq-content">
					<p>El acceso al sistema es sencillo, únicamente ingrese su nombre de usuario y contraseña los cuales fueron proporcionados previamente por el administrador del sistema y posteriormente de click en "Entrar". Por su seguridad se recomienda realizar el cambio de contraseña cuando acceda por primera vez. Ingrese como se muestra a continuación.</p>
					<img src="./imagenes/01_login.png"/>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">¿Cómo recuperar la contraseña?</a>
				<div class="cd-faq-content">
					<p>Contacte al administrador del sistema.</p>
				</div> <!-- cd-faq-content -->
			</li>			
		</ul> <!-- cd-faq-group -->

		<ul id="main" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Página principal</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Elementos del formulario</a>
				<div class="cd-faq-content">
					<p>Los elementos del sistema con los cuales el usuario puede interactuar se indican a continuación. Es necesario conocer cada uno de los elementos para poder explotar en su totalidad los procesos que el sistema provee.</p>
					<img src="./imagenes/02_main.png"/>
					<blockquote>
						<ul>
							<li><p>(1). <b>Rol del usuario</b>: cambie de rol en dado caso que el administrador le asigne mas de un rol. Para cambiar basta seleccionar el rol de la lista desplegable.</p></li>
							<li><p>(2). <b>Ajustar</b>: Realice cambios en sus datos de perfil de usuario tales como el nombre, contraseña, email; asi como tambien ejecute acciones de búsqueda, actualización o eliminación (en caso de tener los permisos necesarios).</p></li>
							<li><p>(3). <b>Salir</b>: le permite cerrar la sesión activa.</p></li>
							<li><p>(4). <b>Diagnóstico</b>: ingrese al Diagnóstico de Necesidades de Capacitación.</p></li>							
							<li><p>(5). <b>Administración de usuarios y permisos</b>: registre nuevos usuarios en el sistema, asigne roles y gestione el acceso a los recursos(páginas) del sistema.</p></li>
							<li><p>(6). <b>Informes</b>: genere un reporte de los datos que se encuentran en el sistema y visualice la información en una tabla la cual podrá exportar a formato de Microsoft Office Excel.</p></li>
						</ul>
					</blockquote>
				</div> <!-- cd-faq-content -->
			</li>			
		</ul> <!-- cd-faq-group -->

		<ul id="item1" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Diagnóstico DNC</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Acerca del diagnóstico...</a>
				<div class="cd-faq-content">
					<p>Para realizar el diagnóstico localice el apartado "Diagnóstico de Necesidades de Capacitación" y en seguida de click en el botón "Diagnóstico".</p>
					<img src="./imagenes/03_iraldiagnostico.png"/>
					<p>Una vez en el diagnóstico proceda a completar todos los datos que se solicitan. Vea la demostración a continuación.</p>
					<img src="./imagenes/03_diagnostico_01.png"/>
					<img src="./imagenes/03_diagnostico_02.png"/>
					<img src="./imagenes/03_diagnostico_03.png"/>
					<img src="./imagenes/03_diagnostico_04.png"/>
					<p>Una vez llenado el formulario de click en <b>"Enviar"</b>. En seguida el sistema le mostrará una notificación con el número de registro del diagnóstico presentado.</p>					
					<p>En caso de necesitar limpiar todos los campos del formulario e iniciar de nuevo de click en <b>"Limpiar"</b>.</p>
					<p>Si tiene permisos de Administrador le será visible el botón <b>"Página principal"</b> para regresar al menú de administración.</p>
					<p>Si desea salir del sistema y no continuar con el diagnóstico de click en <b>"Salir"</b>.</p>
					<img src="./imagenes/03_diagnostico_05.png"/>
					<p>Si desea realizar una nueva encuesta de click en <b>"Nueva encuesta"</b> o en <b>"Finalizar"</b> para terminar su sesión. Si tiene permisos de Administrador el sistema le muestra un botón para ir a <b>"Página principal"</b>.</p>
				</div> <!-- cd-faq-content -->
			</li>			
		</ul> <!-- cd-faq-group -->

		<ul id="item3" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Administración de usuarios</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">¿Cómo agregar nuevo usuario?</a>
				<div class="cd-faq-content">
					<p>Localice el apartado "Administración de usuarios y permisos" y de click en "Usuarios".</p>
					<img src="./imagenes/usuario_administracion.png"/>
					<p>En seguida ingrese todos los datos requeridos en el formulario y de click en <b>"Guardar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_alta.png"/></div>
					<div style="width:60%"><img src="./imagenes/usuario_alta2.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>
			<li>
				<a class="cd-faq-trigger" href="#0">Modificación de los datos</a>
				<div class="cd-faq-content">
					<p>Para modificar los datos de un usuario puede realizarlo mediante 3 mecanismos de búsqueda, los cuales se describen a continuación.</p>
					<p><i>1a forma: búsqueda por usuario</i> ingrese únicamente el usuario en "Usuario" y de click en <b>"Buscar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_busqueda01.png"/></div>
					<p><i>2a forma: búsqueda por nombre</i> escriba un indicio o el nombre del usuario en "Nombre" y de click en <b>"Buscar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_busqueda02.png"/></div>
					<p><i>3a forma: búsqueda mediante email</i> especifíque el email del usuario en "Email" y de click en <b>"Buscar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_busqueda03.png"/></div>
					<p>En la imagen siguiente se muestra el resultado de la búsqueda mediante cualquiera de los 3 mecanismos de consulta. Los datos que pueden ser modificados son: contraseña, nombre de usuario, correo electrónico(email) y estatus del usuario(activo). Una vez modificado los datos de click en "Actualizar".</p>
					<div style="width:60%"><img src="./imagenes/usuario_busqueda04.png"/></div>					
				</div> <!-- cd-faq-content -->
			</li>
			<li>
				<a class="cd-faq-trigger" href="#0">Eliminación de un usuario</a>
				<div class="cd-faq-content">					
					<p>Mediante un criterio de búsqueda localice el usuario a eliminar, en seguida de click en "Eliminar". Debe tener total precaución con esta acción debido a que no hay mecanismo de recuperación porque los usuarios se eliminan completamente del sistema.</p>
					<div style="width:60%"><img src="./imagenes/usuario_eliminacion.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>			
		</ul> <!-- cd-faq-group -->

		<ul id="item4" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Permisos de acceso</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Asignar roles a los usuarios</a>
				<div class="cd-faq-content">
					<p>En el sistema pueden haber <i>n</i> número de roles los cuales pueden ser asignados a los usuarios. El acceso a los recursos(páginas) dependerá de los permisos que el rol tenga asignados(lectura, escritura). Al momento de crear un usuario éste no tiene asignado ningún rol, por tal motivo es importante asignarle el rol para que tenga acceso al sistema.</p>
					<p>Localice el apartado "Administración de usuarios y permisos" y de click en <b>"Permisos"</b>.</p>
					<img src="./imagenes/usuario_administracion.png"/>
					<p>En seguida ingrese el dato en cualquiera de los 3 mecanismos de búsqueda (usuario, nomber o email) y de click en <b>"Buscar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_01.png"/></div>
					<p>Si el usuario existe, el sistema devuelve las opciones para asignación de roles. De los <b>"Roles sin asignar"</b> seleccione de la lista desplegable el que desee asignar al usuario, en seguida de click en <b>"Asignar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_02.png"/></div>
					<p>Si hubiesen mas roles disponibles el sistema le sigue mostrando la lista desplegable, de lo contrario únicamente muestra los "Roles asignados".</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_03.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>			
			<li>
				<a class="cd-faq-trigger" href="#0">Quitar roles a los usuarios</a>
				<div class="cd-faq-content">					
					<p>Una vez encontrado el usuario al que se le desea remover los roles, vaya al apartado <b>"Roles asignados"</b> y de la lista desplegable en <b>"Rol"</b> seleccione el que desea quitar al usuario. En seguida de click en "Eliminar".</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_04.png"/></div>
					<p>En seguida verá como el rol recien eliminado aparece nuevamente en "Roles sin asignar".</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_05.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>
			<li>
				<a class="cd-faq-trigger" href="#0">Ver permisos del usuario de acuerdo a un rol específico</a>
				<div class="cd-faq-content">					
					<p>Realice la búsqueda del usuario en el formulario, luego seleccione el <b>"Rol"</b> en <b>"Roles asignados"</b> y de click en "Mostrar".</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_06.png"/></div>
					<p>Los permisos deben aparecen como se demuestra a continuación</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesypermisos_07.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="item5" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Roles y recursos</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Nuevo recurso</a>
				<div class="cd-faq-content">					
					<p>Para efecto de creación de "nuevos recursos" contacte con el área de soporte debido a que se necesitará la programación a nivel de sistema del nuevo recurso. Lea la siguiente sección para la administración de roles.</p>
				</div> <!-- cd-faq-content -->
			</li>
			<li>
				<a class="cd-faq-trigger" href="#0">Nuevo rol</a>
				<div class="cd-faq-content">
					<p>En el formulario de "Roles y recursos" puede agregar nuevos roles, recursos y asignar los permisos del recurso en determinado rol.</p>
					<p>Localice el apartado "Administración de usuarios y permisos" y de click en <b>"Roles y recursos"</b>.</p>
					<img src="./imagenes/usuario_administracion.png"/>
					<p>Para agregar el rol escriba en "Nuevo rol" el nombre del rol que desea crear para los usuarios del sistema. En seguida de click en <b>"Guardar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesyrecursos_01.png"/></div>
					<p>En seguida ubique el apartado "Permisos" y de click en la lista desplegable del <b>"Rol"</b>, verá que el rol se ha creado correctamente y está casi listo para ser asignado a los usuarios.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesyrecursos_02.png"/></div>
					<p>Para que el rol sea funcional, ahora proceda a la asignación de los permisos a los recursos. Para ello de click en <b>"Mostrar permisos"</b> en el rol que haya seleccionado. Se desplegará la lista de recursos como se muestra a continuación.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesyrecursos_03.png"/></div>
					<p>Como puede ver, los recursos aún no tienen permisos asignados, para asignarlos de click en cada permisos que le corresponde a los recursos de la ficha. Es decir, si desea que el rol "Invitado" tenga permisos para visualizar el formulario de "Registro de actividades/eventos académicos" de click en la columna "Leer" y "Escribir". Una vez asignados todos los permisos de click en <b>"Asignar"</b>.</p>
					<div style="width:60%"><img src="./imagenes/usuario_rolesyrecursos_04.png"/></div>
				</div> <!-- cd-faq-content -->
			</li>			
		</ul> <!-- cd-faq-group -->

		<ul id="item6" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Reportes</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">¿Cómo generar los reportes?</a>
				<div class="cd-faq-content">					
					<p>Localice el apartado "Informes" de la página principal y de click en <b>"ver reporte"</b>.</p>
					<img src="./imagenes/informes_administracion.png"/>					
					<p>Ahora seleccione el usuario del cual desea generar el reporte, luego indíque las fecha inicial y final, se sugiere dejar un día de holgura en ambas fechas para un resultado completo, para finalizar de click en <b>"Generar"</b>.</p>
					<img src="./imagenes/informes_formgenerador.png"/>
					<p>El resultado es presentado en una tabla, si desea exportarlo a formato de Microsoft Office Excel de click en <b>"Exportar a excel"</b>.</p>					
					<img src="./imagenes/informes_resultado.png"/>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>