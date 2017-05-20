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
                $lista_categorias['categorias'] = $categorias;
                $this->load->view('admin/tabla_categoria', $lista_categorias);
                ?>
                <h3>Nueva categoria</h3>
                <?php
                $this->load->view('admin/form_nueva_categoria');
                ?>
            </div>
            <div><h3>Cursos</h3>
                <?php
                $data['cursos'] = $cursos;
                $this->load->view('admin/tabla_cursos');
                ?>
                <h3>Nuevo curso</h3>
                <?php
                $this->load->view('admin/form_nuevo_curso', $data);
                ?>
            </div>

            Vista configuración del administrador

        </div>

    </body>
</html>