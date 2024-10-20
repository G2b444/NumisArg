<?php

$sql= "
    SELECT 
        MAX(CASE WHEN partes.lado = 'anverso' THEN imagen.direccion END) AS imagen_anverso,
        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.detalles END) AS detalles_anverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN imagen.direccion END) AS imagen_reverso,
        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.detalles END) AS detalles_reverso,
        valor_nominal,
        YEAR (moneda_atributo.inicio_emision) AS año_inicio,
        YEAR (moneda_atributo.fin_emision) AS año_fin,
        divisa.nombre AS divisa,
        tipo_moneda,
        tipo_canto.tipo,
        moneda_atributo.composicion,
        moneda_atributo.diametro,
        moneda_atributo.espesor,
        moneda_atributo.historia,
        moneda_atributo.id_moneda,
        moneda.nombre AS nombre_moneda
    FROM moneda 
    JOIN moneda_atributo ON moneda.id_moneda = moneda_atributo.id_moneda 
    JOIN divisa ON divisa.id_divisa = moneda_atributo.id_divisa 
    JOIN partes ON partes.id_moneda_atributo = moneda_atributo.id_moneda_atributo 
    JOIN imagen ON partes.id_imagen = imagen.id_imagen
    JOIN tipo_canto ON tipo_canto.id_tipo_canto = moneda_atributo.id_tipo_canto
    JOIN tipo_moneda ON tipo_moneda.id_tipo_moneda = moneda_atributo.id_tipo_moneda
    ";

    if (isset($_POST['buscar']) && isset($_POST['filtro'])) {
        $dato = trim($_POST['search']);
        $filtro = $_POST['filtro'];
        
        if (!empty($dato) && !empty($filtro)) {

            switch ($filtro) {
                case 'divisa':
                    $sql .= " WHERE divisa.nombre LIKE '%$dato%'";
                    break;
                case 'tipo':
                    $sql .= " WHERE tipo_moneda.tipo_moneda LIKE '%$dato%'";
                    break;
                case 'nombre':
                    $sql .= " WHERE moneda.nombre LIKE '%$dato%'";
                    break;
                case 'valor':
                    break;
            }
        }
    }
include '../../inc/conexion.php';

$sql .= "
        GROUP BY 
            moneda_atributo.inicio_emision,
            moneda_atributo.fin_emision,
            divisa.nombre,
            tipo_canto.tipo,
            moneda_atributo.composicion,
            moneda_atributo.diametro,
            moneda_atributo.espesor,
            moneda_atributo.historia;";

