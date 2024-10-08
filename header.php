<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<a name="arriba"></a>
    
<?php
session_start();
if(isset($_SESSION['id_tipo_usuario'])){
    $id = $_SESSION['id_tipo_usuario'];

    if($id == 1){
        echo "<script>window.location='src/views/admin-pages';</script>";
    }
}
if(isset($_SESSION['id_usuario'])){
    $usuario=$_SESSION['id_usuario'];
    ECHO '<header class="flex items-center bg-dark-blue h-20 overflow-visible">
        <div class="container mx-auto flex flex-nowrap justify-between items-center">
            <a href="/numisarg/index.php"><img src="/numisarg/LOGO NUMISARG.svg" alt="logo" class="w-16 h-16 mt-2 ml-4"></a>
            <nav class="flex flex-row space-x-10 px-10 pt-5">
                <a href="/numisarg/src/views/coin-catalog/catalogo.php" class="text-white">Catálogo</a>
                <a href="/numisarg/src/views/contact/contacto.php" class="text-white">Contáctanos</a>
                <div class="flex flex-col relative bottom-2">
                    <a href="/numisarg/src/views/user-profile/main.php" class="border-2 border-white text-white px-4 py-2 rounded-lg" id="desplegable">Usuario</a>
                    <a href="/numisarg/src/php/delsession.php" class=" hidden absolute top-9 border-2 bg-dark-blue border-white text-white px-4 py-2 rounded-b-lg" id="menu">Cerrar sesion</a>
                </div>
            </nav>
        </div>
    </header>';
}else{
    echo '<header class="flex items-center bg-dark-blue h-20">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/numisarg/index.php"><img src="/numisarg/LOGO NUMISARG.svg" alt="logo" class="w-16 h-16 mt-2 ml-4"></a>
            <nav class="space-x-10 px-10">
                <a href="/numisarg/src/views/coin-catalog/catalogo.php" class="text-white">Catálogo</a>
                <a href="/numisarg/src/views/contact/contacto.php" class="text-white">Contáctanos</a>
                <a href="/numisarg/src/views/login" class="border-2 border-white text-white px-4 py-2 rounded-lg">Ingresar</a>
            </nav>
        </div>
    </header>';
}
 ?>   

</body>
</html>


<!-- Tailwind CSS Config -->
<style>
    .bg-dark-blue {
        background-color: #021526;
    }
    .bg-light-blue {
        background-color: #0D3559;
    }
    .bg-white {
        background-color: #FCFFFF;
    }
    .bg-black {
        background-color:  #000911;
    }
    .border-light-blue {
        border-color: #0D3559;
    }
    .font-light-blue {
        color: #0D3559;
    }
    .font-patua{
        font-family: 'Patua One', cursive;
    }
    .font-radio{
        font-family: 'Radio Canada', sans-serif;
    }
    body {
            font-family: 'Radio Canada', sans-serif;
        }
        h1, h2, h3, h4 {
            font-family: 'Patua One', cursive;
        }
    
    #desplegable:hover + #menu, #menu:hover {
        display: block;
    }
</style>
