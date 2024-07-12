<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <script src=../../js/funciones.js></script>
</head>
<body>
    <?php include 'adminheader.html'; ?>
    <main>
        <section class="flex items-center flex-col mb-6">
            <h1 class="text-4xl mb-5 mt-12">Bienvenido, Administrador</h1>
            <p>¿Qué administrará hoy?</p>
            <div class="grid grid-cols-2 mt-10 gap-5">
                <div onclick="redireccionar('vista_moneda.php');" class="bg-light-blue text-white px-10 py-7 rounded-xl text-center cursor-pointer"><h1>Monedas</h1></div>
                <div onclick="redireccionar('tabla_usuario.php');" class="bg-light-blue text-white px-10 py-7 rounded-xl text-center cursor-pointer"><h1>Usuarios</h1></div>
            </div>
        </section>
    </main>
    <footer class="bg-gray-900 py-4 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white">NumisArg</h1>
            <p class="text-lg mt-2 text-white">Hecho por:</p>
            <div class="flex justify-center space-x-8 mt-2 text-white">
                <span>Vincenti Gania</span>
                <span>Rodriguez Gabriel</span>
                <span>Koncerewicz Kevin</span>
            </div>
        </div>
    </footer>
</body>
</html>