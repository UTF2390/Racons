<form enctype="multipart/form-data" action="http://localhost/Racons/index.php/admin/nueva_categoria" method='POST'>
    <text>Nombre</text>
    <input type='text' id='nombre' name="nombre"></input>
    <text>Limite</text>
    <input type='number' id='nombre' value="5" name="limite"></input>
    <input type="submit" value="Guardar"/>
</form>
<!--<script>
    function nuevo_curso() {
        var url = "http://localhost/Racons/admin/nuevo_curso";
        var obj = new Object();
        obj.curso = document.getElementById("curso");
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