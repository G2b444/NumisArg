<?php 
$sql = "SELECT tipo_usuario.nombre AS tipo_usuario,
                usuario.nombre AS nombre,
                correo,
                id_usuario
        FROM usuario
        JOIN tipo_usuario ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";

include '../../inc/conexion.php';

if (isset($_POST['buscar']) && isset($_POST['filtro'])) {
    $dato = trim($_POST['search']);
    $filtro = $_POST['filtro'];
    
    if (!empty($dato) && !empty($filtro)) {
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
    <script src=../../js/funciones.js></script>
    <link rel="stylesheet" href="../../src/style.css">
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
        <!--Inicio del modal-->
            <div class="modal-overlay" id="modal-overlay"></div>
            <div class="modal" id="delete-user">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¿Seguro de que quieres eliminar este usuario?</h1>
                    <div class="flex justify-around">
                        <button class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Cancelar</button>
                        <button class="bg-transparent border-2 text-white py-2 px-4 rounded-3xl hover:bg-white hover:text-black confirm">Eliminar</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="delete-user-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Usuario eliminado de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('delete-user-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="add-user-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Usuario agregado de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('add-user-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="edit-user-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡El usuario se editó de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('edit-user-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
    <!--Fin del modal-->
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
                    <?php
                    
                    if(mysqli_num_rows($res)==0){
                        echo "<td colspan='6' class='p-8'><h1>No hay ningun registro<h1><td>";
                    }
                    
                    foreach ($res as $index => $filas): 
                    
                    ?>
                        <tr class="bg-gray-100">
                            <td class="border px-4 py-2"><?= $filas['tipo_usuario']?></td>
                            <td class="border px-4 py-2"><?= $filas['nombre']?></td>
                            <td class="border px-4 py-2"><?= $filas['correo']?></td>
                            <td class="border px-4 py-2">**************</td>
                            <td class="border px-4 py-2 cursor-pointer"><a href="eliminar_usuario.php?v=<?=$filas['id_usuario']?>" class="delete-user-link"><i class="fa-solid fa-trash-can" style="font-size: x-large; margin-right: 10px; margin-left: 10px;"></i></a></td>
                            <td class="border px-4 py-2 cursor-pointer"><a href="editar_usuario.php?v=<?=$filas['id_usuario']?>"><i class="fa-solid fa-pen" style="font-size: x-large;"></i></a></td>
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        initModal('delete-user-link', 'delete-user');                                          
    });
</script>
<?php 

if(isset($_GET['success'])){

    $proceso = $_GET['success'];

    if($proceso == 'eliminar_usuario'){
        echo "<script>openModal('delete-user-success');</script>";
    }

    if($proceso == 'agregar_usuario'){
        echo "<script>openModal('add-user-success');</script>";
    }

    if($proceso == 'editar_usuario'){
        echo "<script>openModal('edit-user-success');</script>";
    }

    echo "<script>window.history.replaceState({}, '', 'tabla_usuario.php');</script>";
}

?>