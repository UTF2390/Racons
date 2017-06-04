<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    public function __construct() {
        parent::__construct();

        If ($this->session->userdata['rol'] != 'admin' && $this->session->userdata['rol'] != 'profesor') {
            session_destroy();
            redirect('/home');
        }
    }

    public function index() {
        redirect('Profesor/horario');
    }

    public function horario() {
        $this->load->model('Taller_model');
        $this->load->model('Horario_model');
        $taller = new Taller_model();
        $horario = new Horario_model();
        $id_profesor = $taller->session->userdata('id_profesor');
        $data['horario'] = $taller->taller_profesor_horario($id_profesor);
        $data['dias_semana'] = $horario->dias_semana();
        $this->load->view('head');
        $this->load->view('horario', $data);
    }

    public function alumno() {
        $this->load->model('Alumno_model');
        $alumno = new Alumno_model();
        $data['title'] = 'Paginacion_ci';
        $pages = 7; //Número de registros mostrados por páginas
        $config['base_url'] = base_url() . 'profesor/alumno'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $alumno->filas(); //calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data["listas"] = $alumno->total_paginados($config['per_page'], $this->uri->segment(3));
//        var_dump($config['total_rows']);
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('student', $data);
    }

    public function profesor() {
        $this->load->model('Profesor_model');
        $profesor = new Profesor_model();
        $data['title'] = 'Paginacion_ci';
        $pages = 4; //Número de registros mostrados por páginas
        $config['base_url'] = base_url() . 'admin/profesor'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $profesor->filas(); //calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 10; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data["listas"] = $profesor->total_paginados($config['per_page'], $this->uri->segment(3));
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('teacher', $data);
    }

    public function taller() {
        $this->load->model('Taller_model');
        $this->load->model('Categoria_model');
        $this->load->model('Curso_model');
        $taller = new Taller_model();
        $data['title'] = 'Paginacion_ci';
        $config['base_url'] = base_url() . 'profesor/taller'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $taller->numero_filas_taller_profesor(); //calcula el número de filas  
        $config['per_page'] = 6; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data['talleres'] = $taller->total_paginados_profesor($config['per_page'], $this->uri->segment(3));
        $data['categorias'] = $this->Categoria_model->categorias();
        $data['cursos'] = $this->Curso_model->cursos();
        $data['paginacion'] = $this->pagination->create_links();
//        var_dump($data['paginacion']);
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('taller', $data);
    }

    public function nuevo_taller() {
        /*
         * 1.-Recoger los datos por post.
         * 
         * 3.-Comprobar si existe el taller.
         *
         * 4.-Comprobar si el profesor tiene otros talleres a la misma hora y dia.
         * Insertar nuevo taller.
         * 
         * 5.-Ir a la vista mis talleres.
         * 
         */
        $nombre = $this->input->post('nombre');
        $id_taller = $this->input->post('id_taller');
        $id_categoria = $this->input->post('id_categoria');
        $descripcion = $this->input->post('descripcion');
        $dia = $this->input->post('dia');
        $hora_inicio_hh = $this->input->post('hora_inicio_hh');
        $hora_inicio_mm = $this->input->post('hora_inicio_mm');
        $hora_fin_hh = $this->input->post('hora_fin_hh');
        $hora_fin_mm = $this->input->post('hora_fin_mm');
        //$activo = $this->input->post('activo');
        $aforamiento = $this->input->post('aforamiento');
        $i = 1;
        $id_cursos = [];
        while ($this->input->post('id_curso' . $i) != FALSE) {
            $aux = $this->input->post('id_curso' . $i);
            array_push($id_cursos, $aux);
            $i++;
        }
        if ($nombre && $aforamiento != FALSE) {
            $this->load->model('Taller_model');
            $taller = new Taller_model();
            $id_profesor = $this->session->userdata('id_profesor');
            $exito = $taller->insertar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $aforamiento);

            if ($exito) {
                if ($id_cursos != [] && $id_taller != FALSE) {
                    $taller->insertar_curso_taller($id_cursos, $id_taller);
                }
                redirect('profesor/taller');
            } else {
                redirect('profesor/taller');
            }
        } else {
            redirect('profesor/taller');
        }
    }

    public function habilitar_taller($id_taller) {
        /*
         * 1.- Comrueba si la taller pertenece al profesosr.
         * 
         * 2.- Modifica el atributo activo de la taller.
         * 
         */
        $this->load->model('Taller_model');
        $taller = new Taller_model();
//        var_dump($_SESSION);
        $id_profesor = $taller->session->userdata('id_profesor');
        $exito = $taller->habilitar_taller($id_taller, $id_profesor);
        echo $exito;
//        redirect('profesor/taller');
    }

    /*
     * Deshabilita taller.
     */

    public function deshabilitar_taller($id_taller) {
        /*
         * 1.- Comrueba si la taller pertenece al profesosr.
         * 
         * 2.- Modifica el atributo activo de la taller.
         * 
         */
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $exito = $taller->deshabilitar_taller($id_taller);
        echo $exito;
//        redirect('profesor/taller');
    }

    public function historial_alumno($id_alumno) {
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $data['title'] = 'Paginacion_ci';
        $config['base_url'] = base_url() . 'profesor/taller/' . $id_alumno; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $taller->numero_filas_taller_historial_alumno($id_alumno); //calcula el número de filas  
        $config['per_page'] = 10; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data['talleres'] = $taller->total_paginados_historial($config['per_page'], $this->uri->segment(4), $id_alumno);
        $data['paginacion'] = $this->pagination->create_links();
//        var_dump($data['paginacion']);
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('historial_alumno', $data);
    }

}
