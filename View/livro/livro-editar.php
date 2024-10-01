<h1 class="page-header">
    <?php echo $pvd->Cod != null ? $pvd->Titulo : 'Novo'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=livro">Livros</a></li>
  <li class="active"><?php echo $pvd->Cod != null ? $pvd->Titulo : 'Novo Livro'; ?></li>
</ol>

<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4/dist/autoNumeric.min.js"></script>

<form id="frm-livro" action="?c=livro&a=Editar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="Cod" value="<?php echo $pvd->Cod; ?>" />

    <div class="form-group">
        <label>Titulo</label>
        <input type="text" name="Titulo" value="<?php echo $pvd->Titulo; ?>" class="form-control" placeholder="Titulo do Livro - Apenas Letras e Numeros" required pattern="[A-Za-z0-9 ]+"/>
    </div>

    <div class="form-group">
        <label>Editora</label>
        <input type="text" name="Editora" value="<?php echo $pvd->Editora; ?>" class="form-control" placeholder="Nome da Editora - Apenas Letras e Numeros" required   pattern="[A-Za-z0-9 ]+"/>
    </div>

    <div class="form-group">
        <label>Edição</label>
        <input type="number" name="Edicao" value="<?php echo $pvd->Edicao; ?>" class="form-control" placeholder="Número da Edição - Apenas Número" required   />
    </div>

    <div class="form-group">
        <label>Ano de Publicação</label>
        <input type="number" name="AnoPublicacao" value="<?php echo $pvd->AnoPublicacao; ?>" class="form-control" required placeholder="Ano de Publicação - Apenas Número (Entre 1980 e 2025)" min="1980" max="2025" />
    </div>

    <div class="form-group">
            <label for="Preco">Preço:</label>
        <input type="text" id="Preco" name="Preco" value="<?php echo $pvd->Preco; ?>" class="form-control" required placeholder="R$ 0,00"  />
    </div>


    <div class="form-group">
        <label>Assunto</label>
            <Select name="CodAs" class="form-control">
                <?php foreach($this->model->ListaAssunto() as $r): ?>
                    <option value="<?php echo $r->CodAs;?>"  <?php if ($r->CodAs == $pvd->Assunto_CodAs) { ?> SELECTED <?php } ?>  ><?php echo $r->Descricao;?></option>
                <?php endforeach; ?>
            </Select>
        </td>
    </div>
<!--
    <div class="form-group">
        <label>Autor</label>
            <Select name="CodAu" class="form-control">
                <?php foreach($this->model->ListaAutor() as $r): ?>
                    <option value="<?php echo $r->CodAu;?>" <?php if ($r->CodAu == $pvd->Autor_CodAu) { ?> SELECTED <?php } ?> ><?php echo $r->Nome;?></option>
                <?php endforeach; ?>
            </Select>
        </td>
    </div>
                -->
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Atualizar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-livro").submit(function(){
            return $(this).validate();
        });
    })
</script>

<script>
        new AutoNumeric("#Preco", {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            decimalPlaces: 2
        });
    </script>
