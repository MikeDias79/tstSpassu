<?php
require_once 'model/home.php';

class HomeController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new home();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/home/home.php';
        require_once 'view/footer.php';
    }
}
