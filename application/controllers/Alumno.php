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

    public function modificar_password_nick() {
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $nick = $this->input->post('nick');

        if ($password1 == $password2) {
            if (strlen($password1) < 5) {
                echo 'Contraseña demasiado corta';
            } else {
                $id_alumno = $this->session->userdata('id_alumno');
                $this->load->model('Persona_model');
                $persona = new Persona_model();
                $persona->modificar($password1, $nick);
            }
        } else {
            echo 'Las contraseñas no coinciden.';
        }
    }

    public function apuntarse($id_taller) {
        /* 1.-Comprobar si la taller pertenece a la misma presentación 
          que el alumno.

          2.- Si la opción libre_de_limites esta en FALSE, comprobar si el alumno
          ha superado el limite por categoria permitidos en los ultimos 30 dias.

          3.-Insertar en el historial si hay plazas libres. En la consulta
          select tiene que haber un if comprobando si hay plazas luego
          incrementar contador y despues insertar. De este modo se evitan errores.
          Tambien se puede hacer con un triger en la base de datos.

          5.-Ir a la vista presentaciones.
         * 
         */
        $id_alumno = $this->session->userdata('id_alumno');
        $q = $this->db->query("select apuntar(" . $id_taller . "," . $id_alumno . ")");
        var_dump($q->result_array());
//        $this->db->call_function('apuntar', $id_taller, $id_alumno);
    }

    /*
     * El usuario se desapunta de la taller con $id_tarea.
     */

    public function desapuntarse($id_tarea) {
        /*
         * 1.-Comprobar si el alumno esta apuntado a la taller borrarla. 
         * 
         * 2.-Volver a vista_horario.
         */
    }


    public function horario() {
        /*
         * 1.-Conseguir tareas que pertenezcan a la presentacion (curso)
         * del alumno.
         * 
         * 2.-Mostrar vista_tareas. Le pasamos por parametro el array
         * y mostra la vista /alumno/vista_presentaciones.
         */
    }

}
