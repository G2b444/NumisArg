<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Coleccion</title>
    <style>
/* Asegúrate de que el contenedor preserve la perspectiva */
.perspective {
    perspective: 1000px;
}

/* Contenedor que rota en 3D */
.flip-card {
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

/* Al hacer hover en el contenedor padre, rota el contenedor interno */
.perspective:hover .flip-card {
    transform: rotateY(180deg);
}

/* Ajusta el frente y la parte trasera */
.front, .back {
    backface-visibility: hidden;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* La parte trasera está oculta inicialmente y rota 180 grados */
.back {
    transform: rotateY(180deg);
}

.truncated {
overflow: hidden;
white-space: nowrap;
text-overflow:
ellipsis;
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


</head>
<body class="bg-gray-100 p-6">

<?php
include("../libreria/conexion.php");

if (isset($_GET['id_coleccion'])) {
    $id_coleccion = intval($_GET['id_coleccion']);

    // Consulta para obtener las monedas y anomalías de la colección seleccionada
    $sql_normal = "SELECT 
    gm.id_guarda_moneda AS id_guarda,
    gm.id_moneda,
    moneda.nombre AS nombre_moneda,
    gm.id_coleccion,
    dg.id_estado,
    dg.cantidad,
    dg.valor_de_mercado,
    e.estado
    FROM 
        guarda_moneda gm
    LEFT JOIN 
        detalle_guarda dg ON gm.id_detalle_guarda = dg.id_detalle_guarda
    LEFT JOIN 
        estado e ON dg.id_estado = e.id_estado
    LEFT JOIN
        moneda ON moneda.id_moneda = gm.id_moneda
    WHERE 
    gm.id_coleccion = 3";

    $sql_anomalias = "SELECT 
    ga.id_guarda_anomalia AS id_guarda,
    ga.id_anomalia AS id_moneda,
    ga.id_coleccion,
    dg.id_estado,
    dg.cantidad,
    dg.valor_de_mercado,
    e.estado
    FROM 
        guarda_anomalia ga
    LEFT JOIN 
        detalle_guarda dg ON ga.id_detalle_guarda = dg.id_detalle_guarda
    LEFT JOIN 
        estado e ON dg.id_estado = e.id_estado
    LEFT JOIN
        moneda ON moneda.id_moneda = ga.id_anomalia
    LEFT JOIN
        anomalia ON anomalia.id_moneda = moneda.id_moneda AND anomalia.id_anomalia = ga.id_anomalia
    WHERE 
    ga.id_coleccion = 3;
    ";

    $result = mysqli_query($conectar, $sql_normal);
    $result_anomalia = mysqli_query($conectar, $sql_anomalias);

    if(!$result OR !$result_anomalia){
        die('Ocurrió un error');
    }

    echo '<div class="grid grid-cols-5 gap-4 ml-4">';

while ($row = mysqli_fetch_assoc($result)) {
    
    echo '<div class="perspective w-48 h-48">';
    echo '    <div class="flip-card relative w-full h-full">';
    echo '        <div class="front bg-white border border-gray-300 rounded-3xl flex flex-col items-center justify-center">';
    echo '            <p class="w-32 text-center bg-white overflow-hidden whitespace-nowrap truncate">Moneda epica jijuji epicardo</p>';
    echo '            <hr class="border-t-2 border-gray-400 w-full">';
    echo '            <img src="../images/file.png" alt="Moneda" class="w-32 h-32 mb-2 p-2">';
    echo '        </div>';
    echo '        <div class="flip-card-back flex flex-col back bg-white border border-gray-300 rounded-3xl  items-center justify-center">';
    echo '            <p title="" class="w-32 text-center bg-white overflow-hidden whitespace-nowrap truncate">Moneda epica jijuji epicardo</p>';
    echo '            <hr class="border-t-2 border-gray-400 w-full">';
    echo '            <div class="text-left w-42 h-32 mb-2 py-2">';
    echo '                <p title="" class="m-1"><span class="font-semibold">Estado: </span> ' . $row['estado'] . '</p>';
    echo '                <p class="m-1"><span class="font-semibold">Cantidad: </span> ' . $row['cantidad'] . '</p>';
    echo '                <p class="m-1"><span class="font-semibold">Valor de Mercado: </span> ' . $row['valor_de_mercado'] . '</p>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';




}

echo '</div>';
 // Cierre del contenedor del grid

} else {
    echo "ID de colección no válido.";
}
?>

</body>
</html>

