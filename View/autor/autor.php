<h1 class="page-header">Autores </h1>
<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=autor&a=novo">Novo Autor</a>
    <a class="btn btn-primary" href="?c=livro">Livros</a>
    <a class="btn btn-primary" href="index.php">Home</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:20px;">Código Autor</th>
            <th style="width:220px;">Nome</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->CodAu; ?></td>
            <td><?php echo $r->Nome; ?></td>
            <td>
                <a href="?c=autor&a=Crud&CodAu=<?php echo $r->CodAu; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('Confirma?');" href="?c=autor&a=Eliminar&CodAu=<?php echo $r->CodAu; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
