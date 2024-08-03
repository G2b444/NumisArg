<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $items = isset($_POST['items']) ? $_POST['items'] : [];

    if (!empty($items)) {
        include("../../inc/conexion.php");

        $ids = implode(',', array_map('intval', $items));

        
        $sql = "SELECT id_detalle_guarda FROM guarda_moneda WHERE id_coleccion IN ($ids)";
        $result = mysqli_query($conectar, $sql);

        if ($result) {
            $detalle_ids = [];

           
            while ($row = mysqli_fetch_assoc($result)) {
                $detalle_ids[] = $row['id_detalle_guarda'];
            }

            if (!empty($detalle_ids)) {
                $detalle_ids = implode(',', array_map('intval', $detalle_ids));


                $sql = "DELETE FROM detalle_guarda WHERE id_detalle_guarda IN ($detalle_ids)";
                if (!mysqli_query($conectar, $sql)) {
                    echo 'Error al eliminar de detalle_guarda: ' . mysqli_error($conectar);
                }
            }

            $sql = "DELETE FROM guarda_anomalia WHERE id_coleccion IN ($ids)";
            if (!mysqli_query($conectar, $sql)) {
                echo 'Error al eliminar de guarda_anomalia: ' . mysqli_error($conectar);
            }

            $sql = "DELETE FROM guarda_moneda WHERE id_coleccion IN ($ids)";
            if (!mysqli_query($conectar, $sql)) {
                echo 'Error al eliminar de guarda_moneda: ' . mysqli_error($conectar);
            } 

            $sql = "DELETE FROM coleccion WHERE id_coleccion IN ($ids)";
            if (!mysqli_query($conectar, $sql)) {
                echo 'Error al eliminar coleccion: ' . mysqli_error($conectar);
            }else {
                echo 'Registros eliminados correctamente.';
                echo "<script>window.location='main.php?success=eliminar_coleccion';</script>";
            }

        } else {
            echo 'Error en la consulta SELECT: ' . mysqli_error($conectar);
        }

        mysqli_close($conectar);
    } else {
        echo 'No se han seleccionado registros.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>

