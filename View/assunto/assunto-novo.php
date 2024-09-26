<h1 class="page-header">
Novo Assunto
</h1>

<ol class="breadcrumb">
  <li><a href="?c=assunto">Assuntos</a></li>
  <li class="active">Novo Registro</li>
</ol>

<form id="frm-assunto" action="?c=assunto&a=Registrar" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label>Descrição</label>
        <input type="text" name="Descricao" value="" class="form-control" placeholder="Descrição do Assunto" data-validacion-tipo="requerido|min:20" />
    </div>
    
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-assunto").submit(function(){
            return $(this).validate();
        });
    })
</script>
