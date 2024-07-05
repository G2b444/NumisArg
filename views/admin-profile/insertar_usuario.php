<?php 

if(isset($_POST['agregar'])){

    $name = $_POST["user_name"];
    $email = $_POST["user_email"];
    $password = $_POST["user_password"];
    $t_u = $_POST["user_type"];

    $sql = "INSERT INTO `usuario`(`id_tipo_usuario`, `nombre`, `correo`, `contraseña`) 
    VALUES ('$t_u','$name','$email','$password');";
    include '../../inc/conexion.php';
    $res = mysqli_query($conectar, $sql);

    if($res){
        echo "<script>alert('Usuario agregado con éxito'); window.location='tabla_usuario.php';</script>";
        mysqli_close($conectar);
        exit;
    }
}else{
    echo "<script>history.go(-1);</script>";
}

?>