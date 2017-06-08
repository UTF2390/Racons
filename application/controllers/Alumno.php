<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

    public $modelo_alumno;

    public function __construct() {
        parent::__construct();
        If ($this->session->userdata['rol'] != 'alumno') {
            session_destroy();
            redirect('/home');
        }
    }

    public function index() {
        $this->load->model('Taller_model');
        $this->load->model('Horario_model');
        $taller = new Taller_model();
        $horario = new Horario_model();
        $id_alumno = $taller->session->userdata('id_alumno');
        $id_curso = $taller->session->userdata('id_curso');
        $data['horario'] = $taller->taller_alumno_horario($id_alumno, $id_curso);
        $data['dias_semana'] = $horario->dias_semana();
        $this->load->view('head');
        $this->load->view('horario', $data);
    }

    public function lista_taller() {
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $data['title'] = 'Paginacion_ci';
        $config['base_url'] = base_url() . 'alumno/lista_taller'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
//	$config['total_rows'] = $taller->filas_taller_alumno();//calcula el número de filas  
        $config['total_rows'] = $taller->numero_filas_taller_alumno();;
        $config['per_page'] = 7; //Número de registros mostrados por páginas
        $config['num_links'] = 10; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config['uri_segment'] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data["talleres"] = $taller->total_paginados_alumno($config['per_page'], $this->uri->segment(3));
        $data['paginacion'] = $this->pagination->create_links();
        $this->load->view('head');
        $this->load->view('taller_alumno', $data);
    }

    public function apuntarse($id_taller) {
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $id_alumno = $taller->session->userdata('id_alumno');
//        var_dump($id_alumno);
        $q = $taller->apuntar($id_taller, $id_alumno);
        $data = $q[0]['respuesta'];
        echo $data;
        return $data;
//        redirect('alumno/lista_taller');
    }

    public function desapuntarse($id_taller) {
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $id_alumno = $taller->session->userdata('id_alumno');
        $respuesta = $taller->desapuntar($id_taller, $id_alumno);
        if($respuesta == true){
            echo 'ok';
        }else{
            echo 'No estabas apuntado a esta asignatura (-.-) Hacker!!';
        }
    }

}
