<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Cargar el modelo
        //Es la bariable que se envia a la vista para mostrar
        //o ocultar las opciones adicionales del administrador.
        $this->load->model('Profesor_model');
//        $data['admin'] = FALSE;
    }

    public function index() {
        $this->load->view('profesor/vista_profesor');
//        $this->tareas();
    }

    public function desactivar_tarea() {
        /*
         * 1.- Comprueba si la tarea pertenece al profesor.
         * 
         * 2.- Cambia el atributo activo de tarea y elimina en el 
         * historial los alumnos que estaban apuntados a esta.
         * 
         * 3.-Respuesta recogida por Ajax. El javascrip informara al profesor y
         * modifica el html para marcar como desactivado la tarea. O, sin Ajax,:-( cargar la 
         * vista vista_mis_tareas.
         */
    }

    public function activar_tarea($id_tarea) {
        /*
         * 1.- Comrueba si la tarea pertenece al profesosr.
         * 
         * 2.- Modifica el atributo activo de la tarea.
         * 
         * 3.- Con Ajax si todo salio bien, modificar la vista.
         */
    }

    /*
     * Añade nueva tarea.
     */

    public function nueva_tarea() {
        /*
         * 1.-Recoger los datos por post.
         * 
         * 2.-El profesor puede añadir la tarea a un grupo existente o crear uno
         * nuevo. Comprobar si por post hay id_grupo =! null. En tal caso
         * crea el grupo. Sino coger el id del grupo por post.
         * 
         * 3.-Comprobar si existe la presentación y el grupo.
         *
         * 4.-Comprobar si el profesor tiene otras tareas a la misma hora y dia.
         * Insertar nueva tarea
         * 
         * 5.-Ir a la vista mis tareas. O usar Ajax ☺-☻¬.
         * 
         */
    }

    /*
     * Inserta un dia a la tarea.
     */

    public function modificar_tarea() {
        /*
         * 1.- Comprueba si existe la tarea y si pertenece al profesor.
         * 
         * 2.- Comprueba si el dia y la hora se solapan con otro dia y hora 
         * de otro taller del mismo profesor.
         * 
         * 3.- Inserta en la tabla el dia y la hora a la tarea.
         */
    }

    /*
     * Muestra las tareas creadas por el profesor.
     */

    public function tareas() {
        /*
         * 1.-Buscar todas las tareas y el grupo al que pertenecen que ha creado
         *  el profesor y pasarlas a la 
         * vista vista_mis_tareas. 
         * 
         * Grupo info + Tarea info
         */

        $data['tareas'] = [['descripcion' => 'Pos eso limpiar.', 'limite' => 5, 'nombre_grupo' => 'Limpiar', 'id' => 41658556, 'nombre' => 'Limpiar Patio', 'maximo' => 25, 'apuntados' => 15, 'dia' => 5, 'hora_inicio' => '11:30', 'hora_fin' => '11:30'],
            ['descripcion' => 'Matematicas discretas lo dice todo.', 'limite' => 5, 'nombre_grupo' => 'Matematicoadictos', 'id' => 245524467, 'maximo' => 30, 'apuntados' => 10, 'dia' => 4, 'hora_inicio' => '11:30', 'hora_fin' => '11:30', 'nombre' => 'Matematicas Discretas'],
            ['descripcion' => 'Mates version facil.', 'limite' => 5, 'nombre_grupo' => 'Matematicoadictos', 'id' => 757772577, 'nombre' => 'Algebra', 'maximo' => 30, 'apuntados' => 5, 'dia' => 3, 'hora_inicio' => '11:30', 'hora_fin' => '11:30']];
        $data['admin'] = FALSE;
        $data['grupos'] = [['nombre' => 'Limpiar', 'id' => 234234],
            ['nombre' => 'Limpiar', 'id' => 234234],
            ['nombre' => 'Limpiar', 'id' => 234234]];

        $this->load->view('profesor/vista_mis_tareas', $data);
    }

}
