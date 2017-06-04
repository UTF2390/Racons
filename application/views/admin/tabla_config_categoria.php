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
foreach ($categorias as $categoria) {
    echo '
        <tr>
            <td>
            ' . $categoria['nombre_categoria'] . '
            </td>
            <td>
            ' . $categoria['limite'] . '
            </td>
            
            <td>
            <button type="button" onclick=modificar_categoria(' . $categoria['id_categoria'] . ');
            </td>
        </tr>';
}
echo '</tbody>';
echo '</table>';
?>
<script>
    function modificar_categoria(var id_categoria) {
        var url = "<?php echo base_url();?>alumno/apuntarse/" + id_categoria;
        var data ={[
        'id_taller' : document.getElementById(id_categoria)
        ]};
        $.ajax({
            type: 'POST',
            url: url,
            data: data

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
