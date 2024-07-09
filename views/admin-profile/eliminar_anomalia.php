<?php 
if(isset($_GET['v'])){
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    error_reporting(E_ALL);
    $id_anomalia = $_GET['v'];

    $sql = "SELECT MAX(CASE WHEN lado.lado = 'anverso' THEN lado.id_imagen END) AS id_imagen_anverso,
                    MAX(CASE WHEN lado.lado = 'reverso' THEN lado.id_imagen END) AS id_imagen_reverso,
                    MAX(CASE WHEN lado.lado = 'anverso' THEN lado.id_lado END) AS id_lado_anverso,
                    MAX(CASE WHEN lado.lado = 'reverso' THEN lado.id_lado END) AS id_lado_reverso,
                    anomalia.id_anomalia AS identificador_anomalia
            FROM anomalia, lado, imagen
            WHERE anomalia.id_anomalia = $id_anomalia
            AND anomalia.id_anomalia = lado.id_anomalia 
            AND imagen.id_imagen = lado.id_imagen";
    echo $sql;
    echo "<br>";
    include '../../inc/conexion.php';

    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    $data_id = mysqli_fetch_assoc($res);

    $sql = "DELETE FROM lado WHERE id_lado = ".$data_id['id_lado_anverso']."";
    
    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    } 
    $sql = "DELETE FROM lado WHERE id_lado = ".$data_id['id_lado_reverso'].""; 
    echo $sql;
    echo "<br>";
    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }
    $sql = "DELETE FROM imagen WHERE id_imagen = ".$data_id['id_imagen_anverso']."";

    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }
    $sql = "DELETE FROM imagen WHERE id_imagen = ".$data_id['id_imagen_reverso']."";
    
    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }
    $sql = "DELETE FROM anomalia WHERE id_anomalia = ".$data_id['identificador_anomalia']."";
    
    if(!$res = mysqli_query($conectar, $sql)){
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit; 
    }

    echo "<script>alert('Anomalia eliminada con éxito'); window.location='vista_moneda.php';</script>";
}
?>