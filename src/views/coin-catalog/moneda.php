<?php
include '../../../header.php';
include 'consultasmoneda.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <title>Moneda</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="../../js/funciones.js"></script>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="modal-overlay" id="modal-overlay"></div>
<div class="modal" id="add-anomala-collection-success">
    <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
        <h1 class="mb-6 text-lg">¡Moneda anomala guardada de forma éxitosa!</h1>
        <div class="flex justify-around">
            <button onclick="closeModal('add-anomala-collection-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
        </div>
    </div>
</div>
<div class="modal" id="add-coin-collection-success">
    <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
        <h1 class="mb-6 text-lg">¡Moneda guardada de forma éxitosa!</h1>
        <div class="flex justify-around">
            <button onclick="closeModal('add-coin-collection-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
        </div>
    </div>
</div>
<div class="modal" id="select-collection">
    <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
        <h1 class="mb-6 text-lg">!Debe seleccionar una colección para guardar esta moneda!</h1>
        <div class="flex justify-around">
            <button onclick="closeModal('select-collection')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
        </div>
    </div>
</div>
<div class="modal" id="inicio-exitoso">
    <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
        <h1 class="mb-6 text-lg">!Inicio sesión éxitoso!</h1>
        <h1 class="mb-6 text-lg">¡Ahora puedes añadir la moneda a tu colección!</h1>
        <div class="flex justify-around">
            <button onclick="closeModal('inicio-exitoso')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
        </div>
    </div>
</div>
<?php

