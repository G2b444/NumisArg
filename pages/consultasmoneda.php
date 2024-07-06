<?php
include 'conexion.php';

if(!isset($_GET['moneda'])){
    echo '<meta http-equiv="refresh" content="0; URL=./catalogo.php" />';
}
$id= $_GET['moneda'];

//caracteristicas comunes
    $sql="SELECT moneda.nombre, inicio_emision, fin_emision 
    FROM moneda
    INNER JOIN moneda_atributo ON moneda.id_moneda=moneda_atributo.id_moneda
    WHERE moneda.id_moneda='$id'";
    $gral=mysqli_query($conectar,$sql);


//caracteristicas detalladas
    $sql="SELECT divisa.nombre , valor_nominal.valor, tipo_canto.tipo, tipo_moneda, composicion, diametro, espesor, historia 
        FROM moneda_atributo
        INNER JOIN divisa ON moneda_atributo.id_divisa=divisa.id_divisa
        INNER JOIN valor_nominal ON moneda_atributo.id_valor_nominal=valor_nominal.id_valor_nominal
        INNER JOIN tipo_canto ON moneda_atributo.id_tipo_canto=tipo_canto.id_tipo_canto
        INNER JOIN tipo_moneda ON moneda_atributo.id_tipo_moneda=tipo_moneda.id_tipo_moneda
        WHERE id_moneda='$id'";
    $detalle=mysqli_query($conectar,$sql);


//lados
    $sql="SELECT `lado`, `listel`, `efigie`, `leyenda`, `exergo`, `ley`, `grafilia`, `detalles` 
        FROM `partes` 
        INNER JOIN moneda_atributo ON moneda_atributo.id_moneda_atributo=partes.id_moneda_atributo
        WHERE id_moneda='$id'";
    $lados=mysqli_query($conectar,$sql);
    

//anomalias
    $sql="SELECT detalle, anomalia.id_anomalia
        FROM `lado` 
        INNER JOIN anomalia ON anomalia.id_anomalia=lado.id_anomalia
        WHERE id_moneda='$id'";
    $anomalia=mysqli_query($conectar,$sql);
?>