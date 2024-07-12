<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Moneda</title>
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../src/style.css">
    <script src="../../js/funciones.js"></script>
</head>
<body class="bg-white">
    <main class="p-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-2xl">
            <h1 class="text-2xl font-bold mb-6">Agregar moneda</h1>
            <form action="insertar_moneda.php" method="POST" class="space-y-6" enctype="multipart/form-data">
                <!-- General Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">General</h3>
                        <input name="nombre_moneda" type="text" placeholder="Nombre de la moneda" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="30">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input name="v_n" type="number" placeholder="Valor N." class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <select name="divisa" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option selected disabled>Divisa</option>
                                <?php 
                                    $sql = "SELECT * FROM divisa";
                                    include '../../inc/conexion.php';
                                    $res = mysqli_query($conectar, $sql);

                                    foreach($res as $filas){
                                        echo "<option value='".$filas['id_divisa']."'>".$filas['nombre']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <h3 class="text-lg font-semibold">Emisión</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input name="ini_emi" type="number" placeholder="Inicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1816" max="2024">
                            <input name="fin_emi" type="number" placeholder="Final" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1816" max="2024">
                        </div>
                        <textarea name="historia" placeholder="Historia" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="500"></textarea>
                    </div>
                    <!-- Características Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Características</h3>
                        <select name="tipo_moneda" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option selected disabled>Tipo</option>
                            <?php
                                $sql = "SELECT * FROM tipo_moneda";
                                $res = mysqli_query($conectar, $sql);
                                foreach($res as $filas){
                                    echo "<option value='".$filas['id_tipo_moneda']."'>".$filas['tipo_moneda']."</option>";
                                }
                            ?>
                        </select>
                        <select name="t_c" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option selected disabled>Canto</option>
                            <?php
                                $sql = "SELECT * FROM tipo_canto";
                                $res = mysqli_query($conectar, $sql);

                                foreach($res as $filas){
                                    echo "<option value='".$filas['id_tipo_canto']."'>".$filas['tipo']."</option>";
                                }
                            ?>
                        </select>
                        <input type="text" name="composicion" placeholder="Composición" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                        <input type="text" name="diametro" placeholder="Diámetro (milímetros)" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="15" max="35">
                        <input type="text" name="espesor" placeholder="Espesor (milímetros)" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1.5" max="3">
                    </div>
                    <!-- Lados Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-center">Lados</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-center font-semibold">Anverso</h4>
                                <div class="flex justify-center">
                                    <label for="anv" id="imagePreviewAnver" class="p-12 w-16 h-16 bg-gray-200 rounded-full imagePreview">
                                        <input name="anv" type="file" id="anv" class="hidden">
                                    </label>
                                </div>
                                <input type="text" name="listel_anver" placeholder="Listel" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="efigie_anver" placeholder="Efigie" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="leyenda_anver" placeholder="Leyenda" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="exergo_anver" placeholder="Exergo" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="ley_anver" placeholder="Ley" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="grafilia_anver" placeholder="Grafilia" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                            </div>
                            <div>
                                <h4 class="text-center font-semibold">Reverso</h4>
                                <div class="flex justify-center">
                                    <label for="rvo" id="imagePreviewRever" class="p-12 w-16 h-16 bg-gray-200 rounded-full imagePreview">
                                        <input name="rvo" type="file" id="rvo" class="hidden">
                                    </label>
                                </div>
                                <input type="text" name="listel_rever" placeholder="Listel" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="efigie_rever" placeholder="Efigie" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="leyenda_rever" placeholder="Leyenda" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="exergo_rever" placeholder="Exergo" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="ley_rever" placeholder="Ley" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" name="grafilia_rever" placeholder="Grafilia" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Section -->
                <div class="container mx-auto flex justify-between items-center">
                        <button onclick="redireccionar('vista_moneda.php');" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-x"></i></button>
                        <button type="submit" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Guardar <i class="fa-solid fa-check"></i></i></button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<style>
    .imagePreview {
            background-size: cover;
            background-position: center;
    }
</style>
<script>
    createImagePreview('anv', 'imagePreviewAnver');
    createImagePreview('rvo', 'imagePreviewRever');
</script>