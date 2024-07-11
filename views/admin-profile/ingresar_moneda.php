<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moneda</title>
    <script src="https://kit.fontawesome.com/f594a2a0d1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../src/style.css">
    <script src="../../js/funciones.js"></script>
</head>
<body class="bg-white">
    <main>
        <div class="mb-6">
            <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-2xl">
                <h2 class="text-xl font-bold mb-4">Agregar moneda</h2>
                <form action="insertar_moneda.php" method="post" class="lados" id="lados">
                    <div class="flex flex-col justify-center items-center text-center mb-6">
                        <h1 class="text-2xl">Lados</h1>
                        <h2 class="text-xl" id="Anverso">Anverso</h2>
                        <h2 class="text-xl" id="Reverso">Reverso</h2>
                        <label class="text-sm text-gray-400 font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"><div class="w-32 h-32 my-3 bg-dark-blue rounded-full"></div></label>
                        <div class="grid w-full max-w-xs items-center gap-1.5">
                            <input name="img" id="img" type="file" class="flex h-10 w-full rounded-md border border-input bg-white px-3 py-2 text-sm text-gray-400 file:border-0 file:bg-transparent file:text-gray-600 file:text-sm file:font-medium">
                        </div>
                        <input type="text" name="listel" placeholder="Listel" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-center">
                        <input type="text" name="efigie" placeholder="Efigie" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="leyenda" placeholder="Leyenda" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="exergo" placeholder="Exergo" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="ley" placeholder="Ley" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="grafilia" placeholder="Grafilia" class="mt-2 px-2 py-2 border border-black border-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="container mx-auto flex justify-between items-center">
                        <button onclick="redireccionar('vista_moneda.php');" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-x"></i></button>
                        <button type="submit" id="siguienteGeneral" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Siguiente <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </form>
                <form method="post" action="insertar_moneda.php" id="general" class="general">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700">General</label>
                                <input type="text" placeholder="Nombre de la moneda" name="nombre_moneda" class="mt-2 px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="flex space-x-4 mt-2">
                                    <input type="number" placeholder="Valor N." name="v_n" class="w-1/2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <select name="divisa" class="w-1/2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option>Divisa</option>
                                        <?php 
                                            $sql = "SELECT * FROM divisa";
                                            include '../../inc/conexion.php';
                                            $res = mysqli_query($conectar, $sql);

                                            foreach($res as $filas){
                                                echo "<option value='".$filas['id_divisa']."'>".$filas['nombre']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Emisión</label>
                                <div class="flex space-x-4 mt-2">
                                    <input type="number" placeholder="Inicio" name="ini_emi" min="1" max="2024" class="w-1/2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <input type="number" placeholder="Final" name="fin_emi" min="1" max="2024" class="w-1/2 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Características</label>
                                <div class="grid grid-rows gap-4 mt-2">
                                    <select name="tipo_moneda" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option>Tipo</option>
                                        <?php
                                            $sql = "SELECT * FROM tipo_moneda";
                                            $res = mysqli_query($conectar, $sql);

                                            foreach($res as $filas){
                                                echo "<option value='".$filas['id_tipo_moneda']."'>".$filas['tipo_moneda']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <select name="t_c" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option>Canto</option>
                                        <?php
                                            $sql = "SELECT * FROM tipo_canto";
                                            $res = mysqli_query($conectar, $sql);

                                            foreach($res as $filas){
                                                echo "<option value='".$filas['id_tipo_canto']."'>".$filas['tipo']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <input type="text" placeholder="Composición" name="composicion" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <input type="text" placeholder="Diámetro" name="diametro" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <input type="text" placeholder="Espesor" name="espesor" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Historia</label>
                        <textarea name="historia" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="container mx-auto flex justify-between items-center">
                        <button onclick="redireccionar('vista_moneda.php');" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Cancelar <i class="fa-solid fa-x"></i></button>
                        <button type="submit" id="siguienteGeneral" class="text-right bg-dark-blue text-white px-3 py-2 rounded-md hover:bg-blue-900">Siguiente <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<script>
    let i = 0;
    let accumulatedData = {};

    function renameArrayData(formData, oldKey, newKey) {
        if (formData.has(oldKey)) {
            const value = formData.get(oldKey);
            formData.delete(oldKey);
            formData.append(newKey, value);
        }
    }


    document.getElementById('lados').addEventListener('submit', function(event) {
        event.preventDefault();
        i += 1;

        if (i == 1) {
            document.getElementById('Anverso').style.display = 'none';
            document.getElementById('Reverso').style.display = 'block';
            let formData = new FormData(this);
            document.getElementById('img').value = '';
            renameArrayData(formData, 'img', 'anv');
            renameArrayData(formData, 'listel', 'listel_anver');
            renameArrayData(formData, 'efigie', 'efigie_anver');
            renameArrayData(formData, 'leyenda', 'leyenda_anver');
            renameArrayData(formData, 'exergo', 'exergo_anver');
            renameArrayData(formData, 'ley', 'ley_anver');
            renameArrayData(formData, 'grafilia', 'grafilia_anver');

            appendFormDataToAccumulatedData(formData);
        } else {
            let formData = new FormData(this);
            renameArrayData(formData, 'img', 'rvo');
            renameArrayData(formData, 'listel', 'listel_rever');
            renameArrayData(formData, 'efigie', 'efigie_rever');
            renameArrayData(formData, 'leyenda', 'leyenda_rever');
            renameArrayData(formData, 'exergo', 'exergo_rever');
            renameArrayData(formData, 'ley', 'ley_rever');
            renameArrayData(formData, 'grafilia', 'grafilia_rever');
            appendFormDataToAccumulatedData(formData);
            sendAccumulatedData();
        }
    });

    document.getElementById('general').addEventListener('submit', function(event) {
        event.preventDefault();
        document.getElementById('general').style.display = 'none';
        document.getElementById('lados').style.display = 'block';
        document.getElementById('Reverso').style.display = 'none';
        let formData = new FormData(this);
        appendFormDataToAccumulatedData(formData);
    });

    function appendFormDataToAccumulatedData(formData) {
        for (const [key, value] of formData.entries()) {
            accumulatedData[key] = value;
        }
    }

    function sendAccumulatedData() {
        let formData = new FormData();
        for (const key in accumulatedData) {
            formData.append(key, accumulatedData[key]);
        }

        //Inicio del test
        console.log('FormData entries:');
            for (const [key, value] of formData.entries()) {
                console.log(key, ':', value);
            }
        //fin del test
        
        fetch('insertar_moneda.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
        .then(data => {
                document.open();
                document.write(data);
                document.close();
            })
          .catch(error => console.error('Error:', error));
          
    }
</script>
<style>
    .lados {
        display: none;
    }
    .general {
        display: block;
    }
</style>