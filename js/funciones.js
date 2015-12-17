function logout() {

    var parametros = {
        "action": 'logout'
    };
    $.ajax({
        data: parametros,
        url: '../controlador/usuario.php',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) {
            location.href = "index.php";
            $("#resultado").html(response);

        }
    });
}

function buscarproducto(codproducto, id) {
    var parametros = {
        "action": 'buscarproducto',
        "codproducto": codproducto,
        "dbselect": 1
    };
    $.ajax({
        data: parametros,
        url: '../controlador/producto.php',
        type: 'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) {

            if (response === "no") {
                $("#resultado" + id).find("td:gt(0)").remove();
                $('#resultado' + id + ' td:last').after('<td></td><td></td><td></td><td></td><td></td><td><a class="btn btn-link btn-xs"onclick="eliminarFila('+id+')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td>');

            } else {
                $("#resultado" + id).find("td:gt(0)").remove();
                $('#resultado' + id + ' td:last').after(response+'<td><a class="btn btn-link btn-xs"onclick="eliminarFila('+id+')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td>');
                //$("#resultado").html(response);
            }
        }
    });

}
function generarTabla(numero) {

    $('#tabla > tbody').children('tr:not(:first)').remove();
    for (var i = 1; i <= numero; i++) {
        var id = "document.getElementsByName('codproducto[]')[" + i + "].value";
        //$("#tabla tbody tr:eq(0)").clone().show().removeClass('fila-base').appendTo("#tabla tbody");
        $('#tabla tr:last').after('<tr id="resultado' + i + '"><td> <div class="col-xs-8"><input id="codproducto[]" class="form-control input-sm" type="search"   name="codproducto[]" placeholder="EJ: 04008006"      onkeyup="buscarproducto(' + id + ',' + i + ')"     > </div></td> <td></td><td></td> <td></td> <td></td><td></td><td><a class="btn btn-link btn-xs" onclick="eliminarFila('+i+')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td></tr>');
    }
}


function eliminarFila(numero){
  $("#resultado"+numero+"").hide();
  document.getElementsByName('codproducto[]')[numero].value = "";
    
    
}

function agregarFila(){
    var i = $('#tabla > tbody > tr').length;
            var id = "document.getElementsByName('codproducto[]')[" + i + "].value";

            $('#tabla tr:last').after('<tr id="resultado' + i + '"><td> <div class="col-xs-8"><input id="codproducto[]" class="form-control input-sm" type="search"   name="codproducto[]" placeholder="EJ: 04008006"      onkeyup="buscarproducto(' + id + ',' + i + ')"     > </div></td> <td></td><td></td> <td></td> <td></td><td></td><td><a class="btn btn-link btn-xs" onclick="eliminarFila('+i+')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td></tr>');

}