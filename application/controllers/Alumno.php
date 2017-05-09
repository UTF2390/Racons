<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

    public function index() {
        $this->load->view('vista_alumno'); 
    }

    public function apuntarse($id_tarea) {
        //1.-Comprobar si la tarea se permite por curso del alumno.
        //
        //2.-Comprobar si la el alumno ha superado el limite por categoria
        //permitidos en los ultimos 30 dias en caso de que la opcion de 
        //libre_de_limites este en FALSE.
        //
        //3.-Comprobar si el taller tiene plazas libres.
        //
        //4.-El alumno solo puede apuntarse a talleres con fecha de semana 
        //siguiente o actual nunca del pasado.
        //
        //5.-Comprobar si ya esta apuntado a esta tarea. Comparar la ultima
        //fecha de la tabla apuntar, si es posterior a la fecha actual el 
        //alumno ya esta apuntado.
        //
        //6.-Si los puntos anteriores lo permite apuntar al alumno a la tarea.
        //
        //7.-Ir al metodo presentaciones.
    }

    public function desapuntarse() {
        //1.-Comprobar si el alumno esta apuntado a la tarea (si la fecha de
        //la tarea es posterior al dia actual, esta apuntado). 
        //
        //2.-Borrar la ultima fecha que sea mayor a fecha actual.
        //
        //3.-Volver a vista_presentaciones.
    }

    //Muestra una lista de los talleres y presentaciones a las que el alumno
    //se apuntó.
    public function historial() {
        //Pasar por parametro el array del historial a la vista y mostrar
        //vist_historial.
    }

    //Muestra las presentaciónes a las que el alumno se puede apuntar.
    public function presentacion() {
        //1.-Conseguir tareas que pertenezcan a la presentacion del alumno curso.
        //
        //
        //2.-Mostrar vista_tareas. Le pasamos por parametro el array
        //que tiene que mostrar.
    }

}
