<?php
 class ReportesView {

    public function __CONSTRUCT() {
        
    }

    public function View() {
        require_once 'view/header.php';
        require_once 'view/reportes/reportes-admin.php'; //html
        require_once 'view/footer.php'; 
   }

    public function Reporte_Barra($rep,$tipo) {
        require_once 'view/header.php';
        require_once 'view/reportes/reportes-barra.php'; //html
        require_once 'view/footer.php'; 
   }

    public function Reporte_Torta($rep,$tipo) {
        require_once 'view/header.php';
        require_once 'view/reportes/reportes-torta.php'; //html
        require_once 'view/footer.php'; 
   }
}
  ?>