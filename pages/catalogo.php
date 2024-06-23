<?php
include 'conexion.php';

$sql="SELECT moneda.nombre, inicio_emision, fin_emision, direccion 
FROM moneda 
INNER JOIN moneda_atributo ON moneda.id_moneda=moneda_atributo.id_moneda
INNER JOIN partes ON moneda_atributo.id_moneda_atributo=partes.id_moneda_atributo
INNER JOIN imagen ON partes.id_imagen=imagen.id_imagen";
$general= mysqli_query($conectar,$sql);
$campo=0;

if($_GET){
    $campo= $_GET['campo'];
    $valor= $_GET['valor'];
}

switch($campo){
    case 1:
        $sql="SELECT moneda.nombre, inicio_emision, fin_emision, direccion 
        FROM moneda 
        INNER JOIN moneda_atributo ON moneda.id_moneda=moneda_atributo.id_moneda
        INNER JOIN partes ON moneda_atributo.id_moneda_atributo=partes.id_moneda_atributo
        INNER JOIN imagen ON partes.id_imagen=imagen.id_imagen
        WHERE moneda.nombre='.$valor.'";
        $general= mysqli_query($conectar,$sql);
        echo $valor;
    break;
    case 2:
        
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
    <section class="w-full h-fit p-5 px-16">
        <h1 class="text-5xl p-2 font-semibold">Catálogo</h1>
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
    <section class="p-5 w-full h-fit flex flex-row flex-wrap justify-evenly">
        <?php
        if($general){
            while($registrogral=mysqli_fetch_assoc($general)){

                $nombre= $registrogral['nombre'];
                $inicioemision= (int) $registrogral['inicio_emision'];
                $finemision= (int) $registrogral['fin_emision'];
                $imagen= $registrogral['direccion'];

                echo'
                    <div class="bg-white w-52  p-4 px-8 rounded-lg shadow-lg border border-blue-950	 mx-6 my-8 flex flex-col">
                    <img src="'.$imagen.'" class="pb-3">
                    <p class="pt-2 border-t border-blue-950	">
                    <h5 class="text-center text-lg font-medium"><a href="">'.$nombre.'</a></h5>
                    <h6 class="text-center text-sm">'.$inicioemision.'-'.$finemision.'</h6>
                    </p>
                    </div>';
                }
            }
            ?>

    </section>
</body>
</html>