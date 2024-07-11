<?php 
if(isset($_GET['v'])){
    $id_usuario = $_GET['v'];

    $sql = "SELECT usuario.nombre AS usuario_nombre, 
                    correo, 
                    tipo_usuario.nombre AS tipo_usuario, 
                    tipo_usuario.id_tipo_usuario AS id_tipo_usuario
            FROM usuario, tipo_usuario
            WHERE id_usuario = $id_usuario 
            AND tipo_usuario.id_tipo_usuario = usuario.id_tipo_usuario";
    include '../../inc/conexion.php';
    $res = mysqli_query($conectar, $sql);
} else {
    echo "<script>window.location='tabla_usuario.php';</script>";
}


if (isset($_POST['update'])) {
    $updates = [];

    if (isset($_POST['user_name'])) {
        $user_name = $_POST['user_name'];
        $updates[] = "nombre='$user_name'";
    }
    if (isset($_POST['user_email'])) {
        $user_email = $_POST['user_email'];
        $sql = "SELECT *
                FROM usuario
                WHERE correo = '$user_email'";
        $ver = mysqli_query($conectar, $sql);

        if(mysqli_num_rows($ver)>0){
            echo "<script>alert('Este usuario ya está registrado con este correo');</script>";
            echo "<script>window.location='editar_usuario.php?v=$id_usuario'</script>";
        }
        $updates[] = "correo='$user_email'";
    }
    if (isset($_POST['user_type'])) {
        $user_type = $_POST['user_type'];
        $updates[] = "id_tipo_usuario='$user_type'";
    }

    if (!empty($updates)) {
        $sql_update = "UPDATE usuario SET " . implode(", ", $updates) . " WHERE id_usuario=$id_usuario";
        if(mysqli_query($conectar, $sql_update)){
            mysqli_close($conectar);
            header('Location: tabla_usuario.php?success=editar_usuario');
            exit;
        }
    }
}

if(isset($_POST['cancelar'])){
    echo "<script>window.location='tabla_usuario.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script>
        function toggleInput(inputId) {
            const input = document.getElementById(inputId);
            input.disabled = !input.disabled;
        }
    </script>
</head>
<body class="bg-white">
    <form action="" method="post">
        <div class="flex flex-col text-center max-w-md mx-auto bg-white p-6 rounded-lg shadow-2xl">
            <h1 class="text-4xl">Editar usuario</h1>
            <div class="mt-5">
                <?php foreach ($res as $filas): ?>
                    <div class="relative mt-8">
                        <input type="text" id="user_name" value="<?= $filas['usuario_nombre'] ?>" placeholder="Nombre de usuario" name="user_name" class="toggleable px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                        <input type="checkbox" class="absolute top-4 ml-2 p-8" onclick="toggleInput('user_name')">
                    </div>
                    <div class="relative mt-8">
                        <input type="text" id="user_email" value="<?= $filas['correo'] ?>" placeholder="Correo" name="user_email" class="toggleable px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                        <input type="checkbox" class="absolute top-3 ml-2" onclick="toggleInput('user_email')">
                    </div>
                    <div class="relative mt-8">
                        <input type="password" value="**************" placeholder="Contraseña" class="px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                        <i class="fas fa-info-circle absolute top-3 ml-2" title="No se puede editar la contraseña desde esta sección."></i>
                    </div>
                    <div class="relative mt-8">
                        <select name="user_type" id="user_type" class="toggleable px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                            <option value="<?= $filas['id_tipo_usuario']?>" selected disabled><?= $filas['tipo_usuario'] ?></option>
                            <?php 
                            $sql = "SELECT * FROM tipo_usuario WHERE NOT id_tipo_usuario = ".$filas['id_tipo_usuario'];
                            $respuesta = mysqli_query($conectar, $sql);
                            foreach($respuesta as $fila) {
                            ?>
                                <option value="<?= $fila['id_tipo_usuario']?>"><?= $fila['nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="checkbox" class="absolute top-3 ml-2" onclick="toggleInput('user_type')">
                    </div>
                <?php endforeach; ?>
                <div class="text-center mt-6">
                    <button type="submit" name="cancelar" class="bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-xmark"></i></button>
                    <button type="submit" name="update" class="ml-16 bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Actualizar <i class="fa-solid fa-check"></i></button>
                </div>
            </div>
        </div>
    </form>
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
        background-color: #000911;
    }
    body {
        font-family: 'Radio Canada', sans-serif;
    }
    h1, h2 {
        font-family: 'Patua One', cursive;
    }
</style>
