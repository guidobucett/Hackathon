<?php
 require_once 'view/mapa/mapa.view.php';
require_once 'model/query.php';

class mapaController {

    private $model;
    private $vista;

    public function __CONSTRUCT() {
        $this->model = new Query();
        $this->vista = new MapaView();
    }

    public function Index() {
       // $lista = $this->model->Listar();        
        $this->vista->View();
    }

    public function hospital() {
         $hospitales=$this->model->ListarHospital(); 
        $this->vista->Ver($hospitales); 
    }

    public function Laboratorio() {
         $laboratorio=$this->model->ListarLaboratorios(); 
        $this->vista->Ver($laboratorio); 
    }

    public function radiologico() {
         $radiologico=$this->model->ListarRadiologicos(); 
        $this->vista->Ver($radiologico); 
    }

    public function terapeutico() {
         $terapeutico=$this->model->ListarTerapeutico(); 
        $this->vista->Ver($terapeutico); 
    }

    public function bancosangre() {
         $bancosangre=$this->model->ListarBancoSangre(); 
        $this->vista->Ver($bancosangre); 
    }

    public function veterinaria() {
         $veterinaria=$this->model->ListarVeterinaria();
        $this->vista->Ver($veterinaria); 
    }

    public function juridico() {
         $juridico=$this->model->ListarJuridico();
        $this->vista->Ver($juridico); 
    }

    public function contaduria() {
         $contaduria=$this->model->ListarContaduria();
        $this->vista->Ver($contaduria); 
    }

     public function empresarial() {
         $empresarial=$this->model->ListarEmpresarial();
        $this->vista->Ver($empresarial); 
    }

    public function mercado() {
         $mercado=$this->model->ListarMercado();
        $this->vista->Ver($mercado); 
    }

    public function arquitectura() {
         $mercado=$this->model->ListarArquitectura();
        $this->vista->Ver($mercado); 
    }

    public function odontologia() {
         $odontologia=$this->model->ListarOdontologia();
        $this->vista->Ver($odontologia); 
    }



    public function Editar() {
        $mapa = $this->model->Obtener($_REQUEST['id']);
        $tipos=$this->tipos->Listar();
        $this->vista->Editar($mapa,$tipos);
    }

    public function Guardar() {
      
        $datos = array(
        	'ci' => $_REQUEST['ci'],
            'nombre' => $_REQUEST['nombre'],
            'direccion' => $_REQUEST['direccion'],
            'telefono' => $_REQUEST['telefono'],
            'correo' => $_REQUEST['correo'],
            'fktipo_mapa' => $_REQUEST['pktipo_mapa'],
            'username' => $_REQUEST['username'],
            'pass' => $this->Encrypt($_REQUEST['pass']),
        );  

         if($this->model->ExisteUsername($datos['username'])!="")
          {
            header("Location: ?c=mapa&a=nuevo&item=mapa&tarea=username&exito=si");
            exit;
          }
         if($this->model->ExisteCorreo($datos['correo'])!="")
            {
             header("Location: ?c=mapa&a=nuevo&item=mapa&tarea=correo&exito=si");
             exit;
            }

        $pkmapa = $this->model->Registrar($datos);
        header("Location: ?c=mapa&item=mapa&tarea=agregar&exito=si");
    }
    public function GuardarCambios() {
      
        $datos = array(
            'pkmapa' => $_REQUEST['pkmapa'],
            'ci' => $_REQUEST['ci'],
            'nombre' => $_REQUEST['nombre'],
            'direccion' => $_REQUEST['direccion'],
            'telefono' => $_REQUEST['telefono'],
            'correo' => $_REQUEST['correo'],
            'fktipo_mapa' => $_REQUEST['pktipo_mapa'],
        );
           

            $pkmapa = $this->model->Editar($datos);
           

        header("Location: ?c=mapa&item=mapa&tarea=modificar&exito=si");
    }

    public function Eliminar() {
        $this->model->Baja($_REQUEST['id']);
        header("Location: ?c=mapa&item=mapa&tarea=eliminar&exito=si");
    }

    public function validar() {
        if (!isset($_SESSION['user_sistem'])) {
            header('Location: ?c=home');
        }
    }

    public function Encrypt($cadena){
        $key='Aquino';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted; //Devuelve el string encriptado
 
    }

    public function Decrypt($cadena){
         $key='Aquino';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
         $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;  //Devuelve el string desencriptado
    }

}
?>