<body>
    <div class="modal fade" id="respuesta_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Ups!</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- SideBar -->

    <section class="full-box cover dashboard-sideBar">
        <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
        <div class="full-box dashboard-sideBar-ct">
            <!--SideBar Title -->
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                IES BADIA <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <!-- SideBar User info -->
            <?php $this->load->view('sidebaruser'); ?>
            <!-- SideBar Menu -->
            <?php $this->load->view('menu'); ?>
        </div>
    </section>

    <!-- Content page-->
    <section class="full-box dashboard-contentPage">
        <!-- NavBar -->
        <nav class="full-box dashboard-Navbar">
            <ul class="full-box list-unstyled text-right">
                <li class="pull-left">
                    <a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
                </li>
                <li>
                    <a href="#!" class="btn-Notifications-area">
                        <i class="zmdi zmdi-notifications-none"></i>
                        <span class="badge">7</span>
                    </a>
                </li>
                <li>
                    <a href="#!" class="btn-search">
                        <i class="zmdi zmdi-search"></i>
                    </a>
                </li>
                <li>
                    <a href="#!" class="btn-modal-help">
                        <i class="zmdi zmdi-help-outline"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Content page -->
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Usuario <small>Alumno</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
                        <?php
                        if ($this->session->userdata('rol') == "admin") {
                            echo'<li><a href="#new" data-toggle="tab">Nuevo</a></li>';
                        }
                        ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        <form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/nuevo_alumno" method="post">
                                            <fieldset>Datos Alumno</fieldset>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Usuario</label>
                                                <input class="form-control" type="text" name="login">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Password</label>
                                                <input class="form-control" type="text" name="pass">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nombre</label>
                                                <input class="form-control" name="nombre"></input>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Primer Apellido</label>
                                                <input class="form-control" type="text" name="apellido1">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Segundo Apellido</label>
                                                <input class="form-control" type="text" name="apellido2">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" class="control-label">Curso</label>
                                                <select name="id_curso">
                                                    <?php
                                                    foreach ($cursos as $curso) {
                                                        echo' <option value = "' . $curso['id_curso'] . '">' . $curso['curso'] . '</option>';
                                                    }
                                                    ?>
                                                </select> 
                                            </div>
                                            <br><br>
                                            <p class="text-center">
                                                <button href="<?php echo base_url(); ?>admin/nuevo_alumno" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="display: none;">#</th>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Primer Apellido</th>
                                            <th class="text-center">Segundo Apellido</th>
                                            <th class="text-center">Curso</th>
                                            <th class="text-center">Historial</th>
                                            <?php
                                            if ($this->session->userdata('rol') == "admin") {
                                                echo'<th class="text-center">Actualizar</th>';
                                                echo'<th class="text-center">Eliminar</th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listas as $alumno):
                                            echo '<tr id="id_alumno_' . $alumno->id_alumno . '">';
                                            echo '<td class="id_curso" style="display: none;">' . $alumno->id_curso . '</td>';
                                            echo '<td class="id_persona" >' . $alumno->id_persona . '</td>';
                                            echo '<td class="nombre" >' . $alumno->nombre . '</td>';
                                            echo '<td class="apellido1" >' . $alumno->apellido1 . '</td>';
                                            echo '<td class="apellido2" >' . $alumno->apellido2 . '</td>';
                                            echo '<td class="curso" >' . $alumno->curso . '</td>';
                                            echo '<td><a href="' . base_url() . 'profesor/historial_alumno/' . $alumno->id_alumno . '" class="btn glyphicon glyphicon-eye-open"></a></td>';
                                            if ($this->session->userdata('rol') == "admin") {
                                                echo'<td><a onclick="modificar_alumno_modal(' . $alumno->id_alumno . ')" href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                                echo'<td><a onclick="eliminar_alumno(this,' . $alumno->id_alumno . ')" href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
                                            }
                                            echo '</tr>';
                                        endforeach
                                        ?>
                                    </tbody>
                                </table>
                                <?php echo $this->pagination->create_links() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notifications area -->
    <section class="full-box Notifications-area">
        <div class="full-box Notifications-bg btn-Notifications-area"></div>
        <div class="full-box Notifications-body">
            <div class="Notifications-body-title text-titles text-center">
                Notifications <i class="zmdi zmdi-close btn-Notifications-area"></i>
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-alert-triangle"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">17m</div>
                        <h4 class="list-group-item-heading">Tile with a label</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-alert-octagon"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">15m</div>
                        <h4 class="list-group-item-heading">Tile with a label</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-help"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">10m</div>
                        <h4 class="list-group-item-heading">Tile with a label</h4>
                        <p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-info"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">8m</div>
                        <h4 class="list-group-item-heading">Tile with a label</h4>
                        <p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Dialog help -->
    <div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Help</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.material.init();
        function modificar_alumno_modal(id_alumno) {
            var url = "<?php echo base_url(); ?>admin/modificar_alumno_form/" + id_alumno;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response != "false") {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#modal_form_boton_alumno').attr('onclick', 'modificar_alumno(' + id_alumno + ')');
                    $('#respuesta_modal').modal("show");
                } else {
                    $('#respuesta_modal').find('.modal-body').html('No existe el alumno.');
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function modificar_alumno(id_alumno) {
//            alert('modificar_alumno');
            var url = "<?php echo base_url(); ?>admin/modificar_alumno/" + id_alumno;
            var data = {'nick': $('#nick').val(),
                'nombre': $('#nombre').val(),
                'password': $('#password').val(),
                'apellido1': $('#apellido1').val(),
                'apellido2': $('#apellido2').val(),
                'id_curso': $('#id_curso').val()};
            $.ajax({
                type: 'POST',
                url: url,
                data: data
            }).done(function (response) {
                if (response != "false") {
//                    alert('#td_' + id_alumno);
                    $('#id_alumno_' + id_alumno).replaceWith(response);
                    $('#respuesta_modal').modal("hide");
                } else {
                    $('#respuesta_modal').find('.modal-body').html('No existe el alumno.');
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function eliminar_alumno(boton, id_alumno) {
            var url = "<?php echo base_url(); ?>admin/eliminar_alumno/" + id_alumno;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response == "ok") {
                    $('#respuesta_modal').find('.modal-body').html('Se ha eliminado correctamente.');
                    $('#respuesta_modal').modal("show");
                    $(boton).closest('tr').html('');
                } else {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");
            });
        }
    </script>
</body>
</html>