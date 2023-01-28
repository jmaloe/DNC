<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com 04/09/2015*/
 header('Content-type: text/html; charset=utf-8');
 session_start();

 if(!isset($_SESSION['USER']))
 	header("Location:../../login.php");
 $msjs = "";
 if(isset($_POST['accion']))
 {
 	require_once("../clases/CModelo.php");
 	require_once("../clases/CUsuario.php"); //clase pra identificar usuarios del registro de diagnostico DNC 	
 	require_once("../db/AccessDB.php");
 	$obj = new CModelo($db);
 	$usuario = new CUsuariosDNC($db);
 	$usuario->setUsuario($_SESSION['USER']);
 	$usuario->buscarByUser(); /*cargamos los datos del usuario que esta generando el nuevo registro*/
 	if($_POST['accion']=="Enviar")
 	{
 		/*inserción del nuevo usuario q está llenando el formulario*/
 		$usuario->setEdad($_POST['edad']);
 		$usuario->setSexo($_POST['sexo']);
 		$usuario->setIdNivelEstudios($_POST['nivel_estudios']);
 		$usuario->setPuesto($_POST['puesto']);
 		$usuario->setTelefono(isset($_POST['telefono'])?$_POST['telefono']:"0");
 		$usuario->setEmail(isset($_POST['email'])?$_POST['email']:"0");
 		//$usuario->setEstadoCivil($_POST['estado_civil']);
 		if(isset($_POST['alguna_discapacidad']))
 			$usuario->setDiscapacidad($_POST['alguna_discapacidad']);
 		if(!$usuario->insertar())
 			$msjs = $usuario->getError();

 		/*Habilidades profesionales que el encuestado tiene y requiere*/
 		$obj->setTabla("det_reg_habs_profs_tiene");
 		$obj->setCampos("id_usuario,id_hp");
 		foreach ($_POST['habs_profs_t'] as $value)
 		{
 			$obj->setValores($usuario->getIdUsuarioDNC().",".$value);
 			$obj->insertar();
 		}
 		$obj->setTabla("det_reg_habs_profs_requiere");
 		//$obj->setCampos("id_usuario,id_hp"); omitimos este paso porque los campos son iguales al anterior
 		foreach ($_POST['habs_profs_r'] as $value)
 		{
 			$obj->setValores($usuario->getIdUsuarioDNC().",".$value);
 			$obj->insertar();
 		}
 		/*Otras habilidades profesionales que Tiene y Requiere el encuestado*/
 		if(isset($_POST['ohpqt'])){
 			$obj->setTabla("otra_habilidad_prof_tiene");
 			$obj->setCampos("id_usuario,desc_ohpt");
 			$obj->setValores($usuario->getIdUsuarioDNC().",'".mysqli_real_escape_string($db->getConnection(),$_POST['ohpqt'])."'");
 			$obj->insertar();
 		}
 		if(isset($_POST['ohpqr'])){
 			$obj->setTabla("otra_habilidad_prof_requiere");
 			$obj->setCampos("id_usuario,desc_ohpr");
 			$obj->setValores($usuario->getIdUsuarioDNC().",'".mysqli_real_escape_string($db->getConnection(),$_POST['ohpqr'])."'");
 			$obj->insertar();
 		}

 		/*NUEVO REGISTRO DNC*/
 		/*Captación de dias de capacitacion*/
 		$dias_capacitacion="";
 		if(isset($_POST['dia_cap']))
 		{
 			$aux=1;

	 		$total_dias = count($_POST['dia_cap']);
	 		foreach ($_POST['dia_cap'] as $value)
	 		{
	 			if($aux<$total_dias){
	 				$dias_capacitacion.=$value.":";
	 				$aux++;
	 			}
	 			else
	 				$dias_capacitacion.=$value;
	 		}
 		} 		

 		/*Registro de los valores capturados en la interfaz en la tabla registro_dnc de la BD*/
 		$obj->setTabla("registro_dnc");
 		$obj->setCampos("id_usuario,gs_desa_prof,gs_capprop_emp,id_mod,id_lc,id_mc,turno_cap,id_rh,dias_sem_cap,conoce_ofer_educon,comentarios"); 		
 		$obj->setValores($usuario->getIdUsuarioDNC().",".
 						 $_POST['gs_desa_prof'].",".
 						 $_POST['gs_capprop_emp'].",".
 						 $_POST['modalidad_capacitacion'].",".
 						 $_POST['lugar_capacitacion'].",".
 						 $_POST['motivo_capacitacion'].",'".(isset($_POST['turno_capacitacion'])?$_POST['turno_capacitacion']:'*')."',".
 						 (isset($_POST['horas_invertir'])?$_POST['horas_invertir']:'5').",'".$dias_capacitacion."',".
 						 $_POST['conoce_oferta_educon'].",'".mysqli_real_escape_string($db->getConnection(),$_POST['comentarios'])."'");
 		$cns_reg_dnc = $obj->insertar(); /*capturamos el id del nuevo registro para uso posterior*/

 		/*Otro motivo de capacitación*/
 		if(isset($_POST['otro_motivo_cap']))
 		{
 			$obj->setTabla("otro_motivo_capacitacion");
 			$obj->setCampos("cns_reg_dnc,desc_omc");
 			$obj->setValores($cns_reg_dnc.",'".mysqli_real_escape_string($db->getConnection(),$_POST['otro_motivo_cap'])."'");
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}

 		/*Estrategias de aprendizaje que tiene*/
 		if(isset($_POST['estrategias_aprendizaje']))
 		{
 			$obj->setTabla("estrategias_aprendizaje_tiene");
 			$obj->setCampos("cns_reg_dnc,id_eap");

 			foreach ($_POST['estrategias_aprendizaje'] as $value)
 			{
 				$obj->setValores($cns_reg_dnc.",".$value);
 				if(!$obj->insertar())
 					$msjs.="<p>".$obj->getError()."</p>";
 			}
 		}
 		/*en caso de especificar otra estrategia de aprendizaje*/
 		if(isset($_POST['otra_eap'])){
 			$obj->setTabla("otra_estrategia_aprendizaje_tiene");
 			$obj->setCampos("cns_reg_dnc,desc_oeat");
 			$obj->setValores($cns_reg_dnc.",'".mysqli_real_escape_string($db->getConnection(),$_POST['otra_eap'])."'");
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}

 		/*Areas de Formación que el encuestado tiene*/
 		if(isset($_POST['area_form_t']))
 		{
 			$obj->setTabla("area_formacion_tiene");
 			$obj->setCampos("cns_reg_dnc,id_af");

 			foreach ($_POST['area_form_t'] as $value)
 			{
 				$obj->setValores($cns_reg_dnc.",".$value);
 				if(!$obj->insertar())
 					$msjs.="<p>".$obj->getError()."</p>";
 			}
 		} 		
 		/*en caso de especificar otra area de formacion*/
 		if(isset($_POST['otra_af'])){
 			$obj->setTabla("otra_area_formacion");
 			$obj->setCampos("cns_reg_dnc,desc_oaf");
 			$obj->setValores($cns_reg_dnc.",'".mysqli_real_escape_string($db->getConnection(),$_POST['otra_af'])."'");
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}
 		/*areas de formacion que el encuestado requiere*/
 		if(isset($_POST['area_form_r_op1']))
 		{
 			$obj->setTabla("area_formacion_requiere");
 			$obj->setCampos("cns_reg_dnc,id_af,temas_interes"); 			
 			$aux = 1;
 			while($aux<4)
 			{
 				$valor = $cns_reg_dnc.",'".mysqli_real_escape_string($db->getConnection(),$_POST['area_form_r_op'.$aux])."','".mysqli_real_escape_string($db->getConnection(),$_POST['area_form_r_ti'.$aux])."'";
 				$obj->setValores($valor);
 					if(!$obj->insertar())
 						$msjs.="<p>".$obj->getError()."</p>";
 				$aux++;
 			}
 		}

 		/*Areas de capacitación que el encuestrado tiene y require*/
 		if(isset($_POST['area_cap_t']))
 		{
 			$obj->setTabla("area_capacitacion_tiene");
 			$obj->setCampos("cns_reg_dnc,id_ac");
 			$obj->setValores($cns_reg_dnc.",".$_POST['area_cap_t']);
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}

 		if(isset($_POST['area_cap_r']))
 		{
 			$obj->setTabla("area_capacitacion_requiere");
 			$obj->setCampos("cns_reg_dnc,id_ac");
 			$obj->setValores($cns_reg_dnc.",".$_POST['area_cap_r']);
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}
 		/*Licenciatura que requiere*/ 		
 		if(isset($_POST['licenciatura_requiere']))
 		{
 			$obj->setTabla("licenciaturas_eleccion");
 			$obj->setCampos("cns_reg_dnc,id_lics");
 			$obj->setValores($cns_reg_dnc.",".$_POST['licenciatura_requiere']);
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}
 		/*Otra licenciatura que requiere*/
 		if(isset($_POST['otra_licreq'])){
 			$obj->setTabla("otra_licenciatura_requiere");
 			$obj->setCampos("cns_reg_dnc,desc_olr");
 			$obj->setValores($cns_reg_dnc.",'".mysqli_real_escape_string($db->getConnection(),$_POST['otra_licreq'])."'");
 			if(!$obj->insertar())
 				$msjs.="<p>".$obj->getError()."</p>";
 		}

 		require_once("Utilidades.php");
 		echo getStyles();
 		if($msjs!="")
 			echo $msjs;
 		else
 			echo '<div class="centrado">
 					<p>Los datos se guardaron con éxito con registro No. '.$cns_reg_dnc.'</p>
 					<a href="DNC.php" class="btn btn-success separador">Nueva encuesta</a>
 					<a href="../acceso/logout.php" class="btn btn-danger separador">Finalizar</a>'; 				  
 		if($_SESSION['rol_usuario']<3){
 			echo '<a href="FActividad.php" class="btn btn-default">Página principal</a>';
 		}
 		echo '</div>';
 	}
 }
 $db->close_conn(); /*cerramos la conexion a la base de datos*/
?>