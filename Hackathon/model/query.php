<?php
 require_once 'singleton/database.php';

class Query {

    private $pdo;
    private $pdo2;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Singleton::getInstance()->getPDO();
            $this->pdo2 = Singleton::getInstance()->getPDO2();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarHospital() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='851101'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

     public function ListarLaboratorios() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='85191'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ListarTerapeutico() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='85193'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


     public function ListarRadiologicos() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='85192'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
     public function ListarBancoSangre() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='85194'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarVeterinaria() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='852' or c.clase='8520' or c.clase='85200')");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ListarJuridico() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='7411' or c.clase='74110') ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    public function ListarContaduria() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='74120' or c.clase='712' )");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

     public function ListarMercado() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='7413' or c.clase='74130' )");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ListarEmpresarial() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='7414' or c.clase='74140' )");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarArquitectura() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and (c.clase='74140' or c.clase='742' or c.clase='74211' or c.clase='74212' )");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarOdontologia() {
        try {
           $sql = $this->pdo2->prepare("SELECT d.latitud,d.longitud,d.DescripcionClasificacion,d.NombreRef
             FROM datos d,categoria c
             where d.IDCLASIFICADOR=c.clase and c.clase='85123'");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Registrar($datos)
    {
         try {
           $this->pdo->insertInto('area', $datos)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Editar($datos)
    {
         try {
           $this->pdo->update('area')
                     ->set($datos)
                     ->where('pkarea', $datos['pkarea'])
                     ->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
      try 
        {
           return $this->pdo
         ->from('area')
         ->select('area.*')
         ->where('pkarea=?',$id)          
         ->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Existearea($nombre)
    {
       try 
        {
          return $this->pdo
         ->from('area')
         ->select('area.*')
         ->where('nombre=?',$nombre)          
         ->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
      try 
        {
           $this->pdo->update('area')
                     ->set('estado',0)
                     ->where('pkarea', $id)
                     ->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>