<?php 

if (isset($_POST['update'])) {
    $updates = [];

    if (isset($_POST['nombre_moneda'])) {
        $nombre_moneda = $_POST['nombre_moneda'];
        $updates[] = "nombre'$nombre_moneda'";
    }
    if (isset($_POST['v_n'])) {
        $valor_nominal = $_POST['v_n'];
        $updates[] = "valor_nominal='$valor_nominal'";
    }
    if (isset($_POST['divisa'])) {
        $divisa = $_POST['divisa'];
        $updates[] = "divisa='$divisa'";
    }
    if (isset($_POST['ini_emi'])) {
        $inicio_emision = $_POST['ini_emi'];
        $updates[] = "inicio_emision='".$inicio_emision."-01-01'";
    }
    if (isset($_POST['fin_emi'])) {
        $fin_emision = $_POST['fin_emi'];
        $updates[] = "fin_emision='".$fin_emision."-01-01'";
    }
    if (isset($_POST['historia'])) {
        $historia = $_POST['historia'];
        $updates[] = "historia='$historia'";
    }
    if (isset($_POST['tipo_moneda'])) {
        $tipo_moneda = $_POST['tipo_moneda'];
        $updates[] = "tipo_moneda='$tipo_moneda'";
    }
    if (isset($_POST['t_c'])) {
        $tipo_canto = $_POST['t_c'];
        $updates[] = "tipo_canto='$tipo_canto'";
    }
    if (isset($_POST['composicion'])) {
        $composicion = $_POST['composicion'];
        $updates[] = "composicion='$composicion'";
    }
    if (isset($_POST['diametro'])) {
        $diametro = $_POST['diametro'];
        $updates[] = "diametro='$diametro'";
    }
    if (isset($_POST['espesor'])) {
        $espesor = $_POST['espesor'];
        $updates[] = "espesor='$espesor'";
    }

    if (!empty($updates)) {
        $id_moneda = $_GET['v'];
        $sql_update = "UPDATE moneda_atributo SET " . implode(", ", $updates) . " WHERE id_moneda=$id_moneda";
        include '../../inc/conexion.php';
        if (!$res = mysqli_query($conectar, $sql_update)) {
            echo "Error al actualizar: " . mysqli_error($conectar);
            mysqli_close($conectar);
            //header('Location: tabla_moneda.php?success=error_editar_moneda');
            exit;
        }
    }

    // Anverso
    if (isset($_POST['listel_anver'])) {
        $listel_anver = $_POST['listel_anver'];
        $updates[] = "listel_anver='$listel_anver'";
    }
    if (isset($_POST['efigie_anver'])) {
        $efigie_anver = $_POST['efigie_anver'];
        $updates[] = "efigie_anver='$efigie_anver'";
    }
    if (isset($_POST['leyenda_anver'])) {
        $leyenda_anver = $_POST['leyenda_anver'];
        $updates[] = "leyenda_anver='$leyenda_anver'";
    }
    if (isset($_POST['exergo_anver'])) {
        $exergo_anver = $_POST['exergo_anver'];
        $updates[] = "exergo_anver='$exergo_anver'";
    }
    if (isset($_POST['ley_anver'])) {
        $ley_anver = $_POST['ley_anver'];
        $updates[] = "ley_anver='$ley_anver'";
    }
    if (isset($_POST['grafilia_anver'])) {
        $grafilia_anver = $_POST['grafilia_anver'];
        $updates[] = "grafilia_anver='$grafilia_anver'";
    }

    // Reverso
    if (isset($_POST['listel_rever'])) {
        $listel_rever = $_POST['listel_rever'];
        $updates[] = "listel_rever='$listel_rever'";
    }
    if (isset($_POST['efigie_rever'])) {
        $efigie_rever = $_POST['efigie_rever'];
        $updates[] = "efigie_rever='$efigie_rever'";
    }
    if (isset($_POST['leyenda_rever'])) {
        $leyenda_rever = $_POST['leyenda_rever'];
        $updates[] = "leyenda_rever='$leyenda_rever'";
    }
    if (isset($_POST['exergo_rever'])) {
        $exergo_rever = $_POST['exergo_rever'];
        $updates[] = "exergo_rever='$exergo_rever'";
    }
    if (isset($_POST['ley_rever'])) {
        $ley_rever = $_POST['ley_rever'];
        $updates[] = "ley_rever='$ley_rever'";
    }
    if (isset($_POST['grafilia_rever'])) {
        $grafilia_rever = $_POST['grafilia_rever'];
        $updates[] = "grafilia_rever='$grafilia_rever'";
    }

    /*if (!empty($updates)) {
        $id_moneda = $_POST['id_moneda'];
        $sql_update = "UPDATE moneda_atributo SET " . implode(", ", $updates) . " WHERE id_moneda=$id_moneda";
        include '../../inc/conexion.php';
        if (mysqli_query($conectar, $sql_update)) {
            mysqli_close($conectar);
            header('Location: tabla_moneda.php?success=editar_moneda');
            exit;
        } else {
            echo "Error al actualizar: " . mysqli_error($conectar);
            mysqli_close($conectar);
        }
    }*/
}


