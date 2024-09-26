<h1 class="page-header">
    <?php echo $pvd->Cod != null ? $pvd->Titulo : 'Novo'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=livro">Livros</a></li>
  <li class="active"><?php echo $pvd->Cod != null ? $pvd->Titulo : 'Novo Livro'; ?></li>
</ol>

<form id="frm-livro" action="?c=livro&a=AddAutorLivro" method="post" enctype="multipart/form-data">
    <input type="hidden" name="Cod" value="<?php echo $pvd->Cod; ?>" />

    <div class="form-group">
        <label>Autor</label>
            <Select name="CodAu" class="form-control">
                <?php foreach($this->model->ListaAutor() as $r): ?>
                    <option value="<?php echo $r->CodAu;?>"><?php echo $r->Nome;?></option>
                <?php endforeach; ?>
            </Select>
        </td>
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Adicionar</button>
    </div>
</form>

<hr style="height:2px;background:#808080;border:none">


<?php foreach($this->model->LivroAutor($pvd->Cod) as $a): ?>
    <?php echo $a->Nome;?><a onclick="javascript:return confirm('Confirma?');" href="?c=livro&a=EliminarAutorLivro&Cod=<?php echo  $pvd->Cod; ?>&CodAu=<?php echo $a->CodAu;?>"> (X) </a><br>
<?php endforeach; ?>

<script>
    $(document).ready(function(){
        $("#frm-livro").submit(function(){
            return $(this).validate();
        });
    })
</script>
