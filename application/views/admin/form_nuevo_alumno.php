
<form enctype="multipart/form-data" action="http://localhost/Racons/index.php/admin/nuevo_alumno" method='POST'>
    <text>Nombre</text>
    <input type='text' id='nombre' name="nombre"></input>
    <text>Primer apellido</text>
    <input type='text' id='apellido1' name="apellido1"></input>
    <text>Segundo apellido</text>
    <input type='text' id='apellido2' name="apellido2"></input>
    <text>Curso</text>

    <select name="id_curso">
        <?php
        foreach ($cursos as $curso) {
            echo' <option value = "' . $curso['id_curso'] . '">'.$curso['curso'].'</option>';
        }
        ?>
    </select> 
    <input type="submit" value="Submit"/>
    <!--<button type="disabled" onclick="nuevo_curso();">Añadir</button>-->
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
