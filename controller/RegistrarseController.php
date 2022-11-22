<?php

use  PHPMailer\PHPMailer\PHPMailer;

class RegistrarseController
{

    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        echo "adios";
    }

    public function alta(){
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("registrarseForm.mustache", $data);
    }

    function encriptarClave($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public function generarCodigoVerificacion(){
        $codigo = mt_rand(100000, 999999);
        return $codigo;
    }

    public function procesarAlta(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $latitud=$_POST["latitud"];
        $longitud=$_POST["longitud"];
        $claveEncriptada=$this->encriptarClave($clave);

        if($this->estaRegistrado($email)){
            $codigo= $this->generarCodigoVerificacion();
            //$this->envioEmailConfirmacion($email,$nombre,$codigo);
            $this->model->alta($nombre,$email,$direccion,$claveEncriptada,$latitud,$longitud,$codigo);
            $this->renderer->render("validarUsuarioForm.mustache");
        }else{
            $mensaje['mensaje'] = "Ha ocurrido un error inesperado, reintente en unos minutos";
            $this->renderer->render("registrarseForm.mustache",$mensaje);
        }

    }

    public function estaRegistrado($email){
        return $result = $this->model->verificarEmail($email);

    }

    public function validarCodigo(){
        $codigo = $this->model->validarCodigoRegistro($_POST['codigo']);
        if($codigo){
            $this->renderer->render("loginView.mustache");
        }else{
            $mensaje['mensaje'] = "Codigo erroneo";
            $this->renderer->render("validarUsuarioForm.mustache",$mensaje);
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
        <p>Su cuenta fue creada exitosamente. Confirme su dirección de correo electrónico clickeando el link o copia la siguiente url en tu navegador:</p><br>
        <p>http://localhost/registrarse/validarCodigo</p>
        <a href='http://localhost/registrarse/validarCodigo'> VERIFICA TU MAIL</a>";

        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
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
        $mail->setFrom('pw2-2022@outlook.com', 'Gustavo Gonzalez');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Confirmacion Cuenta";
        $mail->Body = $msj;
        $mail->MsgHTML($msj);

        $mail->send();
   }

}