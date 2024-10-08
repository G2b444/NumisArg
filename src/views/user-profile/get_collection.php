<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Coleccion</title>
    <style>

@font-face {
            font-family: 'MiFuente';
            src: url('font/PatuaOne-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'MiFuente', sans-serif;
        }

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

.styled-checkbox {
    appearance: none;
    background-color: #021526;
    margin: 0;
    font: inherit;
    color: #FFFFFF;
    width: 1.25em;
    height: 1.25em;
    border: 0.1em solid #021526;
    border-radius: 0.25em;
    display: grid;
    place-content: center;
    cursor: pointer;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.styled-checkbox::before {
    content: "";
    width: 0.65em;
    height: 0.65em;
    transform: scale(0);
    transition: transform 120ms ease-in-out;
    box-shadow: none; /* Eliminamos el borde interno */
    background-color: currentColor; /* Color del check */
}

.styled-checkbox:checked::before {
    transform: scale(1);
}

.styled-checkbox:hover {
    border-color: #FFFFFF; /* Color de borde cuando se pasa el ratón por encima */
}

.styled-checkbox:focus {
    outline: max(2px, 0.15em) solid currentColor;
    outline-offset: max(2px, 0.15em);
}


</style>


</head>
<body class="bg-gray-100 p-6">

<?php
include("../../inc/conexion.php");

if (isset($_GET['id_coleccion'])) {
    $id_coleccion = intval($_GET['id_coleccion']);

    // Consulta para obtener las monedas y anomalías de la colección seleccionada
    $sql_normal = "SELECT 
                        guarda_moneda.id_guarda_moneda AS id_guarda,
                        moneda.id_moneda,
                        guarda_moneda.fecha_guardado,
                        moneda.nombre AS nombre_moneda,
                        coleccion.id_coleccion,
                        detalle_guarda.id_estado,
                        detalle_guarda.cantidad,
                        detalle_guarda.valor_de_mercado,
                        estado.estado,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN imagen.direccion END) AS direccion,
                        'Moneda Normal' AS tipo_moneda
                    FROM 
                        coleccion
                        JOIN guarda_moneda ON coleccion.id_coleccion = guarda_moneda.id_coleccion
                        JOIN detalle_guarda ON guarda_moneda.id_detalle_guarda = detalle_guarda.id_detalle_guarda
                        JOIN estado ON detalle_guarda.id_estado = estado.id_estado
                        JOIN moneda ON guarda_moneda.id_moneda = moneda.id_moneda
                        JOIN moneda_atributo ON moneda.id_moneda = moneda_atributo.id_moneda
                        JOIN partes ON moneda_atributo.id_moneda_atributo = partes.id_moneda_atributo
                        JOIN imagen ON partes.id_imagen = imagen.id_imagen
                    WHERE 
                        coleccion.id_coleccion = $id_coleccion

                    GROUP BY 
                        guarda_moneda.id_guarda_moneda,
                        moneda.id_moneda,
                        guarda_moneda.fecha_guardado,
                        moneda.nombre,
                        coleccion.id_coleccion,
                        detalle_guarda.id_estado,
                        detalle_guarda.cantidad,
                        detalle_guarda.valor_de_mercado,
                        estado.estado

                    UNION ALL

                    SELECT 
                        guarda_anomalia.id_guarda_anomalia AS id_guarda,
                        anomalia.id_anomalia,
                        guarda_anomalia.fecha_guardado,
                        anomalia.nombre AS nombre_anomalia,
                        coleccion.id_coleccion,
                        detalle_guarda.id_estado,
                        detalle_guarda.cantidad,
                        detalle_guarda.valor_de_mercado,
                        estado.estado,
                        MAX(CASE WHEN lado.lado = 'reverso' THEN imagen.direccion END) AS direccion,
                        'Anomalia' AS tipo_moneda
                    FROM 
                        coleccion
                        JOIN guarda_anomalia ON coleccion.id_coleccion = guarda_anomalia.id_coleccion
                        JOIN detalle_guarda ON guarda_anomalia.id_detalle_guarda = detalle_guarda.id_detalle_guarda
                        JOIN estado ON detalle_guarda.id_estado = estado.id_estado
                        JOIN anomalia ON guarda_anomalia.id_anomalia = anomalia.id_anomalia
                        JOIN lado ON anomalia.id_anomalia = lado.id_anomalia
                        JOIN imagen ON lado.id_imagen = imagen.id_imagen
                    WHERE 
                        coleccion.id_coleccion = $id_coleccion

                    GROUP BY 
                        guarda_anomalia.id_guarda_anomalia,
                        anomalia.id_anomalia,
                        guarda_anomalia.fecha_guardado,
                        anomalia.nombre,
                        coleccion.id_coleccion,
                        detalle_guarda.id_estado,
                        detalle_guarda.cantidad,
                        detalle_guarda.valor_de_mercado,
                        estado.estado

                    ORDER BY fecha_guardado
                ";

    $result = mysqli_query($conectar, $sql_normal);

    if(!$result){
        die('Ocurrió un error');
    }

    echo '<div id="collection-content" class="grid grid-cols-5 gap-10 mx-28 bg-customBlue2">';

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_guarda'];
   
    echo '<div class="perspective w-48 h-48">';
    echo '<div class="selection-grid hidden flex justify-center items-center mb-2">'; // Asegúrate de tener la clase flex, justify-center y items-center
    echo '    <input type="checkbox" class="selection-checkbox styled-checkbox h-8 w-8 border-0 bg-purple" value="' . $id . '">'; // Añade la clase styled-checkbox
    echo '</div>';
    echo '    <div class="flip-card relative w-full h-full ">';
    echo '        <div class="front bg-white border border-gray-300 rounded-3xl flex flex-col items-center justify-center">';
    echo '            <p class="w-32 text-center bg-white overflow-hidden whitespace-nowrap truncate">' . htmlspecialchars($row['nombre_moneda']) . '</p>';
    echo '            <hr class="border-t-2 border-gray-400 w-full">';
    echo '            <img src="'. htmlspecialchars($row['direccion']) .'" alt="Moneda" class="w-32 h-32 mb-2 p-2">';
    echo '        </div>';
    echo '        <div class="flip-card-back flex flex-col back bg-white border border-gray-300 rounded-3xl  items-center justify-center">';
    echo '            <p title="'. htmlspecialchars($row['nombre_moneda']) .'" class="w-32 text-center bg-white overflow-hidden whitespace-nowrap truncate">' . htmlspecialchars($row['nombre_moneda']) . '</p>';
    echo '            <hr class="border-t-2 border-gray-400 w-full">';
    echo '            <div class="text-left w-42 h-32 mb-2 py-2 p">';
    echo '                <p title="' . htmlspecialchars($row['estado']) . '" class="m-1"><span class="font-semibold whitespace-nowrap overflow-hidden truncate">Estado: </span> ' . htmlspecialchars($row['estado']) . '</p>';
    echo '                <p title="' . htmlspecialchars($row['cantidad']) . '" class="m-1"><span class="whitespace-nowrap overflow-hidden truncate font-semibold">Cantidad: </span> ' . htmlspecialchars($row['cantidad']) . '</p>';
    echo '                <p title="' . htmlspecialchars($row['valor_de_mercado']) . '" class="m-1"><span class="whitespace-nowrap overflow-hidden truncate font-semibold">Valor de Mercado: </span> ' . htmlspecialchars($row['valor_de_mercado']) . '</p>';
    echo '                <p title="' . htmlspecialchars($row['tipo_moneda']) . '" class="m-1">' . htmlspecialchars($row['tipo_moneda']) . '</p>'; // Añade el tipo de moneda
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

