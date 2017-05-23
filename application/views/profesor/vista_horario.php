<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="<?php echo base_url(); ?>jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>aeon_grid.css">
        <style>
            .horario{
                background-color: 
            }
            .hora_inicio {
                text-align: right;
            }
            .taller{
                background-color: #3c763d; 
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .cabezera_dia * {
                height: 40px
                font_size:30;
                display:inline;
            }
            .cabezera_dia{
                margin: 0px;
                background-color: #009926; 
                position: relative;
            }
            .dia_semana{

            }
            .dia_mes{
                float:right;
                margin-right: 3px;
            }
            .container{
                display: line;
            }

        </style>
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

            <div class="horario"><h2>Horario</h3>
                    <?php
                    $data['horario'] = $horario;
                    $data['numero_dias'] = $numero_dias;
                    $this->load->view('profesor/tabla_horario', $data);
                    ?>
            </div>
        </div>
    </body>
</html>