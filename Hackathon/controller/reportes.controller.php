<?php

require_once 'model/reportes.php';
require_once 'view/reportes/Reportes.view.php';

class ReportesController {

    private $model;
    private $vista;
    private $cargo;

    public function __CONSTRUCT() {
        $this->model = new Reportes();
        $this->vista = new ReportesView();
    }

    public function Index() {
        $this->vista->View();
    }

    public function Nuevo() {
        $cargos=$this->cargo->Listar();
        $this->vista->Nuevo($cargos);
    }

    public function Editar() {
        $personal= $this->model->Obtener($_REQUEST['pkusuario']);
        $cargos= $this->cargo->Listar();
        $this->vista->Editar($personal, $cargos);
    }

    public function Generar() {
        $reporte=$_POST['Tipo'];
        $distrito=$_POST['Distrito'];
        $tipo="";
        if($reporte=="Hospital")
        {
            $rep=$this->model->Listar_Hospitales($distrito);
            $tipo="Hospitales";
        }

        if($reporte=="Hotel")
        {
            $rep=$this->model->Listar_Hoteles($distrito);  
            $tipo="Hoteles";
        }

        if($reporte=="Comida")
        {
            $rep=$this->model->Listar_Restaurantes($distrito);
            $tipo="Restaurantes";
        }

        if($reporte=="Diversion")
        {
            $rep=$this->model->Listar_Diversion($distrito);
            $tipo="Lugares Turisticos";
        }

        if(isset($_POST['Barras']))
        {
            $this->vista->Reporte_Barra($rep,$tipo);
        }
        else
        {
            $this->vista->Reporte_Torta($rep,$tipo);
        }

    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'ci' => $_POST['ci'],
                'nombre' => $_POST['nombre'],
                'email' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'username' => $_POST['username'],
                'fkcargo' => $_POST['cargo']
            );
            $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el usuario '.$_POST['nombre'];
            $this->bitacora->GuardarBitacora($DescripcionBitacora);
            header("Location: ?c=usuario&item=usuario&tarea=modificar&exito=si");
        }else{
            $datos = array(
                'ci' => $_POST['ci'],
                'nombre' => $_POST['nombre'],
                'email' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'username' => $_POST['username'],
                'pass' => $this->Encrypt($_POST['pass']),
                'fkcargo' => $_POST['cargo']
            );
            $sx = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo usuario '.$_POST['nombre'];
            $this->bitacora->GuardarBitacora($DescripcionBitacora);
        }
        $cargo=$this->cargo->Obtener($_POST['cargo']);
        if($sx>0)
        {
            $mensaje=$this->Mensaje_Registro($_POST['nombre'],$_POST['username'],$_POST['pass'],$cargo->nombre);
            $this->correo->setAddress($_POST['correo']);
            $this->correo->setSubject("Registro Epsas");
            $this->correo->setBody("$mensaje");
            if($this->correo->sendEmail()){
                header("Location: ?c=usuario&item=usuario&tarea=agregar&exito=si");
            }
            else
            {
                echo "No envio el correo";
            }
        }
        else
        {
            echo "No inserto";
        }
        header("Location: ?c=usuario&item=usuario&tarea=agregar&exito=si");
    }

    public function Registrar() {
        $datos = array(
                'nombre' => $_POST['Nombre'],
                'correo' => $_POST['Correo'],
                'username' => $_POST['Username'],
                'pass' => $this->Encrypt($_POST['Pass'])
            );
        $this->model->Guardar($datos);
        header("Location: login.php");
    }

    public function Eliminar() {
        $nombre = $this->model->Obtener($_REQUEST['pk']);
        $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el usuario '.$nombre->nombre);
        header('Location: ?c=usuario&item=usuario&tarea=eliminar&exito=si');
    }

    public function Modificar_Perfil() {
        $datos = array(
            'pkusuario' => $_POST['pkusuario'],
            'ci' => $_POST['ci'],
            'nombre' => $_POST['nombre'],
            'email' => $_POST['correo'],
            'telefono' => $_POST['telefono'],
            'pass' => $this->Encrypt($_POST['pass'])
        );
        var_dump($datos);
    }

    public function Acceder() {
        if ((isset($_POST['Username']) && isset($_POST['Pass']) ) &&
                (!empty($_POST['Username']) && !empty($_POST['Pass']))) {

            $user = $this->model->Acceder($_POST['Username'], $this->Encrypt($_POST['Pass']));
            if ($user) {
                foreach ($user as $u) {
                    $pkusuario=$u->pkusuario;
                    $correo=$u->correo;
                    $nombre_usuario=$u->nombre;
                }
                session_start();
                $_SESSION['usuario'] = (int)$pkusuario;
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                header("Location: index.php");
            }

            elseif ((isset($_POST['Username']) && isset($_POST['Pass']) ) &&
                (!empty($_POST['Username']) && !empty($_POST['Pass']))) {
                echo "Entro Empresa";
            $empresa = $this->model->Acceder_Empresa($_POST['Username'], $this->Encrypt($_POST['Pass']));
            foreach ($empresa as $e) {
                $pkempresa=$e->pkempresa;
                $nombre=$e->nombre;
                $responsable=$e->responsable;
            }

            if ($empresa) {
                session_start();
                $_SESSION['empresa'] = (int)$pkempresa;
                $_SESSION['nombre'] = $nombre;
                header('Location: index.php');
            }
            else
            {
                header("Location: login.php");
            }
        } 
        else 
        {
               header("Location: login.php");
        }
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

    public function Mensaje_Recovery_Password($nombre,$cargo,$pass)
    {
        return "
    <div>
    <table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#FFFFFF' align='center'>
        <tbody><tr>
            <td>
                <table width='520px' cellpadding='0' cellspacing='0' border='0' bgcolor='#FFFFFF' align='center'>
                    <tbody><tr>
                        <td valign='top' style='padding-top:30px;font-family:Helvetica neue,Helvetica,Arial,Verdana,sans-serif;color:#205081;font-size:20px;line-height:32px;text-align:left;font-weight:bold' align='left'>Recuperacion de Cuenta de Usuario</td>
                    </tr>

                    <tr>
                        <td style='color:#cccccc;padding-top:10px' valign='top' width='100%'>
                            <hr color='#CCCCCC' size='1'>
                        </td>
                    </tr>
                <tr valign='top'>
        <td align='left' style='padding-top:0px;padding-bottom:0px'><img style='display:block' src='http://aycsoft.webuda.com/img/ayc.jpg' alt='Download images and then verify your email address!' width='360' height='180' border='0' class='CToWUd a6T' tabindex='0'><div class='a6S' dir='ltr' style='opacity: 0.01; left: 312px; top: 232px;'><div id=':19l' class='T-I J-J5-Ji aQv T-I-ax7 L3 a5q' role='button' tabindex='0' aria-label='Descargar el archivo adjunto' data-tooltip-class='a1V' data-tooltip='Descargar'><div class='aSK J-J5-Ji aYr'></div></div></div></td>
    </tr>
                    <tr>
                        <td valign='top' style='padding-top:10px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#333333;font-size:16px;line-height:20px;text-align:left;font-weight:none' align='left'> Estimado Sr(a) $cargo $nombre </td>
                    </tr>
                    <tr>
                        <td valign='top' style='padding-top:10px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#333333;font-size:16px;line-height:20px;text-align:left;font-weight:none' align='left'>Su contraseña es <b style='font-size:18px;'>$pass</b> por favor acceda al sistema con su contraseña si persiste el error contacte con el administrador del sistema</td>
                    </tr>
                    <tr>
                        <td valign='top' align='left'>
                            <table border='0' cellspacing='0' cellpadding='0' align='left'>
                                <tbody><tr>
                                    <td align='center' style='padding-bottom:20px;padding-top:20px'>
<a href='localhost/Epsas' style='font-size:16px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;font-weight:none;color:#ffffff;text-decoration:none;background-color:#3572b0;border-top:11px solid #3572b0;border-bottom:11px solid #3572b0;border-left:20px solid #3572b0;border-right:20px solid #3572b0;border-radius:5px;display:inline-block' target='_blank'>Acceder al Sistema</a></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top' style='padding-bottom:20px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#333333;font-size:14px;line-height:20px;text-align:left;font-weight:none' align='left'>Aquino<br>
                        Elite Team</td>
                    </tr>
                </tbody></table>
            </td>
        </tr>

        <tr>
            <td>
                <table width='520px' cellpadding='0' cellspacing='0' border='0' bgcolor='#FFFFFF' align='center'>
                    <tbody><tr>
                        <td style='color:#cccccc' valign='top' width='100%''>
                            <hr color='#CCCCCC' size='1'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width='520px' cellpadding='0' cellspacing='0' border='0' bgcolor='#FFFFFF' align='center'>
                                <tbody><tr>
                                    <td valign='top' style='padding-top:10px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#707070;font-size:12px;line-height:18px;text-align:left;font-weight:none' align='left'><a href='http://aycsoft.webuda.com' style='text-decoration:none;color:#707070' target='_blank'>Ver en el Navegador</a><br>
                                    Mensaje Enviado por Elite Team<br></td>
                                    <td align='right' style='padding-top:15px;padding-bottom:30px'><a href='http://aycsoft.webuda.com/' target='_blank'><img src='http://aycsoft.webuda.com/img/ayc.jpg' height='24' width='110' border='0' alt='Atlassian' style='display:block;color:#3572b0' class='CToWUd'></a><img src='./Please verify your email address - ramiroaquinoromero@gmail.com - Gmail_files/2hIIypVtAxxaJXe4mgC-wX3ESXC0IXSUtzzbo3pAhsHnVJjg-4E-tX13ybT6xax0XQG77uwlMLX_7TCJR_KjZLrtKL228Jhh06qbw0HYEmUjWVZ4ktDnEU1HRSXhQCi5jnb47zf7BswZygxCbLjVqPeGkm2Lb' width='1' height='1' class='CToWUd'></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table><div class='yj6qo'></div>";
    }

    public function Mensaje_Registro($nombre,$username,$pass,$cargo)
    {
        return "
        <div><table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none;background-color:#f9f9f9'>
        <tbody><tr>
      <td width='100%' valign='top' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
        <table width='600' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
          <tbody><tr>
            <td valign='top' style='border-collapse:collapse!important;border-spacing:0!important;padding:15px 0 20px;border:none'>
            <center>
                <a href='http://aycsoft.webuda.com' style='text-decoration:none;color:#0654ba' target='_blank'><img src='http://aycsoft.webuda.com/img/ayc.jpg' width='150' height='60' border='0' align='center' style='display:inline block;outline:none;text-decoration:none;border:none'></a>
            </center>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
  </tbody></table> 

    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none;background-color:#f9f9f9'><tbody><tr><td width='100%' valign='top' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
    <table width='600' border='0' cellpadding='0' cellspacing='0' align='center' bgcolor='#f9f9f9' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
      <tbody><tr>
        <td>
            <table width='100%' border='0' cellpadding='0' cellspacing='0' style='margin:20px 0px'>
                <tbody><tr>
                    <td width='50'>
                         <img src='http://aycsoft.webuda.com/img/ayc.jpg' width='60' height='55' border='0' style='display:inline block;outline:none;text-decoration:none;border:none;padding-right:15px'> 
                    </td>
                   <td valign='middle' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
    <h2 style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;line-height:24px;color:#333333;text-align:left;margin:20px 0' align='left'> 
      <b>Registro al Sistema</b>
    </h2>
        </td>
                </tr>
            </tbody></table>
        </td>
      </tr>
      <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;line-height:24px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 25px'>
           <center>
                Bienvenido Sr(a) $nombre.
            </center>
         </td>
      </tr>
      <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;line-height:24px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 20px'>
         Epsas le da la cordial Bienvenida al sistema para que pueda disfrutar de sus funciones asignadas.
         </td>
      </tr>
      <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;line-height:24px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 20px'>
         Se le fue asignado el cargo de $cargo.
         </td>
      </tr>
      <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;line-height:24px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 20px'>
         Su nombre de usuario es $username y su contraseña que le fue asignada es $pass.
         </td>
      </tr>
      <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;line-height:24px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 5px'>
         Ante cualquier duda o consulta acuda al administrador del sistema.
         </td>
      </tr>
        <tr>
          <td valign='top' style='border-collapse:collapse!important;border-spacing:0!important;padding:20px 0;border:none'>
           <table align='center' cellpadding='0' cellspacing='0' border='0' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
              <tbody><tr>
                <td valign='top' align='center' style='border-collapse:collapse!important;border-spacing:0!important;font-size:14px;line-height:normal;font-weight:bold;border-radius:3px;background-image:linear-gradient(to bottom,#0079bc 0%,#00519e 100%);background-color:#0079bc;padding:10px 17px' bgcolor='#0079bc'>
                  <a style='text-decoration:none;color:#ffffff;font-size:18px;line-height:normal;font-weight:bold;font-family:Helvetica,Arial,sans-serif' href='http://aycsoft.webuda.com' target='_blank'>
                  <center>
                    <span style='padding:10px 17px'>
                            Acceder al Sistema
                    </span>
                  </center>
                  </a>
                </td>

              </tr>

            </tbody></table>
          </td>
        </tr>
        <tr>
           <td valign='top' style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#333333;text-align:left;font-size:18px;border-collapse:collapse!important;border-spacing:0!important;border:none;padding:0 0 15px'>
         <center>Atentamente <br>
         Elite Team
         </center>
         </td>
      </tr>
    </tbody></table>
    </td>
    </tr>
    </tbody></table> <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none;border-top:solid 1px #dddddd;background-color:#ffffff'><tbody><tr><td style='font-size:0px;line-height:0px' height='1'>&nbsp;</td></tr></tbody></table> 
    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none;background-color:#ffffff'>
          <tbody><tr>
            <td width='100%' valign='top' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>      

            <table width='600' border='0' cellpadding='0' cellspacing='0' align='center' style='border-collapse:collapse!important;border-spacing:0!important;border:none'>
                <tbody><tr>
                    <td valign='top' style='border-collapse:collapse!important;border-spacing:0!important;padding:20px 0 60px;border:none'>         
    <div>
        <p style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;line-height:normal;color:#888888;text-align:center;font-size:11px;margin:0 0 10px' align='center'><strong>
    Este mensaje es automatico por favor no lo reenvie
    </strong></p></div>
                         
                <p style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;line-height:normal;color:#888888;text-align:center;font-size:11px;margin:0 0 10px' align='center'>
                Titbol envio este mensaje al usuario correspondiente. Para cualquier duda consulte a Elite Team.
                </p>
                

                <p style='font-family:Helvetica,Arial,sans-serif;font-weight:normal;line-height:normal;color:#888888;text-align:center;font-size:11px;margin:0 0 10px' align='center'>
                  TITBOL-2016.          </p>
            </td>
       </tr>
    </tbody></table>
    </td>
    </tr>
    </tbody></table></div>";
    }

}

?>