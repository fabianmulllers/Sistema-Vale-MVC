<?php

session_start();

class conexion {

    var $hostsys = "localhost";
    var $portsys = "5432";
    var $dbnamesys = "sys_consumo";
    var $usersys = "postgres";
    var $password = "masterdb";

    function conexionmaster() {
        $dbconn = pg_connect("host= $this->hostsys port= $this->portsys dbname= $this->dbnamesys user= $this->usersys password= $this->password");
        return $dbconn;
    }

    function conexiondbnombre($db_id) {
        $dbssql = "select * from db_sys where db_id = '$db_id'";
        //echo $dbssql;
        $datosdbs = pg_query($this->conexionmaster(), $dbssql);
        $row = pg_fetch_array($datosdbs);
        $nombrelocal = $row['nombre'];
        $id_db = $row['db_id'];
        $host = $row['db_host'];
        $puerto = $row['db_port'];
        $dbname = $row['db_name'];
        $user = $row['db_user'];
        $pass = $row['db_pass'];
        $dbconn = pg_connect("host=$host port=$puerto dbname=$dbname user=$user password=$pass");
        $_SESSION["nombresala"] = $nombrelocal;
        $_SESSION["db_id"] = $id_db;
        return $dbconn;
    }

    function conexiondb($db_id) {
        $dbssql = "select * from basedatos where id_bd = '$db_id'";
        $datosdbs = pg_query($this->conexionmaster(), $dbssql);
        $row = pg_fetch_array($datosdbs);
        $nombrelocal = $row['nombre_bd'];
        $id_bd = $row['id_bd'];
        $host = $row['host_bd'];
        $puerto = $row['port_bd'];
        $dbname = $row['name_bd'];
        $user = $row['user_bd'];
        $pass = $row['pass_bd'];
        $bodega = $row['bodega'];
        $dbconn = pg_connect("host=$host port=$puerto dbname=$dbname user=$user password=$pass");
        $_SESSION["nombresala"] = $nombrelocal;
        $_SESSION["bd_id"] = $id_bd;
        $_SESSION["bodega"] = $bodega;
        return $dbconn;
    }

    function consultabd($sql, $dbselect) {

        //base datos erp >0
        //base datos consumo = 0

        if ($dbselect > 0) {
            $existendatos = pg_query($this->conexiondb($dbselect), $sql);
        } else {
            $existendatos = pg_query($this->conexionmaster(), $sql);
        }



        if (pg_num_rows($existendatos) != 0) {
            $row = pg_fetch_array($existendatos);
            $resultado = $row;
        } else {
            $resultado = "no ahy datos";
        }
        return $resultado;
    }

}

?>