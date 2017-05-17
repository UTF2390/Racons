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
            echo '
    <table>
    <thead>
        <tr>
            <td>
             Grupo
            </td>
            <td>
            Limite 
            </td>
            <td>
             Categoria
            </td>
            <td>
            Limite 
            </td>
            <td>
             Descripción
            </td>
            <td>
            </td>
        </tr>
    </thead>
    <tbody>';
            foreach ($tareas as $tarea) {
                echo '
        <tr>
            <td>
            <input id="grupo" type="text" value="' . $tarea['nombre_grupo'] . '"/>
            </td>
            <td>
            <input id="nombre" type="text" value="' . $tarea['nombre'] . '"/>
            </td>
            <td>
            <input id="participacion" type="text" value="' . $tarea['maximo'] . '/' . $tarea['apuntados'] . '"/>
            </td>
            <td>
            <input id="limite" type="number" value="' . $tarea['limite'] . '"/>
            </td>
            <td>
            <input id="descripcion" type="text" value="' . $tarea['descripcion'] . '"/>
            </td>
            <td>
            <button type="button" onclick="modificar_tarea();">Añadir</button>
            </td>
        </tr>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>
            Vista tareas creadas por el profesor. (vista_mis_tareas)
        </div>

    </body>
</html>