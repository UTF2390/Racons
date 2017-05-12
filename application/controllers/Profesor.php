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
//        $this->load->view('profesor/vista_profesor', $data);
        $data['admin'] = FALSE;
        $this->load->view('profesor/vista_profesor', $data);
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
         * 2.-Comprobar si existe la presentación.
         *
         * 3.-Comprobar si el profesor tiene otras tareas a la misma hora y dia.
         * 
         * 4.-Insertar nueva tarea.
         * 
         * 5.-Ir a la vista mis tareas. O usar Ajax ☺-☻¬
         * 
         */
    }

    /*
     * Inserta un dia a la tarea.
     */

    public function modificar_dia($dia, $hora_inicio, $hora_fin, $id_tarea) {
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
     * Musetra la vista Vista tareas por presentaciones.
     */

    public function tareas() {
        /*
         * 1.- Musetra todas la lista de tareas de una presentación (curso)
         * especifico.
         * 
         * Bonus: Guardar en coockies la ultima presentación mostrada.
         */
    }

    /*
     * Muestra las tareas creadas por el profesor.
     */

    public function mis_tareas() {
        /*
         * 1.-Buscar todas las tareas que ha creado el profesor y pasarlas a la 
         * vista vista_mis_tareas. (Nota:Las tareas desactivadas (con dia == null)
         * estaran las ultimas)
         */
        $data['tareas'] = [['id' => 41658556, 'nombre' => 'Limpiar Patio', 'Maximo' => 25, 'Apuntados' => 15, 'dia' => 5, 'hora_inicio' => '11:30', 'hora_fin' => '11:30'],
                ['id' => 245524467,  'Maximo' => 30, 'Apuntados' => 10, 'dia' => 4, 'hora_inicio' => '11:30', 'hora_fin' => '11:30','nombre' => 'Matematicas Discretas'],
                ['id' => 757772577, 'nombre' => 'Algebra', 'Maximo' => 30, 'Apuntados' => 5, 'dia' => 3, 'hora_inicio' => '11:30', 'hora_fin' => '11:30']];
        
        $this->load->view('profesor/vista_mis_tareas', $data);
    }

    /* ☺☺☺☺☺☺☺☺☺☺☺---BONUS---☻☻☻☻☻☻☻☻☻☻☻☻☻ */
    /*
     * Quita un usuario de las tareas del profesor.
     */

    public function quitar_usuario($id_usuario, $id_tarea) {
        /*
         * 1.- Comprobar si el usuario esta apuntado a la tarea.
         * 
         * 2.- Comprobar si el profesor es el creador de la tarea.
         * 
         * 3.- Desapuntar usuario con id_usuario.
         * 
         * 4.- Este metodo funciona con Ajax. El javascript tendra que comunicar
         * al usuario del resultado y modificar el html para que no se vea el 
         * alumno apuntado.
         */
    }

}
