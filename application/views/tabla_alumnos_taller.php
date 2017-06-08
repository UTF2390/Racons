<table class="table table-hover text-center">
    <thead>
        <tr>
            <th class="text-center" style="display: none;">#</th>
            <th class="text-center">#</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Primer Apellido</th>
            <th class="text-center">Segundo Apellido</th>
            <th class="text-center">Curso</th>
            <th class="text-center">Expulsar</th>
                
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($alumnos as $alumno):
            echo '<tr id="id_alumno_modal_' . $alumno['id_alumno'] . '">';
            echo '<td class="id_curso" style="display: none;">' . $alumno['id_curso'] . '</td>';
            echo '<td class="id_persona" >' . $alumno['id_persona'] . '</td>';
            echo '<td class="nombre" >' . $alumno['nombre'] . '</td>';
            echo '<td class="apellido1" >' . $alumno['apellido1'] . '</td>';
            echo '<td class="apellido2" >' . $alumno['apellido2'] . '</td>';
            echo '<td class="curso" >' . $alumno['curso'] . '</td>';
            echo '<td><a onclick="expulsar_alumno(this,' . $id_taller . ',' . $alumno['id_alumno'] . ')" class="glyphicon glyphicon-remove-sign"></a></td>';
            
            echo '</tr>';
        endforeach
        ?>
    </tbody>
</table>