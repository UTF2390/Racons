<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

    </head>
    <body>

        <div id="container">

            <div><h2>Categorias</h3>
                    <?php
                    $lista_categorias['categorias'] = $categorias;
                    if (empty($categorias) != TRUE) {
                        $this->load->view('admin/tabla_categoria', $lista_categorias);

                    }
                        echo '<h4>Añadir categoria</h2>';
                    $this->load->view('admin/form_nueva_categoria');
                    ?>
            </div>
            <div><h2>Cursos</h3>
                    <?php
                    $data['cursos'] = $cursos;
                    if (empty($cursos) != TRUE) {
                        $this->load->view('admin/tabla_cursos');

                    }
                        echo '<h4>Añadir curso</h3>';
                    $this->load->view('admin/form_nuevo_curso', $data);
                    ?>
            </div>
<!--            <div><h2>Crear Cuentas de usuario</h3>
                    <?php
                    $data['cursos'] = $cursos;
                    if (empty($cursos) != TRUE) {
                        $this->load->view('admin/form_nuevo_alumno');

                    }
                        echo '<h4>Añadir curso</h3>';
                    $this->load->view('admin/form_nuevo_curso', $data);
                    ?>
            </div>-->
            Vista configuración del administrador

        </div>

    </body>
</html>