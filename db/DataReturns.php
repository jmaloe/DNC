<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com*/
 class DataReturns{
  var $elementos;
 	/*Devuelve valores para el datalist, especifique en su consulta SQL el id y el valor para el option*/
 	public function getDataListItems($result){
 		$datos="";
 		$elementos=0;
		while($fila = mysqli_fetch_row($result))
		{
		   $elementos++;
		   $datos.="<option id='".$fila[0]."' value='".$fila[1]."'/>";
		}
		return $datos;
 	}

 	public function getCustomDataListItems($result){
 		$datos="";
 		while($fila = mysqli_fetch_assoc($result)){
 			$datos.='<option ';
 			foreach ($fila as $key => $value) {
 				$datos.=$key.'="'.$value.'"';
 			}
 			$datos.='/>';
 		}
 		return $datos;
 	}

 	public function getCheckboxItems($result, $nombre, $columnas){
 		$datos="";
 		$elementos = 0;
		while($fila = mysqli_fetch_row($result))
		{
		  $elementos++;
		   	$datos.='<label class="checkbox '.$columnas.'"><input type="checkbox" name="'.$nombre.'" value="'.$fila[0].'">'.$fila[1].'</label>';		   
		}
		return $datos;
 	}

 	public function getSelectItems($result, $defaultselect){
 		$datos="";
 		$elementos = 0; 		
		while($fila = mysqli_fetch_row($result))
		{
		  $elementos++;
		   if($fila[0]==$defaultselect)
		   	$datos.="<option value='".$fila[0]."' selected>".$fila[1]."</option>";
		   else
		    $datos.="<option value='".$fila[0]."'>".$fila[1]."</option>";
		}
		return $datos;
 	}

 	/*para formar el select con optgroup pasar 4 columnas: idTablaSuperior,descripcionTablaSuperior,idTablaInferior,descripcionTablaInferior*/
 	public function getOptionGroupsItems($result){
 		$id=0;
		$datos="";
		while($fila = mysqli_fetch_row($result)) {
		 if($fila[0]!=$id)
		 {
		   if($id>1)
		    $datos.="</optgroup>";	
		   $datos.="<optgroup label='".$fila[1]."'>";
		   $id=$fila[0];
		 }
		 $datos.="<option value='".$fila[2]."::".$fila[3]."'>".$fila[3]."</option>";
		}
		return $datos;
 	}

 	public function getElementosDeTabla($result){
		$datos="";
		while($fila = mysqli_fetch_assoc($result)){
			$datos.="<tr>";
			foreach ($fila as $key => $value)
			{
				/*esta condicion es para separar el resultado de AREA_FORM_R con separador :?:*/
				if($key=="AREA_FORM_R"){
					$elemns = explode(":?:", $value);
					 foreach ($elemns as $key => $value)
					 {
					 	$elems2 = explode("::",$value);
					 	$datos.="<td>".$elems2[0]."</td>";
					 	$datos.="<td>".$elems2[1]."</td>";
					 }
				}
				else
				  $datos.="<td>".$value."</td>";
			}
			$datos.="</tr>";
		}
		return $datos;
 	}

 	public function getRowsTableItems($result, $icon){
 		$datos="";
 		while($fila = mysqli_fetch_row($result)){
 			$datos.="<tr>";
 			foreach ($fila as $key => $value){ 				
 				if($key==$icon)
 					$datos.='<td align="center"><div class="icono '.str_replace(" ", "", $value).'" title="'.$value.'"></div></td>';
 				else if($key==2)
 					$datos.='<td class="actividad_evento" id="'.$fila[0].'">'.$value.'</td>';
 				else if($key==3)
 					$datos.='<td align="center"><div class="icono '.str_replace(" ", "", $value).'" title="'.$value.'"></div></td>';
 				else
 					$datos.="<td>".$value."</td>";
 			}
 			$datos.="</tr>";
 		}
 		return $datos;
 	}

 	public function getFechaToMysql($fecha){
 		return date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));
 	}

 	public function getFechaFromMysql($fecha){
 		return date('d-m-Y',strtotime($fecha));
 	}

 	public function getTimeToMysql($hora){
 		return date('H:i:s', strtotime($hora));
 	}

 	public function getTimeFromMysql($hora){
 		return date('H:i A', strtotime($hora));
 	}

 	public function getReqItems($result){
 		$id=0;
		$datos="";
		while($fila = mysqli_fetch_assoc($result)) {
		 if($fila['id_cat_req']!=$id)
		 {
		   $datos.='<p class="titulo">'.$fila['descripcion'].'</p>';
		   $id=$fila['id_cat_req'];
		 }
		 //$datos.="<option value='".$fila[2]."::".$fila[3]."'>".$fila[3]."</option>";
		 $datos.='<div class="form-group">				
				<label class="'.$fila['l_class'].'">'.$fila['label'].'</label>
				<div class="'.$fila['id_input_class'].'">';
				if($fila['input']=="text")
				 	$datos.='<input type="text" name="'.$fila['id_input'].'" id="'.$fila['id_input'].'" class="form-control" placeholder="'.$fila['id_input_placeholder'].'" />';
				else if($fila['input']=="textarea")
					 $datos.='<textarea name="'.$fila['id_input'].'" id="'.$fila['id_input'].'" class="form-control" placeholder="'.$fila['id_input_placeholder'].'"></textarea>';
		 $datos.='</div>
			</div>';
		}
		return $datos;
 	}

 }
?>