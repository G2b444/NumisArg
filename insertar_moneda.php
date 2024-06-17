<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dvs = $_POST['divisa'];
$v_n = $_POST['v_n']; //valor nominal
$t_c = $_POST['t_c']; //tipo canto
$n_m = $_POST['nombre_moneda'];
$t_m = $_POST['tipo_moneda'];
$cmpscn = $_POST['composicion'];
$dmtr = $_POST['diametro'];
$spsr = $_POST['espesor'];
$hstr = $_POST['historia'];
$nc_msm = $_POST['ini_emi'];
$fn_msm = $_POST['fin_emi'];

$lstl_anver = $_POST['listel_anver'];
$fg_anver = $_POST['efigie_anver'];
$lynd_anver = $_POST['leyenda_anver'];
$exergo_anver = $_POST['exergo_anver'];
$ly_anver = $_POST['ley_anver'];
$grfl_anver = $_POST['grafilia_anver'];
$dtlls_anver = $_POST['detalles_anver'];

$lstl_rever = $_POST['listel_rever'];
$fg_rever = $_POST['efigie_rever'];
$lynd_rever = $_POST['leyenda_rever'];
$exergo_rever = $_POST['exergo_rever'];
$ly_rever = $_POST['ley_rever'];
$grfl_rever = $_POST['grafilia_rever'];
$dtlls_rever = $_POST['detalles_rever'];

$ruta_indexphp = dirname(realpath(__FILE__));
$anverso = $_FILES['anv']['tmp_name'];
$reverso = $_FILES['rvo']['tmp_name'];
$anverso_destino ='imagenes/'. $_FILES['anv']['name'];
$reverso_destino ='imagenes/'. $_FILES['rvo']['name'];


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
            $id_img_anv = mysqli_insert_id($conectar);
            $sql = "INSERT INTO `imagen`(`direccion`) VALUES ('$reverso_destino')";
            $res = mysqli_query($conectar, $sql);
            $id_img_rev = mysqli_insert_id($conectar);

            if($res){
                $sql = "INSERT INTO `moneda`(`nombre`) VALUES ('$n_m')";
                $res = mysqli_query($conectar, $sql);
                $id_act = mysqli_insert_id($conectar);

                if($res){
                    $sql = "INSERT INTO `moneda_atributo`(`id_moneda`, `id_divisa`, `id_valor_nominal`, `id_tipo_canto`, 
                    `id_tipo_moneda`, `composicion`, `diametro`, `espesor`, `historia`, `inicio_emision`, `fin_emision`) 
                    VALUES ($id_act , $dvs, $v_n, $t_c, $t_m,'$cmpscn','$dmtr','$spsr','$hstr','$nc_msm','$fn_msm')";
                    $res = mysqli_query($conectar, $sql);
                    $id_act = mysqli_insert_id($conectar);

                    if($res){
                        $sql = "INSERT INTO `partes`(`id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, 
                        `leyenda`, `exergo`, `ley`, `grafilia`, `detalles`) 
                        VALUES ($id_img_anv,$id_act,'anverso','$lstl_anver','$fg_anver','$lynd_anver','$exergo_anver'
                        ,'$ly_anver','$grfl_anver','$dtlls_anver')";
                        $res = mysqli_query($conectar, $sql);
                        var_dump($sql);

                        if($res){
                            $sql = "INSERT INTO `partes`(`id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, 
                            `leyenda`, `exergo`, `ley`, `grafilia`, `detalles`) 
                            VALUES ($id_img_rev,$id_act,'reverso','$lstl_rever','$fg_rever','$lynd_rever','$exergo_rever'
                            ,'$ly_rever','$grfl_rever','$dtlls_rever')";
                            $res = mysqli_query($conectar, $sql);
                            var_dump($sql);

                            if($res){
                                echo "<script>alert('La moneda se ingresó con éxito.');</script>";
                            }else{
                                echo "<script>alert('ERROR: La moneda no se pudo ingresar.');</script>";
                            }

                        }else{
                            echo "<script>alert('ERROR: No se pudo insertar el anverso de la moneda');</script>";
                        }
                    }else{
                        var_dump($sql);
                        echo "<script>alert('ERROR: No se pudo insertar los atrbutos de la moneda');</script>";
                    }
                }else{
                    echo "<script>alert('ERROR: No se pudo insertar el nombre de la moneda');</script>";
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