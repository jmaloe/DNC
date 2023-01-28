$(document).ready(function() {
/*Deshabilitamos enter para evitar submit form*/
$("input").keypress(function( e ){
  if(!$(this).is('textarea'))
  {
    if(e.which == 13)
    {
     e.preventDefault();
    }
  }  
});

 $("#btn_exportar_xls").click(function(e){      
      e.preventDefault();
      var file = {
        worksheets: [[]], // worksheets has one empty worksheet (array)
        creator: 'UVUNACH', created: new Date(),
        lastModifiedBy: 'UVUNACH', modified: new Date(),
        activeWorksheet: 0
        }, w = file.worksheets[0]; // cache current worksheet
        w.name = "DiagnosticoDNC";

      $('#tabla_exportar tr').each(function(){
        var r = w.push([]) - 1; // index of current row
        $(this).find('th').each(function(){
          w[r].push($(this).text());
        });
        $(this).find('td').each(function() {
          w[r].push($(this).text());
        });
      });

      window.location.href = xlsx(file).href();
  });

 try
  {
   $( "#f_inicial" ).datepicker();  
   $( "#f_final" ).datepicker();
  }catch(e){console.log(e.message)}

 window.onafterprint = function(){
	$("#contenedor").css("width","60%");
 }

 $("#padece_discapacidad").on('change',function(){
    if($(this).val()==1){
      $("#especifique_discapacidad").removeClass("oculto");
    }
    else{
      $("#especifique_discapacidad").addClass("oculto");
    }
 });

 /*Si selecciona "Otro (Especifique)" = la opcion 4, entonces ocultamos*/
 $("#motivo_capacitacion").on('change',function(){
    if( $(this).val()==4 )
    {
      $("#otro_motivo_capacitacion").removeClass("oculto");
    }
    else
    {
     $("#otro_motivo_capacitacion").addClass("oculto"); 
    }
 });

 /*Si selecciona "A distancia (via internet)" = la opcion 2, entonces ocultamos*/
 $("#modalidad_capacitacion").on('change',function(){
    if( $(this).val()==2){
      $("#bloque_ocho").addClass("oculto");
    }
    else
    {
      $("#bloque_ocho").removeClass("oculto");
    }

 });

}); /*FIN $(document).ready*/