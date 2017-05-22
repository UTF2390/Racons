<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div id="container">
  <!--lo dejo aqui-->
            <div>
                
                <div>


                </div>

            </div>
        </div>
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
        foreach ($tareas as $taller) {
            echo '
                    <tr>
                        <td>
                        ' . $taller['nombre'] . ' ' . $taller['apellido1'] . ' ' . $taller['apellido2'] . '
                        </td>
                        <td>
                        ' . $taller['nombre_grupo'] . ' 
                        </td>
                        <td>
                        ' . $taller['nombre_taller'] . '
                        </td>
                        <td>
                        ' . $taller['fecha'] . '
                        </td>
                        <td>
                        ' . $taller['categoria'] . '
                        </td>
                    </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        ?>
        Vista historial
    </div>

</body>
</html>