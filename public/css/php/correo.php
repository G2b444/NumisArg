<?php
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include ("../libreria/conexion.php");
session_start();
$correoString = $_POST['correo'];

$sql = " SELECT id_usuario FROM usuario WHERE correo = '$correoString' ";
$res = mysqli_query($conectar, $sql);

if(!$res){
    echo " <script> alert('El correo solicitado no está registrado'); history.go(-1) </script> ";
}else{


        if(empty($_SESSION['numero']) && empty($_SESSION['correo'])){
            $generador = mt_rand(0, 999999);
            $numero = sprintf('%06d', $generador);
            $_SESSION['numero'] = $numero;
            $_SESSION['correo'] = $correoString;
            $id = mysqli_fetch_assoc($res);
            $id_n = $id['id_usuario'];
            $_SESSION['id_usuario'] = $id_n;
        }
        echo '<script> alert("' . $_SESSION['numero'] . '\n' . $_SESSION['correo'] . '\n' . $_SESSION['id_usuario'] . '"); </script>';
        
        if(isset($_POST['Enviar'])) {
        
        require '../PHPMailer/Exception.php';
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kevinkoncerewic@gmail.com';                     //SMTP username
            $mail->Password   = 'bczj zkug iqnp mwvz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            
            $mail->setFrom('kevinkoncerewic@gmail.com', 'Intendente de Itaembé Guazú');
            $mail->addAddress($correoString, 'Usuario');

            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Codigo de verificacion';
            $mail->Body    = '<!DOCTYPE html>
            <html lang="es">
            <head>
                <title>Correo de verificacion</title>
            </head>
            <body>
                <h1>Su código de verificacion es: ' . $numero . '</h1>
                <p>Tiene 15 minutos hasta que su código deje de funcionar.</p>
            </body>
            </html>';
            
            $mail->charset = 'UTF-8';
            $mail->send();
            echo 'Message has been sent';
            echo " <script> location.href='../html/cambio.html'; </script> ";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>

