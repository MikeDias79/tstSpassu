<h1 class="page-header">
    <?php echo $ass->CodAu != null ? $ass->Nome : 'Autor'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=autor">Autor</a></li>
  <li class="active"><?php echo $ass->CodAu != null ? $ass->Nome : 'Autor'; ?></li>
</ol>

<form id="frm-autor" action="?c=autor&a=Editar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="CodAu" value="<?php echo $ass->CodAu; ?>" />

    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="Nome" value="<?php echo $ass->Nome; ?>" class="form-control" placeholder="Nome do Autor" data-validacion-tipo="requerido|min:20" />
    </div>
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Atualizar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-autor").submit(function(){
            return $(this).validate();
        });
    })
</script>
