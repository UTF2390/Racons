<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

    </head>
    <body>

        <div id="container">
            <?php
            echo '<table>
                    <thead>
                        <tr>
                            <td>
                             Profesor
                            </td>
                            <td>
                            Grupo 
                            </td>
                            <td>
                            Taller
                            </td>
                            <td>
                            Fecha
                            </td>
                            <td>
                            Categoria
                            </td>
                        </tr>
                    </thead>
            <tbody>';
            foreach ($tareas as $tarea) {
                echo '<td>
                        ' . $tarea['nombre'] . ' ' . $tarea['apellido1'] . ' ' . $tarea['apellido2'] . '
                        </td>
                        <td>
                        ' . $tarea['nombre_grupo'] . ' 
                        </td>
                        <td>
                        ' . $tarea['nombre_taller'] . '
                        </td>
                        <td>
                        ' . $tarea['fecha'] . '
                        </td>
                        <td>
                        ' . $tarea['categoria'] . '
                        </td>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>
            Vista historial
        </div>

    </body>
</html>