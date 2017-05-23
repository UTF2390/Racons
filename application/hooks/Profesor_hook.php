<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor_hook extends CI_Controller {

    public function is_loggedIn() {
        $check_login = isset($_SESSION['profesor']);

        if (isset($_SESSION['profesor']) == FALSE) {
            echo'Nice try.';
            redirect('http://localhost/Racons/index.php/Home');
        }
    }

}
