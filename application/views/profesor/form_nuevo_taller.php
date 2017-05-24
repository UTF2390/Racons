<form enctype="multipart/form-data" action="<?php base_url() ?>nuevo_taller" method='POST' class="col">
    <text>Nombre</text>
    <input type='text' id='nombre' name="nombre"></input>
    <text>Categoria</text>
    <select name="id_categoria">
        <?php
        foreach ($categorias as $categoria) {
            echo' <option value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
        }
        ?>
    </select>

    <text>Descripcion</text>
    <input type="text" name="descripcion"/><br>
    <text>Cursos</text>
    <div class="">
    //<?php
    $c = 0;
    foreach ($cursos as $curso) {
        echo '<input type="checkbox" name="curso' . $c . '" value="' . $curso['id_curso'] . '">' . $curso['curso'] . ' </input>';
        $c += 1;
    }
    ?>
    </div>
</div>
    <text>Dia</text>
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
            if ($i < 10) {
                echo' <option value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo' <option value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>:   
    <select name="hora_inicio_mm">
        <?php
        for ($i = 0; $i < 60; $i++) {
            if ($i < 10) {
                echo' <option value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo' <option value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>     
    <text>Fin(HH:MM)</text>
    <select name="hora_fin_hh">
        <?php
        for ($i = 0; $i < 24; $i++) {
            if ($i < 10) {
                echo' <option value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo' <option value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>:  
    <select name="hora_fin_mm">
        <?php
        for ($i = 0; $i < 60; $i++) {
            if ($i < 10) {
                echo' <option value = "0' . $i . '">0' . $i . '</option>';
            } else {
                echo' <option value = "' . $i . '">' . $i . '</option>';
            }
        }
        ?>
    </select>
    <text>Aforo</text>
    <input type="number" name="aforamiento"/><br>
    <input type="submit" value="Guardar"/>
</form>
<script type="text/javascript">
    var numero_cursos = 1;
    function nuevo_curso() {
        var curso = document.getElementById("id_curso0");
        var nuevo_curso = curso.cloneNode(true);
        nuevo_curso.setAttribute("name", "id_curso" + numero_cursos);
        document.getElementById("baton_id_curso").insertBefore(nuevo_curso);
        numero_cursos += 1;
    }
</script>
