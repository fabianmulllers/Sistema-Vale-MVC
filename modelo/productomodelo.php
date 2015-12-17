<?php

include "conexion.php";

class productoModelo {

    function buscarProducto($codproducto, $dbselect) {

        $conexion = new conexion();
        $conexionerp = $conexion->conexiondb($dbselect);
        $codbodega = $_SESSION["bodega"];
        $codigobarra=$this->codigobarra($codproducto,$dbselect);
        if(is_numeric($codigobarra)){
            $codproducto=$codigobarra;
            
        }
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
        $precodlista = $this->precodlista($dbselect);
        $precioproducto = $this->precioproducto($codproducto, $precodlista, $dbselect);

        if (is_array($datos)) {

            $resultado = "<td>" . $datos['pro_desc'] . " </td> "
                    . "   <td>" . $datos['psl_saldo'] . "</td> "
                    . "    <td> " . $precioproducto   . "</td> "
                    . "<td><div class='col-xs-8'><input id='cantidad[]' class='form-control input-sm' type='number' min='1'  max='".$datos['psl_saldo']."' name='cantidad[]'   required > </div> </td>"
                    . "<td></td>";
                   


            return $resultado;
        } else {
            return "no";
        }




        //$querycodigobarras = "select bar_codprod, bar_codbarras from sto_prodcodbar where bar_codbarras = '$codproducto'";
    }

    function precodlista($db_id) {
        $conexion = new conexion();
        $sql = "select * from basedatos where id_bd ='$db_id'";
        $datos = $conexion->consultabd($sql, 0);
        if (is_array($datos)) {
            $resultado = $datos['pre_codlista'];
            return $resultado;
        } else {
            return "no tiene precodlista";
        }
    }

    function precioproducto($codproducto, $precodlista, $dbselect) {
        $conexion = new conexion();
        $querypreciocodigo = "select pre_codprod ,round ( (pre_precio-((pre_precio*pre_maxdesctorecargo)/100))) as pre_precio 
from sto_precios 
where pre_codprod= '$codproducto' and pre_codlista='$precodlista'and pre_correlativo = '1'";
        $datos = $conexion->consultabd($querypreciocodigo, $dbselect);
        if (is_array($datos)) {
            $resultado = $datos['pre_precio'];
            return $resultado;
        } else {
            return "no tiene precio";
        }
    }

    function codigobarra($codproducto,$dbselect){
        $conexion = new conexion();
        $querycodigobarras = "select bar_codprod, bar_codbarras from sto_prodcodbar where bar_codbarras = '$codproducto'";
        $datos = $conexion->consultabd($querycodigobarras, $dbselect);
        if (is_array($datos)) {
            $resultado = $datos['bar_codprod'];
            return $resultado;
        } else {
            return "no tiene codigo barra";
        }
        
        
    }
    
    
}

?>