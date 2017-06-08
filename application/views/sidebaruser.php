<div class="modal fade" id="modificar_cuenta_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modificar cuenta</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<div class="full-box dashboard-sideBar-UserInfo">
    <figure class="full-box">
        <i class="zmdi zmdi-account-circle zmdi-hc-5x" style="margin-left: 95px"></i>
            <!--<img src="<?php //echo base_url();            ?>/assets/img/avatar.jpg" alt="UserIcon">-->
        <figcaption id="nick_name" class="text-center text-titles"><?php echo $this->session->userdata('nick'); ?></figcaption>
    </figure>
    <ul class="full-box list-unstyled text-center">
        <li>
            <a onclick="open_modal_modificar_usuario()">
                <i class="zmdi zmdi-settings"></i>
            </a>
        </li>
        <li>
            <a href="#!" class="btn-exit-system">
                <i class="zmdi zmdi-power"></i>
            </a>
        </li>
    </ul>
</div>

<!--modificar_cuenta_modal-->
<script>
    function modificar_usuario() {
        var url = "<?php echo base_url(); ?>usuario/modificar_usuario";
        var data = $('#form_modificar_usuario').serialize();
        var nick = jQuery('input[name="nick"]').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: data
        }).done(function (response) {
            if (response == "ok") {
                $('#respuesta_modal').modal("hide");
                $('#nick_name').html(nick);
            } else {
                $('#respuesta_modal').find('.modal-body').html(response);
                $('#respuesta_modal').modal("show");
            }
        }).fail(function (response) {
            console.log("La solicitud a fallado: " + response);
            alert("Error en la url.");

        });
    }
    function open_modal_modificar_usuario() {
        var form = '<form enctype="multipart/form-data"  method="post" id="form_modificar_usuario">' +
                '<fieldset>Datos Alumno</fieldset>' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Usuario</label>' +
                '<input value="<?php echo $this->session->userdata('nick'); ?>" class="form-control" type="text" name="nick">' +
                '</div>' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password</label>' +
                '<input class="form-control" type="text" name="password1">                    </div>                    <div class="form-group label-floating">                        <label class="control-label">Repite el password</label>                        <input class="form-control" type="text" name="password2">                    </div>                    <br><br>                    <p class="text-center">                        <button type="button" onclick="modificar_usuario()" class="btn btn-info btn-raised btn-sm"><i class=""></i> Guardar</button>                    </p>                </form>';
        $('#respuesta_modal').find('#myModalLabel').html('Modificar cuenta');
        $('#respuesta_modal').find('.modal-body').html(form);
        $('#respuesta_modal').modal("show");

    }
</script>