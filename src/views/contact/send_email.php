<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['send'])){

        $snt = $_POST['asunto'];
        $nmbr = $_POST['nombre'];
        $ml = $_POST['email'];
        $mnsj = $_POST['mensaje'];

        
    
        require '../../inc/PHPMailer/Exception.php';
        require '../../inc/PHPMailer/PHPMailer.php';
        require '../../inc/PHPMailer/SMTP.php';
        $mail = new PHPMailer(true);
        try {
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'numisarg6@gmail.com';                     //SMTP username
            $mail->Password   = 'rwbu zccx ynxs yxkn';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
            $mail->setFrom('numisarg6@gmail.com');
            $mail->addAddress('numisarg6@gmail.com' , 'Usuario');
            
            $mail->isHTML(true);                                  
            $mail->Subject = "$snt";
            $mail->Body    = '<!DOCTYPE html>
            <html lang="es">
            <head>
                <title>"'.$snt.'"</title>
            </head>
            <body>
                <h1>Usuario: '.$nmbr.'</h1>
                <h2>Correo: '.$ml.'</h2>
                <p>'.$mnsj.'</p>
            </body>
            </html>';
            
            $mail->charset = 'UTF-8';
            $mail->send();
            echo 'Message has been sent';
            echo " <script> location.href='contacto.php?success=send_message'; </script> ";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


?>
