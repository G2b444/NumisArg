<?php 
include("../../inc/conexion.php");
include '../../../header.php';
if(!isset($_SESSION['id_usuario'])) {
    echo '<script>window.location="./../../../index.php";</script>';
}
$id = $_SESSION['id_usuario'];

// Información del perfil (funciona)
$perfil = "SELECT usuario.nombre, usuario.fecha_inicio, GROUP_CONCAT(coleccion.id_coleccion) AS ids,
COUNT(coleccion.id_coleccion) AS numero_coleccion 
FROM usuario LEFT JOIN coleccion ON usuario.id_usuario = coleccion.id_usuario 
WHERE usuario.id_usuario = $id GROUP BY usuario.id_usuario;";
$res_perfil = mysqli_query($conectar, $perfil);

if(!$res_perfil){
    echo 'No se pudo cargar la información';
}else{
    $info = mysqli_fetch_assoc($res_perfil);

    $u = $info['nombre'];
    $f = $info['fecha_inicio'];
    $m = $info['numero_coleccion'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Cuenta</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="../../js/funciones.js"></script>
    <link rel="stylesheet" href="../../style.css">

    <script>
    // Mostrar sección por defecto al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
    // Mostrar sección por defecto al cargar la página
    showSection('colecciones'); // Mostrar sección colecciones por defecto

    // Añadir evento de clic al botón de selección
    document.getElementById('seleccionar').addEventListener('click', function() {
        toggleSelectionGrid();
    });

    // Añadir eventos de clic a todos los botones con la clase 'btn-action'
    document.querySelectorAll('.btn-action').forEach(button => {
        button.addEventListener('click', function() {
            var selectedIds = [];
            document.querySelectorAll('.selection-checkbox:checked').forEach(function(checkbox) {
                selectedIds.push(checkbox.value);
            });

            var action = this.getAttribute('data-action'); // Obtener la acción (customize o delete)

            // Enviar los datos seleccionados a PHP
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'process_changes.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_ids';
            input.value = JSON.stringify(selectedIds);
            form.appendChild(input);

            var actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            document.body.appendChild(form);
            form.submit();
        });
    });

    });

// Función para mostrar y ocultar la rejilla de selección
function toggleSelectionGrid() {
    document.querySelectorAll('.selection-grid').forEach(grid => {
        grid.classList.toggle('hidden');
    });
}

// Función para mostrar secciones según el clic en el menú lateral
function showSection(sectionId) {
    const sections = document.querySelectorAll('section');
    sections.forEach(section => section.style.display = 'none');

    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}

// Función para cargar la colección seleccionada
function loadCollection(id_coleccion) {
    if (id_coleccion == "") {
        document.getElementById("collection-content").innerHTML = "";
        return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.status == 200) {
            document.getElementById("collection-content").innerHTML = this.responseText;
        } else {
            document.getElementById("collection-content").innerHTML = "Error al cargar la colección.";
        }
    }
    xhttp.open("GET", "get_collection.php?id_coleccion=" + id_coleccion, true);
    xhttp.send();
}

// Validar formularios de perfil y seguridad
function validarFormulario1(event) {
    let usuario = document.getElementsByName('usuario')[0].value;
    let correo = document.getElementsByName('correo')[0].value;
    let contraseña = document.getElementsByName('contraseña')[0].value;

    if (usuario === '' || correo === '' || contraseña === '') {
        alert('Por favor, complete todos los campos del primer formulario.');
        event.preventDefault();
    }
}

function validarFormulario2(event) {
    let con_nueva = document.getElementsByName('con_nueva')[0].value;
    let rep_con_nueva = document.getElementsByName('rep_con_nueva')[0].value;
    let con_act = document.getElementsByName('con_act')[0].value;

    if (con_nueva === '' || rep_con_nueva === '' || con_act === '') {
        alert('Por favor, complete todos los campos del segundo formulario.');
        event.preventDefault();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form1 = document.querySelector('#form1');
    const form2 = document.querySelector('#form2');

    form1.addEventListener('submit', validarFormulario1);
    form2.addEventListener('submit', validarFormulario2);
});


