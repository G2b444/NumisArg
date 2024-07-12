<?php 

$divisa = $_POST['d'];

$sql = "INSERT INTO `divisa`(`nombre`) VALUES ('$divisa')";


include '../../inc/conexion.php';

$res = mysqli_query($conectar, $sql);
mysqli_close($conectar);

if(!$res){
    echo "<script>alert('ERROR: No se pudo insertar la divisa.'); history.go(-1)</script>";
    exit;
}else{
    echo "<script>alert('El tipo inserción se realizó con éxito.'); window.location='lista_monedas.php';</script>";
    exit;
}
?>