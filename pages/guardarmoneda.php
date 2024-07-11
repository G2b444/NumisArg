<?php
include 'conexion.php';

if(isset($_POST)){
    $usuario = $_POST['usuario'];
    $moneda = $_POST['moneda'];
    $cantidad = $_POST['cantidad'];
    $valor = $_POST['valor'];
    $estado = $_POST['estado'];
    $anomalia = $_POST['anomalia'];
    $coleccion = $_POST['coleccion'];
    $nuevacoleccion = $_POST['nuevacoleccion'];


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

    //validaciones de desplegables
    if(($estado=="0") AND ($anomalia=="0")){
        echo '<script>alert("ERROR: debe seleccionar un estado válido");history.go(-1);</script>';
    }

    if(($estado=="0") AND ($anomalia=="")){
        echo '<script>alert("ERROR: debe seleccionar una anomalía");history.go(-1);</script>';
    }

    if(($coleccion=="0") AND ($nuevacoleccion=="")){
        echo '<script>alert("ERROR: debe definir un nombre para su colección");history.go(-1);</script>';
    }

    //registrar coleccion
    if($coleccion=="0"){
        $sql = "INSERT INTO coleccion (nombre, id_usuario) 
            VALUES ('$nuevacoleccion','$usuario')";
        $res = mysqli_query($conectar,$sql);
        if($res){
            $sql = "SELECT id_coleccion 
                FROM coleccion 
                WHERE nombre='$nuevacoleccion'";
            $res = mysqli_query($conectar,$sql);
            $idcol= mysqli_fetch_assoc($res);
            $coleccion = $idcol['id_coleccion'];
        }
    }

    //detalle de guardado
    $sql="INSERT INTO `detalle_guarda`(`id_estado`, `cantidad`, `valor_de_mercado`) 
    VALUES ('$estado','$cantidad','$valor')";

    if(estado!=0){
        //estados normales
        $sql="INSERT INTO `guarda_moneda`(`id_detalle_guarda`, `id_moneda`, `id_coleccion`, `fecha_guardado`) 
            VALUES ('','','','')";

    }else{
        //estado anomalía

    }
}
?>