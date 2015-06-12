jQuery(document).ready(function() {


  if( $("#registro-form").length > 0 )
  {

    $("#Jugador_fecha_nacimiento").change( function(){
        var fecha_nacimiento  =  $("#Jugador_fecha_nacimiento").val();
        var edad  =  verificar_edad( fecha_nacimiento );

        if( edad < 18 )
        {
          $("#responsable").show();

          $("#Jugador_nombre_adulto").attr('disabled',false);
          $("#Jugador_documento_adulto").attr('disabled',false);
          $("#Jugador_parentesco_id").attr('disabled',false);
          $("#Jugador_correo_adulto").attr('disabled',false);
        }
        else
        {
          $("#Jugador_nombre_adulto").attr('disabled',true);
          $("#Jugador_documento_adulto").attr('disabled',true);
          $("#Jugador_parentesco_id").attr('disabled',true);
          $("#Jugador_correo_adulto").attr('disabled',true);

          $("#responsable").hide();

        }

    });
  }

if( $("#pregunta-form").length > 0 )
{
  $(".datepicker").datepicker({
      dateFormat: "dd/mm/yy", 
      yearRange: "2015:2020", 
      minDate: new Date(2015, 1, 1),
      maxDate: new Date(2020, 0, 0),
      changeMonth: true, changeYear: true},
      $.datepicker.regional[ "es" ]
    );  
}



});


/**
*
* @function verificar_edad
* @author Pablo Martinez
* Permite devolver la edad de la persona basados en parametros tipo fecha
* formato Date ( '1991-03-20 ')
*
**/
function verificar_edad( fecha_nacimiento )
{

    var today = Date.now();
    var nac		= new Date(fecha_nacimiento);


    var edad 	  = new Date(today - nac);
    var edadTotal = Math.round(Number(edad.valueOf()) / 31536000000 );

    if( !edadTotal.NaN )
    {
      return edadTotal;
    }
    else
    {
      return;
    }

}
