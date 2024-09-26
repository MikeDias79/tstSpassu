<?php
require_once 'Model/livro.php';

class LivroController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new livro();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/livro/livro.php';
        require_once 'view/footer.php';
    }

    
    public function Crud(){
        $pvd = new livro();

        if(isset($_REQUEST['Cod'])){
            $pvd = $this->model->Obter($_REQUEST['Cod']);
        }

        require_once 'view/header.php';
        require_once 'view/livro/livro-editar.php';
        require_once 'view/footer.php';
  }

  public function CadAutor(){
    $pvd = new livro();

    if(isset($_REQUEST['Cod'])){
        $pvd = $this->model->Obter($_REQUEST['Cod']);
    }

    require_once 'view/header.php';
    require_once 'view/livro/livro-autor.php';
    require_once 'view/footer.php';
}

    public function novo(){
        $pvd = new livro();

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/livro/livro-novo.php';
        require_once 'view/footer.php';
    }

    public function Registrar(){
        $pvd = new livro();
        $pvd->Titulo = $_REQUEST['Titulo'];
        $pvd->Editora = $_REQUEST['Editora'];
        $pvd->Edicao = $_REQUEST['Edicao'];
        $pvd->AnoPublicacao = $_REQUEST['AnoPublicacao'];
        $pvd->Preco = $_REQUEST['Preco'];
        $pvd->CodAs = $_REQUEST['CodAs'];
        $this->model->Registrar($pvd);
        header('Location: index.php');
    }

    public function AddAutorLivro(){
        $pvd = new livro();
        $pvd->CodAu = $_REQUEST['CodAu'];
        $pvd->Cod = $_REQUEST['Cod'];
        $this->model->RegistraAutorLivro($pvd);
        header('Location: index.php?c=livro&a=CadAutor&Cod=' . $pvd->Cod);
    }

    public function Editar(){
        $pvd = new livro();
        $pvd->Titulo = $_REQUEST['Titulo'];
        $pvd->Editora = $_REQUEST['Editora'];
        $pvd->Edicao = $_REQUEST['Edicao'];
        $pvd->AnoPublicacao = $_REQUEST['AnoPublicacao'];
        $pvd->Preco = $_REQUEST['Preco'];
        $pvd->CodAs = $_REQUEST['CodAs'];
        $pvd->Cod = $_REQUEST['Cod'];
        $this->model->Atualizar($pvd);
        header('Location: index.php');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['Cod']);
        header('Location: index.php');
    }


    public function EliminarAutorLivro(){
        $this->model->ApagarAutorLivro($_REQUEST['Cod'], $_REQUEST['CodAu']);
        header('Location: index.php?c=livro&a=CadAutor&Cod=' . $_REQUEST['Cod']);
    }

}
