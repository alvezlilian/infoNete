<?php

use  PHPMailer\PHPMailer\PHPMailer;

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud, $codigo){

        $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud,activo,idRol) VALUES ('$nombre','$direccion','$email','$latitud','$longitud',FALSE,1)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();

        $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario,codigo,validado) VALUES ('$clave','$idUsuario','$codigo',FALSE)";
        $this->database->execute($sqlContrasenia);
        $this->envioEmailConfirmacion($email,$nombre,$codigo); //Al controller

    }

    public function verificarEmail($email){
        $sql="SELECT * FROM infonete.usuario WHERE email = '$email'";
        $result = $this->database->query($sql);
        if(empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function validarCodigoRegistro($codigo){
        $sql = "SELECT * FROM infonete.contrasenia WHERE codigo = '$codigo'";
        $result = $this->database->query($sql);
        if(!(empty($result))){
            $insert1="UPDATE infonete.contrasenia SET validado=TRUE WHERE codigo='$codigo'";
            $this->database->execute($insert1);
            $insert2="UPDATE infonete.usuario SET activo=TRUE WHERE id = (select idUsuario from infonete.contrasenia where codigo = '$codigo');";
            $this->database->execute($insert2);
            return true;
        }else{
            return false;
        }
    }

    public function envioEmailConfirmacion($email,$nombre,$codigo)
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
   <a href='localhost/registrarse/procesarAlta'> VERIFICA TU MAIL</a>";


        //Server settings
        $mail->SMTPDebug = true;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        //$mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Host = 'SMTP.Office365.com';
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        //$mail->Username = 'infonete.pw@gmail.com';                     //SMTP username
        $mail->Username = 'pw2-2022@outlook.com';
        //$mail->Password = 'Infonete2022';                               //SMTP password
        $mail->Password = '2022!Pw2';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                //465    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('pw2-2022@outlook.com', 'Infonete Noticias Web');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Confirmacion Cuenta";
        $mail->Body = $msj;
        $mail->MsgHTML($msj);

        $mail->send();

    }

}