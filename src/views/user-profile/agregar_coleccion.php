<?php 

session_start();
include("../../inc/conexion.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION['id_usuario'])){

    $coleccion = $_POST['nuevacoleccion'];
    $id_usuario = $_SESSION['id_usuario'];
    echo $coleccion;
    
    if(!$coleccion == ''){
        $sql = "SELECT * 
                FROM coleccion 
                WHERE nombre = '$coleccion' 
                AND id_usuario= $id_usuario";
        $res = mysqli_query($conectar, $sql);
        if($res){
            $num = mysqli_num_rows($res);
            if($num!=0){
                echo '<script>alert("ERROR: Ya tienes una coleccion con este nombre.");history.go(-1);</script>';
                exit();
            }
        }
 

        $sql = "INSERT INTO coleccion (nombre, id_usuario) 
            VALUES ('$coleccion', $id_usuario)";
        $res = mysqli_query($conectar,$sql);

        if($res){
            header('Location: main.php?success=agregar_coleccion');
        }
    }

}else{
    echo "window.location='../../../';";
}

?>