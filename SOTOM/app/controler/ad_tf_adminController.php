<?php
class AdminController{
    public function lista(){

        require_once 'app/models/ad_tf_modeloBase.php';
        $modelo = new ModeloBase();
        $tablaprincipal = $modelo->tablaprincipal();
        require_once 'app/views/ad_tf_adminPage.php';
    }
}