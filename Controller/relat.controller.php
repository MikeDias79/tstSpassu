<?php
require_once 'model/relat.php';

class RelatController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new relat();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/relat/relat.php';
        require_once 'view/footer.php';
    }

}
