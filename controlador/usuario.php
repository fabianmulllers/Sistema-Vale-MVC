<?php
include '../modelo/usuariomodelo.php';

if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        
        switch($action) {
            case 'identificame' : 
                if(isset($_POST['correo'])&& isset($_POST['pass'])){
                    $correo= trim($_POST['correo']);
                    $pass = trim ($_POST['pass']);
                    $usuariomodelo = new usuarioModelo();
                   $resultado= $usuariomodelo->identificacionUsuario($correo, md5($pass));
                    echo $resultado ;
                    
                }
                
                break;
            case 'logout' : 
                
                session_destroy();
                break;
            
        }
    }   
    ?>