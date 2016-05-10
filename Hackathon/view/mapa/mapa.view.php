<?php
 class mapaView {

    public function __CONSTRUCT() {
        
    }

    public function View() {
        require_once 'view/header.php';
        require_once 'view/mapa/mapa-admin.php'; //html
        require_once 'view/footer.php';
       
    
   }

   public function Ver($rows)
   {
        require_once 'view/header.php';
        require_once 'view/mapa/mapa-hospital.php'; //html
        require_once 'view/footer.php';
   }
}
  ?>