<?php 
$sql = "SELECT tipo_usuario.nombre AS tipo_usuario,
                usuario.nombre AS nombre,
                correo
        FROM usuario
        JOIN tipo_usuario ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";

include '../../inc/conexion.php';

if (isset($_POST['buscar'])) {
    $dato = trim($_POST['search']);
    
    if (!empty($dato)) {
        $filtro = $_POST['filtro'];
        
        switch ($filtro) {
            case 'correo':
                $sql .= " WHERE usuario.correo LIKE '%$dato%'";
                break;
            case 'tipo':
                $sql .= " WHERE tipo_usuario.nombre LIKE '%$dato%'";
                break;
            case 'nombre':
                $sql .= " WHERE usuario.nombre LIKE '%$dato%'";
                break;
        }
    }
}

$res = mysqli_query($conectar, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NumisArg</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
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
    <main class="p-6">
        <section class="mb-6 flex flex-col justify-center items-center text-center">
            <section class="mb-6" >
                <h1 class="text-4xl mb-5 mt-12">Usuarios</h1>
                <div class="flex space-x-4 items-center">
                    <form action="" method="post">
                        <label for="search-category" class="font-bold">En ...</label>
                        <select id="search-category" name="filtro" class="p-2 border border-gray-300 rounded">
                            <option value="valor" selected disabled>Atributo</option>
                            <option value="tipo">Tipo</option>
                            <option value="nombre">Nombre</option>
                            <option value="correo">Correo</option>
                        </select>
                        <input type="text" name="search" id="search-input" class="p-2 border border-gray-300 rounded" placeholder="Buscar...">
                        <button type="submit" name="buscar" class="bg-dark-blue text-white px-4 py-2 rounded"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                        <button type="button" class="bg-dark-blue text-white px-4 py-2 rounded"><a href="agregar_usuario.html"><i class="fa-solid fa-plus"></i> Agregar</a></button>
                    </form>
                </div>
            </section>
            <section class="mb-6">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-dark-blue text-white">Tipo</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Nombre</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Correo</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Contraseña</th>
                            <th class="py-2 px-4 bg-dark-blue text-white" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($res as $index => $filas): ?>
                        <tr class="bg-gray-100">
                            <td class="border px-4 py-2"><?= $filas['tipo_usuario']?></td>
                            <td class="border px-4 py-2"><?= $filas['nombre']?></td>
                            <td class="border px-4 py-2"><?= $filas['correo']?></td>
                            <td class="border px-4 py-2">**************</td>
                            <td class="border px-4 py-2 cursor-pointer"><i class="fa-solid fa-trash-can" style="font-size: x-large; margin-right: 10px; margin-left: 10px;"></i></td>
                            <td class="border px-4 py-2 cursor-pointer"><i class="fa-solid fa-pen" style="font-size: x-large;"></i></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </section>
    </main>
    <footer class="bg-gray-900 py-4">
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