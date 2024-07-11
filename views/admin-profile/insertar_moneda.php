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


$lstl_rever = $_POST['listel_rever'];
$fg_rever = $_POST['efigie_rever'];
$lynd_rever = $_POST['leyenda_rever'];
$exergo_rever = $_POST['exergo_rever'];
$ly_rever = $_POST['ley_rever'];
$grfl_rever = $_POST['grafilia_rever'];

$ruta_indexphp = dirname(realpath(__FILE__));
$anverso = $_FILES['anv']['tmp_name'];
$reverso = $_FILES['rvo']['tmp_name'];
$anverso_destino ='assets/img/'. $_FILES['anv']['name'];
$reverso_destino ='assets/img/'. $_FILES['rvo']['name'];


$extensiones = array(0=>'image/jpg', 1=>'image/jpeg', 2=>'image/png');
$max_tamanio = 1024*1024*8;

if(in_array($_FILES['anv']['type'], $extensiones)){

    if($_FILES['anv']['size']<$max_tamanio){
        if((move_uploaded_file($anverso, $anverso_destino)) && (move_uploaded_file($reverso, $reverso_destino))){
            include '../../inc/conexion.php';
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
                    $sql = "INSERT INTO `moneda_atributo` (
                            `id_moneda`, 
                            `id_divisa`, 
                            `id_valor_nominal`, 
                            `id_tipo_canto`, 
                            `id_tipo_moneda`, 
                            `composicion`, 
                            `diametro`, 
                            `espesor`, 
                            `historia`, 
                            `inicio_emision`, 
                            `fin_emision`
                        ) 
                        VALUES (
                            $id_act, 
                            $dvs, 
                            $v_n, 
                            $t_c, 
                            $t_m, 
                            '$cmpscn', 
                            '$dmtr', 
                            '$spsr', 
                            '$hstr', 
                            '".$nc_msm."-01-01',
                            '".$fn_msm."-01-01'
                        )";
                    $res = mysqli_query($conectar, $sql);
                    $id_act = mysqli_insert_id($conectar);

                    if($res){
                        $sql = "INSERT INTO `partes`(`id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, 
                        `leyenda`, `exergo`, `ley`, `grafilia`) 
                        VALUES ($id_img_anv,$id_act,'anverso','$lstl_anver','$fg_anver','$lynd_anver','$exergo_anver'
                        ,'$ly_anver','$grfl_anver')";
                        $res = mysqli_query($conectar, $sql);
                        var_dump($sql);

                        if($res){
                            $sql = "INSERT INTO `partes`(`id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, 
                            `leyenda`, `exergo`, `ley`, `grafilia`) 
                            VALUES ($id_img_rev,$id_act,'reverso','$lstl_rever','$fg_rever','$lynd_rever','$exergo_rever'
                            ,'$ly_rever','$grfl_rever')";
                            $res = mysqli_query($conectar, $sql);
                            var_dump($sql);

                            if($res){
                                mysqli_close($conectar);
                                header('Location: vista_moneda.php?success=agregar_moneda');
                            }else{
                                echo "<script>alert('ERROR: La moneda no se pudo ingresar.');</script>";
                                echo "<script>location.reload();</script>";
                            }

                        }else{
                            echo "<script>alert('ERROR: No se pudo insertar el anverso de la moneda');</script>";
                            echo "<script>location.reload();</script>";
                        }
                    }else{
                        echo "<script>alert('ERROR: No se pudo insertar los atrbutos de la moneda');</script>";
                        echo "<script>location.reload();</script>";
                    }
                }else{
                    echo "<script>alert('ERROR: No se pudo insertar el nombre de la moneda');</script>";
                    echo "<script>location.reload();</script>";
                }
            }else{
                echo "<script>alert('ERROR: No se pudo ingresar las imagenes de la moneda');</script>";
                echo "<script>location.reload();</script>";
            }
            }
    }
}
?>