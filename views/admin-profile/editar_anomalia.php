<?php 
$id_anomalia = $_GET['v'];
if(isset($_GET['v'])){

    $sql = "SELECT * FROM anomalia WHERE id_anomalia = $id_anomalia";
    include '../../inc/conexion.php';
    $res = mysqli_query($conectar, $sql);
    $data = mysqli_fetch_assoc($res);

}else{
    echo "<script>history.go(-1);</script>";
}

if(isset($_POST['editar'])){
    $name = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    $sql = "UPDATE `anomalia` 
            SET `nombre`='$name',`detalle`='$detalle' 
            WHERE id_anomalia = $id_anomalia";
    
    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al actualizar la anomalía: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }
    
    echo "<script>window.location='vista_moneda.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../src/style.css">
</head>
<body class="bg-white">
    <form action="" method="post">
        <div class="flex flex-col text-center max-w-md mx-auto bg-white p-6 rounded-lg shadow-2xl">
            <h1 class="text-4xl">Editar Anomalía</h1>
            <div class="grid grid-rows">
                <h1 class="text-xl">Nombre Actual: <?php echo $data['nombre']?></h1>
                <input name="nombre" type="text" class="mt-4 px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nuevo nombre de la anomalía" value="<?php echo $data['nombre']?>">
                <textarea name="detalle" class="mt-6 w-full h-32 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Detalles"><?php echo $data['detalle']?></textarea>
                <div class="text-center">
                    <button type="button" onclick="window.history.back();" class="mt-6 bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-xmark"></i></button>
                    <button type="submit" name="editar" class="mt-6 bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Guardar <i class="fa-solid fa-check"></i></button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>