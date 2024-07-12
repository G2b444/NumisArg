<?php
include './header.php';
include 'consultasmoneda.php';
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
<body>
<?php

if($gral){
    while($general=mysqli_fetch_assoc($gral)){
        if($detalle){
            while($det=mysqli_fetch_assoc($detalle)){
                //variables
                $nombre= mb_convert_encoding($general['nombre'], "UTF-8", mb_detect_encoding($general['nombre'],"UTF-8, ISO-8859-1, auto"));
                $emisioni= (int) $general['inicio_emision'];
                $emisionf= (int) $general['fin_emision'];
                $valor= $det['valor']; 
                $divisa= mb_convert_encoding($det['nombre'], "UTF-8", mb_detect_encoding($det['nombre'],"UTF-8, ISO-8859-1, auto"));
                $canto= $det['tipo'];
                $tipomoneda= $det['tipo_moneda'];
                $composicion= mb_convert_encoding($det['composicion'], "UTF-8", mb_detect_encoding($det['composicion'],"UTF-8, ISO-8859-1, auto"));
                $diametro= $det['diametro'];
                $espesor= $det['espesor'];
                $historia= mb_convert_encoding($det['historia'], "UTF-8", mb_detect_encoding($det['historia'],"UTF-8, ISO-8859-1, auto"));
                echo'
                <section class="grid grid-cols-4 grid-rows-6 p-5 font-light-blue">
                        
                    <h1 class="col-span-2 h-10 text-center text-4xl ">'.$nombre.'</h1>
                    <span class="inline-block col-start-3 col-span-4 row-span-6 m-2 p-4 border-2 rounded-2xl shadow-lg border-light-blue">
                        <h2 class="text-2xl inline-block mb-5 ">Características:</h2>
                        <button onclick="mostrarguardar()"  class="float-right p-1 px-5 m-1 rounded-full text-white font-bold text-2xl bg-light-blue leading-loose">
                            +
                        </button>
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
                            $leyenda= mb_convert_encoding($lado['leyenda'], "UTF-8", mb_detect_encoding($lado['leyenda'],"UTF-8, ISO-8859-1, auto"));
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
                                $imagenlado= mb_convert_encoding($imagen['direccion'], "UTF-8", mb_detect_encoding($imagen['direccion'],"UTF-8, ISO-8859-1, auto"));
                            }else{
                            $imagenlado='assets/img/usd-circle.svg';
                            }
                            echo '
                            <div class="inline-block  row-span-6 p-4 ">
                                <img src="'.$imagenlado.'" class="w-60 mx-6 rounded-full">
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

                <section  class="border-2 rounded-2xl shadow-lg m-7 p-4  border-light-blue font-light-blue">
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

<div class="relative py-10 pb-20">
    <h1 class="text-center text-3xl mb-10 font-light-blue">Anomalias registradas</h1>
    <div class="relative  rounded-xl sm:h-64 xl:h-80 4xl:h-96">
        <!-- Contenido del carrusel -->
        <div class="carousel-inner">
            <?php
            if ($anomalia){
                while($anom=mysqli_fetch_assoc($anomalia)){
                            $det=$anom['detalle'];
                            $anomaliaid=$anom['id_anomalia'];
                            $anomalianombre=$anom['nombre'];

                            $sql="SELECT `direccion` 
                                FROM `imagen`
                                INNER JOIN lado ON imagen.id_imagen=lado.id_imagen
                                WHERE id_anomalia='$anomaliaid' 
                                AND lado='reverso'";

                            $res=mysqli_query($conectar,$sql);
                            $anomaliaReverso=mysqli_fetch_assoc($res);
                            if(isset($anomaliaReverso['direccion'])){
                                $aReverso= mb_convert_encoding($anomaliaReverso['direccion'], "UTF-8", mb_detect_encoding($anomaliaReverso['direccion'],"UTF-8, ISO-8859-1, auto"));
                            }

                            $sql="SELECT `direccion` 
                                FROM `imagen`
                                INNER JOIN lado ON imagen.id_imagen=lado.id_imagen
                                WHERE id_anomalia='$anomaliaid' 
                                AND lado='anverso'";

                            $res=mysqli_query($conectar,$sql);
                            $anomaliaAnverso=mysqli_fetch_assoc($res);
                            if(isset($anomaliaAnverso['direccion'])){
                                $aAnverso= mb_convert_encoding($anomaliaAnverso['direccion'], "UTF-8", mb_detect_encoding($anomaliaAnverso['direccion'],"UTF-8, ISO-8859-1, auto"));
                            }

                    echo '
                    <!-- Tarjeta 3 -->
                    <div class="carousel-item">
                        <div class="flex justify-center absolute w-full 2xl:h-96 -translate-x-1/2 -translate-y-1/2">
                            <div class="w-1/2 h-full shadow-lg flex flex-col flex-wrap justify-between rounded-xl py-10 bg-light-blue">
                                <span class="flex flex-row justify-evenly">
                                    <img src="'.$aAnverso.'" class="w-52 rounded-full">
                                    <img src="'.$aReverso.'" class="w-52 rounded-full">
                                </span>
                                <h2 class="text-2xl px-10 pt-5 text-white">'.$anomalianombre.'</h2>
                                <p class="text-xl pt-3 px-10 text-white">'.$det.'</p>   
                            </div>
                        </div>
                    </div>
                    ';

                }
            }
            echo '<p class="text-2xl p-20 py-32 text-center">No se han registrado anomalias para esta moneda</p>';
            ?>
        <!-- ... -->
        </div>
        <!-- Botones de navegación -->
        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center pl-44 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-10 h-10 text-black sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="hidden">Anterior</span>
        </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center pr-44 h-full cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex justify-center items-center w-10 h-10 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-10 h-10 text-black sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="hidden">Siguiente</span>
        </span>
        </button>
    </div>
</div>

<div id="guardar" class="w-1/3 h-fit bg-white hidden top-28 right-1/3 rounded-2xl shadow-xl border-light-blue border">
    <h2 class="text-center text-2xl mt-10 font-light-blue">Guardar moneda</h2> 
    <form action="guardarmoneda.php" method="post" class="flex flex-col h-full p-5">

        <label class="flex flex-row m-2 border-2 border-light-blue rounded-full w-4/5 place-self-center px-1">
            <img src="./assets/cantidadmoneda.png" class="w-5 m-1">
            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" class="border-0 bg-transparent w-full outline-none" maxlength="3" required>
        </label>
        <label class="flex flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1">
            <img src="./assets/valormercado.png" class="w-6 m-1">    
            <input type="number" name="valor" id="valor" placeholder="Valor de mercado (en USD)" class="border-0 bg-transparent w-full outline-none " maxlength="8" required>
        </label>
        <?php
        echo '
        <input type="hidden" name="usuario" id="usuario" value="1">
        <input type="hidden" name="moneda" id="moneda" value="'.$id.'">
        ';
        ?>
        <label class="flex flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1">
            <img src="./assets/billetera.svg" class="w-6 m-1">
            <select name="estado" id="estado" class="border-0 bg-transparent w-full rounded-lg outline-none">
                <option value="">Estado de moneda</option>
                <?php
                if($estado){
                    while($est = mysqli_fetch_array($estado)){
                        echo '<option value="'.$est['id_estado'].'">'.$est['estado'].'</option>';
                    }
                }
                ?>
            </select>
        </label>

        <label id="cont-anomalia" class="hidden flex-row m-2 border-2 border-light-blue rounded-full w-4/5 place-self-center px-1">
            <img src="./assets/token.png" class="w-6 m-1">
            <select name="anomalia" id="anomalia" class="border-0 bg-transparent w-full rounded-lg outline-none ">
                <?php
                 echo '<option value="">Seleccionar anomalía</option>';
                $anomaliascol= mysqli_num_rows($anomalia);
                    while($anomselect=mysqli_fetch_assoc($anomaliaselect)){
                        $anomaliaid= $anomselect['id_anomalia'];
                        $anomalianombre= $anomselect['nombre'];
                       
                       echo'<option value="'.$anomaliaid.'">'.$anomaliaid.'='.$anomalianombre.'</option>';
                    }
                ?>

            </select>
        </label>

        <label class="flex flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1">
            <img src="./assets/anomalia.svg" class="w-6 m-1">
            <select name="coleccion" id="coleccion" class="border-0 bg-transparent w-full rounded-lg outline-none">
                <option value="">Colección a guardar</option>
                <?php
                if($coleccion){
                    while($col = mysqli_fetch_assoc($coleccion)){
                        echo '<option value="'.$col['id_coleccion'].'">'.$col['nombre'].'</option>';
                    }
                }
                ?>
                <option value="0">Nueva colección</option>
            </select>
        </label>
        <label id="cont-coleccion" class="hidden flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1 pl-8">
            <input type="text" name="nuevacoleccion" id="nuevacoleccion" placeholder="Nombre de colección" class="border-0 bg-transparent w-full outline-none " maxlength="20">
        </label>
        <label class="w-full flex justify-evenly">
            <input type="submit" class="m-2 border-2 border-light-blue rounded-full px-1 w-1/3 mt-8 place-self-center bg-light-blue text-white text-lg font-patua">
            <button type="button" onclick="cerrarguardar()" class="m-2 border-2 border-light-blue rounded-full px-1 w-1/3 mt-8 place-self-center bg-light-blue text-white text-lg font-patua">Cancelar</button>
        </label>
    </form>
</div>
<?php
include './../footer.html';
?>
<script> 
//carrusel
    // Selecionar los elementos del carrusel
    const carouselInner = document.querySelector('.carousel-inner');
    const carouselItems = document.querySelectorAll('.carousel-item');
    const prevButton = document.querySelector('[data-carousel-prev]');
    const nextButton = document.querySelector('[data-carousel-next]');

    // Establecer el índice actual del carrusel
    let currentIndex = 0;

    // Función para mostrar la tarjeta actual
    function showCurrentItem() {
    carouselItems.forEach((item, index) => {
        item.classList.toggle('hidden', index !== currentIndex);
    });
    }

    // Función para avanzar al siguiente elemento
    function nextItem() {
    currentIndex = (currentIndex + 1) % carouselItems.length;
    showCurrentItem();
    }

    // Función para retroceder al elemento anterior
    function prevItem() {
    currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
    showCurrentItem();
    }

    // Agregar eventos a los botones de navegación
    prevButton.addEventListener('click', prevItem);
    nextButton.addEventListener('click', nextItem);

    // Mostrar la tarjeta actual al inicio
    showCurrentItem();

//formulario guardar moneda
    //mostrar formulario
    function mostrarguardar(){
        document.getElementById("guardar").style.display = "block";
        document.getElementById("guardar").style.position = "absolute";
    }
    //cerrar formulario
    function cerrarguardar(){
        document.getElementById("guardar").style.display = "none";
    }
    
    //mostrar el input de anomalia
    var anomaliascol = "<?php echo $anomaliascol; ?>";
    if(anomaliascol > 0){
        document.getElementById("cont-anomalia").style.display = "flex";
    }

    //mostrar el input de coleccion nueva
    const coleccionSelect = document.getElementById("coleccion");
    coleccionSelect.addEventListener("change", function() {
        const selectedValue = this.value;
        if (selectedValue == '0') {
            document.getElementById("cont-coleccion").style.display = "flex";
        } else {
            document.getElementById("cont-coleccion").style.display = "none";
        }
    });

</script>
</body>
</html>