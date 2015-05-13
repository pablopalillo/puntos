jQuery(document).ready(function() {


  if( $("#registro-form").length > 0 )
  {

    $("#Jugador_fecha_nacimiento").change( function(){
        var fecha_nacimiento  =  $("#Jugador_fecha_nacimiento").val();
        var edad  =  verificar_edad( fecha_nacimiento );

        if(  edad < 18)
        {
           alert('Usted es un marciano hp!');

        }

    });
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
