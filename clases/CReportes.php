<?php
/*Autor: Jesus Malo, support: dic.malo@gmail.com 13-08-2015*/
date_default_timezone_set('America/Mexico_City');
require_once('../db/ConexionDB.php');

class CReportes extends ConexionDB{
	
 var $f_inicial, $f_final;
 
 function __construct($db)
 {
    parent::__construct($db); /*invocar el constructor de la clase padre*/
 }
 
 function setFechaInicial($fi){
	 $this->f_inicial = $fi;
 }
 
 function setFechaFinal($ff){
	 $this->f_final = $ff;
 }
 
 function getFechaInicial(){
	 return $this->f_inicial;
 }
 
 function getFechaFinal(){
	 return $this->f_final;
 }

 function getReporteSimple($param){
    $sql = 'SELECT
    rdnc.cns_reg_dnc,
    u.edad,
    u.puesto,
    u.sexo,
    u.discapacidad,
    ne.desc_ne,
    (select GROUP_CONCAT(hp.desc_hp) from habilidades_profesionales hp, det_reg_habs_profs_tiene hpt where hp.id_hp = hpt.id_hp and hpt.id_usuario=u.id_usuario) as HABS_PROFS_TIENE,
    (select desc_ohpt from otra_habilidad_prof_tiene ohpt where ohpt.id_usuario=u.id_usuario) as OTRA_HABS_PROF_TIENE,
    (select desc_gs from grados_satisfaccion where id_gs=rdnc.gs_desa_prof) as GSDP,
    (select desc_gs from grados_satisfaccion where id_gs=rdnc.gs_capprop_emp) as GSCPE,
    (select ac.desc_ac from area_capacitacion ac, area_capacitacion_tiene act where ac.id_ac = act.id_ac AND act.cns_reg_dnc=rdnc.cns_reg_dnc) AS AREA_CAP_T,
    (select GROUP_CONCAT(af.desc_af) from area_formacion af, area_formacion_tiene aft where af.id_af=aft.id_af AND aft.cns_reg_dnc=rdnc.cns_reg_dnc) as AREA_FORM_T,
    (select desc_oaf from otra_area_formacion where cns_reg_dnc=rdnc.cns_reg_dnc) as OTRA_AREA_FORM,
    (select GROUP_CONCAT(ea.desc_eap) from estrategias_aprendizaje ea, estrategias_aprendizaje_tiene eat where ea.id_eap=eat.id_eap AND eat.cns_reg_dnc=rdnc.cns_reg_dnc) as ESTRATEGIAS_AP_TIENE,
    (select desc_oeat from otra_estrategia_aprendizaje_tiene where cns_reg_dnc=rdnc.cns_reg_dnc) as OTRA_EST_AP_TIENE,
    (select GROUP_CONCAT(hp.desc_hp) from habilidades_profesionales hp, det_reg_habs_profs_requiere hpr where hp.id_hp = hpr.id_hp and hpr.id_usuario=u.id_usuario) as HABS_PROFS_REQUIERE,
    (select desc_ohpr from otra_habilidad_prof_requiere ohpr where ohpr.id_usuario=u.id_usuario) as OTRA_HABS_PROF_REQUIERE,
    (select ac.desc_ac from area_capacitacion ac, area_capacitacion_requiere acr where ac.id_ac = acr.id_ac AND acr.cns_reg_dnc=rdnc.cns_reg_dnc) AS AREA_CAP_R,
    (select GROUP_CONCAT(lics.desc_lics) from licenciaturas lics, licenciaturas_eleccion licse where lics.id_lics = licse.id_lics and licse.cns_reg_dnc=rdnc.cns_reg_dnc) as LICS_REQUIERE,
    (select desc_olr from otra_licenciatura_requiere where cns_reg_dnc=rdnc.cns_reg_dnc) as OTRA_LIC_REQUIERE,
    mc.desc_mod,
    IF(rdnc.turno_cap="M","Matutino","Vespertino"),
    rh.desc_rh,
    rdnc.dias_sem_cap,
    lc.desc_lc,
    (select group_concat(concat(af.desc_af,"::", afr.temas_interes) SEPARATOR ":?:") from area_formacion af, area_formacion_requiere afr where afr.id_af=af.id_af and  afr.cns_reg_dnc=rdnc.cns_reg_dnc) AS AREA_FORM_R,
    motcap.desc_mc,
    (select desc_omc from otro_motivo_capacitacion where cns_reg_dnc=rdnc.cns_reg_dnc) as OTRO_MOTIVO_CAP,
    IF(rdnc.conoce_ofer_educon=1,"SI","NO"),
    u.telefono,
    u.email,
    rdnc.comentarios,
    rdnc.fechaRegistro    
FROM registro_dnc rdnc, usuarios u, usuarios_sistema us, nivel_estudios ne, modalidad_capacitacion mc, lugar_capacitacion lc, motivo_capacitacion motcap, rango_horas rh 
WHERE rdnc.id_usuario=u.id_usuario 
    AND us.idUser = u.idUser
    AND ne.id_ne = u.id_ne
    AND mc.id_mod = rdnc.id_mod
    AND lc.id_lc = rdnc.id_lc
    AND motcap.id_mc = rdnc.id_mc   
    AND rh.id_rh = rdnc.id_rh
    AND rdnc.fechaRegistro BETWEEN \''.$this->scapeString($this->getFechaToMysql($this->f_inicial)).'\' AND \''.$this->scapeString($this->getFechaToMysql($this->f_final)).'\' 
    AND us.idUser='.$param.' ORDER BY rdnc.cns_reg_dnc;';    
    $resultado = $this->query($sql);    
    return $this->getElementosDeTabla($resultado);
 }
}
?>