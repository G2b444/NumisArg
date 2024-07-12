<?php
include("../libreria/conexion.php");
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}
$id = $_SESSION['id_usuario'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedIds = isset($_POST['selected_ids']) ? json_decode($_POST['selected_ids']) : [];
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $id_coleccion = isset($_POST['id_coleccion']) ? intval($_POST['id_coleccion']) : 0;

    if ($action === 'add') {
        echo'<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Formulario</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        input[type="number"]::-webkit-outer-spin-button,
                        input[type="number"]::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                        input[type="number"] {
                            -moz-appearance: textfield;
                        }
                        .relative input {
                            padding-left: 2.5rem; 
                        }
                        .bg-customBlue {
                            background-color: #021526;
                        }
                        .bg-customBlue2{
                            background-color: #0D3559;
                        }
                        /* Custom styles for select dropdown */
                        @font-face {
                            font-family: "MiFuente";
                            src: url("font/PatuaOne-Regular.ttf") format("truetype");
                            font-weight: normal;
                            font-style: normal;
                        }
                        body {
                            font-family: "MiFuente", sans-serif;
                        }
                    </style>
                    </head>
                    <body class="flex items-center justify-center min-h-screen bg-gray-100 font-semibold">
                        <div class="w-1/3 h-1/3 bg-customBlue rounded-3xl p-8 flex flex-col items-center justify-center">
                            <h1 class="text-5xl font-normal mb-4 text-white">Crear colección</h1>
                            <form method="post" action="" class="w-full flex flex-col items-center">
                                <div class="relative my-6 mb-4 w-full flex justify-center">
                                    <div class="relative w-96">
                                        <img src="../images/billetera.png" alt="Icono Correo" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6">
                                        <input placeholder="Nombre" type="text" name="nombre" min="1" class="w-full p-2 pl-10 rounded-3xl">
                                    </div>
                                </div>
                                <div class="flex justify-center w-full gap-4">
                                    <a href="main.php" class="bg-customBlue text-white p-2 rounded-3xl border-2 border-white w-28 text-center inline-block">Volver</a>
                                    <input type="submit" value="Guardar" name="agregar" class="bg-white text-customBlue p-2 rounded-3xl font-bold border-2 border-white w-28 cursor-pointer">
                                </div>
                            </form>
                        </div>
                    </body>
                    </html>';
        
    }
    if ($action === 'del') {
    
            echo'<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Formulario</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        input[type="number"]::-webkit-outer-spin-button,
                        input[type="number"]::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }

                        input[type="number"] {
                            -moz-appearance: textfield;
                        }
                        .relative input {
                            padding-left: 2.5rem; 
                        }

                        .bg-customBlue {
                            background-color: #021526;
                        }

                        .bg-customBlue2{
                            background-color: #0D3559;
                        }

                        /* Custom styles for select dropdown */
                        @font-face {
                            font-family: "MiFuente";
                            src: url("font/PatuaOne-Regular.ttf") format("truetype");
                            font-weight: normal;
                            font-style: normal;
                        }
                        body {
                            font-family: "MiFuente", sans-serif;
                        }
                    </style>
                    </head>
                    <body class="flex items-center justify-center min-h-screen bg-gray-100 font-semibold">
                        <div class="w-2/3 h-1/3 bg-customBlue rounded-3xl p-8 flex flex-col items-center justify-center">
                            <h1 class="text-5xl font-normal mb-4 text-white">¿Seguro que quieres eliminar esta colección?</h1>
                            <form method="post" action="" class="w-full flex flex-col items-center">
                                <div class="flex justify-center w-full gap-4">
                                    <a href="main.php" class="bg-customBlue text-white p-2 rounded-3xl border-2 border-white w-28 text-center inline-block">Volver</a>
                                    <input type="submit" value="Eliminar" name="borrar-coleccion" class="bg-white text-customBlue p-2 rounded-3xl font-bold border-2 border-white w-28 cursor-pointer">
                                </div>
                            </form>
                        </div>
                    </body>
                    </html>';
            
    }
    
    elseif ($action === 'customize') {
            $select = "SELECT * FROM estado";
            $query = mysqli_query($conectar, $select);
        ?>

                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Formulario</title>
                        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                        <style>
                            input[type="number"]::-webkit-outer-spin-button,
                            input[type="number"]::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }

                            input[type="number"] {
                                -moz-appearance: textfield;
                            }

                            .bg-customBlue {
                                background-color: #021526;
                            }

                            .bg-customBlue2{
                                background-color: #0D3559;
                            }

                            /* Custom styles for select dropdown */
                            @font-face {
                                font-family: 'MiFuente';
                                src: url('font/PatuaOne-Regular.ttf') format('truetype');
                                font-weight: normal;
                                font-style: normal;
                            }
                            body {
                                font-family: 'MiFuente', sans-serif;
                            }
                        </style>
                        </head>
                        <body class="flex items-center justify-center min-h-screen bg-gray-100 font-semibold">
                            <div class="w-1/3 h-96 bg-customBlue rounded-3xl p-8 flex flex-col items-center justify-center">
                                <h1 class="text-5xl font-normal mb-4 text-white">Modificar</h1>
                                <form method="post" action="" class="w-full flex flex-col items-center">
                                    <input type="hidden" name="selected_ids" value='<?php echo json_encode($selectedIds); ?>'>
                                    <input type="hidden" name="action" value="customize">

                                    <div class="mb-4 w-full flex justify-center relative">
                                        <div class="custom-select-container relative">
                                            <select name="estado" class="custom-select w-96 h-10 p-2 rounded-3xl block appearance-none bg-white px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline border border-gray-300">
                                                <?php
                                                while ($querybucle = mysqli_fetch_assoc($query)) {
                                                    echo '<option class="border-b border-gray-200 hover:bg-gray-100" value="' . htmlspecialchars($querybucle['id_estado']) . '">' . htmlspecialchars($querybucle['estado']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center px-2 text-gray-700">
                                                <img src="../images/flecha.png" alt="Flecha" class="h-4 w-4">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="relative mb-4 w-full flex justify-center">
                                        <input placeholder="Cantidad" type="number" name="cantidad" min="1" class="w-96 p-2 rounded-3xl">
                                    </div>
                                    <div class="relative mb-4 w-full flex justify-center">
                                        <input placeholder="Valor de mercado" type="number" name="precio" min="1" class="w-96 p-2 rounded-3xl">
                                    </div>
                                    <div class="flex justify-center w-full gap-4">
                                        <a href="main.php" class="bg-customBlue text-white p-2 rounded-3xl border-2 border-white w-28 text-center inline-block">Volver</a>
                                        <input type="submit" value="Guardar" name="customize" class="bg-customBlue text-white p-2 rounded-3xl border-2 border-white w-28 cursor-pointer">
                                    </div>
                                </form>
                            </div>
                        </body>
                        </html>

        <?php
    }elseif($action === 'delete'){
        ?>
       <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Formulario</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        input[type="number"]::-webkit-outer-spin-button,
                        input[type="number"]::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }

                        input[type="number"] {
                            -moz-appearance: textfield;
                        }
                        .relative input {
                            padding-left: 2.5rem; 
                        }

                        .bg-customBlue {
                            background-color: #021526;
                        }

                        .bg-customBlue2{
                            background-color: #0D3559;
                        }

                        /* Custom styles for select dropdown */
                        @font-face {
                            font-family: "MiFuente";
                            src: url("font/PatuaOne-Regular.ttf") format("truetype");
                            font-weight: normal;
                            font-style: normal;
                        }
                        body {
                            font-family: "MiFuente", sans-serif;
                        }
                    </style>
                    </head>
                    <body class="flex items-center justify-center min-h-screen bg-gray-100 font-semibold">
                        <div class="w-2/4 h-1/3 bg-customBlue rounded-3xl p-8 flex flex-col items-center justify-center">
                            <h1 class="text-5xl font-normal mb-4 text-white">¿Seguro que quieres eliminarla/s?</h1>
                            <form method="post" action="" class="w-full flex flex-col items-center">
                            <input type="hidden" name="selected_ids" value='<?php echo json_encode($selectedIds); ?>'>
                            <input type="hidden" name="action" value="delete">
                                <div class="flex justify-center w-full gap-4">
                                    <a href="main.php" class="bg-customBlue text-white p-2 rounded-3xl border-2 border-white w-28 text-center inline-block">Volver</a>
                                    <input type="submit" value="Eliminar" name="delete" class="bg-white text-customBlue p-2 rounded-3xl font-bold border-2 border-white w-28 cursor-pointer">
                                </div>
                            </form>
                        </div>
                    </body>
                    </html>'
                    <?php
    }


    if(isset($_POST['agregar'])){
        $var = $_POST['nombre'];

        $sql_valor = "SELECT MAX(id_coleccion) AS max_num FROM coleccion WHERE id_usuario = $id";
        $lelo = mysqli_query($conectar, $sql_valor);

        if($lelo){
            $array = mysqli_fetch_assoc($lelo);
            $max = $array['max_num'];
            $max = $max + 1;
            echo "$max";
            $sql = "INSERT INTO `coleccion`(`id_coleccion`, `id_usuario`, `nombre`) VALUES ('$max', $id, '$var')";
            
            if ($conectar->query($sql) === TRUE) {
                echo '<script>alert("Colección creada!"); window.location="main.php";</script>';
            } else {
                 echo "Error creando colección: " . $conectar->error;
            }
        }
    }elseif(isset($_POST['borrar-coleccion'])){

        
        $sql2 = "DELETE FROM guarda_moneda WHERE id_coleccion = $id";
        $sql3 = "DELETE FROM guarda_anomalia WHERE id_coleccion = $id";
        if ($conectar->query($sql2) === TRUE && $conectar->query($sql3) === TRUE) {
            $sql1 = "DELETE FROM coleccion WHERE id_coleccion = $id";
            if($conectar->query($sql1) === TRUE){
                echo "<script> alert('Registros eliminados exitosamente'); window.location='main.php'; </script>";
            }
        } else {
            echo "Error eliminando registros: " . $conectar->error;
        }
    }




    if (isset($_POST['customize'])) {
        $e = $_POST['estado'];
        $c = $_POST['cantidad'];
        $p = $_POST['precio'];

        $ids = implode(',', array_map('intval', $selectedIds));

        $sql_dg1 = "SELECT id_detalle_guarda FROM guarda_moneda WHERE id_guarda_moneda IN ($ids)";
        $sql_dg2 = "SELECT id_detalle_guarda FROM guarda_anomalia WHERE id_guarda_anomalia IN ($ids)";

        $detalleGuardaIds1 = [];
        $detalleGuardaIds2 = [];

        
        

        $result_dg1 = $conectar->query($sql_dg1);
        if ($result_dg1) {
            $detalleGuardaIds1 = array_column($result_dg1->fetch_all(MYSQLI_ASSOC), 'id_detalle_guarda');
        } else {
            echo "Error en la consulta 1: " . $conectar->error;
        }


        $result_dg2 = $conectar->query($sql_dg2);
        if ($result_dg2) {
            $detalleGuardaIds2 = array_column($result_dg2->fetch_all(MYSQLI_ASSOC), 'id_detalle_guarda');
        } else {
            echo "Error en la consulta 2: " . $conectar->error;
        }


        if (!empty($detalleGuardaIds1)) {
            $sqlnormal = "UPDATE detalle_guarda 
                          SET id_estado='$e', cantidad='$c', valor_de_mercado='$p' 
                          WHERE id_detalle_guarda IN (" . implode(',', $detalleGuardaIds1) . ")";
        } else {
            $sqlnormal = null;
        }

        if (!empty($detalleGuardaIds2)) {
            $sql_anomalias = "UPDATE detalle_guarda 
                              SET id_estado='$e', cantidad='$c', valor_de_mercado='$p' 
                              WHERE id_detalle_guarda IN (" . implode(',', $detalleGuardaIds2) . ")";
        } else {
            $sql_anomalias = null;
        }

        if ($sqlnormal) {
            if ($conectar->query($sqlnormal) !== TRUE) {
                echo "Error en la consulta de actualización normal: " . $conectar->error . "<br>Consulta: " . $sqlnormal;
            }
        }

        if ($sql_anomalias) {
            if ($conectar->query($sql_anomalias) !== TRUE) {
                echo "Error en la consulta de actualización de anomalías: " . $conectar->error . "<br>Consulta: " . $sql_anomalias;
            }
        }

        if (($sqlnormal && $sql_anomalias) || ($sqlnormal && $conectar->query($sqlnormal) === TRUE && $sql_anomalias && $conectar->query($sql_anomalias) === TRUE)) {
            echo "<script> alert('Registros actualizados exitosamente.'); window.location='main.php'; </script>";
        } elseif (!$sqlnormal && !$sql_anomalias) {
            echo "No hay registros para actualizar.";
        } else {
            echo "<script> alert('Se han actualizado los registros'); window.location='main.php'; </script>";
        }
    }elseif(isset($_POST['delete'])){

        $ids = implode(',', array_map('intval', $selectedIds));

        $sql_dg1 = "SELECT id_detalle_guarda FROM guarda_moneda WHERE id_guarda_moneda IN ($ids)";
        $sql_dg2 = "SELECT id_detalle_guarda FROM guarda_anomalia WHERE id_guarda_anomalia IN ($ids)";

        $detalleGuardaIds1 = [];
        $detalleGuardaIds2 = [];

        
        

        $result_dg1 = $conectar->query($sql_dg1);

        if ($result_dg1) {
            $detalleGuardaIds1 = array_column($result_dg1->fetch_all(MYSQLI_ASSOC), 'id_detalle_guarda');
        } else {
            echo "Error en la consulta 1: " . $conectar->error;
        }


        $result_dg2 = $conectar->query($sql_dg2);
        if ($result_dg2) {
            $detalleGuardaIds2 = array_column($result_dg2->fetch_all(MYSQLI_ASSOC), 'id_detalle_guarda');
        } else {
            echo "Error en la consulta 2: " . $conectar->error;
        }


        if (!empty($detalleGuardaIds1)) {
            $sqlgm = "DELETE FROM guarda_moneda 
                          WHERE id_detalle_guarda IN (" . implode(',', $detalleGuardaIds1) . ")";
        } else {
            $sqlgm = null;
        }

        if (!empty($detalleGuardaIds2)) {
            $sqlga = "DELETE FROM guarda_anomalia
                              WHERE id_detalle_guarda IN (" . implode(',', $detalleGuardaIds2) . ")";
        } else {
            $sqlga = null;
        }

        if ($sqlgm) {
            if ($conectar->query($sqlgm) !== TRUE) {
                echo "Error en la consulta de actualización normal: " . $conectar->error . "<br>Consulta: " . $sqlgm;
            }
        }

        if ($sqlga) {
            if ($conectar->query($sqlga) !== TRUE) {
                echo "Error en la consulta de actualización de anomalías: " . $conectar->error . "<br>Consulta: " . $sqlga;
            }
        }

        if (($sqlgm && $sqlga) || ($sqlgm && $conectar->query($sqlgm) === TRUE && $sqlga && $conectar->query($sqlga) === TRUE)) {
            echo "<script> alert('Monedas eliminadas.'); window.location='main.php'; </script>";
        } elseif (!$sqlgm && !$sqlga) {
            echo "No hay registros para actualizar.";
        }
      
        $conectar->close();
    }
}

?>

