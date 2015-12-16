<?php
include '../modelo/productomodelo.php';

if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        
        switch($action) {
            case 'buscarproducto' : 
                if(isset($_POST['codproducto'])&& isset($_POST['dbselect'])){
                    $codproduct= trim($_POST['codproducto']);
                    $dbselect = trim ($_POST['dbselect']);
                    $productomodelo = new productoModelo();
                   $resultado= $productomodelo->buscarProducto($codproduct, $dbselect);
                    echo $resultado ;
                    
                }
                
                break;
            case 'logout' : 
                
                session_destroy();
                break;
            
        }
    }   

?>