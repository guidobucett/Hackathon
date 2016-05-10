<?php
require_once 'view/categoria/categoria.view.php';
class categoriaController {

    private $model;
    private $vista;

    public function __CONSTRUCT() {
        $this->vista=new categoriaView();
    }

    public function Index() {
       // $lista = $this->model->Listar();        
        $this->vista->View();
    }

   

}
?>