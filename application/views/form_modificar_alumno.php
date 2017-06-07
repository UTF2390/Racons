<form class="modificar_alumno"  enctype="multipart/form-data" action="" method="post">
    <fieldset>Datos Alumno</fieldset>
    <div class="form-group label-floating">
        <label class="control-label">Usuario</label>
        <input id="nick" class="form-control" type="text" name="nick" value="<?php echo $alumno['nick']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Password</label>
        <input id="password" class="form-control" type="text" name="password" value="<?php echo $alumno['password']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Nombre</label>
        <input id="nombre" class="form-control" name="nombre" value="<?php echo $alumno['nombre']; ?>"></input>
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Primer Apellido</label>
        <input id="apellido1" class="form-control" type="text" name="apellido1" value="<?php echo $alumno['apellido1']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Segundo Apellido</label>
        <input id="apellido2" class="form-control" type="text" name="apellido2" value="<?php echo $alumno['apellido2']; ?>">
    </div>

    <div class="form-group">
        <label class="control-label" class="control-label">Curso</label>
        <select id="id_curso" name="id_curso">
            <?php
            foreach ($cursos as $curso) {
                if ($curso['id_curso'] == $alumno['id_curso']) {
                    echo' <option selected value = "' . $curso['id_curso'] . '">' . $curso['curso'] . '</option>';
                } else {
                    echo' <option value = "' . $curso['id_curso'] . '">' . $curso['curso'] . '</option>';
                }
            }
            ?>
        </select> 
    </div>
    <br><br>
    <p class="text-center">
        <button id="modal_form_boton_alumno" type="button" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
    </p>
</form>