<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monedas</title>
    <style>
        .image-container {
            display: flex; /* Enable flexbox layout */
            justify-content: space-between; /* Distribute images evenly */
            width: 100%; /* Span the full width of the columns */
        }

        .image-container img {
            width: 50%; /* Adjust image width as needed */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover; /* Ensure images cover the entire space */
        }
    </style>
</head>
<body>
    <header>

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
                
                $sql = "SELECT 
                            MAX(CASE WHEN partes.lado = 'anverso' THEN imagen.direccion END) AS imagen_anverso,
                            MAX(CASE WHEN partes.lado = 'reverso' THEN imagen.direccion END) AS imagen_reverso, 
                            valor_nominal.valor, moneda_atributo.inicio_emision, 
                            moneda_atributo.fin_emision
                        FROM moneda, imagen, partes, moneda_atributo, divisa, valor_nominal 
                        WHERE moneda_atributo.id_moneda_atributo = partes.id_moneda_atributo 
                        AND moneda.id_moneda = moneda_atributo.id_moneda 
                        AND partes.id_imagen = imagen.id_imagen 
                        AND valor_nominal.id_valor_nominal = moneda_atributo.id_valor_nominal";
                include 'conexion.php';
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