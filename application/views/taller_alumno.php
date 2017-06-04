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
                    </ul>

                    <div class="tab-pane fade active in" id="list">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Plazas</th>
                                        <th class="text-center">Dia</th>
                                        <th class="text-center">Inicio</th>
                                        <th class="text-center">Fin</th>
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
                                            echo'<tr>';
                                            echo'<td class="id_taller">' . $taller['id_taller'] . '</td>';
                                            echo"<td>" . $taller['nombre'] . "</td>";
                                            echo"<td>" . $taller['descripcion'] . "</td>";
                                            echo"<td>" . $taller['aforamiento'] . "/" . $taller['participantes'] . "</td>";
                                            echo"<td>" . $taller['dia'] . "</td>";
                                            echo"<td>" . substr($taller['hora_inicio'], 3) . "</td>";
                                            echo"<td>" . substr($taller['hora_fin'], 3) . "</td>";
                                            echo'<td class="td_apuntarse">';

                                            if ($taller['apuntado'] != "0") {
                                                echo '<button class="desapuntarse" onclick="desapuntarse(this)">Desapuntarse</button>';
                                            } else {
                                                echo'<button class="apuntarse" onclick="apuntarse(this)">Apuntarse</button>';
                                            }
                                            echo "</td>";
                                            if ($this->session->userdata('rol') == "admin") {
                                                echo'<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                                echo'<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
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

    function desapuntarse(boton) {
        var tr = $(boton).closest("tr");
        var id_taller = $(boton).closest("tr")
                .find(".id_taller")
                .html();
        var url = "<?php echo base_url(); ?>alumno/desapuntarse/" + id_taller;
        $.ajax({
            url: url
        }).done(function (response) {
            if (response == "ok") {
                tr.find('.td_apuntarse').append('<button class="apuntarse" onclick="apuntarse(this)">Apuntarse</button>');
                tr.find('.desapuntarse').remove();

            } else {
                $('#respuesta_modal').find('.modal-body').html(response);
                $('#respuesta_modal').modal("show");
            }
        }).fail(function (response) {
            console.log("La solicitud a fallado: " + response);
            alert("Error en la url.");

        });
    }

    function apuntarse(boton) {
        var tr = $(boton).closest("tr");
        var id_taller = $(boton).closest("tr")
                .find(".id_taller")
                .html();
        var url = "<?php echo base_url(); ?>alumno/apuntarse/" + id_taller;
        $.ajax({
            url: url
        }).done(function (response) {
            if (response == "ok") {
                tr.find('.td_apuntarse').append('<button class="desapuntarse" onclick="desapuntarse(this)">Desapuntarse</button>');
                tr.find('.apuntarse').remove();
                console.log('Eliminado correctamente.');
            } else {
                $('#respuesta_modal').find('.modal-body').html(response);
                $('#respuesta_modal').modal("show");

            }
        }).fail(function (textStatus) {
            console.log("La solicitud a fallado: ");
            alert("Error en la url.");
        });
    }
</script>
</body>
</html>