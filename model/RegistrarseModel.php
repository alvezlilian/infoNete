<?php

use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\SMTP;
use  PHPMailer\PHPMailer\Exception;

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud, $codigo){

        $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud,activo) VALUES ('$nombre','$direccion','$email','$latitud','$longitud',FALSE)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();

        $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario,codigo,validado) VALUES ('$clave','$idUsuario','$codigo',FALSE)";
        $this->database->execute($sqlContrasenia);
        //$this->envioEmailConfirmacion($email,$clave,$nombre,$codigo); //Al controller

        Redirect::doIt("/registrarse/validarUsuarioForm"); //Al controller



    }

    public function verificarEmail($email){
        $sql="SELECT * FROM infonete.usuario WHERE email = '$email'";
        $result = $this->database->query($sql);
        $row_cnt = 0;
        $row_cnt = $result->num_rows;
        return $row_cnt;
    }

    public function validarCodigoGenerado($codigo){

    }
    // password_verify('rasmuslerdorf', $hash)
    //


    public function emailRegistrado($email){
        $sql = "SELECT * FROM infonete.usuario WHERE email = '$email'";
        $result = $this->database->execute($sql);

        if(is_null($result)){
            return true;
        }else{
            return false;
        }
    }

    public function envioEmailConfirmacion($email,$clave,$nombre,$codigo)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/OAuth.php';

        $mail = new PHPMailer(true);

        $msj="<h2>Gracias por registrarse!</h2><br>
    <p>------------------------</p><br>
    Username: ".$nombre."<br>
    Código de Verificación: ".$codigo."<br>
    ------------------------
    <h4>Su cuenta fue creada, puede confirmar su email en el link de abajo</h4><br>
    <p>Confirmar tu dirección de correo electrónico nos ayuda a mantener la seguridad de tu cuenta.</p><br>
    <p>Dedica un momento para avisarnos si esta es la dirección correcta: ".$email."</p><br>
   <a href='localhost/registro/verificacion?email=$email & hash=$clave'> VERIFICA TU MAIL</a>";


        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'infonete.pw@gmail.com';                     //SMTP username
        $mail->Password = 'Infonete2022';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                //465    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('infonete.pw@gmail.com', 'Empresa');
        $mail->addAddress($email);     //Add a recipient

        //Content
        //$mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Confirmacion Cuenta";
        $mail->Body = $msj;

        $mail->send();

    }

    public function verificacionHash($email,$clave){
        $sql1 = "SELECT * FROM infonete.usuario WHERE email='$email'";
        $result1=$this->database->query($sql1);

        $sql2 = "SELECT * FROM infonete.contrasenia WHERE clave='$clave'";
        $result2=$this->database->query($sql2);

        if(isset($result1) AND isset($result2)){
            $insert1="UPDATE infonete.contrasenia SET validado=TRUE WHERE clave='$clave'";
            $this->database->execute($insert1);
            $insert2="UPDATE infonete.usuario SET activo=TRUE WHERE email='$email'";
            $this->database->execute($insert2);
        }

    }


}