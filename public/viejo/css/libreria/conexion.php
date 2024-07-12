<?php

$conectar = mysqli_connect("localhost","root","","numisarg");

if(!$conectar){
    echo 'Error al conectar!!!';
    exit;
}

?>