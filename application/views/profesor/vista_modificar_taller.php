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
                display:line;
            }

        </style>
        <div class="col12">
            <?php $this->load->view('menu_navegacion'); ?>

        </div>

        <div id="container" class="col12">
            <div class=""><h2>Talleres</h3>
                    <?php
                    $data['taller'] = $taller;
                    $data['categorias'] = $categorias;
                    if (empty($taller) != TRUE) {
                        $this->load->view('profesor/form_modificar_taller', $data);
                    }
                    ?>
            </div>
    </body>
</html>