<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Teacher</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="./css/main.css">
    </head>
    <body>
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
                    <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Usuario <small>Profesor</small></h1>
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
                            <div class="tab-pane" id="new">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-10 col-md-offset-1">
                                            <form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/nuevo_profesor" method="post">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Usuario</label>
                                                    <input class="form-control" type="text" name="log">
                                                </div>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input class="form-control" type="text" name="pass">
                                                </div>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Nombre</label>
                                                    <textarea class="form-control" name="nombre"></textarea>
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
                                                    <label class="control-label">Curso</label>
                                                    <select class="form-control" name="adminstrador">
                                                        <option value="0" selected>No Administrador</option>
                                                        <option value="1">Administrador</option>
                                                    </select>
                                                </div>
                                                <p class="text-center">
                                                    <button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade fade active in" id="list">
                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Primer Apellido</th>
                                                <th class="text-center">Segundo Apellido</th>
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
                                            foreach ($listas as $profesor):
                                                echo'<tr>';
                                                echo"<td>" . $profesor->id_persona . "</td>";
                                                echo"<td>" . $profesor->nombre . "</td>";
                                                echo"<td>" . $profesor->apellido1 . "</td>";
                                                echo"<td>" . $profesor->apellido2 . "</td>";
                                                if ($this->session->userdata('rol') == "admin") {
                                                    echo'<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                                    echo'<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
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
        </script>
    </body>
</html>