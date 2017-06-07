<form enctype="multipart/form-data" action="" method="post">
    <fieldset>Datos Curso</fieldset>
    <div class="form-group label-floating">
        <label class="control-label">Nombre del Curso</label>
        <input id="id_curso_form" style="display: none;" class="form-control" type="number" name="id_curso" value="<?php echo $curso['id_curso'];?>">
        <input id="curso_form" class="form-control" type="text" name="curso" value="<?php echo $curso['curso'];?>">
    </div>
    <br><br>
    <p class="text-center">
        <button type="button" id="modal_form_boton_curso" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardarrr</button>
    </p>
</form>