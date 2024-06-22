<?php 

include("conexion.php");
$nombre = $_POST['nombre'];
if(isset($_POST['mail'])){
    $mail = $_POST['mail'];    
}
$ID = $_POST['ps'];

if(isset($_POST['R'])){

$sql_1 = " SELECT * FROM usuario WHERE correo = '$mail' AND contraseña = '$ID' ";
$res_1 = mysqli_query($conectar, $sql_1);

    if(mysqli_num_rows($res_1) > 0){
        echo " <script> alert('El registro no se ha podido llevar a cabo. Intente nuevamente.'); history.go(-1); </script> ";
    }else{
        $sql_2 = " INSERT INTO `usuario`(`id_usuario`, `id_tipo_usuario`, `nombre`, `correo`, `contraseña`)
         VALUES ('','1','$nombre','$mail','$id')";
        $res_2 = mysqli_query($conectar, $sql_2);

            if(!$res_2){
                echo "<script> alert('El registro no se ha podido llevar a cabo. Intente nuevamente'); history.go(-1); </script> ";
            }else{
                echo "<script> alert('El registro fue exitoso. Inicie sesión para acceder a su cuenta'); window.location=inicio.html; </script> ";
            }        
    }
}

if(isset($_POST['IS'])){

$sql_3 = "SELECT * FROM usuario WHERE Nombre = '$nombre' AND contraseña = '$ID'";
$res_3 = mysqli_query($conectar, $sql_3);

    if(mysqli_num_rows($res_3) == 1 ){

        session_start();
        $_SESSION['nombre'] = $nombre;
        $_SESSION['contraseña'] = $contraseña; 

        echo "<script> alert('El inicio de sesión fue exitoso.'); 
        window.location=inicio.html; </script>";
    }else{
        echo "<script> alert('El inicio de sesión no se ha podido realizar. Intente nuevamente.'); 
        history.go(-1); </script>";
    }
   
}

?>