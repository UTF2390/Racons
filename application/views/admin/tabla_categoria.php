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
            <td style="display:none;">
             
            </td>
            <td style="display:none;">
             
            </td>
            <td style="display:none;">
             
            </td>
        </tr>
    </thead>
    <tbody>';

foreach ($categorias as $categoria) {
    echo '
        <tr>
            <td>
            <input class="nombre" value="' . $categoria['nombre'] . '"/>
            </td>
            <td>
            <input type="number" class="limite" value="' . $categoria['limite'] . '"/>
            </td>
            <td style="display:none;">
            <input class="id_categoria" value="' . $categoria['id_categoria'] . '"/>
            </td>
            <td>
             <button class="eliminar_categoria">Eliminar</button>
            </td>
            <td>
             <button class="modificar_categoria">Modificar</button>
            </td>
        </tr>';
}
echo '</tbody>';
echo '</table>';
?>
<script>
//    window.onload = function () {
    $(".modificar_categoria").click(function () {
        var nombre = $(this).closest("tr")
                .find(".nombre")
                .val();
        var limite = $(this).closest("tr")
                .find(".limite")
                .val();
        var id_categoria = $(this).closest("tr")
                .find(".id_categoria")
                .val();
        var url = "http://localhost/Racons/index.php/admin/modificar_categoria";
        var data = {'nombre': nombre, 'limite': limite, 'id_categoria': id_categoria};
        $.ajax({
            type: 'POST',
            url: url,
            data: data

        }).done(function (response) {
            if (response = "ok") {
                $(this).closest("tr")
                        .find(".nombre")
                        .text(data.nombre);
                $(this).closest("tr")
                        .find(".limite")
                        .text(data.limite);
            } else {
                alert(response);
            }

        }).fail(function (textStatus) {
            console.log("La solicitud a fallado: ");
            alert("La solicitud modificar categoria a fallado ");

        });
    });

    $(".eliminar_categoria").click(function () {
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
