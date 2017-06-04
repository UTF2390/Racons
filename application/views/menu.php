<?php

if ($this->session->userdata('rol') == "admin") {
    echo'<ul class="list-unstyled full-box dashboard-sideBar-Menu">
            <li>
                <a href="' . base_url() . 'admin">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Personal
                </a>
            </li>
            <li>
                <a href="' . base_url() . 'admin/horario">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Horario
                </a>
            </li>
            <li>
                <a href="' . base_url() . 'admin/taller" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-case zmdi-hc-fw"></i>Mis Talleres
                </a>
            </li>
            <li>
                <a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
                </a>
                <ul class="list-unstyled full-box">
                    <li>
                        <a href="' . base_url() . 'admin/profesor"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Profesor</a>
                    </li>
                    <li>
                        <a href="' . base_url() . 'admin/alumno"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Alumnos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
                </a>
                <ul class="list-unstyled full-box">
                    
                    <li>
                        <a href="' . base_url() . 'admin/categoria"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Categoria</a>
                    </li>
                    <li>
                        <a href="' . base_url() . 'admin/curso"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Curso</a>
                    </li>
                </ul>
            </li>
        </ul>';
} else if ($this->session->userdata('rol') == "profesor") {
    echo'<ul class="list-unstyled full-box dashboard-sideBar-Menu">
            <li>
                <a href="' . base_url() . 'profesor">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Horario
                </a>
            </li>
            <li>
                <a href="' . base_url() . 'profesor/taller" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-case zmdi-hc-fw"></i>Mis Talleres
                </a>
            </li>
            <li>
                <a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
                </a>
                <ul class="list-unstyled full-box">
                    <li>
                        <a href="' . base_url() . 'profesor/profesor"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Profesor</a>
                    </li>
                    <li>
                        <a href="' . base_url() . 'profesor/alumno"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Alumnos</a>
                    </li>
                </ul>
            </li>
        </ul>';
} else if ($this->session->userdata('rol') == "alumno") {
    echo'<ul class="list-unstyled full-box dashboard-sideBar-Menu">
            <li>
                <a href="' . base_url() . 'alumno">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Horario
                </a>
            </li>
            <li>
                <a href="' . base_url() . 'alumno/lista_taller">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Talleres
                </a>
            </li>
        </ul>';
}
?>