$res = mysqli_query($conectar, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NumisArg</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <script src="../../js/funciones.js"></script>
    <link rel="stylesheet" href="../../style.css">
</head>
<body class="bg-gray-100">
    <?php include 'adminheader.html'; ?>
    <main class="p-6">
        <section class="mb-6 flex flex-col justify-center items-center text-center">

    <!--Inicio del modal-->
            <div class="modal-overlay" id="modal-overlay"></div>
            <div class="modal" id="delete-coin">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¿Seguro de que quieres eliminar esta moneda?</h1>
                    <div class="flex justify-around">
                        <button class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Cancelar</button>
                        <button class="bg-transparent border-2 text-white py-2 px-4 rounded-3xl hover:bg-white hover:text-black confirm">Eliminar</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="delete-anomaly">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¿Seguro de que quieres eliminar esta anomalía?</h1>
                    <div class="flex justify-around">
                        <button class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Cancelar</button>
                        <button class="bg-transparent border-2 text-white py-2 px-4 rounded-3xl hover:bg-white hover:text-black confirm">Eliminar</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="delete-coin-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Moneda eliminada de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('delete-coin-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="delete-anomaly-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Anomalia eliminada de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('delete-anomaly-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="add-coin-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Moneda agregada de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('add-coin-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="add-anomaly-success">
                <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
                    <h1 class="mb-6 text-lg">¡Anomalia agregada de forma exitosa!</h1>
                    <div class="flex justify-around">
                        <button onclick="closeModal('add-anomaly-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="add-coin-error">
                <div class="text-white rounded-3xl p-6 w-full text-center bg-dark-blue">
                    <h1 class="mb-6 text-4xl">¡Error al agregar la moneda!</h1>
                    <h3 class="text-lg">Intentelo nuevamente.</h3>
                    <br>
                    <p class="text-base">Si el error persiste, contacte a soporte para obtener ayuda.</p>
                    <br>
                    <div class="flex justify-around">
                        <button onclick="closeModal('add-coin-error')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
            <div class="modal" id="add-anomaly-error">
                <div class="text-white rounded-3xl p-6 w-full text-center bg-dark-blue">
                    <h1 class="mb-6 text-4xl">¡Error al agregar la anomalía!</h1>
                    <h3 class="text-lg">Intentelo nuevamente.</h3>
                    <br>
                    <p class="text-base">Si el error persiste, contacte a soporte para obtener ayuda.</p>
                    <br>
                    <div class="flex justify-around">
                        <button onclick="closeModal('add-anomaly-error')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
                    </div>
                </div>
            </div>
           
    <!--Fin del modal-->
            <section class="mb-6" >
                <h1 class="text-4xl mb-5 mt-12">Monedas</h1>
                <div class="flex space-x-4 items-center">
                    <form action="" method="post">
                        <label for="search-category" class="font-bold">En ...</label>
                        <select name="filtro" id="search-category" class="p-2 border border-gray-300 rounded">
                            <option value="valor" selected disabled>Atributo</option>
                            <option value="divisa">Divisa</option>
                            <option value="tipo">Tipo</option>
                            <option value="nombre">Nombre</option>
                        </select>
                        <input type="text" name="search" id="search-input" class="p-2 border border-gray-300 rounded" placeholder="Buscar...">
                        <button type="submit" name="buscar" class="bg-dark-blue text-white px-4 py-2 rounded"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                        <button type="button" class="bg-dark-blue text-white px-4 py-2 rounded"><a href="ingresar_moneda.php"><i class="fa-solid fa-plus"></i> Agregar </a></button>
                    </form>
                </div>
            </section>
            <section class="mb-6">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-dark-blue text-white">Anverso</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Reverso</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Valor</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Divisa</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Emisión</th>
                            <th class="py-2 px-4 bg-dark-blue text-white">Tipo</th>
                            <th class="py-2 px-4 bg-dark-blue text-white w-48">Características</th>
                            <th class="py-2 px-4 bg-dark-blue text-white" colspan="2">Anomalías</th>
                            <th class="py-2 px-4 bg-dark-blue text-white" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        if(mysqli_num_rows($res)==0){
                            echo "<td colspan='10' class='p-8'><h1>No hay ningun registro<h1><td>";
                        }

                        foreach ($res as $index => $filas): 
                        
                        ?>
                            <tr class="bg-gray-100">
                                <td class="border px-4 py-2"><img src="<?= $filas['imagen_anverso'] ?>" alt="" class="w-16 h-16 object-cover rounded-full"></td>
                                <td class="border px-4 py-2"><img src="<?= $filas['imagen_reverso'] ?>" alt="" class="w-16 h-16 object-cover rounded-full"></td>
                                <td class="border px-4 py-2 truncated"><?= $filas['valor_nominal'] ?></td>
                                <td class="border px-4 py-2 truncated"><?= $filas['divisa'] ?></td>
                                <td class="border px-4 py-2 truncated"><?= $filas['año_inicio'] ?>-<?= $filas['año_fin'] ?></td>
                                <td class="border px-4 py-2 truncated"><?= $filas['tipo_moneda'] ?></td>
                                <td class="border px-4 py-2"><a href="javascript:void(0);" onclick="toggleDetails('caracteristicas-<?= $index ?>', this, 'Ocultar', 'Mostrar')">Mostrar</a></td>
                                <td class="border px-4 py-2 w-24"><a href="javascript:void(0);" onclick="toggleDetails('anomalias-<?= $index ?>', this, 'Ocultar', 'Ver')">Ver</a></td>
                                <td class="border px-4 py-2"><a href="agregar_anomalia.php?v=<?= $filas['id_moneda'] ?>">Agregar</a></td>
                                <td class="border px-4 py-2 cursor-pointer"><a href="eliminar_moneda.php?v=<?= $filas['id_moneda'] ?>" class="delete-coin-link"><i class="fa-solid fa-trash-can" style="font-size: x-large; margin-right: 10px; margin-left: 10px;"></i></a></td>
                                <td class="border px-4 py-2 cursor-pointer"><a href="editar_moneda.php?v=<?= $filas['id_moneda'] ?>"><i class="fa-solid fa-pen" style="font-size: x-large;"></i></a></td>
                            </tr>
                            <tr>
                                <td colspan="11">
                                    <table class="min-w-full bg-white" id="caracteristicas-<?= $index ?>" style="display:none;">
                                        <thead>
                                            <?php
                                            //array de detalles de lados
                                            $detalles = array("Listel", "Efigie - Exergo", "Leyenda", "Grafilia");
                                            $detallescant = count($detalles);
                                            ?>
                                            <tr>
                                                <th class="py-2 px-4 bg-light-blue text-white text-left text-xl" colspan="3">Características Físicas</th>
                                                <th class="py-2 px-4 bg-light-blue text-white text-left text-xl" colspan="7">Lados</th>
                                            </tr>
                                            <tr>
                                                <th class="py-2 px-4 bg-light-blue text-white">Canto</th>
                                                <th class="py-2 px-4 bg-light-blue text-white">Composición</th>
                                                <th class="py-2 px-4 bg-light-blue text-white">Diámetro</th>
                                                <th class="py-2 px-4 bg-light-blue text-white"></th>
                                                <?php
                                                //Para listar cada detalle de lados dinamicamente
                                                for($n=0;$n<$detallescant;$n++){
                                                echo '<th class="py-2 px-4 bg-light-blue text-white">'.$detalles[$n].'</th>';
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //convertir cadena de texto detalles a secciones según separación
                                            $secciones_anverso = explode("-", $filas['detalles_anverso']);
                                            $secciones_reverso = explode("-", $filas['detalles_reverso']);
                                            $anversocant = count($secciones_anverso);
                                            $reversocant = count($secciones_reverso);

                                            //ajustar la cantidad de registros mostrados según la cantidad de secciones y tipos
                                            if($anversocant < $detallescant){
                                                $contar_anverso = $anversocant;
                                            }
                                            if($anversocant >= $detallescant){
                                                $contar_anverso = $detallescant;
                                            }

                                            if($reversocant < $detallescant){
                                                $contar_reverso = $reversocant;
                                            }
                                            if($reversocant >= $detallescant){
                                                $contar_reverso = $detallescant;
                                            }

                                            ?>
                                            <tr>
                                                <td class="border px-4 py-2"><?= $filas['tipo'] ?></td>
                                                <td class="border px-4 py-2 truncated" title='<?= $filas['composicion'] ?>'><?= $filas['composicion'] ?></td>
                                                <td class="border px-4 py-2"><?= $filas['diametro'] ?> milímetros</td>
                                                <td class="border px-4 py-2">Anverso</td>
                                                <?php 
                                                //para mostrar las secciones separadas, según la cantidad de detalles agregados
                                                for($n=0;$n<$contar_anverso;$n++){
                                                    echo'<td class="border px-4 py-2 truncated" title="'.$secciones_anverso[$n].'">'.$secciones_anverso[$n].'</td>';
                                                }
                                                ?>
                                                </tr>
                                            <tr>
                                                <td class="border px-4 py-2"></td>
                                                <td class="border px-4 py-2"></td>
                                                <td class="border px-4 py-2"></td>
                                                <td class="border px-4 py-2">Reverso</td>
                                                <?php 
                                                //para mostrar las secciones separadas, según la cantidad de detalles agregados
                                                for($n=0;$n<$contar_reverso;$n++){
                                                    echo'<td class="border px-4 py-2 truncated" title="'.$secciones_reverso[$n].'">'.$secciones_reverso[$n].'</td>';
                                                }
                                                ?>
                                                </tr>
                                        </tbody>
                                        <td colspan="11"class='w-96 break-keep'>
                                            <h2 class='py-2 px-4 bg-light-blue text-white text-xl'>Historia</h2>
                                            <p class='bg-white p-4 border border-gray-300'><?= $filas['historia'] ?></p>
                                        </td>
                                    </table>
                                    <div class="min-w-full" id='anomalias-<?= $index ?>' style="display:none;">
                                        
                                        <?php
                                            $sql = "SELECT 
                                                    MAX(CASE WHEN lado.lado = 'anverso' THEN imagen.direccion END) AS imagen_anverso,
                                                    MAX(CASE WHEN lado.lado = 'reverso' THEN imagen.direccion END) AS imagen_reverso,
                                                    anomalia.detalle, anomalia.id_anomalia, nombre 
                                                    FROM anomalia
                                                    LEFT JOIN lado ON anomalia.id_anomalia = lado.id_anomalia
                                                    LEFT JOIN imagen ON lado.id_imagen = imagen.id_imagen
                                                    WHERE anomalia.id_moneda = ".$filas['id_moneda']."
                                                    GROUP BY anomalia.detalle";
                                            
                                            $res_an = mysqli_query($conectar, $sql);
                                            
                                            
                                            $anomalies = [];
                                            while ($row = mysqli_fetch_assoc($res_an)) {
                                                if ($row['imagen_anverso'] || $row['imagen_reverso'] || $row['detalle']) {
                                                    $anomalies[] = $row;
                                                }
                                            }
                                            
                                            if (count($anomalies) > 0) {
                                                echo "
                                                        <table class='min-w-full bg-white'>
                                                            <thead>
                                                                <tr>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left text-xl' colspan='6'>Anomalía</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left w-48'>Nombre</th>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left'>Detalle</th>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left'>Anverso</th>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left'>Reverso</th>
                                                                    <th class='py-2 px-4 bg-light-blue text-white text-left' colspan='2'></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";
                                            
                                                foreach ($anomalies as $fila) {
                                                    echo "<tr>
                                                            <td class='border px-4 py-2 text-left truncated' title='{$fila['nombre']}'>{$fila['nombre']}</td>
                                                            <td class='border px-4 py-2 text-left truncated ' title='.{$fila['detalle']}'>{$fila['detalle']}</td>
                                                            <td class='border px-4 py-2'><img src='{$fila['imagen_anverso']}' alt='' class='w-16 h-16 object-cover rounded-full'></td>
                                                            <td class='border px-4 py-2'><img src='{$fila['imagen_reverso']}' alt='' class='w-16 h-16 object-cover rounded-full'></td>
                                                            <td class='border px-4 py-2 cursor-pointer'><a href='eliminar_anomalia.php?v={$fila['id_anomalia']}' class='delete-anomaly-link'><i class='fa-solid fa-trash-can' style='font-size: x-large; margin-right: 10px; margin-left: 10px;'></i></a></td>
                                                            <td class='border px-4 py-2 cursor-pointer'><a href='editar_anomalia.php?v={$fila['id_anomalia']}'><i class='fa-solid fa-pen' style='font-size: x-large;'></i></a></td>
                                                        </tr>";
                                                }
                                            
                                                echo "</tbody></table>";
                                            } else {
                                                echo "<div class='p-10'>";
                                                echo "<h1>No hay anomalias registradas</h1>";
                                                echo "</div>";
                                            }
                                        ?>      
                                    </div>
                                </td>
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
    .truncated {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 150px;
        position: relative;
    }
    .truncated:hover::after {
        content: attr(title);
        position: absolute;
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        white-space: normal;
        z-index: 10;
        left: 0;
        top: 100%;
    }
</style>
<script>
function toggleDetails(id, link, open, close) {
    var table = document.getElementById(id);
    if (table.style.display === "none") {
        table.style.display = "table";
        link.textContent = open;
    } else {
        table.style.display = "none";
        link.textContent = close;
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    initModal('delete-coin-link', 'delete-coin');            
    initModal('delete-anomaly-link', 'delete-anomaly');            
});

</script>
<?php 

if(isset($_GET['success'])){

    $proceso = $_GET['success'];

    switch ($proceso) {
        case 'eliminar_moneda':
            echo "<script>openModal('delete-coin-success');</script>";
            break;
        case 'eliminar_anomalia':
            echo "<script>openModal('delete-anomaly-success');</script>";
            break;
        case 'agregar_moneda':
            echo "<script>openModal('add-coin-success');</script>";
            break;
        case 'agregar_anomalia':
            echo "<script>openModal('add-anomaly-success');</script>";
            break;
        case 'error_agregar_moneda':
            echo "<script>openModal('add-coin-error');</script>";
            break;
        case 'error_agregar_anomalia':
            echo "<script>openModal('add-anomaly-error');</script>";
            break;
        
        default:
            # code...
            break;
    }

    echo "<script>window.history.replaceState({}, '', 'vista_moneda.php');</script>";
}

?>