<?php

require_once 'singleton/database.php';

class Reportes {

    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Singleton::getInstance()->getPDO2();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar_Hospitales($distrito) {
        try {
            $sql = $this->pdo->prepare("select d.IdSecuencial,d.distrito,d.manzana,d.barrio,d.IDCLASIFICADOR,c.subclase as descripcion,COUNT(c.subclase) as cantidad from datos d, categoria c where d.IDCLASIFICADOR=c.clase and (d.IDCLASIFICADOR=85110 or d.IDCLASIFICADOR=851101 or d.IDCLASIFICADOR=851104 or d.IDCLASIFICADOR=851105 or d.IDCLASIFICADOR=851211) and d.distrito='".$distrito."' GROUP BY descripcion,d.IDCLASIFICADOR;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar_Hoteles($distrito) {
        try {
            $sql = $this->pdo->prepare("select d.IdSecuencial,d.distrito,d.manzana,d.barrio,d.IDCLASIFICADOR,c.subclase as descripcion,COUNT(c.subclase) as cantidad from datos d, categoria c where d.IDCLASIFICADOR=c.clase and (d.IDCLASIFICADOR=55 or d.IDCLASIFICADOR=55102 or d.IDCLASIFICADOR=55103 or d.IDCLASIFICADOR=5510 or d.IDCLASIFICADOR=551 or d.IDCLASIFICADOR=55101) and d.distrito='".$distrito."' GROUP BY descripcion,d.IDCLASIFICADOR;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar_Restaurantes($distrito) {
        try {
            $sql = $this->pdo->prepare("select d.IdSecuencial,d.distrito,d.manzana,d.barrio,d.IDCLASIFICADOR,c.subclase as descripcion,COUNT(c.subclase) as cantidad from datos d, categoria c where d.IDCLASIFICADOR=c.clase and (d.IDCLASIFICADOR=55203 or d.IDCLASIFICADOR=55201 or d.IDCLASIFICADOR=5520 or d.IDCLASIFICADOR=552 or d.IDCLASIFICADOR=55) and d.distrito='".$distrito."' GROUP BY descripcion,d.IDCLASIFICADOR;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar_Diversion($distrito) {
        try {
            $sql = $this->pdo->prepare("select d.IdSecuencial,d.distrito,d.manzana,d.barrio,d.IDCLASIFICADOR,c.subclase as descripcion,COUNT(c.subclase) as cantidad from datos d, categoria c where d.IDCLASIFICADOR=c.clase and (d.IDCLASIFICADOR=00103 or d.IDCLASIFICADOR=001031 or d.IDCLASIFICADOR=001032 or d.IDCLASIFICADOR=15136 or d.IDCLASIFICADOR=15137 or d.IDCLASIFICADOR=15205 or d.IDCLASIFICADOR=15434) and d.distrito='".$distrito."' GROUP BY descripcion,d.IDCLASIFICADOR;");
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
}
    

?>