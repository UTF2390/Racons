<div class="horario container">
    <?php
    $dia_orden = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri'];
    $traductor = ['Mon' => 'Lunes', 'Tue' => 'Martes', 'Wed' => 'Miercoles', 'Thu' => 'Jueves', 'Fri' => 'Viernes',];
    $o = 1;
//    var_dump($horario);
    for ($h = 1; $h < 6; $h++) {
        $dia = $horario[$h];
        echo '<div class="talleres_dia col2">';
        if ($dia != null) {
//        var_dump($numero_dias[$dia_orden[$h]][0]['dia_mes'].'asdfajdfasdfasdfasfddfadfsdf');
            echo '<div class="cabezera_dia">';
            echo '<div class="dia_semana">' . $traductor[$dia_orden[$h]] . '</div>';
//        var_dump($numero_dias[$dia_orden[$o]][0]['dia_mes']);
            echo '<div class="dia_mes">' . $numero_dias[$dia_orden[$h]][0]['dia_mes'] . '</div>';
            echo '</div>';
            foreach ($dia as $taller) {
//            var_dump($taller);
                echo '<div class="taller col12">';
                echo '<div class="nombre col6">' . $taller['nombre'] . '</div>';
                echo '<div class="hora col6">';
                echo '<div class="hora_inicio col12">' . substr($taller['hora_inicio'], -5) . '</div>';
                echo '<div class="hora_inicio col12">' . substr($taller['hora_fin'], -5) . '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="no_hay_tareas">No hay tareas para este dia.</div>';
        }
        echo '</div>';
    }
    $o += 1;
    ?>
</div>

<script>
//    window.onload = function () {
//♦♦♦♦♦♦♦♦♦♦♦ No terminado no funciona♦♦♦♦♦♦♦♦♦♦
//    $(".deshabilitar_taller").click(function () {
//        var id_categoria = $(this).closest("tr")
//                .find(".id_categoria")
//                .val();
//
//        var data = {'id_categoria': id_categoria};
//
//        var url = "http://localhost/Racons/index.php/admin/eliminar_categoria";
//        var tr = $(this).closest("tr");
//        $.ajax({
//            type: 'POST',
//            url: url,
//            data: data
//
//        }).done(function (response) {
//            if (response = "ok") {
//                tr.remove();
//                console.log('Eliminado correctamente.');
//            } else {
//                alert('No se pudo eliminar correctamente.');
//            }
//        }).fail(function (textStatus) {
//            console.log("La solicitud a fallado: ");
//            alert("La solicitud a fallado: ");
//        });
//    });
//    }
</script>
