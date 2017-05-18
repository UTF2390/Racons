<?php

//Completo
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        /*
         * Comprueva si hay sesion iniciada buscando en session el objeto alumno,
         * profesor o admin y redirecciona a la vista del controlador correspondiente
         * o la vista login para logear/registrar.
         */

        $newdata = ['alumno' => ['username' => 'johndoe',
                'email' => 'johndoe@some-site.com',
                'logged_in' => TRUE]];

        $this->session->set_userdata($newdata);

        if ($this->session->has_userdata('alumno')) {
//            $this->load->controller('alumno');
            redirect('alumno');                      //redirecciona al controlador 'alumno', 
        } elseif ($this->session->has_userdata('profesor')) {   //este ejecuta el metodo index
            redirect('profesor', 'refresh');
        } elseif ($this->session->has_userdata('admin')) {
            redirect('admin', 'refresh');
            $segments = array('news', 'local', '123');
            echo site_url($segments);
        } else {
            $this->load->view('logout/login');
        }
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
        $this->load->model('Usuario_model');
        $usuario = new Usuario_model();
        //recibe por post el password y el nick
        $password = $this->db->escape($this->post('password'));
        $nick = $this->db->escape($this->post('nick'));
        
        //Existe el usuario? Y guarda los datos en sesión.
        $userdata = $usuario->login($password, $nick);
        $this->session->userdata($userdata['usuario']);
    }

}
