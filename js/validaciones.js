$(function(){ 

 $("#RegistroDNC").validate({
 	lang: 'es',
	rules: {
		edad: {required: true, number:true, maxlength:3, range:[0,200]},
		sexo:{required:true},
		nivel_estudios:{required:true},
		estado_civil:{required:true},
		puesto:{required:true, maxlength:255},
		padece_discapacidad:{required:true},
		alguna_discapacidad:{required:true, maxlength:50},
		gs_desa_prof:{required:true},
		gs_capprop_emp:{required:true},
		area_cap_t:{required:true},
		area_cap_r:{required:true},
		modalidad_capacitacion:{required:true},
		turno_capacitacion:{required:true},
		horas_invertir:{required:true, number:true, range:[1,168]},
		lugar_capacitacion:{required:true},
		area_form_r_op1:{required:true},
		area_form_r_op2:{required:true},
		area_form_r_op3:{required:true},
		area_form_r_ti1:{required:true},
		area_form_r_ti2:{required:true},
		area_form_r_ti3:{required:true},
		motivo_capacitacion:{required:true},
		conoce_oferta_educon:{required:true},
		"area_form_t[]":{required:true, minlength:1},
		"habs_profs_t[]":{required:true, minlength:1},
		"habs_profs_r[]":{required:true, minlength:1},
		"dia_cap[]":{required:true, minlength:1}
	},
	messages: {
		edad: {required: "Ingrese edad", number:"Sólo números", maxlength:"3 caracteres máximo", range:"rango permitido de 0 a 200"},
		sexo:{required:"Seleccione"},
		nivel_estudios:{required:"Seleccione"},
		estado_civil:{required:"Seleccione"},
		puesto:{required:"Dato requerido", maxlength:"Máximo 255 caracteres"},
		padece_discapacidad:{required:"Seleccione"},
		alguna_discapacidad:{required:"Campo requerido", maxlength:"50 caracteres como máximo"},
		gs_desa_prof:{required:"Seleccione"},
		gs_capprop_emp:{required:"Seleccione"},
		area_cap_t:{required:"Seleccione"},
		area_cap_r:{required:"Seleccione"},
		modalidad_capacitacion:{required:"Seleccione"},
		turno_capacitacion:{required:"Seleccione"},
		horas_invertir:{required:"Requerido", number:"Sólo números", range:"rango permitido de 1 a 168"},
		lugar_capacitacion:{required:"Seleccione"},
		area_form_r_op1:{required:"Seleccione"},
		area_form_r_op2:{required:"Seleccione"},
		area_form_r_op3:{required:"Seleccione"},
		area_form_r_ti1:{required:"Indíque"},
		area_form_r_ti2:{required:"Indíque"},
		area_form_r_ti3:{required:"Indíque"},		
		motivo_capacitacion:{required:"Seleccione"},
		conoce_oferta_educon:{required:"Seleccione"},
		"area_form_t[]":{required:"Seleccione al menos 1 opción"},
		"habs_profs_t[]":{required:"Seleccione al menos 1 opción"},
		"habs_profs_r[]":{required:"Seleccione al menos 1 opción"},
		"dia_cap[]":{required:"Seleccione al menos 1 opción"}
	},
	tooltip_options: {
		edad: {trigger:'focus'}
	},
	focusInvalid: false,
    invalidHandler: function(form, validator) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top - 50
        }, 500);

    }
 });
});