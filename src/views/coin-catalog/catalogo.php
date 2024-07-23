<?php
include '../../inc/conexion.php';

$sql="SELECT nombre, inicio_emision, fin_emision, moneda.id_moneda, id_moneda_atributo
    FROM  moneda
    INNER JOIN moneda_atributo ON moneda.id_moneda=moneda_atributo.id_moneda";


$campo=0;
if(isset($_GET['campo']) && isset($_GET['valor'])) {

    $campo= $_GET['campo'];
    $valor= $_GET['valor'];
}

switch($campo){
    case 1:
        $sql .= "WHERE moneda.nombre LIKE '%$valor%'";
        echo $valor;
    break;
    case 2:
        $sql .= "WHERE moneda.nombre LIKE '%$valor%'";
        echo $valor;
    break;
    case 3:
        
    break;
    case 4:
        
    break;
    case 5:
        
    break;
    case 6:
        
    break;
}

$gen= mysqli_query($conectar,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
    <title>Catálogo</title>
</head>
<body>
    <?php include  '../../../header.php'; 
    ?>
    <section class="w-full h-fit p-5 px-16">
        <h1 class="text-5xl p-2 pt-8 font-light-blue">Catálogo</h1>
            <form class="p-2 pt-4" action="catalogo.php" method="get">
                <div class="inline px-1">
                    <p class="inline font-semibold">En </p>
                    <select name="campo" id="campo" class="border-2 rounded-lg  border-blue-950">
                        <option value="1">Nombre</option>
                        <option value="2">Valor</option>
                        <option value="3">Divisa</option>
                        <option value="4">Tipo de moneda</option>
                        <option value="5">Inicio de emisión</option>
                        <option value="6">Final de emisión</option>
                    </select>
                </div>
                <div class="inline px-1">
                    <p class="inline font-semibold">buscar </p>
                    <input type="text" name="valor" id="valor" maxlength="20"required class="border-2 rounded-lg  border-blue-950">
                </div>
                
                <input type="submit" class="px-3 mx-2 rounded-md bg-blue-950 font-semibold">
            </form>
    </section>
    <section class="p-5 w-full h-fit flex flex-row flex-wrap justify-evenly ">
        <?php
        if(empty($gen)){
            echo '<p>No hay monedas con estas características</p>';
        }else{
            while($registrogral=mysqli_fetch_assoc($gen)){

                $nombre= mb_convert_encoding($registrogral['nombre'], "UTF-8", mb_detect_encoding($registrogral['nombre'],"UTF-8, ISO-8859-1, auto"));
                $inicioemision= (int) $registrogral['inicio_emision'];
                $finemision= (int) $registrogral['fin_emision'];
                $id= $registrogral['id_moneda'];
                $id_atributo = $registrogral['id_moneda_atributo'];
                
                $sql="SELECT  direccion
                    FROM imagen 
                    INNER JOIN partes ON partes.id_imagen=imagen.id_imagen
                    WHERE partes.id_moneda_atributo=$id_atributo
                    AND lado='anverso'";
                    $anverso=mysqli_query($conectar,$sql);
                        $imagena=mysqli_fetch_assoc($anverso);
                    if(isset($imagena['direccion'])){
                        $imagen1= mb_convert_encoding($imagena['direccion'], "UTF-8", mb_detect_encoding($imagena['direccion'],"UTF-8, ISO-8859-1, auto"));
                    }else{
                        $imagen1='assets/img/usd-circle.svg';
                    }
                
                $sql="SELECT  direccion
                    FROM imagen 
                    INNER JOIN partes ON partes.id_imagen=imagen.id_imagen
                    WHERE partes.id_moneda_atributo=$id_atributo
                    AND lado='reverso'";
                    $reverso=mysqli_query($conectar,$sql);
                    $imagenr=mysqli_fetch_assoc($reverso);
                    if(isset($imagenr['direccion'])){
                        $imagen2= mb_convert_encoding($imagenr['direccion'], "UTF-8", mb_detect_encoding($imagenr['direccion'],"UTF-8, ISO-8859-1, auto"));
                    }else{
                        $imagen2='assets/img/usd-circle.svg';
                    }
                echo'
                    <a href="moneda.php?moneda='.$id.'">
                        <div class="bg-white w-64  rounded-lg shadow-lg border-light-blue border-2 relative mx-6 my-8 flex flex-col">
                            <img src="'.$imagen2.'" class="pb-4 p-6 z-10 rounded-full">
                            <img src="'.$imagen1.'" class="pb-3 p-6 hover:opacity-5 absolute bottom-20 rounded-full">

                            <p class="pt-2 border-t border-light-blue ">
                            <h5 class="text-center text-lg font-medium font-light-blue">'.$nombre.'</h5>
                            <h6 class="text-center text-sm pb-4 font-light-blue" >'.$inicioemision.'-'.$finemision.'</h6>
                            </p>
                        </div>
                    </a>';
                
            }
        }
            ?>

    </section>
    <?php include  '../../../footer.html';?>
</body>