if($gral){
    while($general=mysqli_fetch_assoc($gral)){
        if($detalle){
            while($det=mysqli_fetch_assoc($detalle)){
                //variables
                $nombre= mb_convert_encoding($general['nombre'], "UTF-8", mb_detect_encoding($general['nombre'],"UTF-8, ISO-8859-1, auto"));
                $emisioni= (int) $general['inicio_emision'];
                $emisionf= (int) $general['fin_emision'];
                $valor= $det['valor_nominal']; 
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

                            //características de cada lado
                            $nombrelado=$lado['lado'];
                            $detalles= mb_convert_encoding($lado['detalles'], "UTF-8", mb_detect_encoding($lado['detalles'],"UTF-8, ISO-8859-1, auto"));

                            //convertir cadena de texto detalles a segmentos
                            $secciones = explode("-", $detalles);
                            $seccionescant = count($secciones);

                            //array de características propias de cada lado
                            $tiposanverso = array("Listel", "Efigie", "Leyenda", "Grafilia");
                            $tiposreverso = array("Listel", "Exergo", "Leyenda", "Grafilia");

                            //buscar la imagen de cada lado
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
                            $imagenlado='../../assets/icon/usd-circle.svg';
                            }

                            //saber qué lado es para ajustar las especificaciones
                            if($nombrelado == 'anverso'){
                                $tipos = $tiposanverso;
                            }else{
                                $tipos = $tiposreverso;
                            }
                            $tiposcant = count($tipos);
                            
                            //ajustar la cantidad de registros mostrados según la cantidad de secciones y tipos
                            if($tiposcant <= $seccionescant){
                                $contar = $tiposcant;
                            }
                            if($tiposcant > $seccionescant){
                                $contar = $seccionescant;
                            }
                            //mostrar los lados
                            echo '
                            <div class="inline-block  row-span-6 p-4 ">
                                <img src="'.$imagenlado.'" class="w-60 mx-6 rounded-full">
                                <h3 class="font-semibold">'.$nombrelado.'</h3>
                                <p class="text-sm">';
                                for($n=0;$n<$contar;$n++){
                                    echo "<br><b>";
                                    echo $tipos[$n];
                                    echo ": </b>";
                                    echo $secciones[$n];
                                }
                                echo'</p>
                            </div>
                            ';
                        }
                    }
                    //historia de la moneda
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

                            $sql="SELECT 
                                    MAX(CASE WHEN lado.lado = 'anverso' THEN imagen.direccion END) AS anverso,
                                    MAX(CASE WHEN lado.lado = 'reverso' THEN imagen.direccion END) AS reverso
                                FROM `imagen`
                                INNER JOIN lado ON imagen.id_imagen=lado.id_imagen
                                WHERE id_anomalia= $anomaliaid;";

                            $res=mysqli_query($conectar,$sql);
                            $res=mysqli_fetch_assoc($res);
                            $aAnverso = $res['anverso'];
                            $aReverso = $res['reverso'];
                            

                            echo '<div class="carousel-item">
                            <div class="flex justify-center absolute w-full 2xl:h-96 -translate-x-1/2 -translate-y-1/2">
                                <div class="w-1/2 h-full shadow-lg flex flex-col justify-between rounded-xl py-10 bg-light-blue">
                                    <span class="flex flex-row justify-evenly">
                                        <img src="' . htmlspecialchars($aAnverso, ENT_QUOTES, 'UTF-8') . '" class="w-48 h-48 mx-6 object-cover rounded-full">
                                        <img src="' . htmlspecialchars($aReverso, ENT_QUOTES, 'UTF-8') . '" class="w-48 h-48 mx-6 object-cover rounded-full">
                                    </span>
                                    <h2 class="text-2xl px-10 pt-5 text-white">' . htmlspecialchars($anomalianombre, ENT_QUOTES, 'UTF-8') . '</h2>
                                    <p class="text-xl pt-3 px-10 text-white">' . htmlspecialchars($det, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>
                        </div>';

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
            <img src="../../assets/icon/cantidadmoneda.png" class="w-5 m-1">
            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" class="border-0 bg-transparent w-full outline-none" maxlength="3" required>
        </label>
        <label class="flex flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1">
            <img src="../../assets/icon/valormercado.png" class="w-6 m-1">    
            <input type="number" name="valor" id="valor" placeholder="Valor de mercado (en USD)" class="border-0 bg-transparent w-full outline-none " maxlength="8" required>
        </label>
        <?php
        echo '
        <input type="hidden" name="usuario" id="usuario" value="1">
        <input type="hidden" name="moneda" id="moneda" value="'.$id.'">
        ';
        ?>
        <label class="flex flex-row m-2 border-2 border-light-blue w-4/5 place-self-center rounded-full px-1">
            <img src="../../assets/icon/billetera.svg" class="w-6 m-1">
            <select name="estado" id="estado" class="border-0 bg-transparent w-full rounded-lg outline-none" required>
                <option value="" selected disabled>Estado de moneda</option>
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
            <img src="../../assets/icon/token.png" class="w-6 m-1">
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
            <img src="../../assets/icon/anomalia.svg" class="w-6 m-1">
            <select name="coleccion" id="coleccion" class="border-0 bg-transparent w-full rounded-lg outline-none" required>
                <option value="" selected disabled>Colección a guardar</option>
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
include '../../../footer.html';
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
    var usuarioId = <?=isset($_SESSION['id_usuario']) ? 'true' : 'false' ?>;
    if(usuarioId){
        function mostrarguardar(){
            //mostrar formulario
            document.getElementById("guardar").style.display = "block";
            document.getElementById("guardar").style.position = "absolute";
        }
    }else{
        function mostrarguardar(){
            //Almacenamiento del id moneda y redireccionamiento al login
            <?php $_SESSION['id_moneda'] = $_GET['moneda']?>
            window.location= "../login";
        }
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
<?php 
if(isset($_GET['success'])){

    $proceso = $_GET['success'];

    switch ($proceso) {
        case 'añadir_moneda_anomala_coleccion':
            echo "<script>openModal('add-anomala-collection-success');</script>";
            break;

        case 'añadir_moneda_coleccion':
            echo "<script>openModal('add-coin-collection-success');</script>";
            break;

        case 'seleccione_coleccion':
            echo "<script>openModal('select-collection');</script>";
            break;

        case 'inicio-exitoso':
            echo "<script>openModal('inicio-exitoso');</script>";
            break;
    }

    echo "
    <script>
        function removeFromChar(url, char) {
            let index = url.indexOf(char);
            if (index !== -1) {
                return url.substring(0, index);
            }
            return url;
        }

        let currentUrl = window.location.href;
        let modifiedUrl = removeFromChar(currentUrl, '&');

        // Actualiza la URL en la barra de direcciones del navegador
        window.history.replaceState({}, '', modifiedUrl);
    </script>";
}

?>
