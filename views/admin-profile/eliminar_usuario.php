<?php 
if(isset($_GET['v'])){
    $id_usuario = $_GET['v'];

    include '../../inc/conexion.php';

    $sql = "SELECT coleccion.id_coleccion, guarda_moneda.id_guarda_moneda, guarda_anomalia.id_guarda_anomalia, detalle_guarda.id_detalle_guarda, estado.id_estado 
    FROM coleccion
    LEFT JOIN guarda_moneda ON guarda_moneda.id_coleccion = coleccion.id_coleccion
    LEFT JOIN guarda_anomalia ON guarda_anomalia.id_coleccion = coleccion.id_coleccion
    LEFT JOIN detalle_guarda ON guarda_moneda.id_detalle_guarda = detalle_guarda.id_detalle_guarda OR guarda_anomalia.id_detalle_guarda = detalle_guarda.id_detalle_guarda
    LEFT JOIN estado ON detalle_guarda.id_estado = estado.id_estado
    WHERE coleccion.id_usuario = $id_usuario;";

    if(!$res = mysqli_query($conectar, $sql)) {
        echo "Error al obtener los identificadores de los registros: " . mysqli_error($conectar) . "\n";
        echo "Código de error: " . mysqli_errno($conectar) . "\n";
        exit;
    }

    if(mysqli_num_rows($res) > 0){
        while($filas = mysqli_fetch_assoc($res)){

            if (!is_null($filas['id_guarda_moneda'])) {
                $sql = "DELETE FROM `guarda_moneda` WHERE id_guarda_moneda = ".$filas['id_guarda_moneda'];
                if(!mysqli_query($conectar, $sql)) {
                    echo "<h1>$sql</h1>";
                    echo "Error al eliminar guarda_moneda: " . mysqli_error($conectar) . "\n";
                    exit;
                }
            }

            if (!is_null($filas['id_guarda_anomalia'])) {
                $sql = "DELETE FROM `guarda_anomalia` WHERE id_guarda_anomalia = ".$filas['id_guarda_anomalia'];
                if(!mysqli_query($conectar, $sql)) {
                    echo "<h1>$sql</h1>";
                    echo "Error al eliminar guarda_anomalia: " . mysqli_error($conectar) . "\n";
                    exit;
                }
            }

            if (!is_null($filas['id_detalle_guarda'])) {
                $sql = "DELETE FROM `detalle_guarda` WHERE id_detalle_guarda = ".$filas['id_detalle_guarda'];
                if(!mysqli_query($conectar, $sql)) {
                    echo "<h1>$sql</h1>";
                    echo "Error al eliminar detalle_guarda: " . mysqli_error($conectar) . "\n";
                    exit;
                }
            }

            if (!is_null($filas['id_estado'])) {
                $sql = "DELETE FROM `estado` WHERE id_estado = ".$filas['id_estado'];
                if(!mysqli_query($conectar, $sql)) {
                    echo "<h1>$sql</h1>";
                    echo "Error al eliminar estado: " . mysqli_error($conectar) . "\n";
                    exit;
                }
            }
        }
    }

    $sql = "DELETE FROM `usuario` WHERE id_usuario = $id_usuario";
    if(!mysqli_query($conectar, $sql)) {
        echo "Error al eliminar usuario: " . mysqli_error($conectar) . "\n";
        exit;
    }

    mysqli_close($conectar);
    header('Location: tabla_usuario.php?success=eliminar_usuario');
    exit;
}
?>

