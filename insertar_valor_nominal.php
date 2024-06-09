<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $vn = $_POST['vn'];

    $sql = "INSERT INTO `valor_nominal`(`valor`) VALUES ('$vn')";

    include 'conexion.php';

    $res = mysqli_query($conectar, $sql);
    mysqli_close($conectar);

    if(!$res){
        echo "<script>alert('ERROR: No se pudo insertar el valor nominal'); history.go(-1)</script>";
        exit;
    }else{
        echo "<script>alert('La inserción del valor nominal se realizó con éxito.'); window.location='lista_monedas.php';</script>";
        exit;
    }
?>