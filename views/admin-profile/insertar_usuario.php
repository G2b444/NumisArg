<?php 

if(isset($_POST['agregar'])){

    $name = $_POST["user_name"];
    $email = $_POST["user_email"];
    $password = $_POST["user_password"];
    $t_u = $_POST["user_type"];

    $sql = "SELECT * FROM usuario WHERE correo = '$email'";
    include '../../inc/conexion.php';
    $res = mysqli_query($conectar, $sql);

    if(mysqli_num_rows($res)>0){
        echo "<script>alert('Este usuario ya está registrado con este correo'); history.go(-1);</script>";
    }else{
        $sql = "INSERT INTO `usuario`(`id_tipo_usuario`, `nombre`, `correo`, `contraseña`) 
                VALUES ('$t_u','$name','$email','$password');";
                
        $res = mysqli_query($conectar, $sql);

        if($res){
            echo "<script>alert('Usuario agregado con éxito'); window.location='tabla_usuario.php';</script>";
            mysqli_close($conectar);
            exit;
        }
    }
}else{
    echo "<script>history.go(-1);</script>";
}

?>