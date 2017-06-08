<?php

class Usuario extends CI_Controller {

    public function index() {
        $rol = $this->session->userdata('rol');
        if ($rol == 'alumno') {
            redirect('Alumno');
        } else if ($rol == 'profesor') {
//        var_dump($_SESSION);
            redirect('Profesor');
        } else if ($rol == 'admin') {
            redirect('Admin');
        } else {
            redirect('home');
        }
    }

    public function login() {
        $this->load->model('Usuario_model');
        $usuario = new Usuario_model();
        $nick = $this->input->post('log');
        $password = $this->input->post('pass');
        $datasession = $usuario->dame_datos_usuario($password, $nick);
        if ($datasession != FALSE) {
            $this->session->set_userdata($datasession);
            $rol = $this->session->userdata('rol');
            if ($rol == 'alumno') {
                redirect('Alumno');
            } else if ($rol == 'profesor') {
                redirect('Profesor');
            } else if ($rol == 'admin') {
                redirect('Admin');
            } else {
                redirect('home');
            }
        } else {
            session_destroy();
            redirect('home');
        }
    }

    public function modificar_usuario() {
        $this->load->model('Usuario_model');
        $usuario = new Usuario_model();
        $nick = $this->input->post('nick');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        if ($password2 != $password1) {
            echo 'No coinciden las contraseñas';
        } else if ($usuario->existe_nick($nick)) {
            echo 'Este nick esta siendo usado.';
        } else {
            $usuario->modificar_usuario($nick, $password1);
            $this->session->set_userdata('nick', $nick);
            echo 'ok';
        }
    }

    function logout() {
        session_destroy();
        redirect('/');
    }

}
