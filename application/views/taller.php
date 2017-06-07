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
                <h1 class="text-titles"> Taller </h1>
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
                                        <form enctype="multipart/form-data" action="<?php echo base_url(); ?>profesor/nuevo_taller" method="post">
                                            <fieldset>Datos Alumno</fieldset>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nombre</label>
                                                <input class="form-control" type="text" name="nombre">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Descripción</label>
                                                <input class="form-control" type="text" name="descripcion">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Aforamiento</label>
                                                <input type="number" class="form-control" name="aforamiento"></input>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Dia</label>
                                                <select class="form-control" name="dia">
                                                    <?php
                                                    $dia = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes'];
                                                    for ($i = 1; $i < 6; $i++) {
                                                        echo' <option value = "' . $i . '">' . $dia[$i] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label ">Hora Inicio</label>
                                                <select class="hora" name="hora_inicio_hh">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            echo' <option value = "0' . $i . '">0' . $i . '</option>';
                                                        } else {
                                                            echo' <option value = "' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!--</div>-->
                                                <!--                                            <div class="form-group">-->
                                                <label class="control-label hora"> : </label>
                                                <select class="" name="hora_inicio_mm">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            echo' <option type="number" value = "0' . $i . '">0' . $i . '</option>';
                                                        } else {
                                                            echo' <option value = "' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                <label class="control-label">Hora Fin</label>
                                                <select class=" hora" name="hora_fin_hh">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            echo' <option value = "0' . $i . '">0' . $i . '</option>';
                                                        } else {
                                                            echo' <option value = "' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                <label class="control-label  hora"> : </label>
                                                <select class="" name="hora_fin_mm">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            echo' <option value = "0' . $i . '">0' . $i . '</option>';
                                                        } else {
                                                            echo' <option value = "' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Categoria</label>
                                                <select class="form-control" name="id_categoria">
                                                    <?php
                                                    foreach ($categorias as $categoria) {
                                                        echo' <option value = "' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Curso</label>
                                                <?php
                                                $c = 0;
                                                foreach ($cursos as $curso) {
                                                    echo '<input type="checkbox" name="curso' . $c . '" value="' . $curso['id_curso'] . '">' . $curso['curso'] . '</input>';
                                                    $c += 1;
                                                }
                                                ?>
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
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Aforamiento</th>
                                            <th class="text-center">Dia</th>
                                            <th class="text-center">Hora Inicio</th>
                                            <th class="text-center">Hora Fin</th>
                                            <th class="text-center">Activo</th>
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
                                        if (empty($talleres[0]) == false) {
                                            foreach ($talleres as $taller) {
                                                echo'<tr id="id_taller_' . $taller['id_taller'] . '">';
                                                echo"<td class='id_taller'>" . $taller['id_taller'] . "</td>";
                                                echo"<td>" . $taller['nombre'] . "</td>";
                                                echo"<td>" . $taller['descripcion'] . "</td>";
                                                echo"<td>" . $taller['aforamiento'] . "/" . $taller['participantes'] . "</td>";
                                                echo"<td>" . $taller['dia'] . "</td>";
                                                echo"<td>" . substr($taller['hora_inicio'], 3) . "</td>";
                                                echo"<td>" . substr($taller['hora_fin'], 3) . "</td>";
                                                echo"<td class='td_habilitar'>";

                                                if ($taller['activo'] == "1") {
//                                                                                                                $id_taller, $dia, $hora_inicio, $hora_fin
                                                    echo '<button class="boton_deshabilitar" onclick="deshabilitar(this)">Deshabilitar</button>';
                                                } else {
                                                    echo '<button class="boton_habilitar" onclick="habilitar(this)">Habilitar</button>';
                                                }
                                                "</td>";
                                                if ($this->session->userdata('rol') == "admin") {
                                                    echo'<td><a onclick="modificar_taller_modal(' . $taller['id_taller'] . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                                    echo'<td><a onclick="eliminar_taller(this,' . $taller['id_taller'] . ')" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
                                                }
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php echo $paginacion; ?>
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
        function deshabilitar(boton) {
            var tr = $(boton).closest("tr");
            var id_taller = $(boton).closest("tr")
                    .find(".id_taller")
                    .html();
            var url = "<?php echo base_url(); ?>profesor/deshabilitar_taller/" + id_taller;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response == "ok") {
                    tr.find('.td_habilitar').append('<button class="boton_habilitar" onclick="habilitar(this)">Habilitar</button>');
                    tr.find('.boton_deshabilitar').remove();

                } else {
                    $('#respuesta_modal').find('.modal-body').html('No se habilitó el taller. ' + response);
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function habilitar(boton) {
            var tr = $(boton).closest("tr");
            var id_taller = $(boton).closest("tr")
                    .find(".id_taller")
                    .html();
            var url = "<?php echo base_url(); ?>profesor/habilitar_taller/" + id_taller;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response == "ok") {
                    tr.find('.td_habilitar').append('<button class="boton_deshabilitar" onclick="deshabilitar(this)">Deshabilitar</button>');
                    tr.find('.boton_habilitar').remove();
                    console.log('Habilitado correctamente.');
                } else {
                    $('#respuesta_modal').find('.modal-body').html('No se habilitó el taller. ' + response);
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");
            });
        }

//        -------

        function modificar_taller_modal(id_taller) {
            var url = "<?php echo base_url(); ?>profesor/modificar_taller_form/" + id_taller;
            $.ajax({
                url: url
            }).done(function (response) {
                if (response != "false") {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#modal_form_boton_taller').attr('onclick', 'modificar_taller(' + id_taller + ')');
                    $('#respuesta_modal').modal("show");
                } else {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function modificar_taller(id_taller) {
            var url = "<?php echo base_url(); ?>profesor/modificar_taller/" + id_taller;
            $.ajax({
                type: 'POST',
                url: url,
                data: $('#form_modificar').serialize()
            }).done(function (response) {
                if (response != "false") {
                    $('#id_taller_' + id_taller).replaceWith(response);
                    $('#respuesta_modal').modal("hide");
                } else {
                    $('#respuesta_modal').find('.modal-body').html(response);
                    $('#respuesta_modal').modal("show");
                }
            }).fail(function (response) {
                console.log("La solicitud a fallado: " + response);
                alert("Error en la url.");

            });
        }

        function eliminar_taller(boton, id_taller) {
            var url = "<?php echo base_url(); ?>profesor/eliminar_taller/" + id_taller;
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
    <style>
        .hora{
            display:inline;
        }
    </style>
</body>
</html>