<?php
    echo '
    <table >
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

    foreach ($categorias as $categoria) {
        echo '
        <tr>
            <td>
            ' . $categoria['nombre'] . '
            </td>
            <td>
            ' . $categoria['limite'] . '
            </td>
            <td>
            <a href="http://localhost/Racons/index.php/admin/eliminar_categoria/' . $categoria['id_categoria'] . '"><button>Eliminar</button></a>
            </td>
            <td>
            <a href="http://localhost/admin/modificar_categoria/' . $categoria['id_categoria'] . '"><button type="button" value="Modificar">Modificar</button><a>
            </td>
        </tr>';
    }
    echo '</tbody>';
    echo '</table>';

?>
<script>
//    function modificar_categoria(var id_categoria) {
//        var url = "http://localhost/Racons/admin/modificar_categoria/" + id_categoria;
//        var obj = new Object();
//        obj.id = document.getElementById(id_categoria);
//        obj.nombre = document.getElementById("nombre");
//        obj.limite = document.getElementById("limite");
//        obj.descripcion = document.getElementById("descripcion");
//        var jsonString = JSON.stringify(obj);
//        $.ajax({
//            dataType: 'json',
//            type: 'POST',
//            url: url,
//            data: jsonString
//
//        }).done(function (response) {
//            var data = JSON.parse(response);
//                alert(data.mensaje);
//        }).fail(function (textStatus) {
//            if (console && console.log) {
//                console.log("La solicitud a fallado: " + textStatus);
//                alert("La solicitud a fallado: " + textStatus);
//            }
//        });
//    }
</script>
