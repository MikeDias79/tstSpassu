<h1 class="page-header">Livros</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=livro&a=novo">Novo Livro</a>
    <a class="btn btn-primary" href="?c=assunto">Assuntos</a>
    <a class="btn btn-primary" href="?c=autor">Autores</a>
</div>

<table class="table table-striped" border="0">
    <thead>
        <tr>
            <th style="width:10px;">COD</th>
            <th style="width:100px;">TITULO</th>
            <th style="width:70px;">EDITORA</th>
            <th style="width:20px;">EDICAO</th>
            <th style="width:20px;">ANO</th>
            <th style="width:100px;">AUTOR</th>
            <th style="width:100px;">ASSUNTO</th>
            <th style="width:10px;"></th>
            <th style="width:10px;"></th>
            <th style="width:10px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->Cod;?></td>
            <td><?php echo $r->Titulo;?></td>
            <td><?php echo $r->Editora;?></td>
            <td><?php echo $r->Edicao;?></td>
            <td><?php echo $r->AnoPublicacao;?></td>
            <td>

                <?php foreach($this->model->LivroAutor($r->Cod) as $a): ?>
                    <?php echo $a->Nome;?><br>
                <?php endforeach; ?>

            </td>
            <td><?php echo $r->Descricao;?></td>
            <td><a href="?c=livro&a=CadAutor&Cod=<?php echo $r->Cod; ?>">Cadastrar Autor</a></td>
            <td><a href="?c=livro&a=Crud&Cod=<?php echo $r->Cod; ?>">Editar</a></td>
            <td><a onclick="javascript:return confirm('Confirma?');" href="?c=livro&a=Eliminar&Cod=<?php echo $r->Cod; ?>">Eliminar</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
