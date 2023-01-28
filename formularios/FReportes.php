<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
mb_internal_encoding("UTF-8");
session_start();
if(!isset($_SESSION['USER']))
	header("Location:../login.php");

header('Content-type: text/html; charset=utf-8');
require_once('../clases/CReportes.php');
require_once("../db/AccessDB.php");
require_once("Utilidades.php"); 
if(!$db->connect())
	echo "Error de conexión a la base de datos";
$reporte = new CReportes($db);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Educación Continua: Sistema de Registro de Actividades Académicas</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Formulario de reportes">
	<meta name="author" content="Jesús Malo Escobar">		
	<script src="../js/xlsx/js/jszip.js"></script>
	<script src="../js/xlsx/js/jszip-load.js"></script>
	<script src="../js/xlsx/js/jszip-deflate.js"></script>
	<script src="../js/xlsx/js/jszip-inflate.js"></script>
	<script src="../js/xlsx/js/xlsx.js"></script>
	<?php  
	getStyles(); /*para darle estilos al formulario*/ 			
	?>		
</head>
<body class="container">
	<form method="POST" action="FReportes.php" id="informes">
		<div class="panel panel-primary">
			<div class="panel-heading">Reporte de actividades y eventos registrados</div>			
			<div class="panel-body">
				<div class="doce">
					<p>Criterios de búsqueda</p>
				</div>
				<div class="form-group">
					<label class="tres">Usuario:</label>
					<div class="nueve">
						<select class="form-control tres" name="usuario">
							<?php
							require_once("../clases/CModelo.php");
							$obj = new CModelo($db);
							$obj->setTabla("usuarios_sistema");
							$obj->setCampos("idUser,user");
							$obj->setClausulas("WHERE idUser<>0");
							echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>isset($_POST['usuario'])?$_POST['usuario']:0));
							?>
						</select>
					</div>
				</div>
				<div class="doce">
					<p>Indicar rango de fechas para la búsqueda</p>
				</div>
				<div class="form-group">
					<label for="f_inicial" class="tres">Fecha inicial:</label>
					<div class="nueve">				
						<input type="text" class="datepicker form-control tres" name="f_inicial" id="f_inicial" placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[/-](0[1-9]|1[012])[/-](19|20)\d\d">
					</div>
				</div>
				<div class="form-group">
					<label for="f_final" class="tres">Fecha final:</label>
					<div class="nueve">
						<input type="text" class="datepicker form-control tres" name="f_final" id="f_final" placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[/-](0[1-9]|1[012])[/-](19|20)\d\d">
					</div>
				</div>
				<hr/>
				<input type="submit" name="accion" id="buscar" value="Generar" class="btn btn-info">
				<?php
				if(isset($_POST['f_inicial']))
				{
					if($_POST['f_inicial']!="")
					{
						if($_POST['f_final']!="")
						{
							$reporte->setFechaFinal($_POST['f_final']);
						}
						else
						{
							$reporte->setFechaFinal(date("Y/m/d"));
						}
						$reporte->setFechaInicial($_POST['f_inicial']);
					}
					if(isset($_POST['usuario']))
					{
						echo '<div id="tabla_exportar" class="table-responsive">';
						echo '<table cellpadding="2" class="table table-bordered actividades">
						<thead>
							<tr>
								<th>ID</th>
								<th>Edad</th>
								<th>Puesto</th>
								<th>Sexo</th>
								<th>Discapacidad</th>
								<th>Nivel de estudios</th>
								<th>Habilidades profesionales (tiene)</th>
								<th>Otras habs. profesionales (tiene)</th>
								<th title="Grado de satisfacción">G.S. (desarrollo profesional)</th>
								<th title="Grado de satisfacción">G.S. (Capacitación prop. por la empresa)</th>
								<th>Áreas de capacitación que posee</th>
								<th>Áreas de formación que posee</th>
								<th>Otra área de formación que posee</th>
								<th>Estrategias de aprendizaje que posee</th>
								<th>Otra estrategia de aprendizaje</th>
								<th>Habilidades profesionales (requiere)</th>
								<th>Otras habs. profesionales (requiere)</th>
								<th>Área de capacitación que requiere</th>
								<th>Licenciaturas de interés</th>
								<th>Otra licenciatura de interés</th>
								<th>Modalidad requerida</th>
								<th>Turno para asistir</th>
								<th>Horas a invertir semanalmente</th>
								<th>Días de la semana para capacitación</th>
								<th>Lugar para la capacitación</th>
								<th>Área de formación requerida opcion 1</th>
								<th>Temas</th>
								<th>Área de formación requerida opcion 2</th>
								<th>Temas</th>
								<th>Área de formación requerida opcion 3</th>
								<th>Temas</th>
								<th>Motivo obtención de capacitación</th>
								<th>Otro motivo para recibir capacitación</th>
								<th>Conoce la oferta de la UNACH</th>
								<th>Tel.</th>
								<th>Email</th>
								<th>Comentarios</th>
								<th>Fecha de captura</th>
							</tr>
						</thead>
						<tbody>';
							echo $reporte->getReporteSimple($_POST['usuario']);
							echo "</tbody>
						</table>
					</div>";
					echo '<br><button id="btn_exportar_xls" class="btn btn-success">Exportar a excel</button>';
				}
			}
			?>
			<a href="../" class="btn btn-default">Página principal</a> 
		</div>
	</div>
</div>

<?php
getScripts(); 
?>
</form>
</body>
</html>