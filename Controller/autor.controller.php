<?php
require_once 'model/autor.php';

class AutorController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new autor();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/autor/autor.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $ass = new autor();

        if(isset($_REQUEST['CodAu'])){
            $ass = $this->model->Obter($_REQUEST['CodAu']);
        }

        require_once 'view/header.php';
        require_once 'view/autor/autor-editar.php';
        require_once 'view/footer.php';
    }

    public function novo(){
        $ass = new autor();
        require_once 'view/header.php';
        require_once 'view/autor/autor-novo.php';
        require_once 'view/footer.php';
    }

    public function Registrar(){
        $ass = new autor();
        $ass->Nome = $_REQUEST['Nome'];
        $this->model->Registrar($ass);
        header('Location: index.php?c=autor');
    }

    public function Editar(){
        $ass = new autor();
        $ass->Nome = $_REQUEST['Nome'];
        $ass->CodAu = $_REQUEST['CodAu'];

        $this->model->Atualizar($ass);

        header('Location: index.php?c=autor');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['CodAu']);
        header('Location: index.php?c=autor');
    }
}
