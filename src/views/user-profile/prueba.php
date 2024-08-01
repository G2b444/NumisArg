<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Eliminación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/dist/tailwind.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <script src="../../js/funciones.js"></script>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <!-- Botón para abrir el modal -->
    <button onclick="document.getElementById('deleteModal').style.display='flex'" class="m-4 p-2 bg-blue-500 text-white rounded">Abrir Modal de Eliminación</button>

    <!-- Modal de Eliminación de coleccion -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="w-1/3 bg-white rounded-2xl shadow-xl border-light-blue border p-5">
            <h1 class="text-center text-2xl mt-10 font-light-blue">Eliminar Colecciones</h1>
            <form action="eliminar_registros.php" method="post" class="flex flex-col mt-4">
                <div id="itemList" class="flex flex-col space-y-2">
                    <!-- Lista de elementos (con checkboxes) -->
                     <?php 
                     foreach ($res_colec as $filas){
                     ?>
                    <label class="flex items-center space-x-2 border-2 border-light-blue rounded-lg p-2">
                        <input type="checkbox" name="items[]" value="1" class="form-checkbox">
                        <span><?= $filas['nombre']?></span>
                    </label>
                    <?php 
                    }
                    ?>
                    <!-- Agrega más elementos según sea necesario -->
                </div>
                <div class="flex justify-between mt-8">
                    <button type="submit" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg cursor-pointer">Eliminar</button>
                    <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg cursor-pointer">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


