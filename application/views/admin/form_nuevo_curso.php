<form enctype="multipart/form-data" action="" method='POST'>
    <text>Nombre del Curso</text>
    <input type='text'id='curso'></input>
    <button type="disabled" onclick="nuevo_curso();">Añadir</button>
</form>
<script>
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
</script>
