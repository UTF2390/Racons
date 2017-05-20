<?php
echo '
    <table>
    <thead>
        <tr>
            <td>
             Curso
            </td>
            <td>
            </td>
        </tr>
    </thead>
    <tbody>';
foreach ($cursos as $curso) {
    echo '
        <tr>
            <td>
             ' . $curso['curso'] . '
            </td>
            <td>
            <a href="http://localhost/Racons/index.php/admin/eliminar_curso/' . $curso['id_curso'] . '"><button>Eliminar</button></a>
            </td>
        </tr>';
}
echo '</tbody>';
echo '</table>';
?>
<!--<script>
    function eliminar_curso() {
        var url = "http://localhost/Racons/index.php/admin/eliminar_curso/";
        var obj = new Object();
        obj.curso = curso
        var jsonString = JSON.stringify(obj);
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data: jsonString
        }).done(function (response) {
            var data = JSON.parse(response);
            alert(data.mensaje);
            if (data.mensaje = "ok"){
                console.log("La solicitud a fallado: " + textStatus);
            }
        }).fail(function (textStatus) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + textStatus);
                alert("La solicitud a fallado: " + textStatus);
            }
        });
    }
</script>-->
