<?php

include "conexion.php";

class productoModelo {

    function buscarProducto($codproducto, $dbselect) {

        $conexion = new conexion();
        $conexionerp = $conexion->conexiondb($dbselect);
        $codbodega = $_SESSION["bodega"];
        $queryporcodigointerno = "select
						    pro_codprod,
						    pro_desc,
						    pro_umprincipal,
						    case when psl_saldo is null then '0' else round(psl_saldo) end as psl_saldo
							from sto_producto --def de producto
							left join sto_prodsal on --tabla de saldos
						    psl_codprod = pro_codprod and
						    psl_codbodega = '$codbodega'
							where
						    pro_codtipo = '5' and
						    pro_codprod = '$codproducto'";

        $datos = $conexion->consultabd($queryporcodigointerno, $dbselect);
        
          if (is_array($datos)) {
               
               $resultado ="<td>" .$datos['pro_desc']." </td> "
                       . "   <td>".$datos['psl_saldo']. "</td> ";
               
               return $resultado;
          }else{
              return "no";
          }
          



        //$querycodigobarras = "select bar_codprod, bar_codbarras from sto_prodcodbar where bar_codbarras = '$codproducto'";
    }

}

?>