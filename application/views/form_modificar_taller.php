<form enctype="multipart/form-data" method="post" id="form_modificar">
    <fieldset>Datos Alumno</fieldset>
    <div class="form-group label-floating">
        <label class="control-label">Nombre</label>
        <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $taller['nombre']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Descripción</label>
        <input id="descripcion" class="form-control" type="text" name="descripcion" value="<?php echo $taller['descripcion']; ?>">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Aforamiento</label>
        <input id="aforamiento" type="number" class="form-control" name="aforamiento" value="<?php echo $taller['aforamiento']; ?>"></input>
    </div>
    <div class="form-group">
        <label class="control-label">Dia</label>
        <select id="dia" class="form-control" name="dia">
            <?php
            $dia = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes'];
            for ($i = 1; $i < 6; $i++) {
                if ($taller['dia'] == $i) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                echo' value = "' . $i . '">' . $dia[$i] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label ">Hora Inicio</label>
        <select id="hora_inicio_hh" class="hora" name="hora_inicio_hh">
            <?php
            for ($i = 0; $i < 24; $i++) {
                if ((int) substr($taller['hora_inicio'], -5, 2) == $i) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                if ($i < 10) {
                    echo' <option value = "0' . $i . '">0' . $i . '</option>';
                } else {
                    echo' <option value = "' . $i . '">' . $i . '</option>';
                }
            }
            ?>
        </select>
        <!--</div>-->
        <!--                                            <div class="form-group">-->
        <label class="control-label hora"> : </label>
        <select id="hora_inicio_mm" class="" name="hora_inicio_mm">
            <?php
            for ($i = 0; $i < 60; $i++) {
                if ((int) substr($taller['hora_inicio'], -2, 2) == $i) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                if ($i < 10) {
                    echo' value = "0' . $i . '">0' . $i . '</option>';
                } else {
                    echo' value = "' . $i . '">' . $i . '</option>';
                }
            }
            ?>
        </select>
        <!--</div>-->
        <!--<div class="form-group">-->
        <label class="control-label">Hora Fin</label>
        <select id="hora_fin_hh" class="hora" name="hora_fin_hh">
            <?php
            for ($i = 0; $i < 24; $i++) {
                if ((int) substr($taller['hora_fin'], -5, 2) == $i) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                if ($i < 10) {
                    echo' value = "0' . $i . '">0' . $i . '</option>';
                } else {
                    echo' value = "' . $i . '">' . $i . '</option>';
                }
            }
            ?>
        </select>
        <!--</div>-->
        <!--<div class="form-group">-->
        <label class="control-label  hora"> : </label>
        <select id="hora_fin_mm" class="" name="hora_fin_mm">
            <?php
            for ($i = 0; $i < 60; $i++) {
                if ((int) substr($taller['hora_fin'], -2, 2) == $i) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                if ($i < 10) {
                    echo' value = "0' . $i . '">0' . $i . '</option>';
                } else {
                    echo' value = "' . $i . '">' . $i . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label">Categoria</label>
        <select id="id_categoria" class="form-control" name="id_categoria">
            <?php
            foreach ($categorias as $categoria) {
                if ($taller['id_categoria'] == $categoria['id_categoria']) {
                    echo '<option selected';
                } else {
                    echo '<option';
                }
                if ($taller['id_categoria'] == $categoria['id_categoria']) {
                    echo' value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                } else {
                    echo' value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group" id="checkboxes">
        <label class="control-label">Curso</label>
        <?php
        $c = 1;
        foreach ($cursos as $curso) {

            echo '<input id="id_curso_' . $c . '" value="' . $curso['id_curso'] . '" type="checkbox" name="id_curso_' . $c . '" value="' . $curso['id_curso'] . '">' . $curso['curso'] . '</input>';
            $c += 1;
        }
        ?>
    </div>
    <br><br>
    <p class="text-center">
        <button type="button" id="modal_form_boton_taller" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
    </p>
</form>