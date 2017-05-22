<?php
    echo '
    <table >
    <thead>
        <tr>
            <td>
             Nombre
            </td>
            <td>
            Categoria 
            </td>
            <td>
            Plazas 
            </td>
            <td>
            Dia 
            </td>
            <td>
            Inicio(h)
            </td>
            <td>
            Fin(h) 
            </td>
            <td style="display:none;">
            </td>
            <td style="display:none;">
            </td>
        </tr>
    </thead>
    <tbody>';
    $dia = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes',];
    foreach ($talleres as $taller) {
        if ($taller['activo']) {
            echo '<tr class="taller_deshabilitado">';
        } else {
            echo '<tr class="taller_habilitado">';
        }
        echo '<tr>';
        echo '
            <td>
            ' . $taller['nombre'] . '
            </td>
            <td>
            ' . $taller['nombre_categoria'] . '
            </td>
            <td>
            ' . $taller['aforamiento'] . '/' . $taller['participantes'] . '
            </td>
            <td>
            ' . $dia[$taller['dia']] . '
            </td>
            <td>
            ' . substr($taller['hora_inicio'], -5) . '
            </td>
            <td>
            ' . substr($taller['hora_fin'], -5) . '
            </td>
            <td>';
        if ($taller['activo']) {
            echo '<button class = "deshabilitar_taller">Deshabilitar</button>';
        } else {
            echo '<button class = "habilitar_taller">Habilitar</button>';
        }
        echo '</td>
        </tr>';
    }
    echo '</tbody>';
    echo '</table>';

?>
<script>
//    window.onload = function () {
//♦♦♦♦♦♦♦♦♦♦♦ No terminado no funciona♦♦♦♦♦♦♦♦♦♦
    $(".deshabilitar_taller").click(function () {
        var id_categoria = $(this).closest("tr")
                .find(".id_categoria")
                .val();

        var data = {'id_categoria': id_categoria};

        var url = "http://localhost/Racons/index.php/admin/eliminar_categoria";
        var tr = $(this).closest("tr");
        $.ajax({
            type: 'POST',
            url: url,
            data: data

        }).done(function (response) {
            if (response = "ok") {
                tr.remove();
                console.log('Eliminado correctamente.');
            } else {
                alert('No se pudo eliminar correctamente.');
            }
        }).fail(function (textStatus) {
            console.log("La solicitud a fallado: ");
            alert("La solicitud a fallado: ");
        });
    });
//    }
</script>
