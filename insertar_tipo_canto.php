<?php 
    $tdc = $_POST['tdc'];

    $sql = "INSERT INTO `tipo_canto`(`tipo`) VALUES ($tdc)";

    include 'conexion.php';

    $res = mysqli_query($conectar, $sql);
    mysqli_close($conectar);

    if(!$res){
        echo "<script>alert('ERROR: No se pudo insertar el tipo de canto.'); history.go(-1)</script>";
        exit;
    }else{
        echo "<script>alert('El tipo inserción se realizó con éxito.'); window.location='lista_monedas.php';</script>";
        exit;
    }
?>