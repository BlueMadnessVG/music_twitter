<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './libraries/src/Exception.php';
require './libraries/src/PHPMailer.php';
require './libraries/src/SMTP.php';
require_once './Models/connection.php';
//Modelo de la Tabla Correo
class CorreoModel{
    //Atributo del correo que contendra la conexion
     private $mail;
    //Constructor que inicializa el Servidor de Correo
    function __construct(){
        $this->mail = new PHPMailer(true);
        try {
            //Server settings
            $this->mail->SMTPDebug = 0;                      //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;
            //$this->mail->SMTPSecure = "ssl";                                 //Enable SMTP authentication
            $this->mail->Username   = 'equiposoundclon@outlook.com';                     //SMTP username
            $this->mail->Password  ='Soundclon123!';                               //SMTP password
            $this->mail->SMTPSecure = "STARTTLS";            //Enable implicit TLS encryption
            $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        } catch (Exception $e) {
            echo "Error".$e->getMessage();
        }
    }




    //Funcion para enviar correo
     function EnviarCorreoban($correo,$motivo){

    //Recipients
    $this->mail->setFrom( $this->mail->Username , 'Equipo de Soundclon');
      //Add a recipient
    $this->mail->addAddress($correo);               //Name is optional

    //Content
    $this->mail->isHTML(true);                                  //Set email format to HTML
    $this->mail->Subject = 'AVISO DE BANEO DE CUENTA';
    $this->mail->Body    = "LAMENTAMOS INFORMARLE QUE SU CUENTA HA SIDO DADA DE BAJA POR UN ADMINISTRADOR <br> si crees que esto es un error o quieres apelar a esta decisión, por favor envía un correo de vuelta explicando la situación...<br><b>Motivo</b>:<p style='color:red;display:block'>$motivo</p>";
    $this->mail->CharSet = 'UTF-8';
    $this->mail->AltBody = 'Has sido baneado de Soundclon'.$motivo;

    $this->mail->send();
    return  'El correo se envio correctamente';
    }
    function EnviarCorreodesban($correo){

      //Recipients
      $this->mail->setFrom( $this->mail->Username , 'Equipo de Soundclon');
        //Add a recipient
      $this->mail->addAddress($correo);               //Name is optional

      //Content
      $this->mail->isHTML(true);                                  //Set email format to HTML
      $this->mail->Subject = 'APROBACIÓN DE APELACIÓN';
      $this->mail->Body    = "SU SOLICITUD DE DESBANEO HA SIDO EVALUADA Y APROBADA POR UN ADMINISTRADOR. LAMENTAMOS LOS INCONVENIENTES, ESPERAMOS QUE SIGA TENIENDO UNA BUENA EXPERIENCIA CON NOSOTROS";
      $this->mail->CharSet = 'UTF-8';
      $this->mail->AltBody = 'Has sido desdesbaneado de Soundclon';

      $this->mail->send();
      return  'El correo se envio correctamente';
      }

      function Notificarbaneopost($correo,$motivo,$post){

        //Recipients
        $this->mail->setFrom( $this->mail->Username , 'Equipo de Soundclon');
          //Add a recipient
        $this->mail->addAddress($correo);               //Name is optional
    
        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = 'ELIMINACIÓN DE PUBLICACIÓN';
        $this->mail->Body    = "LAMENTAMOS INFORMARLE QUE SU PUBLICACIÓN <b>$post</b> HA SIDO DADA DE BAJA POR UN ADMINISTRADOR <br> Lamentamos los inconvenientes que esto pueda causar<br><b>Motivo</b>:<p style='color:red;'>$motivo</p>";
        $this->mail->CharSet = 'UTF-8';
        $this->mail->AltBody = 'Tu post ha sido baneado de Soundclon, motivo: '.$motivo;
    
        $this->mail->send();
        return  'El correo se envio correctamente';
        }




}
