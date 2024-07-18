<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style> @font-face {
            font-family: 'MiFuente';
            src: url('font/PatuaOne-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'MiFuente', sans-serif;
        }
        .bg-customBlue {
            background-color: #021526;
        }

        .bg-customBlue2{
            background-color: #0D3559;
        }
        </style>
</head>
<body class="flex flex-col justify-center items-center h-screen bg-white">

    <div class="bg-customBlue p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4 text-white">Recuperar clave</h1>
        <h2 class="mb-6 font-bold text-white">Te enviaremos un correo</h2>

        <form action="correo.php" method="POST" class="space-y-4">
            <div class="relative w-96">
                <img src="../../assets/icon/image 5.png" alt="Icono Correo" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6">
                <input type="email" name="correo" placeholder="Correo" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl" required>
            </div>
            <input type="submit" name="Enviar" value="Continuar" class="bg-white text-customBlue p-2 w-full border rounded-3xl cursor-pointer font-bold">
        </form>


        <form action="../libreria/delsession.php" method="post"><button class="bg-customBlue border-1 border-white text-white mt-4 inline-block font-bold rounded-3xl" name="volver">Volver</button></form>
    </div>
</body>
</html>
