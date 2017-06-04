<?php

//Completo
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $this->load->view('head');
        $this->load->view('index');
    }

    public function login($password, $nombre) {
        /*
         * 1.- Comprobar si coincide la pass y el nombre de usuario.
         * 
         * 2.- Si No es Positivo, en Ajax tienes que recojer el codigo de error.
         * Y mostrar al usuario un mensaje comunicando el tipo de error.
         * Nota: => ['Nombre y contraseña no coinciden']
         * 
         */
    }

}
