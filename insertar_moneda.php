<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dvs = $_POST['divisa'];
$v_n = $_POST['v_n']; //valor nominal
$t_c = $_POST['t_c']; //tipo canto
$ld = $_POST['lado'];
$lstl = $_POST['listel'];
$fg = $_POST['efigie'];
$lynd = $_POST['leyenda'];
$exergo = $_POST['exergo'];
$ly = $_POST['ley'];
$grfla = $_POST['grafilia'];
$crclcn = $_POST['circulacion'];
$cmpscn = $_POST['composicion'];
$dmtr = $_POST['diametro'];
$spsr = $_POST['espesor'];
$hstr = $_POST['historia'];
$nc_msn = $_POST['ini_emi'];
$fn_msm = $_POST['fin_emi'];

$ruta_indexphp = dirname(realpath(__FILE__));
$anverso = $_FILES['anv']['tmp_name'];
$reverso = $_FILES['rvo']['tmp_name'];
$anverso_destino = $ruta_indexphp . '/imagenes/'. $_FILES['anv']['name'];
$reverso_destino = $ruta_indexphp . '/imagenes/'. $_FILES['rvo']['name'];


$extensiones = array(0=>'image/jpg', 1=>'image/jpeg', 2=>'image/png');
$max_tamanio = 1024*1024*8;

if(in_array($_FILES['anv']['type'], $extensiones)){
    echo "<script>alert('Efectivamente es una imagen');</script>";
    if($_FILES['anv']['size']<$max_tamanio){
        echo "<script>alert('Pesa menos de 1 MB medio raro');</script>";
        if((move_uploaded_file($anverso, $anverso_destino)) && (move_uploaded_file($reverso, $reverso_destino))){
            include 'conexion.php';
            $sql = "INSERT INTO `imagen`(`direccion`) VALUES ('$anverso_destino')";
            $res = mysqli_query($conectar, $sql);
            $id_img_anv = last_insert($res);
            $sql = "INSERT INTO `imagen`(`direccion`) VALUES ('$reverso_destino')";
            $res = mysqli_query($conectar, $sql);
            $id_img_rev = last_insert($res);

            if($res){
                $sql = "INSERT INTO 'moneda_atributos'(`id_divisa`, `id_valor_nominal`, 
                        `id_tipo_canto`, `circulacion`, `composicion`, `diametro`, `espesor`, `historia`, `inicio_emision`,
                        `fin_emision`)
                        VALUES ('$dvs','$v_n','$t_c','$crclcn','$cmpscn','$dmtr', '$spsr','$hstr','$ini_emi','$fin_emi')";
                $res = mysqli_query($conectar, $sql);

                if($res){
                    $sql = "INSERT INTO 'partes'(`id_imagen`, `id_moneda_atributos`, `lado`, `listel`, `efigie`, `leyenda`, `exergo`, `ley`, `grafilia`) VALUE ();";
                }
            }else{
                echo "<script>alert('ERROR: No se pudo ingresar las imagenes de la moneda');</script>";
            }
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