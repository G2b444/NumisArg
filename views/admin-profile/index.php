<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="flex items-center bg-dark-blue h-20">
        <div class="container mx-auto flex justify-between items-center">
            <img src="../../assets/multimedia/img/logo/LOGO NUMISARG.svg" alt="logo" class="w-16 h-16 mt-2">
            <nav class="space-x-4">
                <a href="#" class="text-white">Usuarios</a>
                <a href="#" class="text-white">Monedas</a>
                <a href="#" class="bg-light-blue text-white px-4 py-2 rounded">Ingresar</a>
            </nav>
        </div>
    </header>
    <main>
        <div class="flex items-center flex-col">
            <h1 class="text-4xl mb-5 mt-12">Bienvenido, Administrador</h1>
            <p>¿Qué administrará hoy?</p>
            <div class="grid grid-cols-2 mt-10 gap-5">
                <div class="bg-light-blue text-white px-4 py-2 rounded w-fulpx-4 py-2"><h1>Monedas</h1></div>
                <div class="bg-light-blue text-white px-4 py-2 rounded"><h1>Usuarios</h1></div>
                <div class="bg-light-blue text-white px-4 py-2 rounded"><h1>Divisa</h1></div>
                <div class="bg-light-blue text-white px-4 py-2 rounded"><h1>Personal</h1></div>
            </div>
        </div>
    </main>
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

    body {
            font-family: 'Radio Canada', sans-serif;
        }
        h1, h2 {
            font-family: 'Patua One', cursive;
        }
   
</style>