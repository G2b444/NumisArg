<?php 
    if(isset($_POST['agregar']) && isset($_GET['v'])){

        $id_moneda = $_GET['v'];
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        
        $ruta_indexphp = dirname(realpath(__FILE__));
        $anverso = $_FILES['anv']['tmp_name'];
        $reverso = $_FILES['rev']['tmp_name'];
        $anverso_destino ='assets/img/'. $_FILES['anv']['name'];
        $reverso_destino ='assets/img/'. $_FILES['rev']['name'];
        $extensiones = array(0=>'image/jpg', 1=>'image/jpeg', 2=>'image/png');
        $max_tamanio = 1024*1024*8;

        if(in_array($_FILES['anv']['type'], $extensiones)){
            echo "<script>alert('Efectivamente es una imagen');</script>";
            if($_FILES['anv']['size']<$max_tamanio){
                echo "<script>alert('Pesa menos de 1 MB medio raro');</script>";
                if((move_uploaded_file($anverso, $anverso_destino)) && (move_uploaded_file($reverso, $reverso_destino))){
                    include '../../inc/conexion.php';
                    $sql = "INSERT INTO `imagen`(`direccion`) VALUES ('$anverso_destino')";
                    $res = mysqli_query($conectar, $sql);
                    $id_img_anv = mysqli_insert_id($conectar);
                    $sql = "INSERT INTO `imagen`(`direccion`) VALUES ('$reverso_destino')";
                    $res = mysqli_query($conectar, $sql);
                    $id_img_rev = mysqli_insert_id($conectar);
        
                    if($res){
                        $sql = "INSERT INTO `anomalia`(`id_moneda`, `nombre`, `detalle`) 
                        VALUES ('$id_moneda', '$nombre','$detalle')";  
                        $res = mysqli_query($conectar, $sql);
                        $id_anomalia = mysqli_insert_id($conectar);

                        if($res){
                            $sql = "INSERT INTO `lado`(`id_anomalia`, `id_imagen`, `lado`) 
                            VALUES ('$id_anomalia','$id_img_anv','anverso')";
                            $res = mysqli_query($conectar, $sql);

                            if($res){
                                $sql = "INSERT INTO `lado`(`id_anomalia`, `id_imagen`, `lado`) 
                                VALUES ('$id_anomalia','$id_img_rev','reverso')";
                                $res = mysqli_query($conectar, $sql);

                                if($res){
                                    mysqli_close($conectar);
                                    header('Location: vista_moneda.php?success=agregar_anomalia');                         
                                }else{
                                    mysqli_close($conectar);
                                    header('Location: vista_moneda.php?success=error_agregar_anomalia');
                                    exit;
                                }
                            }
                        }else{
                            mysqli_close($conectar);
                            header('Location: vista_moneda.php?success=error_agregar_anomalia');
                            exit;
                        }
                    }else{
                        mysqli_close($conectar);
                        header('Location: vista_moneda.php?success=error_agregar_anomalia');
                        exit;
                    }
                    }
            }
        }
    }else{
        if(isset($_GET['v'])){

            $id_moneda = $_GET['v'];
        
            $sql = "SELECT * FROM moneda WHERE id_moneda = $id_moneda";
            include '../../inc/conexion.php';
            $res = mysqli_query($conectar, $sql);
            $data = mysqli_fetch_assoc($res);
        
        }else{
            echo "<script>history.go(-1);</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NumisArg</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <script src=../../js/funciones.js></script>
</head>
<body class="bg-white">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-col text-center max-w-md mx-auto bg-white p-6 rounded-lg shadow-2xl">
            <h1 class="text-4xl">Agregar anomalía</h1>
            <div class="mt-5 flex justify-center flex-row space-x-28">
                <div>
                    <label for=""><h1 class="text-xl">Anverso</h1></label>
                    <div class="w-32 h-32 my-3 bg-dark-blue rounded-full cursor-pointer imagePreview" id="imagePreviewAnver">
                    </div>
                    <div class="grid w-full max-w-xs items-center gap-1.5" >
                            <input name="anv" id="anv" type="file" class="flex h-10 w-full rounded-md border border-input bg-white px-3 py-2 text-sm text-gray-400 file:border-0 file:bg-transparent file:text-gray-600 file:text-sm file:font-medium">
                    </div>
                </div>
                <div>
                    <label for=""><h1 class="text-xl">Reverso</h1></label>
                    <div class="w-32 h-32 my-3 bg-dark-blue rounded-full cursor-pointer imagePreview" id="imagePreviewRever">
                    </div>
                    <div class="grid w-full max-w-xs items-center gap-1.5" >
                            <input name="rev" id="rvo" type="file" class="flex h-10 w-full rounded-md border border-input bg-white px-3 py-2 text-sm text-gray-400 file:border-0 file:bg-transparent file:text-gray-600 file:text-sm file:font-medium">
                    </div>
                </div>
            </div>
            <div class="grid grid-rows">
                <h1 class="text-xl"><?php echo $data['nombre']?></h1>
                <input name="nombre" type="text" class="mt-4 px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la anomalia">
                <textarea name="detalle" class="mt-6 w-full h-32 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Detalles"></textarea>
                <div class="container mx-auto flex justify-between items-center">
                    <button onclick="redireccionar('vista_moneda.php');" type="button" class="mt-6 bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-xmark"></i></button>
                    <button type="submit" name="agregar" class="mt-6 bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Agregar <i class="fa-solid fa-check"></i></button>
                </div>
            </div>
        </div>
    </form>
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