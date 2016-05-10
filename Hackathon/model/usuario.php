<?php

require_once 'singleton/database.php';

class Usuario {

    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Singleton::getInstance()->getPDO2();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar() {
        try {
            $sql = $this->pdo->prepare("select u.pkusuario,u.nombre,u.ci,u.telefono,u.email,c.nombre as cargo from usuario u, cargo c where u.fkcargo=c.pkcargo and u.estado=1 and c.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM usuario u WHERE u.pkusuario= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = $this->pdo->prepare("INSERT INTO usuario (nombre,correo,username,pass) VALUES (?,?,?,?)");
            $sql->execute(
                array(
                    $datos['nombre'],
                    $datos['correo'],
                    $datos['username'],
                    $datos['pass']
                )
            );
            if($sql)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Cargar_Perfil($pkusuario) {
        try {
            $sql = $this->pdo->prepare("select u.pkusuario,u.nombre,u.pass,u.ci,u.telefono,u.username,u.email,c.nombre as cargo from usuario u, cargo c where u.fkcargo=c.pkcargo and u.estado=1 and c.estado=1 and u.pkusuario=$pkusuario;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Acceder($username,$pass) {
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario,u.nombre,u.correo from usuario u where u.username='".$username."' and u.pass='".$pass."' and u.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Acceder_Empresa($username,$pass) {
        try {
            $sql = $this->pdo->prepare("SELECT e.pkempresa,e.nombre,e.responsable from empresa e where e.username='".$username."' and e.pass='".$pass."' and e.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Mail_User($correo) {
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario,u.nombre,u.ci,u.telefono,u.email,c.nombre as cargo,u.pass from usuario u,cargo c where u.fkcargo=c.pkcargo and u.email='".$correo."'  and u.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Cargo_User($cargo) {
        try {
            $sql = $this->pdo->prepare("SELECT * from cargo where pkcargo=$cargo");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE usuario SET ci=? ,nombre=? ,email=? ,telefono=? ,username=? ,fkcargo=? WHERE pkusuario=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['ci'],
                    $datos['nombre'],
                    $datos['email'],
                    $datos['telefono'],
                    $datos['username'],
                    $datos['fkcargo'],
                    $datos['pk']
                )
            );
        } catch (exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($pk) {
        try {
            $sql = $this->pdo->prepare("UPDATE usuario SET estado=0 WHERE pkusuario = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>