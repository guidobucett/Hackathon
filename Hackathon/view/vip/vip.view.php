<?php
 class VipView {

    public function __CONSTRUCT() {
        
    }

    public function View($empresa) {
        require_once 'view/header.php';
        require_once 'view/vip/vip-admin.php'; //html
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