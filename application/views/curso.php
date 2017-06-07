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
                <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Curso </h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
                        <li><a href="#new" data-toggle="tab">Nuevo</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        <form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/nuevo_curso" method="post"">
                                            <fieldset>Datos Curso</fieldset>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nombre del Curso</label>
                                                <input class="form-control" type="text" name="nombre">
                                            </div>
                                            <br><br>
                                            <p class="text-center">
                                                <button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="list">
                            <div class="table-responsive">
                                <table id="my_table" class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre del Curso</th>
                                            <th class="text-center">Actualizar</th>
                                            <th class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listas as $curso):
                                            echo'<tr id="tr_' . $curso->id_curso . '">';
                                            echo"<td class='id_curso'>" . $curso->id_curso . "</td>";
                                            echo"<td>" . $curso->curso . "</td>";
                                            echo'<td><a onclick="modificar_curso_modal(' . $curso->id_curso . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                            echo'<td><a onclick="eliminar_curso(this,' . $curso->id_curso . ')" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
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
        function modificar_curso_modal(id_curso) {
            var url = "<?php echo base_url(); ?>admin/modificar_curso_form/" + id_curso;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response != "false") {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#modal_form_boton_curso').attr('onclick', 'modificar_curso(' + id_curso + ')');
                    $('#respuesta_modal').modal("show");
                } else {
                    $('#respuesta_modal').find('.modal-body').html('No existe el curso.');
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function modificar_curso(id_curso) {
            var url = "<?php echo base_url(); ?>admin/modificar_curso/" + id_curso;
            var data = {'curso': $('#curso_form').val()};
            $.ajax({
                type: 'POST',
                url: url,
                data: data
            }).done(function (response) {
                if (response != "false") {
                    $('#tr_' + id_curso).replaceWith(response);
                    $('#respuesta_modal').modal("hide");
                } else {
                    $('#respuesta_modal').find('.modal-body').html('No existe el curso.');
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function eliminar_curso(boton, id_curso) {
            var url = "<?php echo base_url(); ?>admin/eliminar_curso/" + id_curso;
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
</script>
</body>
</html>