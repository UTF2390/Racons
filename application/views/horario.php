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
                        <span class="badge">0</span>
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
                <h1 class="text-titles"> Horario <small>Talleres</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#list" data-toggle="tab"></a></li>
                        <li><a href="#new" data-toggle="tab"></a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        <div class="calendario_ajax">
                                            <div class="cal"></div><div id="mask"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>

                                            <th class="text-center distancia<?php echo $dias_semana[0]['distancia'] . '">Lunes ' . $dias_semana[0]['dia_mes']; ?></th>
                                                <th class="text-center distancia<?php echo $dias_semana[1]['distancia'] . '">Martes ' . $dias_semana[1]['dia_mes']; ?></th>
                                            <th class="text-center distancia<?php echo $dias_semana[2]['distancia'] . '">Miercoles ' . $dias_semana[2]['dia_mes']; ?></th>
                                                <th class="text-center distancia<?php echo $dias_semana[3]['distancia'] . '">Jueves ' . $dias_semana[3]['dia_mes']; ?></th>
                                            <th class="text-center distancia<?php echo $dias_semana[4]['distancia'] . '">Viernes ' . $dias_semana[4]['dia_mes']; ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $dia_orden = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri'];
                                                $traductor = ['Mon' => 'Lunes', 'Tue' => 'Martes', 'Wed' => 'Miercoles', 'Thu' => 'Jueves', 'Fri' => 'Viernes',];
                                                $maximo_filas = 1;
                                                foreach ($horario as $dia) {
                                                    if (count($dia) > $maximo_filas) {
                                                        $maximo_filas = count($dia);
                                                    }
                                                }
                                                for ($fila = 1; $fila < $maximo_filas+1; $fila++) {
                                                    echo '<tr >';
                                                    for ($h = 1; $h < 6; $h++) {
                                                        $dia = $horario[$h];
                                                        if (empty($dia[$fila-1])!= TRUE) {
                                                            $taller = $dia[$fila-1];
                                                            //echo"<td>".substr($taller['hora_inicio'], -5).substr($taller['hora_fin'], -5) . "</td>";
                                                            echo'<td class="td_tabla" >'
                                                            . '<div class="taller_container">'
                                                            . '<div class="nombre_taller">' . $taller['nombre'] . '</div>'
                                                            . '<div class="hora_container">'
                                                            . '<div class="hora_inicio">' . substr($taller['hora_inicio'], 3) . '</div>'
                                                            . '<div class="hora_fin">' . substr($taller['hora_fin'], 3) . '</div>'
                                                            . '</div>'
                                                            . '</div>'
                                                            . '</td>';

                                                            //echo'<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
                                                            //echo'<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
                                                            //echo '</tr>';
                                                        } elseif ($fila == 1) {
                                                            if ($this->session->userdata('rol') == 'alumno') {
                                                                echo '<td class=""><span class="no_taller">No estas apuntado a un taller.</span></td>';
                                                            } else {
                                                                echo '<td class=""></td>';
                                                            }
                                                        } else {
                                                            echo '<td class=""></td>';
                                                        }
                                                    }
                                                    echo '</tr>';
                                                }
                                                ?>
                                                </tbody>
                                                </table>
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
                                                <style>
                                                    [class*="distancia"]{
                                                        border-radius: 15px 50px;
                                                    }
                                                    .distancia7{
                                                        background-color: #A9F5A9;
                                                    }
                                                    .distancia6{
                                                        background-color: #81F781;
                                                    }
                                                    .distancia5{
                                                        background-color: #58FA58;
                                                    }
                                                    .distancia4{
                                                        background-color: #2EFE2E;
                                                    }
                                                    .distancia3{
                                                        background-color: #00FF00;
                                                    }
                                                    .distancia2{
                                                        background-color: #01DF01;
                                                    }
                                                    .distancia1{
                                                        background-color: #04B404;
                                                    }
                                                    .hora_container{
                                                        width: 50%;
                                                        display: inline;
                                                    }
                                                    .taller_container{
                                                        display:inline;
                                                        float: left;
                                                        width:100%;
                                                    }
                                                    .nombre_taller{
                                                        text-align: center;
                                                        vertical-align: middle;
                                                        /*                                                        line-height: 45px;       */
                                                        width:70%;
                                                        float:left;
                                                        position: relative;

                                                    }
                                                    .hora_inicio{
                                                        width:30%;
                                                        float:right;
                                                        position: relative;
                                                    }
                                                    .hora_fin{
                                                        width:30%;
                                                        float:right;
                                                        position: relative;
                                                    }
                                                    .table> tr {
                                                        display: block;
                                                        width:20%;
                                                        border: 1 1 black;
                                                    }
                                                    .td_tabla{
                                                        width:20%;
                                                    }
                                                </style>
                                                </body>
                                                </html>