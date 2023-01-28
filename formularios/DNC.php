<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com 04/09/2015*/
session_start();
 if(!isset($_SESSION['USER']))
 	header("Location:../acceso/login.php");
 require_once("../db/AccessDB.php");
 require_once("../clases/CModelo.php");
 require_once("Utilidades.php");
 $obj = new CModelo($db);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Diagnóstico de Necesidades de Capacitación</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
	<meta charset="utf-8" />
	<meta name="description" content="Formulario principal">
	<meta name="author" content="Jesús Malo Escobar">
	<?php
		getStyles();
	?>	
</head>
<body class="todo-contenido ancho">	
  <form id="RegistroDNC" action="Procesador.php" method="POST" enctype="multipart/form-data">
	<div class="panel panel-primary contenido">
    	<div class="panel-heading"><h4>DIAGNÓSTICO DE NECESIDADES DE CAPACITACIÓN (DNC)</h4></div>    	
	 	<div class="panel-body">
	 		<p class="instruccion">
	 			Por favor, dedique unos minutos para completar este cuestionario que tiene como propósito diagnosticar las necesidades de capacitación de acuerdo con su experiencia profesional y laboral de los últimos tres años.
	 			<br>
	 			<b><i>La información que proporcione será tratada de forma confidencial y anónima.</i></b>
			</p>
			<hr />
			<div class="content">
					<div class="doce">
					  	<div class="cuatro">
					  		<div class="form-group">
								<label class="doce">Edad:</label>
								<div class="seis">
									<input type="text" name="edad" class="form-control" autofocus>
								</div>
							</div>
						</div>

						<div class="cuatro">
							<div class="form-group">
								<label class="doce">Puesto:</label>
								<div class="doce">
									<input type="text" name="puesto" class="form-control">
								</div>
							</div>
						</div>
					  					 
						<div class="cuatro">
							<div class="form-group">
								<label class="doce">Sexo:</label>
								<div class="doce">
									<select name="sexo" class="form-control">
										<option value="" selected="" disabled="">-- Selecciona --</option>
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>										
									</select>
								</div>
							</div>
						</div>					 
					  						
					   <!--
					   <div class="tres">
							<div class="form-group">
								<label class="doce">Estado civil:</label>
								<div class="doce">
									<select name="estado_civil" class="form-control">
										<option value="" selected="" disabled="">-- Selecciona --</option>
										<php
											$obj->setTabla("estado_civil");
											$obj->setCampos("id_ec,desc_ec");
											$obj->setClausulas("order by id_ec");
											echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
										?>
									</select>
								</div>
							</div>	
					   </div>
						-->
					</div>					
					
					<div class="doce">
						<div class="cuatro">
							<div class="form-group">
								<label class="doce">¿Padece algúna discapacidad?</label>
								<div class="ocho">
									<select name="padece_discapacidad" id="padece_discapacidad" class="form-control">
										<option value="" selected="" disabled="">-- Selecciona --</option>
										<option value="1">Si</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="cuatro oculto" id="especifique_discapacidad">
							<div class="form-group">
								<label class="doce">¿Cuál?</label>
								<div class="doce">									
									<input type="text" name="alguna_discapacidad" class="form-control" placeholder="Especifíque">									
								</div>
							</div>
						</div>
						<div class="cuatro">
							<div class="form-group">
								<label class="doce">Nivel de estudios:</label>
								<div class="diez">
									<select name="nivel_estudios" class="form-control">
										<option value="" selected="" disabled="">-- Selecciona --</option>
										<?php
											$obj->setTabla("nivel_estudios");
											$obj->setCampos("id_ne,desc_ne");
											$obj->setClausulas("order by id_ne");
											echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
										?>
									</select>
								</div>
							</div>	
					   </div>
					</div>

					<hr/>
					<div class="doce">
						<p><b>Instrucciones:</b> Responda y/o subraye la opción que considere pertinente</p>
					</div>
					<hr/>
					<div class="form-group">
						<label class="nueve">1. Indique las habilidades profesionales y/o laborales que posee (puede elegir de una a tres opciones).</label>
						<div class="checkbox">
									<?php
										$obj->setTabla("habilidades_profesionales");
										$obj->setCampos("id_hp,desc_hp");
										$obj->setClausulas("order by id_hp");
										echo $obj->getColeccion(array('tiporetorno'=>'checkbox','nombre'=>'habs_profs_t[]','columnas'=>'tres'));
									?>
									<div class="checkbox tres">
						  				<input type="text" placeholder="Otro (Especifíque)" class="form-control" name="ohpqt">
									</div>
						</div>
					</div>

					<div class="form-group">
						<label class="nueve">2. En términos generales, indique el grado de satisfacción que tiene con su desarrollo profesional.</label>
						<div class="tres">
							<select name="gs_desa_prof" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php
										$obj->setTabla("grados_satisfaccion");
										$obj->setCampos("id_gs,desc_gs");
										$obj->setClausulas("order by id_gs");
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
							</select>	
						</div>
					</div>

					<div class="form-group">
						<label class="nueve">3. Indique el grado de satisfacción que tiene con la capacitación proporcionada por la empresa en que labora.</label>
						<div class="tres">
							<select name="gs_capprop_emp" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php										
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0)); /*No especificamos parametros porque fueron indicados en la consulta anterior*/
									?>
							</select>	
						</div>
					</div>					

					<div class="form-group">
						<label class="nueve">4. Indique el tipo de capacitación que ha recibido por parte de la empresa en que labora.</label>
						<div class="tres">
							<select name="area_cap_t" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
								<?php
									$obj->setTabla("area_capacitacion");
									$obj->setCampos("id_ac,desc_ac");
									$obj->setClausulas("order by id_ac");
									echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
								?>								
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="doce">5. Indique el área en la que se encuentra capacitado (puede elegir de una a tres opciones).</label>
						<div class="checkbox">
							<?php
								$obj->setTabla("area_formacion");
								$obj->setCampos("id_af,desc_af");
								$obj->setClausulas("order by id_af");
								echo $obj->getColeccion(array('tiporetorno'=>'checkbox','nombre'=>'area_form_t[]','columnas'=>'tres'));
							?>
						  <div class="checkbox tres">
						  	<input type="text" class="form-control" name="otra_af" placeholder="Otro (especifíque)">
						  </div>
						</div>
					</div>

					<div class="form-group">
						<label class="nueve">6. Indique cuál de las siguientes estrategias de aprendizaje ha utilizado.</label>
						<div class="checkbox">
								<?php
									$obj->setTabla("estrategias_aprendizaje");
									$obj->setCampos("id_eap,desc_eap");
									$obj->setClausulas("order by id_eap");									
									echo $obj->getColeccion(array('tiporetorno'=>'checkbox','nombre'=>'estrategias_aprendizaje[]','columnas'=>'tres'));
								?>
								<div class="checkbox tres">
					  				<input type="text" placeholder="Otro (Especifíque)" class="form-control" name="otra_eap">
								</div>
						</div>
				  	</div>

				  	<div class="form-group">
						<label class="nueve">7. Indique las habilidades que considere necesario desarrollar para su mejor desempeño laboral (puede elegir de una a tres opciones).</label>
						<div class="checkbox">
								<?php
									$obj->setTabla("habilidades_profesionales");
									$obj->setCampos("id_hp,desc_hp");
									$obj->setClausulas("order by id_hp");
									echo $obj->getColeccion(array('tiporetorno'=>'checkbox','nombre'=>'habs_profs_r[]','columnas'=>'tres'));
								?>
								<div class="checkbox tres">
					  				<input type="text" placeholder="Otro (Especifíque)" class="form-control" name="ohpqr">
								</div>
						</div>
				  	</div>
				  
				  	<div class="form-group">
						<label class="nueve">8. Indique el tipo de capacitación que requiere.</label>
						<div class="tres">
							<select name="area_cap_r" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
								<?php
									$obj->setTabla("area_capacitacion");
									$obj->setCampos("id_ac,desc_ac");
									$obj->setClausulas("order by id_ac");
									echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
								?>								
							</select>
						</div>
				  	</div>				  	

				 	<div class="form-group">
						<label class="nueve">9. En caso de haber elegido en la pregunta anterior la opción F) Licenciatura, indique una opción de interés del siguiente listado.</label>
						<div class="tres">
							<select name="licenciatura_requiere" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
								<?php
									$obj->setTabla("licenciaturas");
									$obj->setCampos("id_lics,desc_lics");
									$obj->setClausulas("order by id_lics");
									echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
								?>
							</select>							
						</div>
						<div class="checkbox tres">
				  			<input type="text" placeholder="Otro (Especifíque)" class="form-control" name="otra_licreq">
						</div>
				  	</div>

				  	<div class="form-group">
						<label class="nueve">10. Indique la modalidad que requiere para su capacitación.</label>
						<div class="tres">
							<select name="modalidad_capacitacion" id="modalidad_capacitacion" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
								<?php
									$obj->setTabla("modalidad_capacitacion");
									$obj->setCampos("id_mod,desc_mod");
									$obj->setClausulas("order by id_mod");
									echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
								?>
							</select>
						</div>
				 	</div>

				 	<div id="bloque_ocho">
					  	<div class="form-group">
							<label class="nueve">11. Indique el turno más factible para asistir a la capacitación en caso de haber elegido las opciones A) Presencial o C) Semipresencial (mixta).</label>
							<div class="tres">										
									<select name="turno_capacitacion" class="form-control">
										<option value="" selected="" disabled="">-- Selecciona --</option>
										<option value="M">Matutino</option>
										<option value="V">Vespertino</option>
									</select>										
							</div>
						</div>

						<div class="form-group">
							<label class="nueve">12. Indique las horas semanales que considere podría invertir en el proceso de capacitación.</label>
							<div class="tres">
								<select name="horas_invertir" class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php
										$obj->setTabla("rango_horas");
										$obj->setCampos("id_rh,desc_rh");
										$obj->setClausulas("order by id_rh");
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="nueve">13. Indique el día o días de la semana en que puede obtener la capacitación?</label>
							<div class="nueve">							
								<div class="checkbox">
								  <label class="checkbox-inline">
								    <input type="checkbox" name="dia_cap[]" value="LU">Lunes
								  </label>
								  <label class="checkbox-inline">
								    <input type="checkbox" name="dia_cap[]" value="MA">Martes
								  </label>
								  <label class="checkbox-inline">
									<input type="checkbox" name="dia_cap[]" value="MI">Miércoles
								  </label>
								  <label class="checkbox-inline">
									<input type="checkbox" name="dia_cap[]" value="JU">Jueves
								  </label>
								  <label class="checkbox-inline">
									<input type="checkbox" name="dia_cap[]" value="VI">Viernes
								  </label>
								  <label class="checkbox-inline">
									<input type="checkbox" name="dia_cap[]" value="SA">Sábado
								  </label>
								  <label class="checkbox-inline">
									<input type="checkbox" name="dia_cap[]" value="DO">Domingo
								  </label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="nueve">14. Indique en dónde le gustaría obtener la capacitación.</label>
						<div class="tres">
							<select name="lugar_capacitacion" class="form-control">
								<option value="" selected="" disabled="">-- Selecciona --</option>
								<?php
									$obj->setTabla("lugar_capacitacion");
									$obj->setCampos("id_lc,desc_lc");
									$obj->setClausulas("order by id_lc");
									echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="doce">15. En orden de importancia, indique tres áreas de formación en la que requiere capacitación.</label>
					</div>
					<div class="doce">
						<div class="cuatro separador"></div>
						<div class="siete"><label>Indique tres temas de interés que le ayuden a fortalecer su desempeño laboral y personal:</label></div>
					</div>
					<div class="form-group">
						<label class="uno">Opcion 1</label>
						<div class="tres">										
								<select name='area_form_r_op1' class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php
										$obj->setTabla("area_formacion");
										$obj->setCampos("id_af,desc_af");
										$obj->setClausulas("order by id_af");
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
								</select>
						</div>
						<div class="siete">
							<input type="text" placeholder="3 temas de interés" name='area_form_r_ti1' class="form-control"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="uno">Opcion 2</label>
						<div class="tres">										
								<select name="area_form_r_op2" class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php										
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
								</select>
						</div>
						<div class="siete">
							<input type="text" placeholder="3 temas de interés" name="area_form_r_ti2" class="form-control"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="uno">Opcion 3</label>
						<div class="tres">										
								<select name="area_form_r_op3" class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php										
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
								</select>
						</div>
						<div class="siete">
							<input type="text" placeholder="3 temas de interés" name="area_form_r_ti3" class="form-control"></input>
						</div>
					</div>

					<div class="form-group">									
						<label class="nueve">16. Indique el motivo por el que le interesaría obtener una capacitación.</label>
						<div class="tres">
								<select name="motivo_capacitacion" id="motivo_capacitacion" class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<?php
										$obj->setTabla("motivo_capacitacion");
										$obj->setCampos("id_mc,desc_mc");
										$obj->setClausulas("order by id_mc");
										echo $obj->getColeccion(array('tiporetorno'=>'select','defaultselect'=>0));
									?>
								</select>							
						</div>
						<div class="tres oculto" id="otro_motivo_capacitacion">
					  		<input type="text" placeholder="Otro (Especifíque)" class="form-control" name="otro_motivo_cap">
						</div>
					</div>					

					<div class="form-group">									
						<label class="nueve">17. ¿Conoce la oferta educativa formal e informal de la Universidad Autónoma de Chiapas?</label>
						<div class="tres">										
								<select name="conoce_oferta_educon" class="form-control">
									<option value="" selected="" disabled="">-- Selecciona --</option>
									<option value="1">Sí</option>
									<option value="0">No</option>
								</select>
						</div>
					</div>

					<div class="form-group">									
						<label class="doce">18. En caso de requerir información sobre nuestra oferta de educación continua, proporcione un medio de contacto (correo electrónico y/o número de teléfono).</label>
						<label class="doce"><b><i><span style="color:gray">Recuerde que la información otorgada es confidencial.</span></i></b></label>
					</div>
					
						<div class="form-group">
							<label class="dos">Teléfono:</label>
							<div class="cuatro">
								<input type="text" placeholder="Telf." spellcheck="false" name="telefono" class="form-control"></input>
							</div>
						</div>
						
						<div class="form-group">
							<label class="dos">Email:</label>
							<div class="cuatro">
								<input type="text" placeholder="email" spellcheck="false" name="email" class="form-control"></input>
							</div>
						</div>

					<div class="form-group">									
						<label class="doce">19. Comentarios, sugerencias u opiniones finales que desee realizar.</label>
							<div class="doce">
								<textarea placeholder="Favor de llenar" spellcheck="false" name="comentarios" class="form-control"></textarea>
							</div>
					</div>

					<button type="submit" name="accion" class="btn btn-primary separador" value="Enviar">Enviar</button>
					<button type="reset" class="btn btn-info separador">Limpiar</button>
					<?php
						/**/
						if($_SESSION['rol_usuario']<3){
							echo '<a href="FActividad.php" class="btn btn-default separador">Página principal</a>';
						}
					?>
					<a href="../acceso/logout.php" class="btn btn-danger">Salir</a>
			</div> <!-- div content -->
	 	</div> <!-- div panel-body -->
	</div> <!-- div panel-primary -->
  </form>
</body>
</html>
<?php	
	getScripts();
	$db->close_conn();
?>