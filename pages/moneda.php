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


//LADOS
    $sql="SELECT `lado`, `listel`, `efigie`, `leyenda`, `exergo`, `ley`, `grafilia`, `detalles` 
        FROM `partes` 
        INNER JOIN moneda_atributo ON moneda_atributo.id_moneda_atributo=partes.id_moneda_atributo
        WHERE id_moneda='$id'";
    $lados=mysqli_query($conectar,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <title>Moneda</title>
</head>
<?php
if($gral){
    while($general=mysqli_fetch_assoc($gral)){
        if($detalle){
            while($det=mysqli_fetch_assoc($detalle)){
                //variables
                $nombre= wordwrap(utf8_encode($general['nombre']));
                $emisioni= (int) $general['inicio_emision'];
                $emisionf= (int) $general['fin_emision'];
                $valor= $det['valor']; 
                $divisa= wordwrap(utf8_encode($det['nombre']));
                $canto= $det['tipo'];
                $tipomoneda= $det['tipo_moneda'];
                $composicion= wordwrap(utf8_encode($det['composicion']));
                $diametro= $det['diametro'];
                $espesor= $det['espesor'];
                $historia= wordwrap(utf8_encode($det['historia']));
                echo'
                <body>
                <section class="grid grid-cols-4 grid-rows-6 p-5">
                        
                    <h1 class="col-span-2 h-10 text-center text-4xl ">'.$nombre.'</h1>
                    <span class="inline-block col-start-3 col-span-4 row-span-6 m-2 p-4 border-2 rounded-2xl shadow-lg">
                    <h2 class="text-2xl inline-block mb-5 ">Características:</h2>
                    <button class="float-right p-1 px-3  m-1 rounded-xl text-white font-bold text-2xl bg-light-blue">+</button>
                    <p class="text-lg leading-loose">
                        <b>Valor:</b> '.$valor.'
                        <b><br>Divisa:</b> '.$divisa.'
                        <b><br>Años de emisión:</b> '.$emisioni.'-'.$emisionf.'
                        <b><br>Tipo de moneda:</b> '.$tipomoneda.'
                        <b><br>Composición:</b> '.$composicion.'
                        <b><br>Diámetro:</b> '.$diametro.'
                        <b><br>Espesor:</b> '.$espesor.'
                        <b><br>Canto:</b> '.$canto.'
                    </p>
                    </span>';
                    if($lados){
                        while($lado=mysqli_fetch_assoc($lados)){
                            $nombrelado=$lado['lado'];
                            $listel=$lado['listel'];
                            $efigie=$lado['efigie'];
                            $leyenda= wordwrap(utf8_encode($lado['leyenda']));
                            $exergo=$lado['exergo'];
                            $ley=$lado['ley'];
                            $grafilia=$lado['grafilia'];
                            $detalles=$lado['detalles'];

                            $sql="SELECT  direccion
                                FROM imagen 
                                INNER JOIN partes ON partes.id_imagen=imagen.id_imagen
                                INNER JOIN moneda_atributo ON partes.id_moneda_atributo=moneda_atributo.id_moneda_atributo
                                WHERE id_moneda='$id'  
                                AND lado='$nombrelado'";
                            $img=mysqli_query($conectar,$sql);
                            $imagen=mysqli_fetch_assoc($img);
                            if(isset($imagen['direccion'])){
                                $imagenlado= wordwrap(utf8_encode($imagen['direccion']));
                            }else{
                            $imagenlado='assets/img/usd-circle.svg';
                            }
                            echo '
                            <div class="inline-block  row-span-6 p-4 ">
                                <img src="'.$imagenlado.'" class="w-52 mx-6">
                                <h3 class="font-semibold">'.$nombrelado.'</h3>
                                <p class="text-sm">
                                    '.$leyenda.'
                                    <br><b>Listel:</b> '.$listel.'
                                    <br><b>Efigie:</b> '.$efigie.'
                                    <br><b>Exergo:</b> '.$exergo.'
                                    <br><b>Ley:</b> '.$ley.'
                                    <br><b>Grafilia:</b> '.$grafilia.'
                                </p>
                            </div>
                            ';
                        }
                    }
                    echo'
                </section>

                <section  class="border-2 rounded-2xl shadow-lg m-7 p-4">
                    <h2 class="mb-3 text-xl">Historia</h2>
                    <p class="break-words">
                    '.$historia.'
                    </p>
                </section>
                ';
            }
        }
    }        
}
        ?>
   
</body>
</html>

<!-- Tailwind CSS Config -->
<style>
    .bg-dark-blue {
        background-color: #021526;
    }
    .bg-light-blue {
        background-color: #0D3559;
    }
    .bg-white {
        background-color: #FCFFFF;
    }
    .bg-black {
        background-color:  #000911;
    }

    body {
            font-family: 'Radio Canada', sans-serif;
        }
        h1, h2 {
            font-family: 'Patua One', cursive;
        }
   
</style>