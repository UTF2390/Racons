<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

    </head>
    <body>

        <div id="container">
            <div><h3>Categorias</h3>
                <?php
                $this->load->view('tabla_config_categoria');
                ?>
                <h3>Nueva categoria</h3>
                <?php
                $this->load->view('form_nueva_categoria');
                ?>
            </div>
            <div><h3>Cursos</h3>
                <?php
                $this->load->view('tabla_cursos');
                ?>
                <h3>Nuevo curso</h3>
                <?php
                $this->load->view('form_nueva_categoria');
                ?>
            </div>

            Vista configuración del administrador

        </div>

    </body>
</html>