<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NumisArg</title>
   </head>
<body class="bg-white overflow-x-hidden">
    <?php include 'header.php'; ?>
    <main class="text-center">
        <div class="w-screen h-5/6 flex justify-between items-center my-5 ">
            <div class="mb-10"> <img src="./src/assets/monedaindex1.svg" alt="moneda1"></div>
            <div class="mb-20">
                <h1 class="text-7xl mb-10 ">NumisArg</h1>
                <p class="text-xl mb-8 ">Coleccionando la patria</p>
                <a href="pages/catalogo.php"><button class="bg-dark-blue shadow-lg text-white px-6 py-3 mt-2 rounded hover:scale-105">Ver Monedas</button></a>
            </div>
            <div class="mb-10"> <img src="./src/assets/monedaindex2.svg" alt="moneda2"></div>
        </div>

        <section class="w-screen h-screen flex items-start my-10">
            <div class="w-screen flex items-center flex-col">
              <h2 class="text-5xl mb-24 font-patua">¿De qué se trata?</h2>
              <div class="w-screen flex justify-around">
                  <div class="bg-light-blue w-72 h-72 rounded-xl shadow-2xl flex items-center flex-col p-10"> <h1 class="text-white text-center text-4xl ">Mirá</h1> <p class="text-white text-center text-3xl"><br> nuestro catálogo de monedas</p></div>
                  <div class="bg-light-blue w-72 shadow-2xl h-72 rounded-xl flex items-center flex-col p-10"> <h1 class="text-white text-center text-4xl ">Registrá</h1><p class="text-white text-center text-3xl"><br> tus colecciones de monedas</p></div>
                  <div class="bg-light-blue w-72 shadow-2xl h-72 rounded-xl flex items-center flex-col p-10"> <h1 class="text-white text-center text-4xl ">Administrá</h1><p class="text-white text-center text-3xl"><br> facilmente los detalles de tus colecciones</p></div>
              </div>
                </a>
            </div>
        </section>
    </main>
    <?php include 'footer.html'; ?>
</body>
</html>