if(isset($_GET['v'])){

    $id_moneda = $_GET['v'];

    $sql= "
    SELECT 
        MAX(CASE WHEN partes.lado = 'anverso' THEN imagen.direccion END) AS imagen_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.listel END) AS listel_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.efigie END) AS efigie_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.leyenda END) AS leyenda_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.exergo END) AS exergo_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.ley END) AS ley_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.grafilia END) AS grafilia_anverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN imagen.direccion END) AS imagen_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.listel END) AS listel_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.efigie END) AS efigie_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.leyenda END) AS leyenda_reverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.exergo END) AS exergo_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.ley END) AS ley_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.grafilia END) AS grafilia_reverso,
        valor_nominal.valor AS valorNominal,
        YEAR (moneda_atributo.inicio_emision) AS año_inicio,
        YEAR (moneda_atributo.fin_emision) AS año_fin,
        divisa.nombre AS divisa,
        divisa.id_divisa AS idDivisa,
        tipo_moneda,
        tipo_moneda.id_tipo_moneda AS id_tipo_moneda,
        tipo_canto.tipo AS tipo_canto,
        tipo_canto.id_tipo_canto AS id_tipo_canto,
        moneda_atributo.composicion,
        moneda_atributo.diametro,
        moneda_atributo.espesor,
        moneda_atributo.historia AS historia,
        moneda_atributo.id_moneda,
        moneda.nombre AS nombre_moneda
    FROM moneda 
    JOIN moneda_atributo ON moneda.id_moneda = moneda_atributo.id_moneda 
    JOIN valor_nominal ON valor_nominal.id_valor_nominal = moneda_atributo.id_valor_nominal 
    JOIN divisa ON divisa.id_divisa = moneda_atributo.id_divisa 
    JOIN partes ON partes.id_moneda_atributo = moneda_atributo.id_moneda_atributo 
    JOIN imagen ON partes.id_imagen = imagen.id_imagen
    JOIN tipo_canto ON tipo_canto.id_tipo_canto = moneda_atributo.id_tipo_canto
    JOIN tipo_moneda ON tipo_moneda.id_tipo_moneda = moneda_atributo.id_tipo_moneda
    WHERE moneda.id_moneda = $id_moneda
    ";

    include '../../inc/conexion.php';
    if(!$res = mysqli_query($conectar, $sql)){
        echo "<script>window.location='vista_moneda.php';</script>";
        exit;
    }

}else{
    echo "<script>window.location='vista_moneda.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Moneda</title>
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../src/style.css">
    <script src="../../js/funciones.js"></script>
</head>
<body class="bg-white">
    <main class="p-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-2xl">
            <h1 class="text-2xl font-bold mb-6">Editar moneda</h1>
            <form action="" method="POST" class="space-y-6" enctype="multipart/form-data">
                <!-- General Section -->
                <?php foreach($res as $fila): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">General</h3>
                        <input name="nombre_moneda" value="<?= $fila['nombre_moneda']?>" type="text" placeholder="Nombre de la moneda" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="30">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input name="v_n" type="text" value="<?= $fila['valorNominal'] ?>" placeholder="Valor N." class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <select name="divisa" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option selected disabled>Divisa</option>
                                <option disabled><?= $fila['divisa'] ?></option>
                                <?php 
                                    $sql = "SELECT * FROM divisa WHERE NOT id_divisa = ".$fila['idDivisa']."";
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
                            <input name="ini_emi" value="<?= $fila['año_inicio'] ?>" type="number" placeholder="Inicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1816" max="2024">
                            <input name="fin_emi" value="<?= $fila['año_fin'] ?>" placeholder="Final" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1816" max="2024">
                        </div>
                        <textarea name="historia" placeholder="Historia" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="500"><?= $fila['historia'] ?></textarea>
                    </div>
                    <!-- Características Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Características</h3>
                        <select name="tipo_moneda" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option selected disabled>Tipo</option>
                            <option disabled><?= $fila['tipo_moneda']?></option>
                            <?php
                                $sql = "SELECT * FROM tipo_moneda WHERE NOT id_tipo_moneda = ".$fila['id_tipo_moneda']."";
                                $res = mysqli_query($conectar, $sql);
                                foreach($res as $filas){
                                    echo "<option value='".$filas['id_tipo_moneda']."'>".$filas['tipo_moneda']."</option>";
                                }
                            ?>
                        </select>
                        <select name="t_c" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option selected disabled>Canto</option>
                            <option disabled><?= $fila['tipo_canto']?></option>
                            <?php
                                $sql = "SELECT * FROM tipo_canto WHERE NOT id_tipo_canto = ".$fila['id_tipo_canto']."";
                                $res = mysqli_query($conectar, $sql);

                                foreach($res as $filas){
                                    echo "<option value='".$filas['id_tipo_canto']."'>".$filas['tipo']."</option>";
                                }
                            ?>
                        </select>
                        <input type="text" value="<?= $fila['composicion'] ?>" name="composicion" placeholder="Composición" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                        <input type="text" value="<?= $fila['diametro'] ?>" name="diametro" placeholder="Diámetro (milímetros)" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="15" max="35">
                        <input type="text" value="<?= $fila['espesor'] ?>" name="espesor" placeholder="Espesor (milímetros)" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1.5" max="3">
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
                                <input type="text" value="<?= $fila['listel_anverso'] ?>" name="listel_anver" placeholder="Listel" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['efigie_anverso'] ?>" name="efigie_anver" placeholder="Efigie" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['leyenda_anverso'] ?>" name="leyenda_anver" placeholder="Leyenda" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['exergo_anverso'] ?>" name="exergo_anver" placeholder="Exergo" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['ley_anverso'] ?>" name="ley_anver" placeholder="Ley" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['grafilia_anverso'] ?>" name="grafilia_anver" placeholder="Grafilia" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                            </div>
                            <div>
                                <h4 class="text-center font-semibold">Reverso</h4>
                                <div class="flex justify-center">
                                    <label for="rvo" id="imagePreviewRever" class="p-12 w-16 h-16 bg-gray-200 rounded-full imagePreview">
                                        <input name="rvo" type="file" id="rvo" class="hidden">
                                    </label>
                                </div>
                                <input type="text" value="<?= $fila['listel_anverso'] ?>" name="listel_rever" placeholder="Listel" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['efigie_anverso'] ?>" name="efigie_rever" placeholder="Efigie" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['leyenda_anverso'] ?>" name="leyenda_rever" placeholder="Leyenda" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['exergo_anverso'] ?>" name="exergo_rever" placeholder="Exergo" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['ley_anverso'] ?>" name="ley_rever" placeholder="Ley" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                                <input type="text" value="<?= $fila['grafilia_anverso'] ?>" name="grafilia_rever" placeholder="Grafilia" class="w-full mt-2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="100">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Submit Section -->
                <div class="container mx-auto flex justify-between items-center">
                        <button onclick="redireccionar('vista_moneda.php');" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-x"></i></button>
                        <button name="update" type="submit" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Guardar <i class="fa-solid fa-pen"></i></button>
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
