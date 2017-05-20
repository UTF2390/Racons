<form enctype="multipart/form-data" action="http://localhost/Racons/index.php/admin/nueva_categoria" method='POST'>
    <text>Nombre</text>
    <input type='text' id='nombre' name="nombre"></input>
    <text>Limite</text>
    <input type='number' id='limite' value="5" name="limite"></input>
    <!--<button type="disabled" onclick="insertar_categoria();">Añadir</button>-->
    <input type="submit" value="Añadir"/>
</form>
<!--<script>
    function insertar_categoria() {
        var url = "http://localhost/Racons/admin/nueva_categoria";
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
</script>-->
