<form enctype="multipart/form-data" action="http://localhost/Racons/index.php/Profesor/modificar_taller/<?php echo $taller['id_taller']; ?>" method='POST' id="form_modificar_taller" onsubmit="return enviar();">
    <input name="id_taller" value="<?php $taller['id_taller'] ?>" style="display:none;" ></input>
    <text>Nombre</text>
    <?php echo'<input type="text" id="nombre" name="nombre" value="' . $taller['nombre'] . '"> </input>'; ?>
    <div class="col1">
        <text>Categoria</text>
        <select name="id_categoria">
            <?php
            foreach ($categorias as $categoria) {
                if ($categoria['id_categoria'] = $taller['id_categoria']) {
                    echo' <option selected value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                } else {
                    echo' <option value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="col1">
        <text>Dia</text>
        <select name="dia" id="dia">
            <?php
            $dia = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes',];
            for ($i = 1; $i < 6; $i++) {
                echo' <option value = "' . $i . '">' . $dia[$i] . '</option>';
            }
            ?>
        </select>
    </div>
    <!--    <div class="col2">
            <text>Inicio(HH:MM)</text>
            <div class="hora_form">
    <?php echo '<input type="number" name="hora_inicio_hh" id="hora_inicio_hh" min="0" max="23" value="' . substr($taller['hora_inicio'], -5, 2) . '"/>:'; ?>
    <?php echo '<input type="number" name="hora_inicio_mm" id="hora_inicio_mm" min="0" max="60" value="' . substr($taller['hora_inicio'], -2, 2) . '"/>'; ?>
            </div>
        </div>
        <div class="col2">
            <text>Fin(HH:MM)</text>
            <div class="hora_form">
    <?php echo '<input type="number" name="hora_fin_hh" id="hora_fin_hh" min="0" max="23" value="' . substr($taller['hora_fin'], -5, 2) . '"/>:'; ?>
    <?php echo '<input type="number" name="hora_fin_mm" id="hora_fin_mm" min="0" max="60" value="' . substr($taller['hora_fin'], -2, 2) . '"/>'; ?>
            </div>
        </div>-->
    <select name="dia">
        <?php
        $dia = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes',];
        for ($i = 1; $i < 6; $i++) {
            echo' <option value = "' . $i . '">' . $dia[$i] . '</option>';
        }
        ?>
    </select>

    <text>Inicio(HH:MM)</text>
    <select name="hora_inicio_hh">
        <?php
        for ($i = 0; $i < 24; $i++) {
            if (intval(substr($taller['hora_inicio'], -5, 2)) == $i){
                echo '<option selected';
            }else{
                echo '<option';
            }
            if ($i < 10) {
                echo'  value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo'  value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>:   
    <select name="hora_inicio_mm">
        <?php
        for ($i = 0; $i < 60; $i++) {
            if (intval(substr($taller['hora_inicio'], -2, 2)) == $i){
                echo '<option selected';
            }else{
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
    <text>Fin(HH:MM)</text>
    <select name="hora_fin_hh">
        <?php
        for ($i = 0; $i < 24; $i++) {
            if (intval(substr($taller['hora_fin'], -5, 2)) == $i){
                echo '<option selected';
            }else{
                echo '<option';
            }
            if ($i < 10) {
                echo' value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo' value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>:  
    <select name="hora_fin_mm">
        <?php
        for ($i = 0; $i < 60; $i++) {
            if (intval(substr($taller['hora_fin'], -2, 2)) == $i){
                echo '<option selected';
            }else{
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
    <div class="col2">
        <text>Aforo</text>
        <input type="number" name="aforamiento" value="<?php echo $taller['aforamiento']; ?>"/>
    </div>
    <input type="submit" name="modificar_taller" value="Guardar"/>
</form>
<text>Descripcion</text>
<textarea cols="50" rows="5" name="descripcion" form="form_modificar_taller" value='<?php echo $taller['descripcion']; ?>'>
</textarea>
<script type="text/javascript">
    var taller = {'dia':<?php $taller['dia'] ?>,
        'hora_fin_hh':<?php substr($taller['hora_fin'], -5, 2) ?>,
        'hora_fin_mm':<?php substr($taller['hora_fin'], -2, 2) ?>,
        'hora_inicio_hh':<?php substr($taller['hora_inicio'], -5, 2) ?>,
        'hora_inicio_mm':<?php substr($taller['hora_inicio'], -2, 2) ?>};
    var alerta = 0;
    function enviar() {
        var dia = document.getElementById("dia").value;
        var hora_inicio_hh = document.getElementById("hora_inicio_hh").value;
        var hora_inicio_mm = document.getElementById("hora_inicio_mm").value;
        var hora_fin_hh = document.getElementById("hora_fin_hh").value;
        var hora_fin_mm = document.getElementById("hora_fin_mm").value;
        if (taller['dia'] != dia || taller['hora_inicio_hh'] != hora_inicio_hh || taller['hora_inicio_mm'] != hora_inicio_mm
                || taller['hora_fin_hh'] != hora_fin_hh || taller['hora_fin_mm'] != hora_fin_mm) {
            var statusConfirm = confirm("Si modifica la fecha del taller, los alumnos apuntados tendran que volver apuntarse. ¿Seguro que desea continuar?");
            if (statusConfirm == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

</script>
