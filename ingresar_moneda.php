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
            <label for="">Partes:</label>
        </p>
        <p>
            <p>
                <select name="lado" required>
                    <option value="" disabled selected>--Selecciona el lado--</option>
                    <option value="Anverso">Anverso</option>
                    <option value="Reverso">Reverso</option>
                </select>
            </p>
            <p>
                <label for="listel">Listel:</label>
                <input type="text" name="listel" required>
            </p>
            <p>
                <label for="efigie">Efigie:</label>
                <input type="text" name="efigie" required>
            </p>
            <p>
                <label for="leyenda">Leyenda:</label>
                <input type="text" name="leyenda" required>
            </p>
            <p>
                <label for="exergo">Exergo:</label>
                <input type="text" name="exergo" required>
            </p>
            <p>
                <label for="ley">Ley:</label>
                <input type="text" name="ley" required>
            </p>
            <p>
                <label for="grafilia">Grafilia:</label>
                <input type="text" name="grafilia" required>
            </p>
        </p>
        <p>
            <select name="circulacion" id="" required>
                <option value="" Selected disabled>--Circulación--</option>
                <option value="0">Verdadero</option>
                <option value="1">Falso</option>
            </select>
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
            <label for="historia">Historia:</label>
            <input type="text" name="historia" required>
        </p>
        <p>
            <label for="ini_emi">Inicio emisión:</label>
            <input type="date" name="ini_emi" required>
        </p>
        <p>
            <label for="fin_emi">Fin emisión:</label>
            <input type="date" name="fin_emi" required>
        </p>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>