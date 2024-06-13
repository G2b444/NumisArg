<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo $_FILES['anv']['name'];
echo $_FILES['anv']['tmp_name'];
echo $_FILES['anv']['type'];
echo $_FILES['anv']['size'];
echo $_FILES['anv']['error'];
echo $_FILES['rvo']['name'];
echo $_FILES['rvo']['tmp_name'];
echo $_FILES['rvo']['type'];
echo $_FILES['rvo']['size'];
echo $_FILES['rvo']['error'];

$ruta_indexphp = dirname(realpath(__FILE__));
echo "<script>alert('$ruta_indexphp');</script>";
$ruta_fichero_origen = $_FILES['anv']['tmp_name'];
$ruta_nuevo_destino = $ruta_indexphp . '/imagenes/'. $_FILES['anv']['name'];
echo "<script>alert('$ruta_nuevo_destino');</script>";

$extensiones = array(0=>'image/jpg', 1=>'image/jpeg', 2=>'image/png');
$max_tamanio = 1024*1024*8;

if(in_array($_FILES['anv']['type'], $extensiones)){
    echo "<script>alert('Efectivamente es una imagen');</script>";
    if($_FILES['anv']['size']<$max_tamanio){
        echo "<script>alert('Pesa menos de 1 MB medio raro');</script>";
        if(move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)){
            echo "<script>alert('fichero guardado con éxito');</script>";
        }
    }
}

?>
<?php
/*
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && isset($_POST["tipo"]) && isset($_POST["nombre"]) && isset($_POST["desc"]) &&  isset($_POST["precio"]) ){

    echo "<script> alert('funciona');  </script> ";

    echo $_FILES['imagen']['name'];
    echo $_FILES['imagen']['tmp_name'];
    echo $_FILES['imagen']['type'];
    echo $_FILES['imagen']['size'];
    echo $_FILES['imagen']['error'];

    $imagenContenido = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $extensiones = array(0=>'image/jpg', 1=>'image/jpeg', 2=>'image/png');
    $max_tamanyo = 1024 * 1024 * 8;

    if (in_array($_FILES['imagen']['type'], $extensiones)) {
        
        if ($_FILES['imagen']['size'] < $max_tamanyo) {
            
            $ruta_indexphp = dirname(realpath(_FILE_));
            $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
            $nombre_unico = uniqid() . '_' . $_FILES['imagen']['name'];
            $ruta_nuevo_destino = $ruta_indexphp . '/imagenes/' . $nombre_unico;
            $ruta_bd = 'fotos-admin' . '/imagenes/' . $nombre_unico;

            if (move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)) {
                echo '<script> alert("Fichero guardado con éxito"); </script> ';
            }
        }
    }

    $tipo= $_POST['tipo'];
    $nombre= $_POST['nombre'];
    $desc = $_POST['desc'];
    $precio = $_POST['precio'];
    
   
    $sql = "INSERT INTO producto(id_producto, id_categoria, id_local,Nombre, precio, Descripcion, foto, ruta,disponibilidad) VALUES ('', '$tipo', '0','$nombre', '$precio', '$desc', '$imagenContenido', '$ruta_bd','1')";
    $datos = mysqli_query($conectar, $sql);

    if (!$datos) {
        echo "<script> alert('Error al subir la imagen'); history.go(-1); </script>";
    } else {
        echo "<script> alert('Imagen subida correctamente a la base de datos'); window.location.href='agregar.php'; </script>";
    }

    mysqli_close($conectar);
} else {
    echo "<script> alert('No se ha enviado ninguna imagen'); history.go(-1); </script>";
}
*/
?>