<?php

    if(isset($_POST['volver'])){
        session_start();

        unset($_SESSION['correo']);
        unset($_SESSION['numero']);

        header('Location: /numisarg/');
        exit;
    }else{

        session_start();

        $_SESSION = [];

        session_destroy();

        echo "<script>window.location='/numisarg/';</script>";
        exit;
    }


?>
