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
                <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Lista <small>Talleres</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#list" data-toggle="tab"></a></li>
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
                                        <form action="">
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
                                                <label class="control-label">Foto</label>
                                                <div>
                                                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                                                    <input type="file" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Curso</label>
                                                <select class="form-control" name="curso">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
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

                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">descripcion</th>
                                            <th class="text-center">aforamiento</th>
                                            <th class="text-center">dia</th>
                                            <th class="text-center">Hora inicio</th>
                                            <th class="text-center">Hora fin</th>
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
                                        //foreach($listas as $alumno):
                                        echo'<tr>';
                                        echo"<td>'Taller'</td>";
                                        echo"<td>'des'</td>";
                                        echo"<td>'3/50'</td>";
                                        echo"<td>'2'</td>";
                                        echo"<td>'08:00'</td>";
                                        echo"<td>'09:00'</td>";
                                        echo '</tr>';
                                        //endforeach
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