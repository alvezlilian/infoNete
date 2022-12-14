<?php

class AdministradorController{
    private $renderer;
    private $model;
    private $domPdf;

    public function __construct($render, $model,$domPdf) {
        $this->renderer =$render;
        $this->model = $model;
        $this->domPdf=$domPdf;
    }
    public function list(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            Redirect::doIt('/');
        }
    }

    public function home(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("adminViewHome.mustache", $data);
    }

    function encriptarClave($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public function acciones(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("usuarios-action.mustache",$data);
    }

    public function alta_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("admin-alta-usuario.mustache",$data);
    }

    public function modificar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $email = $_POST['email'];

        if($this->estaRegistrado($email)){
            $usuario = $this->model->getUserByMail($email);
            $this->renderer->render("admin-modificar-usuario.mustache",$usuario, $data);
        }
        Redirect::doIt('/administrador/buscar_usuario');
    }

    public function eliminar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $usuarios['usuarios'] = $this->model->getUsuarios();
        $this->renderer->render("admin-eliminar-usuario.mustache",$usuarios);
    }

    public function alta_contenidista(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("admin-alta-contenidista.mustache",$data);
    }

    public function buscar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("admin-buscar-usuario-actualizar.mustache",$data);
    }

    public function ver_publicaciones(){
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("admin-publicaciones.mustache", $data);
    }

    public function eliminar_publicacion(){
        $id = $_POST['id'];
        $this->model->eliminarPublicacionPor($id);
        Redirect::doIt('/administrador/ver_publicaciones');
    }

    public function nuevo_usuario(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $rol = $_POST['rol'];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $this->model->alta($nombre, $email, $direccion, $rol, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function baja_usuario(){
        $id['id'] = $_POST['id'];
        $this->model->baja($id);
        Redirect::doIt('/administrador/eliminar_usuario');
    }

    public function update_usuario(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $ubicacion = $_POST['direccion'];
        $rol = $_POST['rol'];
            $id = $this->model->getUserByMail($email);
            $this->model->updateUsuario($id, $nombre, $email, $ubicacion, $rol);
            Redirect::doIt('/administrador/acciones');

    }

    public function nuevo_contenidista(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $this->model->agregar_contenidista($nombre, $email, $direccion, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function estaRegistrado($email){
        return $result = $this->model->existeMail($email);
    }
public function verReporte(){
        $data['contenidistas']=$this->model->listaDeContenidista();
$data['lectores']=$this->model->listaDeLectores();
$data['notasVendidas']=$this->model->ContarNotasVendidas();
$data['edicionesVendidas']=$this->model->contarEdicionesVendidas();
    $this->renderer->render("reporte.mustache", $data);


}
public function imprimirReporte(){
        $html="";
        $html1="";
    $data['contenidistas']=$this->model->listaDeContenidista();
    $data['lectores']=$this->model->listaDeLectores();
    $data['notasVendidas']=$this->model->ContarNotasVendidas();
    $data['edicionesVendidas']=$this->model->contarEdicionesVendidas();
  foreach ($data['contenidistas'] as $contenidistas){

      $html=" <h1 style='text-align: center'>Reporte administrativo</h1><div class='w3-container w3-content w3-center w3-padding-64' style='max-width:90%' id='band'>
  <h2 class='w3-wide'>Lista de tus contenidistas</h2>
 <table class='w3-table'>
        <tr>
            <th>Id</th>
            <th>Nombre y apellido</th>
            <th>Email</th>
            <th>Direccion</th>
            <th>Rol</th>

        </tr>
      
           <tr>
                <td>".$contenidistas['id']."</td>
                <td>".$contenidistas['nombreApellido']."</td>
                <td>".$contenidistas['email']."</td>
               <td>".$contenidistas['ubicacion']."</td>
               <td>".$contenidistas['descripcion']."</td>


           </tr>
         
    </table></div>";
  }

  foreach ($data['lectores']as $lector){
      $html1="<h2 class='w3-wide'>Lista de tus Lectores que adquirieron noticias</h2>
    <table class='w3-table'>
        <tr>
            <th>Id</th>
            <th>Nombre y apellido</th>
            <th>Email</th>
            <th>Direccion</th>
            <th>publucacion</th>
            <th>Edicion</th>
            <th>Seccion</th>
            <th>N?? de Noticia</th>
        </tr>
    
            <tr>
                <td>".$lector['id']."</td>
                <td>".$lector['nombreApellido']."</td>
                <td>".$lector['email']."</td>
                <td>".$lector['ubicacion']."</td>
                <td>".$lector['informacion']."</td>
                <td>".$lector['descripEdicion']."</td>
                <td>".$lector['descripSeccion']."</td>
                <td>".$lector['notaId']."</td>


            </tr>
        
    </table>";
    }



    $this->domPdf->recibirHtml($html.$html1);
    }

}