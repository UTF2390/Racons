<?php

class Usuario extends CI_Controller {

        public function index() {
            redirect('home');
        }

    public function login() {
        $this->load->model('Usuario_model');
        $usuario = new Usuario_model();
        $nick = $this->input->post('log');
        $password = $this->input->post('pass');
        $datasession = $usuario->dame_datos_usuario($password, $nick);
        $this->session->set_userdata($datasession);
        $rol = $this->session->userdata('rol');
        if ($rol == 'alumno') {
            redirect('Alumno');
        } else if ($rol == 'profesor') {
//        var_dump($_SESSION);
            redirect('Profesor');
        } else if ($rol == 'admin') {
            redirect('Admin');
        }
    }

    function logout() {
        session_destroy();
        redirect('/');
    }

}
