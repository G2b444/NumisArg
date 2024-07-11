<?php
include 'conexion.php'

if(isset($_POST)){
    $usuario = $_POST['usuario'];
    $moneda = $_POST['moneda'];
    $cantidad = $_POST['cantidad'];
    $valor = $_POST['valor'];
    $estado = $_POST['estado'];
    $coleccion = $_POST['coleccion'];

    //validaciones
    if($usuario==''){
        echo '<script>alert("ERROR: debe iniciar sesión");history.go(-1);</script>';
    }

    if($cantidad==''){
        echo '<script>alert("ERROR: debe definir la cantidad de monedas");history.go(-1);</script>';
    }

    if($valor==''){
        echo '<script>alert("ERROR: debe definir el valor de mercado");history.go(-1);</script>';
    }


    if($estado==''){
        echo '<script>alert("ERROR: debe seleccionar un estado de moneda");history.go(-1);</script>';
    }

    if($coleccion==''){
        echo '<script>alert("ERROR: debe seleccionar una colección");history.go(-1);</script>';
    }

    //validaciones con BD
    
}
?>