<?php
session_start();
if (!isset($_SESSION['correo'])) {

    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sistema de vales de consumo</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet"> 

        <!-- DataTables CSS -->
        <link href="../css/tabla.css" rel="stylesheet">
        <link href="../css/tablaroja.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->

        <!-- Custom CSS -->
       <!-- <link href="../css/sb-admin-2.css" rel="stylesheet">-->

        <!-- Custom Fonts -->
        <!--<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>




<div> 
    <select id="iterador">
     <?php
        for($i= 1;$i<=22; $i++){
            echo "<option value ='$i'> $i </option>";
        }     
     ?>
    </select> 
    
    <button class="btn btn-primary" type="button" onclick="generarTabla($('#iterador').val())">click tabla </button>
</div>




        <form name="form" method="post" action="ingresoconsumo.php" >
                    <table id="tabla"   class="mitabla">
                        <thead>
                            <tr>
                                <td>Codigo Producto</td>
                                <td>Descripcion Producto</td>
                                <td>Cantidad <br> stock</td>
                                <td>Precio Unitario</td>
                                <td>Cantidad a pedir</td>
                                <td>Subtotal</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                        <tbody >
                            <tr id="resultado"style="display:none" >
                                <td><input class="form-control"  placeholder="EJ: 04008006" id="codproducto[]" name="codproducto[]" type="search" onkeyup="buscarproducto(document.getElementsByName('codproducto[]')[0].value)"  autofocus></td>

                            </tr>
                        </tbody>
                        <button class="btn btn-primary" type="submit" >enviar </button>
                    
                    </table>
        </form>
        <button type="button" onclick="agregarFila()"class="btn btn-success btn-xs">Agregar fila <span class="glyphicon glyphicon-plus"></span></button>

 </button>
               
                <!-- /.table-responsive -->
  
  


<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->


<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<script src="../js/funciones.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->


</body>

</html>
