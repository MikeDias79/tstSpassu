<h1 class="page-header">Assuntos </h1>
<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=assunto&a=novo">Novo Assunto</a>
    <a class="btn btn-primary" href="?c=livro">Livros</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:20px;">Código Assunto</th>
            <th style="width:220px;">Descrição</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->CodAs; ?></td>
            <td><?php echo $r->Descricao; ?></td>
            <td>
                <a href="?c=assunto&a=Crud&CodAs=<?php echo $r->CodAs; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('Confirma?');" href="?c=assunto&a=Eliminar&CodAs=<?php echo $r->CodAs; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
