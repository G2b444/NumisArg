<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Cuenta</title>
    <link rel="icon" href="../../assets/multimedia/logo/LOGO NUMISARG.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <script src="../../js/funciones.js"></script>
    <link rel="stylesheet" href="../../style.css">
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
        .form-custom{
            margin: 5px;
            border: 4px solid #0D3559;
            border-radius: 20px 20px 100px 100px;
        }
    </style>
    <script>
        function toggleForms() {
            var loginForm = document.getElementById("loginForm");
            var registerForm = document.getElementById("registerForm");
            loginForm.classList.toggle("hidden");
            registerForm.classList.toggle("hidden");
        }

        document.addEventListener("DOMContentLoaded", function(){
            const linkRegistro = document.getElementById("button-registro");
            const linkInicio = document.getElementById("button-inicio");
            const divInicio = document.getElementById("inicio"); 
            const divRegistro = document.getElementById("registro");

            console.log(linkInicio);
            console.log(divInicio);
            console.log(linkRegistro);
            console.log(divRegistro);

            divInicio.style.display = "block";
            divRegistro.style.display = "none";

            linkRegistro.addEventListener("click", function(event){
                event.preventDefault();
                divInicio.style.display = "none";
                divRegistro.style.display = "block";
            });

            linkInicio.addEventListener("click", function(event){
                event.preventDefault();
                divInicio.style.display = "block";
                divRegistro.style.display = "none";
            });
        });
    </script>
</head>
<body>
    <form action="../../php/delsession.php" method="post" >
        <button name="volver">
            <img src="../../assets/icon/arrow.png" alt="Flecha de volver" class="w-10 h-10 m-2">
        </button>
    </form> 
    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modal" id="error-iniciar">
        <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
            <h1 class="mb-6 text-lg">¡Error al iniciar sesión!</h1>
            <h1 class="mb-6 text-lg">Verifique que los datos que introdujo sean correctos.</h1>
            <div class="flex justify-around">
                <button onclick="closeModal('error-iniciar')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
            </div>
        </div>
    </div>
    
    <div class="modal" id="correo-existente">
        <div class="text-white rounded-3xl p-6 w-80 text-center bg-dark-blue">
            <h1 class="mb-6 text-lg">¡Este correo ya está registrado!</h1>
            <h1 class="mb-6 text-lg">Puedes iniciar sesión si ya tienes una cuenta.</h1>
            <div class="flex justify-around">
                <button onclick="closeModal('correo-existente')" class="bg-transparent border-white border-2 py-2 px-4 rounded-3xl hover:bg-white hover:text-black cancel">Hecho</button>
            </div>
        </div>
    </div>
    
    <div class="flex justify-center items-center h-screen">

        <div class="flex items-center w-[964px] h-[552px] bg-customBlue2 rounded-3xl p-0 pl-[10px]" id="inicio">
            <div class="flex flex-col justify-center w-[602px] h-[530px] bg-white rounded-3xl form-custom">
                <form action="Registrar-Iniciar.php" method="post" class="flex flex-col items-center p-4">
                    <h2 class="text-xl m-0 mx-[25%]">Inicia sesión</h2><br>
                    <p class="text-lg m-0 ml-[80px]">Completa los campos e ingresa</p><br>
    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 5.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="email" placeholder="Correo" maxlength="30" name="correo" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required>                
                    </div>
                    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 6.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="password" placeholder="Contraseña" maxlength="30" name="ps" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required>
                    </div>
                   
                    <a href="recuperacion.php" class="text-xs text-blue-500 underline">Olvidé mi contraseña</a><br>
                    <input type="submit" name="IS" value="Iniciar sesión" class="bg-customBlue rounded-3xl text-white w-28 h-10 px-2 text-[20px]"><br>
                    <p class="pb-6">¿No tienes una cuenta? <a href="" class="text-blue-500 underline" id="button-registro">¡Regístrate!</a></p>
                </form>
            </div>
        </div>
        
        <div class="flex items-center w-[964px] h-[552px] bg-customBlue2 rounded-3xl p-0 pl-[10px]" id="registro" style="display: none;">
            <div class="flex flex-col justify-center w-[602px] h-[530px] bg-white rounded-3xl form-custom">
                <form action="Registrar-Iniciar.php" method="post" class="flex flex-col items-center p-4">
                    <h2 class="text-xl m-0 mx-[25%]">Crea una cuenta</h2><br>
                    <p class="text-lg m-0 ml-[80px]">Completa los campos para registrarte</p><br>
                    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 4.png"  class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="text" placeholder="Nombre de usuario" maxlength="30" name="nombre" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required><br>
                    </div>
                    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 5.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="email" placeholder="Correo" maxlength="30" name="correo" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required><br>
                    </div>
    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 6.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="password" placeholder="Contraseña" maxlength="30" name="ps" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required><br>
                    </div>
                    
                    <div class="relative w-64">
                        <img src="../../assets/icon/image 6.png" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                        <input type="password" placeholder="Repetir Contraseña" maxlength="30" name="ps-verify" class="border border-gray-300 p-2 pl-10 w-full rounded-3xl my-1" required>
                    </div>
    
                    <input type="submit" name="R" value="Registrarse" class="bg-customBlue rounded-3xl text-white w-28 h-10 px-2 my-2">
                    <p class="pb-8">¿Ya tienes una cuenta? <a href="" class="text-blue-500 underline" id="button-inicio">¡Inicia sesión!</a></p>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
<?php 

if(isset($_GET['success'])){

    $proceso = $_GET['success'];

    switch ($proceso) {
        case 'error_iniciar':
            echo "<script>openModal('error-iniciar');</script>";
            break;

        case 'correo_existente':
            echo "<script>openModal('correo-existente');</script>";
            break;
    }

    echo "<script>window.history.replaceState({}, '', 'index.php');</script>";
}


?>