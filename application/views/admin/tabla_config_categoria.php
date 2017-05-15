<?php
echo '
    <table>
    <thead>
        <tr>
            <td>
             Categoria
            </td>
            <td>
            Limite 
            </td>
        </tr>
    </thead>
    <tbody>';
foreach ($tareas as $tarea) {
    echo '
        <tr>
            <td>
            <input id="nombre" type="text">' . $tarea['nombre_categoria'] . '</input>
            </td>
            <td>
            <input id="limite" type="number">' . $tarea['limite'] . '</input>
            </td>
            <td>
            <input id="descripcion" type="text">' . $tarea['descripcion'] . '</input>
            </td>
            <td>
            <button onclick=modificar_categoria(' . $tarea['id_categoria'] . ');
            </td>
        </tr>';
}
echo '</tbody>';
echo '</table>';
?>
<script>
    function modificar_categoria(var id_categoria) {
        var url = "http://localhost/Racons/admin/modificar_categoria/" + id_categoria;
        var obj = new Object();
        obj.id = document.getElementById(id_categoria);
        obj.nombre = document.getElementById("nombre");
        obj.limite = document.getElementById("limite");
        obj.descripcion = document.getElementById("descripcion");
        var jsonString = JSON.stringify(obj);
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data: jsonString

        }).done(function (response) {
            var data = JSON.parse(response);
                alert(data.mensaje);
        }).fail(function (textStatus) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + textStatus);
                alert("La solicitud a fallado: " + textStatus);
            }
        });
    }
</script>
