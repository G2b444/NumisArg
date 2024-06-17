<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insertar_moneda.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="anv">Anverso:</label>
            <input type="file" name="anv" required>
        </p>
        <p>
            <label for="rvo">Reverso:</label>
            <input type="file" name="rvo" required>
        </p>
        <p>
            <label for="nombre_moneda">Nombre:</label>
            <input type="text" name="nombre_moneda" required>
        </p>
        <p>
            <select name="tipo_moneda" id="">
                <option selected disabled>--Seleccione el tipo de moneda--</option>
                <?php 
                include 'conexion.php';

                $sql = "SELECT * FROM tipo_moneda";
                $res = mysqli_query($conectar, $sql);
                
                foreach($res as $filas){
                    echo "<option value='".$filas['id_tipo_moneda']."'>".$filas['tipo_moneda']."</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <select name="divisa" id="" required>
                <option selected disabled>--Seleccione la divisa--</option>
                <?php 
                include 'conexion.php';

                $sql = "SELECT * FROM divisa";
                $res = mysqli_query($conectar, $sql);
                
                foreach($res as $filas){
                    echo "<option value='".$filas['id_divisa']."'>".$filas['nombre']."</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <select name="v_n" id="" required>
                <option selected disabled>--Seleccione el valor nominal--</option>
                <?php 
                $sql = "SELECT * FROM valor_nominal";
                $res = mysqli_query($conectar, $sql);
                
                foreach($res as $filas){
                    echo "<option value='".$filas['id_valor_nominal']."'>".$filas['valor']."</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <select name="t_c" id="" required>
                <option selected disabled>--Seleccione el tipo de canto--</option>
                <?php 
                $sql = "SELECT * FROM tipo_canto";
                $res = mysqli_query($conectar, $sql);
                
                foreach($res as $filas){
                    echo "<option value='".$filas['id_tipo_canto']."'>".$filas['tipo']."</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="historia">Historia:</label>
            <input type="text" name="historia" required>
        </p>
        <p>
                <label for="composicion">Composición:</label>
                <input type="text" name="composicion" id="" required>
            </p>
            <p>
                <label for="diametro">Diametro:</label>
                <input type="number" name="diametro" required>
            </p>
            <p>
                <label for="espesor">Espesor:</label>
                <input type="number" name="espesor" required>
            </p>
        <p>
            <label for="ini_emi">Inicio emisión:</label>
            <input type="date" name="ini_emi" required>
        </p>
        <p>
            <label for="fin_emi">Fin emisión:</label>
            <input type="date" name="fin_emi" required>
        </p>
        <p>
            <h2>Partes:</h2>
                <p>
                    <h3>Anverso:</h3>
                    <p>
                        <p>
                            <label for="listel">Listel:</label>
                            <input type="text" name="listel_anver" required>
                        </p>
                        <p>
                            <label for="efigie">Efigie:</label>
                            <input type="text" name="efigie_anver" required>
                        </p>
                        <p>
                            <label for="leyenda">Leyenda:</label>
                            <input type="text" name="leyenda_anver" required>
                        </p>
                        <p>
                            <label for="exergo">Exergo:</label>
                            <input type="text" name="exergo_anver" required>
                        </p>
                        <p>
                            <label for="ley">Ley:</label>
                            <input type="text" name="ley_anver" required>
                        </p>
                        <p>
                            <label for="grafilia">Grafilia:</label>
                            <input type="text" name="grafilia_anver" required>
                        </p>
                        <p>
                            <label for="detalles">Detalles:</label>
                            <input type="text" name="detalles_anver">
                        </p>
                    </p>
                    <br>
                    <h3>Reverso:</h3>
                    <p>
                        <p>
                            <label for="listel">Listel:</label>
                            <input type="text" name="listel_rever" required>
                        </p>
                        <p>
                            <label for="efigie">Efigie:</label>
                            <input type="text" name="efigie_rever" required>
                        </p>
                        <p>
                            <label for="leyenda">Leyenda:</label>
                            <input type="text" name="leyenda_rever" required>
                        </p>
                        <p>
                            <label for="exergo">Exergo:</label>
                            <input type="text" name="exergo_rever" required>
                        </p>
                        <p>
                            <label for="ley">Ley:</label>
                            <input type="text" name="ley_rever" required>
                        </p>
                        <p>
                            <label for="grafilia">Grafilia:</label>
                            <input type="text" name="grafilia_rever" required>
                        </p>
                        <p>
                            <label for="detalles">Detalles:</label>
                            <input type="text" name="detalles_rever">
                        </p>
                    </p>
                </p>
        </p>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>