// Cerrar modal de añadir coleccion
function cerrarAddCollection() {
        document.getElementById('addCollection').classList.add('hidden');
    }

//averiguar el id de coleccion
document.addEventListener('DOMContentLoaded', () => {
    const select = document.querySelector('#colecciones-select');
    const buttonAdd = document.querySelector('#add-collection');

    // Evento para el botón de añadir colección
    buttonAdd.addEventListener('click', (e) => {
        document.getElementById('addCollection').classList.remove('hidden');
    });

    

    // Evento para el botón de eliminar colección
    buttonDelete.addEventListener('click', (e) => {
        e.preventDefault();
        let id_coleccion = select.value;
        if (!id_coleccion) {
            alert('Por favor selecciona una colección.');
            return;
        }
        enviarFormulario('del', id_coleccion);
    });

    function enviarFormulario(action, id_coleccion) {
        // Crear un formulario dinámicamente
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'process_changes.php';

        // Crear un campo oculto para el id_coleccion
        const inputIdColeccion = document.createElement('input');
        inputIdColeccion.type = 'hidden';
        inputIdColeccion.name = 'id_coleccion';
        inputIdColeccion.value = id_coleccion;
        form.appendChild(inputIdColeccion);

        // Crear un campo oculto para la acción
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);

        // Agregar el formulario al body y enviarlo
        document.body.appendChild(form);
        form.submit();
    }
});


