<?php
require_once 'model/assunto.php';

class AssuntoController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new assunto();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/assunto/assunto.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $ass = new assunto();

        if(isset($_REQUEST['CodAs'])){
            $ass = $this->model->Obter($_REQUEST['CodAs']);
        }

        require_once 'view/header.php';
        require_once 'view/assunto/assunto-editar.php';
        require_once 'view/footer.php';
    }

    public function novo(){
        $ass = new assunto();
        require_once 'view/header.php';
        require_once 'view/assunto/assunto-novo.php';
        require_once 'view/footer.php';
    }

    public function Registrar(){
        $ass = new assunto();
        $ass->Descricao = $_REQUEST['Descricao'];
        $this->model->Registrar($ass);
        header('Location: index.php?c=assunto');
    }

    public function Editar(){
        $ass = new assunto();
        $ass->Descricao = $_REQUEST['Descricao'];
        $ass->CodAs = $_REQUEST['CodAs'];

        $this->model->Atualizar($ass);

        header('Location: index.php?c=assunto');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['CodAs']);
        header('Location: index.php?c=assunto');
    }
}
