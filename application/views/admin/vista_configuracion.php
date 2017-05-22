<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="<?php echo base_url(); ?>jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>aeon_grid.css">
        
    </head>
    <body>
        <style>
            form *{
                display:block;
            }

        </style>
        <div class="col12">
            <?php $this->load->view('menu_navegacion'); ?>

        </div>

        <div id="container" class="col10">

            <div class="col5"><h2>Categorias</h3>
                    <?php
                    $lista_categorias['categorias'] = $categorias;
                    if (empty($categorias) != TRUE) {
                        $this->load->view('admin/tabla_categoria', $lista_categorias);
                    }
                    echo '<h4>Añadir categoria</h2>';
                    $this->load->view('admin/form_nueva_categoria');
                    ?>
            </div>
            <div class="col5">
                <h2>Cursos</h3>
                    <?php
                    $data['cursos'] = $cursos;
                    if (empty($cursos) != TRUE) {
                        $this->load->view('admin/tabla_cursos');
                    }
                    echo '<h4>Añadir curso</h3>';
                    $this->load->view('admin/form_nuevo_curso', $data);
                    ?>
            </div>
            <div  class="col10">
                <h2>Crear cuentas de usuario</h3>
                    <div class="col5">
                        <h4>Añadir Alumno</h3>
                            <?php
                            $data['cursos'] = $cursos;
                            if (empty($cursos) != TRUE) {
                                $this->load->view('admin/form_nuevo_alumno', $data);
                            } else {
                                echo '<text>No se pueden crear alumnos si no hay cursos. Introduzca primero un curso.</text>';
                            }
                            ?>
                    </div>
                    <div class="col5">
                        <h4>Añadir Profesor</h3>
                            <?php
                            $this->load->view('admin/form_nuevo_profesor');
                            ?>
                    </div>
                    Vista configuración del administrador
            </div>

        </div>

    </body>
</html>