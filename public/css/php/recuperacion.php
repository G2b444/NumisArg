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
</head>
<body class="flex flex-col justify-center items-center h-screen bg-gray-100">

    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Recuperar clave</h1>
        <h2 class="mb-6">Te enviaremos un correo</h2>

        <form action="correo.php" method="POST" class="space-y-4">
            <input type="email" name="correo" placeholder="Correo" class="border border-gray-300 p-2 w-full rounded-md" required>
            <input type="submit" name="Enviar" value="Continuar" class="bg-blue-500 text-white p-2 w-full rounded-md cursor-pointer">
        </form>

        <form action="../libreria/delsession.php" method="post"><button class="text-blue-500 mt-4 inline-block" name="volver">Volver</button></form>
    </div>
</body>
</html>
