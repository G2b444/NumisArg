<?php 
if(isset($_GET['v'])){
    $id_moneda = $_GET['v'];

    include '../../inc/conexion.php';

    $sql = "SELECT 
                MAX(CASE WHEN lado.lado = 'anverso' THEN lado.id_imagen END) AS id_imagen_anverso,
                MAX(CASE WHEN lado.lado = 'reverso' THEN lado.id_imagen END) AS id_imagen_reverso,
                MAX(CASE WHEN lado.lado = 'anverso' THEN lado.id_lado END) AS id_lado_anverso,
                MAX(CASE WHEN lado.lado = 'reverso' THEN lado.id_lado END) AS id_lado_reverso,
                anomalia.id_anomalia AS identificador_anomalia
            FROM 
                anomalia
                JOIN lado ON anomalia.id_anomalia = lado.id_anomalia
                JOIN imagen ON imagen.id_imagen = lado.id_imagen
            WHERE 
                anomalia.id_moneda = $id_moneda
            GROUP BY 
                anomalia.id_anomalia";
    

    include '../../inc/conexion.php';

    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    if(mysqli_num_rows($res) > 0){

        $data_id = mysqli_fetch_assoc($res);

        $sql = "DELETE FROM lado WHERE id_lado = ".$data_id['id_lado_anverso']."";
        
        if(!$res = mysqli_query($conectar, $sql)){
            echo "Error al eliminar el lado anverso: " . mysqli_error($conectar) . "\n";
            echo "Código de error: " . mysqli_errno($conectar) . "\n";
            exit; 
        } 
        $sql = "DELETE FROM lado WHERE id_lado = ".$data_id['id_lado_reverso'].""; 
        echo $sql;
        echo "<br>";
        if(!$res = mysqli_query($conectar, $sql)){
            echo "Error al eliminar el lado reverso: " . mysqli_error($conectar) . "\n";
            echo "Código de error: " . mysqli_errno($conectar) . "\n";
            exit; 
        }
        $sql = "DELETE FROM imagen WHERE id_imagen = ".$data_id['id_imagen_anverso']."";

        if(!$res = mysqli_query($conectar, $sql)){
            echo "Error al eliminar la imagen anversa: " . mysqli_error($conectar) . "\n";
            echo "Código de error: " . mysqli_errno($conectar) . "\n";
            exit; 
        }
        $sql = "DELETE FROM imagen WHERE id_imagen = ".$data_id['id_imagen_reverso']."";
        
        if(!$res = mysqli_query($conectar, $sql)){
            echo "Error al eliminar la imagen reversa: " . mysqli_error($conectar) . "\n";
            echo "Código de error: " . mysqli_errno($conectar) . "\n";
            exit; 
        }
        $sql = "DELETE FROM anomalia WHERE id_anomalia = ".$data_id['identificador_anomalia']."";
        
        if(!$res = mysqli_query($conectar, $sql)){
            echo "Error al eliminar la anomalia: " . mysqli_error($conectar) . "\n";
            echo "Código de error: " . mysqli_errno($conectar) . "\n";
            exit; 
        }
    }

    $sql = "SELECT * FROM moneda_atributo WHERE id_moneda = $id_moneda";
    $res = mysqli_query($conectar, $sql);
    $var_array = mysqli_fetch_assoc($res);
    $id_moneda_atributo = $var_array['id_moneda_atributo'];
    $sql = "SELECT MAX(CASE WHEN partes.lado = 'anverso' THEN partes.id_imagen END) AS id_imagen_anverso,
                    MAX(CASE WHEN partes.lado = 'reverso' THEN partes.id_imagen END) AS id_imagen_reverso,
                    MAX(CASE WHEN partes.lado = 'anverso' THEN partes.id_partes END) AS id_parte_anverso,
                    MAX(CASE WHEN partes.lado = 'reverso' THEN partes.id_partes END) AS id_parte_reverso 
            FROM partes
            WHERE id_moneda_atributo = $id_moneda_atributo";

    if (!$res = mysqli_query($conectar, $sql)) {
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    $data_id = mysqli_fetch_assoc($res); 

    $sql = "DELETE FROM `imagen`
            WHERE id_imagen IN (
            ".$data_id['id_imagen_anverso']."
            , ".$data_id['id_imagen_reverso']."
            );";

    if (!$res = mysqli_query($conectar, $sql)) {
        echo "Error al eliminar registros de imagen: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    $sql = "DELETE FROM `partes`
            WHERE id_partes IN (
            ".$data_id['id_parte_anverso']."
            , ".$data_id['id_parte_reverso']."
            );";

    echo "<script>alert('$sql');</script>";
        
    if (!$res = mysqli_query($conectar, $sql)) {
        echo $sql;
        echo "Error al eliminar registros de imagenes: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    $sql = "DELETE FROM moneda_atributo WHERE id_moneda_atributo = $id_moneda_atributo";

    if (!$res = mysqli_query($conectar, $sql)) {
        echo "Error al eliminar el registro de atributos de la moneda: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    $sql = "DELETE FROM moneda WHERE id_moneda = $id_moneda";

    if (!$res = mysqli_query($conectar, $sql)) {
        echo "Error al eliminar el registro de la moneda: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }


    mysqli_close($conectar);
    header('Location: vista_moneda.php?success=eliminar_moneda');
    exit;
}else{
    echo "<script>history.go(-1);</script>";
    exit;
}              
?>