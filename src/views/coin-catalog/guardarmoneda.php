<?php
include '../../inc/conexion.php';


if(isset($_POST)){
    session_start();
    $usuario = $_SESSION['id_usuario'];
    $moneda = $_POST['moneda'];
    $cantidad = $_POST['cantidad'];
    $valor = $_POST['valor'];
    $estado = $_POST['estado'];
    $anomalia = $_POST['anomalia'];
    $coleccion = $_POST['coleccion'];
    $nuevacoleccion = $_POST['nuevacoleccion'];
    $fechaguardado= date('Y-m-d');


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

    if(($coleccion==0) AND ($nuevacoleccion=="")){
        echo '<script>alert("ERROR: debe definir un nombre para su colección");history.go(-1);</script>';
    }

    //verificar que coleccion nueva no exista
    if($nuevacoleccion==0){
            $sql = "SELECT * 
            FROM coleccion 
            WHERE nombre = '$nuevacoleccion' 
            AND id_usuario= $usuario";
        $res = mysqli_query($conectar, $sql);
        if($res){
            $num = mysqli_num_rows($res);
            if($num!=0){
                echo '<script>alert("ERROR: Ya tienes una coleccion con este nombre.");history.go(-1);</script>';
                exit();
            }
        }
    }

    //registrar coleccion
    if($coleccion==0){
        $sql = "INSERT INTO coleccion (nombre, id_usuario) 
            VALUES ('$nuevacoleccion', $usuario)";
        echo "<h1>$sql</h1>";
        echo "<br>";
        $res = mysqli_query($conectar,$sql);
        if($res){
            $coleccion= mysqli_insert_id($conectar);
        }
    }

    //detalle de guardado
    $sql="INSERT INTO `detalle_guarda`(`id_estado`, `cantidad`, `valor_de_mercado`) 
    VALUES ($estado,'$cantidad','$valor')";
    $res = mysqli_query($conectar,$sql);
    if($res){
        $id_detalle= mysqli_insert_id($conectar);
    }

    if($anomalia!=""){
            //guardar anomalia 
            $sql="INSERT INTO `guarda_anomalia`(`id_detalle_guarda`, `id_anomalia`, `id_coleccion`, `fecha_guardado`) 
            VALUES ($id_detalle,'$anomalia',$coleccion,'$fechaguardado')";
        $res = mysqli_query($conectar, $sql);
        if($res){
            echo '<script>alert("La moneda anomala se ha guardado correctamente.");history.go(-1);</script>'; 
        }
    }else{
     //guardar sin anomalia 
     $sql="INSERT INTO `guarda_moneda`(`id_detalle_guarda`, `id_moneda`, `id_coleccion`, `fecha_guardado`) 
        VALUES ($id_detalle,'$moneda',$coleccion,'$fechaguardado')";
        echo "<h1>".$sql."</h1>";
    $res = mysqli_query($conectar,$sql);
    if($res){
        echo '<script>alert("La moneda se ha guardado correctamente.");history.go(-1);</script>'; 
    }
    }
}
?>