/* $(document).ready(function() {
        // Escuchar el evento change del select con id 'colecciones'
        $('#colecciones').on('change', function() {
            var selectedValue = $(this).val();
            console.log('Valor seleccionado:', selectedValue);
        });
    }); */
    </script>
    <style>
         @font-face {
            font-family: 'MiFuente';
            src: url('font/PatuaOne-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'MiFuente', sans-serif;
        }
        .bg-customBlue {
            background-color: #021526;
        }

        .bg-customBlue2{
            background-color: #0D3559;
        }

        .perspective {
            perspective: 1000px;
        }
        .transform-style-preserve-3d {
            transform-style: preserve-3d;
        }
        .backface-hidden {
            backface-visibility: hidden;
        }
    </style>
</head>
<body class="h-screen flex flex-col">

<div class="modal-overlay" id="modal-overlay"></div>
<div class="modal" id="add-collection-success">
    <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
        <h1 class="mb-6 text-lg">¡Colección Agregada de forma éxitosa!</h1>
        <div class="flex justify-around">
            <button onclick="closeModal('add-collection-success')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
        </div>
    </div>
</div>
    
<div id="addCollection" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="w-1/3 bg-white rounded-2xl shadow-xl border-light-blue border p-5">
            <h1 class="text-center text-2xl mt-10 font-light-blue">Agregar Nueva Colección</h1> 
            <form action="agregar_coleccion.php" method="post" class="flex flex-col">
    
                <label class="flex flex-row m-4 border-2 border-light-blue w-4/5 mx-auto rounded-lg px-2 py-2">
                    <input type="text" name="nuevacoleccion" id="nuevacoleccion" placeholder="Nombre de colección" class="border-0 bg-transparent w-full outline-none px-2 py-2" maxlength="20" required>
                </label>                
    
                <div class="flex justify-between mt-8">
                    <input type="submit" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg font-patua cursor-pointer" value="Guardar">
                    <button type="button" onclick="cerrarAddCollection()" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg font-patua cursor-pointer">Cancelar</button>
                </div>
            </form>
        </div>
</div>

    <!-- Contenedor principal para el aside y el contenido dinámico -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Menú lateral -->
        <aside class="w-96 mt-0.5 bg-customBlue text-white text-3xl justify-center items-center p-4 overflow-y-auto">
            <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('perfil')">
                <img src="../../assets/icon/user.png" alt="Perfil" class="w-10 h-10 mr-4">Perfil
            </div>
            <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('colecciones')">
                <img src="../../assets/icon/wallet.png" alt="Colecciones" class="w-10 h-10 mr-4">Colecciones
            </div>
            <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('configuracion')">
                <img src="../../assets/icon/customize.png" alt="" class="w-10 h-10 mr-4">Configuración
            </div>
        </aside>

        <!-- Contenido dinámico -->
        <div class="flex-1 mt-0.5 overflow-y-auto">
            <section class="w-full p-16 hidden mt-0.5" id="perfil">
                <h1 class="text-4xl m-4">Perfil</h1>
                <hr class="border-t-2 border-gray-400">
                <h2 class="text-2xl ml-12">Usuario: <?php echo htmlspecialchars($u); ?></h2>
                <p class="text-2xl ml-12">Usted es miembro desde: <?php echo htmlspecialchars($f); ?><br>
                Ha creado un total de: <?php echo htmlspecialchars($m); ?> colecciones.
                </p>
            </section>

            <section class="w-full h-full pt-8 hidden mt-0.5" id="colecciones">
                <div class="flex flex-row justify-between border-b-2 border-black">
                    <div>
                        <h1 class="text-4xl m-2">Colecciones</h1>
                    </div>
                    <div id="colecciones-form">
                        <button id="add-collection" name="add" data-action="add">
                            <img src="../../assets/icon/plus.png" class="w-8 h-8">
                        </button>
                        <button id="delete-collection" onclick="document.getElementById('delete-collection-Modal').style.display='flex'"  name="del" data-action="del">
                            <img src="../../assets/icon/trash 4.png" alt="Eliminar" class="w-8 h-8 mr-10">
                        </button>
                    </div>
                </div>
                <?php
                // Verificación de colecciones
                $sql_colec = "SELECT c.id_coleccion, c.nombre FROM coleccion c WHERE c.id_usuario = $id ORDER BY id_coleccion DESC";
                $res_colec = mysqli_query($conectar, $sql_colec);

                if (!$res_colec) {
                    echo 'No funciona la consulta';
                } elseif (mysqli_num_rows($res_colec) > 0) {
                    echo '<div class="relative">';
                    echo '<select id="colecciones-select" placeholder="Colecciones" class="h-12 block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="colecciones" onchange="loadCollection(this.value)">';
                    echo '<option disabled selected value="0" h-0> Colecciones </option>';
                    while ($row = mysqli_fetch_assoc($res_colec)) {
                        $id_coleccion = $row['id_coleccion'];
                        $nombre_coleccion = htmlspecialchars($row['nombre']);
                        echo "<option id='id_coleccion-currently' class='h-24' value='$id_coleccion'>$nombre_coleccion</option>";
                    }
                    echo '</select>';
                    echo '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">';
                    echo '<img src="../../assets/icon/flecha.png" alt="Flecha" class="h-2 w-2">';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo 'No se encontraron colecciones para el usuario.';
                }
                ?>

                <!-- Modal de Eliminación de coleccion -->
                <div id="delete-collection-Modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl border-light-blue border p-5 max-h-screen overflow-y-auto">
        <h1 class="text-center text-2xl font-light-blue mt-4">Eliminar Colecciones</h1>
        <form action="eliminar_colecciones.php" method="post" class="flex flex-col mt-4">
            <div id="itemList" class="flex flex-col space-y-2 max-h-96 overflow-y-auto">
                <?php foreach ($res_colec as $filas) { ?>
                    <label class="flex items-center space-x-2 border-2 border-light-blue rounded-lg p-2">
                        <input type="checkbox" name="items[]" value="<?= $filas['id_coleccion']?>" class="form-checkbox">
                        <span><?= $filas['nombre']?></span>
                    </label>
                <?php } ?>
            </div>
            <div class="flex justify-between mt-8">
                <button type="submit" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg cursor-pointer">Eliminar</button>
                <button type="button" onclick="document.getElementById('delete-collection-Modal').style.display='none'" class="m-2 border-2 border-light-blue rounded-full px-4 py-2 w-1/2 bg-light-blue text-white text-lg cursor-pointer">Cancelar</button>
            </div>
        </form>
    </div>
</div>


                <div class="flex flex-row justify-end items-end gap-5 bg-customBlue2 p-2">
                                <!--En proceso-->
                    <button class="btn-action" data-action="customize">
                        <img src="../../assets/icon/customize.png" class="w-8 h-8">
                    </button>
                    <button class="mr-8 btn-action" data-action="delete">
                        <img src="../../assets/icon/trash.png" class="w-8 h-8">
                    </button>
                </div>

                <div class="flex justify-end bg-customBlue2">
                    <button id="seleccionar" class="bg-currentColor text-white text-xl mr-8 border border-gray rounded-3xl p-2">Seleccionar</button>
                </div>

                <div class="pt-4 h-full bg-customBlue2" id="collection-content"></div>
            </section>

        <section class="w-full p-16 hidden mt-0.5" id="configuracion">
            <h1 class="text-4xl m-4 font-normal">Configuración</h1>
            <hr class="border-t-2 border-gray-400">
            
            <div class="grid grid-cols-2 grid-flow-col gap">
                <div class="mt-8 w-96 h-64">
                    <form action="../login/cambio.php" method="post" class="mt-4 grid grid-rows grid-rows-col gap-0.5" id="form1">
                        <h2 class="text-3xl font-normal">Perfil</h2>

                        <div class="relative my-6">
                            <input type="text" required name="usuario" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 shadow focus:outline-none focus:shadow-outline" placeholder="Nombre de usuario">
                            <img src="../../assets/icon/image 4.png" alt="Icono Usuario" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <div class="relative my-6">
                            <input type="email" required name="correo" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 shadow focus:outline-none focus:shadow-outline" placeholder="Correo (verificación)">
                            <img src="../../assets/icon/image 5.png" alt="Icono Correo" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <div class="relative my-6">
                            <input type="password" required name="contraseña" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña (verificación)">
                            <img src="../../assets/icon/image 6.png" alt="Icono Contraseña" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <input type="submit" value="Actualizar" name="a1" class="bg-customBlue2 text-white font-bold py-2 px-4 rounded-3xl ml-2 w-32 mt-2">
                    </form>
                </div>

                <div class="mt-8 w-96 h-64">
                    <form action="../login/cambio.php" method="post" class="mt-4 grid grid-rows grid-rows-col gap-0.5" id="form2">
                        <h2 class="text-3xl  font-normal">Seguridad</h2>

                        <div class="relative my-6">
                            <input type="password" required name="con_nueva" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2  shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña nueva">
                            <img src="../../assets/icon/image 6.png" alt="Icono Nueva Contraseña" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <div class="relative my-6">
                            <input type="password" required name="rep_con_nueva" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2  shadow focus:outline-none focus:shadow-outline" placeholder="Repetir contraseña">
                            <img src="../../assets/icon/image 6.png" alt="Icono Repetir Nueva Contraseña" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <div class="relative my-6">
                            <input type="password" required name="con_act" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña actual">
                            <img src="../../assets/icon/image 6.png" alt="Icono Contraseña Actual" class="absolute left-3 top-2.5 w-6 h-6">
                        </div>

                        <input type="submit" value="Actualizar" name="a2" class="bg-customBlue2 text-white font-bold py-2 px-4 rounded-3xl ml-2 w-32 mt-2">
                    </form>
                </div>
            </div>
        </section>
    </div>

</body>
</html>

<?php 

if(isset($_GET['success'])){

    $proceso = $_GET['success'];

    switch ($proceso) {
        case 'agregar_coleccion':
            echo "<script>openModal('add-collection-success');</script>";
            break;

        case 'eliminar_coleccion':
            echo "<script>openModal('delete-collection-success');</script>";
            break;
            
        case 'eliminar_moneda':
            echo "<script>openModal('delete-coin-success');</script>";
            break;
            
        case 'eliminar_moneda':
            echo "<script>openModal('delete-coin-success');</script>";
            break;

    }

    echo "<script>window.history.replaceState({}, '', 'main.php');</script>";
}

?>