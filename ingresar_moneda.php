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
            <input type="file" name="anv">
        </p>
        <p>
            <label for="rvo">Reverso:</label>
            <input type="file" name="rvo">
        </p>
        <p>
            <select name="" id="">
                <option value="" selected disabled>--Seleccione la divisa--</option>
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
            <select name="" id="">
                <option value="" selected disabled>--Seleccione el valor nominal--</option>
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
            <select name="" id="">
                <option value="" selected disabled>--Seleccione el tipo de canto--</option>
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
                <select name="" id="">
                    <option value="" disabled selected>--Selecciona el lado--</option>
                    <option value="Anverso">Anverso</option>
                    <option value="Reverso">Reverso</option>
                </select>
            </p>
            <p>
                <label for="">Listel:</label>
                <input type="text" name="" id="">
            </p>
            <p>
                <label for="">Efigie:</label>
                <input type="text" name="" id="">
            </p>
            <p>
                <label for="">Leyenda:</label>
                <input type="text" name="" id="">
            </p>
            <p>
                <label for="">Exergo:</label>
                <input type="text" name="" id="">
            </p>
            <p>
                <label for="">Ley:</label>
                <input type="text">
            </p>
            <p>
                <label for="">Grafilia:</label>
                <input type="text" name="" id="">
            </p>
        </p>
        <p>
            <select name="" id="">
                <option value="" Selected disabled>--Circulación--</option>
                <option value="0">Verdadero</option>
                <option value="1">Falso</option>
            </select>
        </p>
        <p>
            <label for="">Composición:</label>
            <input type="text" name="" id="">
        </p>
        <p>
            <label for="">Diametro:</label>
            <input type="number" name="" id="">
        </p>
        <p>
            <label for="">Espesor:</label>
            <input type="number" name="" id="">
        </p>
        <p>
            <label for="">Historia:</label>
            <input type="text" name="" id="">
        </p>
        <p>
            <label for="">Inicio emisión:</label>
            <input type="date" name="" id="">
        </p>
        <p>
            <label for="">Fin emisión:</label>
            <input type="date" name="" id="">
        </p>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>