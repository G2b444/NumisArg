<?php
include ("../../inc/conexion.php");
session_start();
    
if(isset($_POST['submit'])){
    $ps = $_POST['ps'];
    $ps2 = $_POST['ps2'];
    $codigo = $_POST['n'];
}

if(isset($_POST['submit']) && !empty($ps) && !empty($ps2) && !empty($codigo)){

    $numero = $_SESSION['numero'];
    $correo = $_SESSION['correo'];

    if("$ps" == "$ps2" && $codigo == $numero){

        $sql = " SELECT * FROM usuario WHERE correo = '$correo'";
        $res = mysqli_query($conectar ,$sql);

        if(!$res){
            echo '<script> alert("No se pudo realizar el cambio de contraseña. Inténtelo nuevamente"); history.go(-1); </script>';
        }else{
            $sql = "UPDATE `usuario` SET `contraseña`='$ps'";
            $res = mysqli_query($conectar, $sql);
            if(!$res){
                echo '<script> alert("No se pudo realizar el cambio de contraseña. Inténtelo nuevamente"); history.go(-1); </script>';
            }else{
                echo' <script> alert("Cambio de contraseña realizado con éxito. Inicie sesión nuevamente."); window.location="../../php/delsession.php"; </script> ';
            }
        }


        
        
    }else{
        echo'<script> alert("Al parecer uno de los datos no es correcto, revise e intente nuevamente."); history.go(-1); </script>';
    }
    
}elseif(isset($_POST['a1'])){
    $usu = $_POST['usuario']; 
    $cor = $_POST['correo']; 
    $con = $_POST['contraseña'];

    

    
    if(empty($usu) && empty($cor) && empty($con)){
        echo '<script> alert("Hubo un problema al actualizar el nombre"); history.go(-1); </script>';
    }else{

        $id = $_SESSION['id_usuario'];

        $sql = " SELECT contraseña FROM usuario WHERE id_usuario = $id ";
        $res = mysqli_query($conectar, $sql);
    
    
    
        if(!$res){
            echo '<script> alert("No se pudieron actualizar los datos correctamente. Intente nuevamente 1"); history.go(-1); </script>';
        }else{
            $ps = mysqli_fetch_assoc($res);
            $ps = $ps['contraseña'];

            $sql = "SELECT * FROM usuario WHERE `id_usuario` = '$id' AND `contraseña`='$ps' AND `correo`='$cor'";

            if(mysqli_num_rows(mysqli_query($conectar, $sql))==0){
                echo "<script>window.location='../user-profile/main.php?success=var_error';</script>";
            }

            $sql = "UPDATE `usuario` SET `nombre`='$usu' WHERE `id_usuario` = '$id'";
            $res = mysqli_query($conectar, $sql);
           
            if(!$res){
                echo '<script> alert("No se pudieron actualizar los datos correctamente. Intente nuevamente 2"); history.go(-1); </script>';
            }else{
                echo '<script> window.location="../user-profile/main.php?success=cambio_de_nombre"; </script>';
            }
        }
        
    }

   
}elseif(isset($_POST['a2'])){
    $con_nueva = $_POST['con_nueva'];
    $rep_con_nueva = $_POST['rep_con_nueva'];
    $con_act = $_POST['con_act']; 

    
    $id = $_SESSION['id_usuario'];

    $sql = " SELECT contraseña FROM usuario WHERE id_usuario = $id ";
    $res = mysqli_query($conectar, $sql);

    $con = mysqli_fetch_assoc($res);
    $con = $con['contraseña'];
     if($res && "$con_act" == "$con" && "$con_nueva" == "$rep_con_nueva"){
        $sql = "UPDATE `usuario` SET `contraseña`='$con_nueva' WHERE `id_usuario`='$id' AND `contraseña`='$con_act'";
        $res = mysqli_query($conectar, $sql);
       
        if(!$res){
            echo '<script> alert("No se pudieron actualizar los datos correctamente. Intente nuevamente"); history.go(-1); </script>';
        }else{
            echo '<script> window.location="../user-profile/main.php?success=cambio_contraseña_éxito";</script>';
        }
    }else{
        echo '<script> window.location="../user-profile/main.php?success=error_cambiar_contraseña" </script>';
        
    }

}

?>