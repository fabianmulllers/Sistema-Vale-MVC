function logout(){
    
      var parametros = {
                
                "action" :'logout'
        };
        $.ajax({
                data:  parametros,
                url:   '../controlador/usuario.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                         location.href="index.php";
                        $("#resultado").html(response);
                        
                }
        });
}
    
function buscarproducto(codproducto){
    
    var parametros = {
                
                "action" :'buscarproducto',
                "codproducto" : codproducto,
                "dbselect" : 1
        };
        $.ajax({
                data:  parametros,
                url:   '../controlador/producto.php',
                type:  'post',
                beforeSend: function () {
                        //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        
                        if(response == "no"){
                            
                            $("#resultado").find("td:gt(0)").remove();
                        }else{
                             $("#resultado").find("td:gt(0)").remove();
                        $('#resultado td:last').after(response);
                        //$("#resultado").html(response);
                    }
                }
        });

}
function generarTabla(numero){
  
$('#tabla > tbody').children( 'tr:not(:first)' ).remove();
  for (var i = 0; i < numero; i++) {
      
      $("#tabla tbody tr:eq(0)").clone().show().removeClass('fila-base').appendTo("#tabla tbody");
    }
    }

