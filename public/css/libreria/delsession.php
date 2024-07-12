<?php

    if(isset($_POST['volver'])){
        session_start();

        unset($_SESSION['correo']);
        unset($_SESSION['numero']);

        header('Location: ../');
        exit;
    }else{

        session_start();

        $_SESSION = [];

        session_destroy();

        header('Location: ./../../../index.php');
        exit;
    }


?>
