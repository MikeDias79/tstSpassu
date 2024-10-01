<h1 class="page-header">
Novo Autor
</h1>

<ol class="breadcrumb">
  <li><a href="?c=assunto">Autor</a></li>
  <li class="active">Novo Registro</li>
</ol>

<form id="frm-autor" action="?c=autor&a=Registrar" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label>Nome</label>
        <input type="text" name="Nome" value="" class="form-control" placeholder="Nome do Autor"   pattern="[A-Za-z0-9 ]+" required />
    </div>
    
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Registrar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-autor").submit(function(){
            return $(this).validate();
        });
    })
</script>
