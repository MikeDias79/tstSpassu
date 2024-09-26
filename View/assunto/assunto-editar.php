<h1 class="page-header">
    <?php echo $ass->CodAs != null ? $ass->Descricao : 'Assunto'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=assunto">Assunto</a></li>
  <li class="active"><?php echo $ass->CodAs != null ? $ass->Descricao : 'Assunto'; ?></li>
</ol>

<form id="frm-assunto" action="?c=assunto&a=Editar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="CodAs" value="<?php echo $ass->CodAs; ?>" />

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="Descricao" value="<?php echo $ass->Descricao; ?>" class="form-control" placeholder="Descrição do Assunto" data-validacion-tipo="requerido|min:20" />
    </div>
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Atualizar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-assunto").submit(function(){
            return $(this).validate();
        });
    })
</script>
