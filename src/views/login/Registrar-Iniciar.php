<?php 

include("../../inc/conexion.php");


if(isset($_POST['R'])){
    if(isset($_POST['nombre']) && isset($_POST['ps']) && isset($_POST['ps-verify']) && isset($_POST['correo'])){
        $nombre = $_POST['nombre'];
        $ID = $_POST['ps'];
        $ID2 = $_POST['ps-verify'];
        $mail = $_POST['correo']; 
        $fecha = date('Y-m-d'); // Formato adecuado para la base de datos (AAAA-MM-DD)

        if($ID == $ID2){
            $sql_1 = "SELECT * FROM usuario WHERE correo = '$mail' AND contraseña = '$ID' AND correo = '$mail'";
            $res_1 = mysqli_query($conectar, $sql_1);

            if(mysqli_num_rows($res_1) > 0){
                echo "<script> alert('El registro no se ha podido llevar a cabo. Intente nuevamente.'); history.go(-1); </script>";
            } else {
                $sql_2 = "INSERT INTO usuario (id_usuario, id_tipo_usuario, nombre, correo, contraseña, fecha_inicio)
                          VALUES ('', '2', '$nombre', '$mail', '$ID', '$fecha')";
                $res_2 = mysqli_query($conectar, $sql_2);

                if($res_2){
                    echo "<script> alert('El registro fue exitoso. Inicie sesión para acceder a su cuenta'); window.location='index.html'; </script>";
                } else {
                    echo "<script> alert('El registro no se ha podido llevar a cabo. Intente nuevamente'); history.go(-1); </script>";
                }
            }
        } else {
            echo "<script> alert('Las contraseñas no coinciden. Intente nuevamente.'); history.go(-1); </script>";
        }
    } else {
        echo "<script> alert('Complete todos los campos.'); history.go(-1); </script>";
    }
}


if(isset($_POST['IS'])){

$mail = $_POST['correo']; 
$id = $_POST['ps'];



$sql_3 = "SELECT * FROM usuario WHERE correo='$mail' AND contraseña = '$id'";
$res_3 = mysqli_query($conectar, $sql_3);

    if(mysqli_num_rows($res_3) == 1 ){

        $array = mysqli_fetch_assoc($res_3);
        $nombre = $array['nombre'];
        $contraseña = $array['contraseña'];
        $id_usuario = $array['id_usuario'];
        $id_tipo_usuario = $array['id_tipo_usuario'];

        session_start();
        $_SESSION['nombre'] = $nombre;
        $_SESSION['contraseña'] = $contraseña; 
        $_SESSION['id_usuario'] = $id_usuario;

        if($id_tipo_usuario=='2'){
            echo "<script> alert('El inicio de sesión fue exitoso.');</script>";

            if(isset($_SESSION['id_moneda'])){
                $id_moneda = $_SESSION['id_moneda'];
                unset($_SESSION['id_moneda']);
                echo "<script>window.location='../coin-catalog/moneda.php?moneda=$id_moneda';</script>";
            }else{
                echo "<script>window.location='./../../../index.php';</script>";
            }
        }else{
            echo "<script> alert('El inicio de sesión fue exitoso.'); 
            window.location='../admin-pages/index.php'; </script>";
        }
       
    }else{
        echo "<script>window.location='index.php?success=error_iniciar'</script>";
    }
   
}




?>