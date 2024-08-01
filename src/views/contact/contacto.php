<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../../../header.php'; ?>

    <section class="h-screen flex items-center justify-start ">
        <div class="px-32 h-full flex flex-col items-start justify-center">
            <h1 class="text-5xl text-blue-900 mb-8">Contáctanos</h1>
            <p class="text-2xl mb-4 text-dark-blue">Ayúdanos a mejorar </p>
            <p class="text-2xl mb-4 text-dark-blue">la comunidad </p> 
            <p class="text-2xl mb-4 text-dark-blue"> numismática </p> 
            <p class="text-2xl mb-4 text-dark-blue"> argentina</p>
        </div>
        <div class="bg-white p-8 ">
            <form method="POST" action="send_email.php">
                <article class="flex items-center justify-evenly">
                  <div class="mb-4 w-60">
                      <input type="text" name="nombre" id="name" class="w-full px-4 py-2 border-2 shadow-md rounded-xl border-dark-blue " placeholder="Nombre">
                  </div>
                  <div class="mb-4 w-60 ml-10">
                      <input type="text" name="asunto" id="name" class="w-full px-4 py-2 border-2 shadow-md rounded-xl border-dark-blue" placeholder="Asunto">
                  </div>
                </article>  
                <div class="mb-4">
                    <input type="text" name="email" id="subject" class="w-full px-4 py-2 border-2 shadow-md rounded-xl border-dark-blue" placeholder="Correo">
                </div>
                <div class="mb-4">
                    <textarea id="message" name="mensaje" class="w-full px-4 py-2 border-2 shadow-md rounded-xl border-dark-blue" placeholder="Mensaje" rows="10"></textarea>
                </div>
                <button type="submit" name="send" class="bg-dark-blue text-white font-patua text-2xl px-4 py-2 rounded-xl w-full">Enviar correo</button>
            </form>
        </div>
    </section>

    <?php include '../../../footer.html'; ?>
</body>
</html>

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
    .border-dark-blue {
        border-color: #021526;
    }
    .font-light-blue {
        color: #0D3559;
    }
</style>
