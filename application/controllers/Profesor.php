<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    public function index() {
        $this->load->view('vista_profesor');
    }

    public function crear_presentacion() {

        }

    public function nueva_tarea() {
        //1.-Recoger los datos por post.
        //
        //2.-Comprobar si existe la presentación.
        //
        //3.-Comprobar si el profesor tiene otras tareas a la misma hora.
        //
        }

}
