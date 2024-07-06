<?php 
include("../libreria/conexion.php");
session_start();
$id = $_SESSION['id_usuario'];

// Información del perfil (funciona)
$perfil = "SELECT usuario.nombre, usuario.fecha_inicio, COUNT(coleccion.id_coleccion) AS numero_coleccion
FROM usuario
LEFT JOIN coleccion ON usuario.id_usuario = coleccion.id_usuario
WHERE usuario.id_usuario = $id";
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Cuenta</title>
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('section');
            sections.forEach(section => section.style.display = 'none');

            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('colecciones'); // Mostrar sección perfil por defecto
        });

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

    const form1 = document.querySelector('#form1');
    const form2 = document.querySelector('#form2');

    form1.addEventListener('submit', validarFormulario1);
    form2.addEventListener('submit', validarFormulario2);




    </script>
    <style>
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
<body class="bg-white">
    <!-- parte superior-->
    <nav class="flex w-full h-105 bg-customBlue justify-between items-center">
        <img src="../images/LOGO.svg" alt="Logo" class="w-24 h-24 p-2 pb-0 ml-10 items-end"> <!--logo-->
        <div class="flex text-white p-10 text-xl">
            <a href="#" class="ml-4">Catálogo</a>
            <a href="#" class="ml-4">Contáctanos</a>
            <a href="../libreria/delsession.php" class="ml-4">Cerrar sesión</a>
        </div>
    </nav>


    <!-- barra lateral-->
    <div class="flex flex-row h-screen mt-0.5">

    <!-- Menú lateral -->
    <aside class="w-96 h-screen bg-customBlue text-white text-3xl justify-center items-center p-4">
        <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('perfil')"><img src="../images/user.png" alt="Perfil" class="w-10 h-10 mr-4 ">Perfil</div>
        <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('colecciones')"><img src="../images/wallet.png" alt="Colecciones" class="w-10 h-10 mr-4">Colecciones</div>
        <div class="flex flex-row items-center my-0.5 p-8 content-center cursor-pointer border-b border-gray" onclick="showSection('configuracion')"><img src="../images/customize.png" alt="" class="w-10 h-10 mr-4">Configuración</div>
    </aside>

    <!-- Contenido dinámico -->
    <section class="w-full p-16 hidden mt-0.5" id="perfil">
        <h1 class="text-4xl m-4">Perfil</h1>
        <hr class="border-t-2 border-gray-400">
        <h2 class="text-2xl ml-12">Usuario: <?php echo htmlspecialchars($u); ?></h2>
        <p class="text-2xl ml-12">Usted es miembro desde: <?php echo htmlspecialchars($f); ?><br>
        Ha coleccionado un total de: <?php echo htmlspecialchars($m); ?> monedas.
        </p>
    </section>

    <section class="w-full pt-8 hidden mt-0.5" id="colecciones">
        <div class="flex flex-row justify-between border-b-2 border-black">
            <div>
                <h1 class="text-4xl m-2 ">Colecciones</h1>
            </div>
            <div class="flex flex-row gap-5">
                <a href="monedas.php"><img src="../images/plus.png"  class="w-8 h-8 "></a>
                <a href="monedas.php"><img src="../images/trash 4.png" alt="Eliminar" class="w-8 h-8 mr-2"></a>
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
            echo '<select id="colecciones" placeholder="Colecciones" class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="colecciones" onchange="loadCollection(this.value)">';
            echo '<option disabled selected value="0"> Colecciones </option>';
            while ($row = mysqli_fetch_assoc($res_colec)) {
                $id_coleccion = $row['id_coleccion'];
                $nombre_coleccion = htmlspecialchars($row['nombre']);
                echo "<option value='$id_coleccion'>$nombre_coleccion</option>";
            }
            echo '</select>';
            echo '<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">';
            echo '<img src="../images/flecha.png" alt="Flecha" class="h-2 w-2">';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No se encontraron colecciones para el usuario.';
        }
        ?>
        <div class="mt-4" id="collection-content"></div>
    </section>

    <section class="w-full p-16 hidden mt-0.5" id="configuracion">
        <h1 class="text-4xl m-4 font-normal">Configuración</h1>
        <hr class="border-t-2 border-gray-400">
        
        <div class="grid grid-cols-2 grid-flow-col gap">

            <div class="mt-8 w-96 h-64 ">
                <form action="../php/cambio.php" method="post" class="mt-4 grid grid-rows grid-rows-col gap-0.5">
                    <h2 class="text-3xl font-normal">Perfil</h2>

                    <div class="relative my-6">
                        <input type="text" required name="usuario" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Nombre de usuario">
                        <img src="../images/image 4.png" alt="Icono Usuario" class="absolute left-3 top-2.5 w-6 h-6">
                    </div>

                    <div class="relative my-6">
                        <input type="email" required name="correo" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Correo">
                        <img src="../images/image 5.png" alt="Icono Correo" class="absolute left-3 top-2.5 w-6 h-6">
                    </div>

                    <div class="relative my-6">
                        <input type="password" required name="contraseña" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña">
                        <img src="../images/image 6.png" alt="Icono Contraseña" class="absolute left-3 top-2.5 w-6 h-6">
                    </div>

                    <input type="submit" value="Actualizar" name="a1" class="bg-customBlue2 text-white font-bold py-2 px-4 rounded-3xl ml-2 w-32 mt-2">

                </form>
            </div>

            <div class="mt-8 w-96 h-64">
                <form action="../php/cambio.php" method="post" class="mt-4 grid grid-rows grid-rows-col gap-0.5">
                    <h2 class="text-3xl  font-normal">Seguridad</h2>

                    <div class="relative my-6">
                        <input type="password" required name="con_nueva" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña nueva">
                        <img src="../images/image 6.png" alt="Icono Nueva Contraseña" class="absolute left-3 top-2.5 w-6 h-6">
                    </div>

                    <div class="relative my-6">
                        <input type="password" required name="rep_con_nueva" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Repetir contraseña">
                        <img src="../images/image 6.png" alt="Icono Repetir Nueva Contraseña" class="absolute left-2.5 top-3 w-6 h-6">
                    </div>

                    <div class="relative my-6">
                        <input type="password" required name="con_act" class="w-full bg-white border border-gray-400 rounded-3xl px-10 py-2 rounded shadow focus:outline-none focus:shadow-outline" placeholder="Contraseña actual">
                        <img src="../images/image 6.png" alt="Icono Contraseña Actual" class="absolute left-3 top-2.5 w-6 h-6">
                    </div>

                    <input type="submit" value="Actualizar" name="a2" class="bg-customBlue2 text-white font-bold py-2 px-4 rounded-3xl ml-2 w-32 mt-2">
                </form>
            </div>

        </div>
    </section>

</div>

<script>
    // Función para mostrar secciones según el clic en el menú lateral
    function showSection(sectionId) {
        // Oculta todas las secciones
        document.querySelectorAll('section').forEach(section => {
            section.classList.add('hidden');
        });
        // Muestra la sección deseada
        document.getElementById(sectionId).classList.remove('hidden');
    }
</script>

</body>
</html>
