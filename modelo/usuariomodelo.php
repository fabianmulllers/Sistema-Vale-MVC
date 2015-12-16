<?php

include "conexion.php";

class usuarioModelo {

    function identificacionUsuario($correo, $clave) {

        $sql = "select * from usuario where correo='$correo' and pass = '$clave' ";
        $conexion = new conexion();
        $datos = $conexion->consultabd($sql,0);

        if (is_array($datos)) {
            foreach ($datos as $index => $valor) {

                switch ($index) {
                    case 'nombre' :
                        $_SESSION['nombre']=$valor;
                        break;
                    case 'apellidoPaterno':
                         $_SESSION['apellidoPaterno']=$valor;
                        break;
                    case 'apellidoMaterno':
                        $_SESSION['apellidoMaterno']=$valor;
                        break;
                    case 'nombreUsuario' :
                        $_SESSION['nombreUsario']=$valor;
                        break;
                    case 'correo':
                        $_SESSION['correo']= $valor;
                }
            }

            return "<script>  location.href='tables.php'</script>";
        } else {

            return "correo electrónico que ingresaste o la contraseña no coinciden con ninguna cuenta";
        }
    }

}

/* $hola= new conexion();
  echo $hola->conexionmaster(); */
?>