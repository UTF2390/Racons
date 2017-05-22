<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

    public $modelo_alumno;

    public function __construct() {
        parent::__construct();
        //Cargar el modelo
//        $this->load->model('Alumno_model');
    }

    public function index() {
        $this->load->view('alumno/vista_alumno');
    }

    /*
     * El usuario se apunta de la taller con $id_tarea.
     */

    public function apuntarse($id_tarea) {
        //1.-Comprobar si la taller pertenece a la misma presentación 
        //que el alumno.
        //
        //2.-Comprobar si ya esta apuntado a esta taller.
        //
        //3.- Si la opción libre_de_limites esta en FALSE, comprobar si el alumno
        // ha superado el limite por categoria permitidos en los ultimos 30 dias. 
        //
        //4.-Insertar en el historial si hay plazas libres. En la consulta
        //select tiene que haber un if comprobando si hay plazas luego 
        //incrementar contador y despues insertar. De este modo se evitan errores.
        //Tambien se puede hacer con un triger en la base de datos.
        //
        //5.-Ir a la vista presentaciones.
    }

    /*
     * El usuario se desapunta de la taller con $id_tarea.
     */

    public function desapuntarse($id_tarea) {
        /*
         * 1.-Comprobar si el alumno esta apuntado a la taller borrarla. 
         * 
         * 2.-Volver a vista_presentaciones.
         */
    }

    /*
     * Muestra una lista de los talleres y presentaciones a las que el alumno
     * se apuntó.
     */

    public function historial() {
        /*
         * 1.- Pasar por parametro el array del historial a la vista y mostrar
         * vist_historial.
         */
        $data['tareas'] = [['id' => 45556868, 'nombre' => 'Sala de poker', 'fecha' => '23/02/17'],
                ['id' => 45556868, 'nombre' => 'Sala de poker', 'fecha' => '30/02/17'],
                ['id' => 45556868, 'nombre' => 'Sala de poker', 'fecha' => '30/03/17']];
        $this->load->view('alumno/vista_historial', $data);
    }

    /*
     * Muestra las presentaciónes a las que el alumno se puede apuntar.
     */

    public function presentacion() {
        /*
         * 1.-Conseguir tareas que pertenezcan a la presentacion (curso)
         * del alumno.
         * 
         * 2.-Mostrar vista_tareas. Le pasamos por parametro el array
         * y mostra la vista /alumno/vista_presentaciones.
         */
    }

}
