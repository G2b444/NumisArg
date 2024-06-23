<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monedas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .image-container {
            display: flex;
            justify-content: space-between; 
            width: 100%; 
        }

        .image-container img {
            width: 50%; 
            height: auto; 
            object-fit: cover; 
        }
    </style>
</head>
<body class="bg-white">
    <header class="flex items-center bg-dark-blue h-20">
        <div class="container mx-auto flex justify-between items-center">
            <img src="../../assets/multimedia/img/logo/LOGO NUMISARG.svg" alt="logo" class="w-16 h-16 mt-2">
            <nav class="space-x-4">
                <a href="#" class="text-white">Usuarios</a>
                <a href="#" class="text-white">Monedas</a>
                <a href="#" class="bg-light-blue text-white px-4 py-2 rounded">Ingresar</a>
            </nav>
        </div>
    </header>
    <main>
        <table border="2" cellspacing="5" cellpadding="10" width="500" align="center">
            <thead>
                <tr>
                    <th>Anverso</th>
                    <th>Reverso</th>
                    <th>Valor</th>
                    <th>Emision</th>
                    <th>Características</th>
                    <th>Anomalías</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql= "
                    SELECT 
                        MAX(CASE WHEN partes.lado = 'anverso' THEN imagen.direccion END) AS imagen_anverso,
                        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.listel END) AS listel_anverso,
                        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.efigie END) AS efigie_anverso,
                        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.leyenda END) AS leyenda_anverso,
                        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.ley END) AS ley_anverso,
                        MAX(CASE WHEN partes.lado = 'anverso' THEN partes.grafilia END) AS grafilia_anverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN imagen.direccion END) AS imagen_reverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.listel END) AS listel_reverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.efigie END) AS efigie_reverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.leyenda END) AS leyenda_reverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.ley END) AS ley_reverso,
                        MAX(CASE WHEN partes.lado = 'reverso' THEN partes.grafilia END) AS grafilia_reverso,
                        valor_nominal.valor,
                        moneda_atributo.inicio_emision,
                        moneda_atributo.fin_emision,
                        divisa.nombre AS divisa,
                        tipo_canto.tipo,
                        moneda_atributo.composicion,
                        moneda_atributo.diametro,
                        moneda_atributo.espesor,
                        moneda_atributo.historia
                    FROM moneda 
                    JOIN moneda_atributo ON moneda.id_moneda = moneda_atributo.id_moneda 
                    JOIN valor_nominal ON valor_nominal.id_valor_nominal = moneda_atributo.id_valor_nominal 
                    JOIN divisa ON divisa.id_divisa = moneda_atributo.id_divisa 
                    JOIN partes ON partes.id_moneda_atributo = moneda_atributo.id_moneda_atributo 
                    JOIN imagen ON partes.id_imagen = imagen.id_imagen
                    JOIN tipo_canto ON tipo_canto.id_tipo_canto = moneda_atributo.id_tipo_canto
                    GROUP BY 
                        valor_nominal.valor,
                        moneda_atributo.inicio_emision,
                        moneda_atributo.fin_emision,
                        divisa.nombre,
                        tipo_canto.tipo,
                        moneda_atributo.composicion,
                        moneda_atributo.diametro,
                        moneda_atributo.espesor,
                        moneda_atributo.historia;
                ";

                include '../../inc/conexion.php';
                $res = mysqli_query($conectar, $sql);


                foreach($res as $fila){
                    echo "<tr>";
                    echo "<td colspan='2'>
                            <div class='image-container'>
                            <img src='".$fila["imagen_anverso"]."' alt='Imagen reverso'>
                            <img src='".$fila["imagen_reverso"]."' alt='Imagen reverso'>
                            </div>
                        </td>";
                    echo "<td>". $fila['valor'] ."</td>";
                    echo "<td>". $fila['inicio_emision'] ." - ". $fila['fin_emision'] ."</td>";
                    echo "<td>Detalles</td>";
                    echo "<td>ver</td>";
                    echo "<td>Editar</td>";
                    echo "<td>Eliminar</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
    </table>

    </main>
</body>
</html>

<!-- Tailwind CSS Config -->
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
        background-color:  #000911;
    }

    body {
            font-family: 'Radio Canada', sans-serif;
        }
        h1, h2 {
            font-family: 'Patua One', cursive;
        }
   
</style>