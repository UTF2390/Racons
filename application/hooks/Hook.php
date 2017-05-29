<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hook extends CI_Controller {

    var $CI;

    function __construct() {

        $this->CI = & get_instance();

        if (!isset($this->CI->session)) {  //Check if session lib is loaded or not
            $this->CI->load->library('session');  //If not loaded, then load it here
        }
    }

    public function is_loggedIn() {


        $check_login = isset($this->CI->session->userdata['profesor']);
        $segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        $controlador = $segments[1];
        echo $controlador;
        if ((( $controlador == 'admin' || $controlador == 'Admin') &&
                ($this->CI->session->userdata('Admin'))) ||
                (( $controlador == 'alumno' || $controlador == 'Alumno') &&
                ($this->CI->session->userdata('Alumno'))) ||
                (( $controlador == 'profesor' || $controlador == 'Profesor') &&
                ($this->CI->session->userdata('Profesor')))) {
            echo '☺☺';
        } else {
//            redirect('Home');
        }
    }

}
