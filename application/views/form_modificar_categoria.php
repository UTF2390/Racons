<form enctype="multipart/form-data" action="" method="post">
    <fieldset>Datos Categoria</fieldset>
    <div class="form-group label-floating">
        <label class="control-label">Nombre</label>
        <input id="nombre" class="form-control" type="text" name="nombre"  value="<?php echo $categoria['nombre']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Limite</label>
        <input id="limite" class="form-control" type="number" name="limite" value="<?php echo $categoria['limite']; ?>">
    </div>
    <br><br>
    <p class="text-center">
        <button type="button" id="modal_form_boton_categoria" href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
    </p>
</form>