<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Profesor.php';

class Admin extends Profesor {

//    private $admin = TRUE;

    public function __construct() {
        parent::__construct();

        If ($this->session->userdata['rol'] != 'admin') {
            session_destroy();
            redirect('/home');
        }
    }

    public function index() {
//        $this->load->view('profesor/vista_profesor', $data);
        //$data['admin'] = TRUE;
        $this->load->model('Profesor_model');
        $this->load->model('Alumno_model');
        $this->load->model('Taller_model');
        $data = array(
            'num_profesores' => $this->Profesor_model->filas(),
            'num_alumnos' => $this->Alumno_model->filas(),
            'num_admin' => $this->Profesor_model->getNumAdmin(),
            'num_taller' => $this->Taller_model->getNumTaller(),
        );
        $this->load->view('head');
        $this->load->view('home', $data);
    }

    public function nuevo_alumno() {
        /*
         * 1.- Comprobar si hay una categoria con el mismo nombre.
         * Si no hay coincidencia, añadirla.
         */

        $nombre = $this->input->post('nombre');
        $apellido1 = $this->input->post('apellido1');
        $apellido2 = $this->input->post('apellido2');
        $id_curso = $this->input->post('curso');
        $id_curso = (int) $id_curso;
        var_dump($_POST);
        if ($nombre != FALSE && $apellido1 != FALSE && $apellido2 != FALSE && $id_curso != FALSE) {
            $this->load->model('Alumno_model');
            $alumno = new Alumno_model();
            $exito = $alumno->insertar_Alumno($nombre, $apellido1, $apellido2, $id_curso);
            redirect('admin/alumno');
        } else {
            //$this->configuracion();
            echo 'Error en el form de nuevo_alumno.';
        }
    }

    public function nuevo_profesor() {
        /*
         * 1.- Inserta un nuevo profesor.
         */
        $nick = $this->input->post('nick');
        $nombre = $this->input->post('nombre');
        $apellido1 = $this->input->post('apellido1');
        $apellido2 = $this->input->post('apellido2');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $administrador = $this->input->post('administrador');

        if ($nombre != FALSE && $apellido1 != FALSE && $apellido2 != FALSE) {
            $this->load->model('Profesor_model');
            $profesor = new Profesor_model();
            $administrador = (int) $administrador;
            $exito = $profesor->insertar_profesor($nick, $nombre, $apellido1, $apellido2, $password1, $administrador);
            redirect('techer');
        } else {
            redirect('admin/profesor');
            echo 'Error en el form de nuevo_profe.';
        }
    }

    public function nueva_categoria() {
        /*
         * 1.- Comprobar si hay una categoria con el mismo nombre.
         * Si no hay coincidencia, añadirla.
         */
        $nombre = $this->input->post('nombre');
        $limite = $this->input->post('limite');
        $limite = (int) $limite;
        if ($nombre != FALSE && $limite != FALSE) {
            $this->load->model('Categoria_model');
            $categoria = new Categoria_model();
            $exito = $categoria->insertar_categoria($nombre, $limite);
            redirect('admin/categoria');
        } else {
            echo 'hola';
        }
    }

    public function categoria() {
        $this->load->model('Categoria_model');
        $categoria = new Categoria_model();
        $data['title'] = 'Paginacion_ci';
        $pages = 5; //Número de registros mostrados por páginas
        $config['base_url'] = base_url() . 'admin/categoria'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $categoria->filas(); //calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data["listas"] = $this->Categoria_model->total_paginados($config['per_page'], $this->uri->segment(3));
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('categoria', $data);
    }

    public function modificar_max_limite($id_alumno, $id_categoria, $limite) {
        /*
         * 1.- Modifica o crea una linea en la tabla de limite_por_categoria.
         * 
         * 2.- Con Ajax recoge el resultado.
         */
    }

    public function modificar_limite_categoria($id_usuario, $id_categoria, $limite) {
        /*
         * 1.- Buscar en la tabla de limites si existe la relación 
         * id_usuario y id_categoria, modificarla o crearla con el limite.
         */
    }

    public function modificar_categoria($id_categoria) {
        /*
         * 1.- Modifica la categoria con los parametros pasados por post y ajax.
         */
        //modificar categoria
        if ($this->db->_error_message()) {
            $jsondata["success"] = False; // Or do whatever you gotta do here to raise an error
            $jsondata["mensaje"] = sprintf('Error en la base de datos.');
        } elseif ($this->db->affected_rows() > 0) {
            $jsondata["success"] = True;
            $jsondata["mensaje"] = sprintf("ok");
        } else {
            $jsondata["success"] = false;
            $jsondata["mensaje"] = sprintf('No se modifico la categoria.');
        }

        echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }

    public function eliminar_categoria($id_categoria) {
        /*
         * 1.- Comprobar si hay tareas con esta categoria.
         * 
         * 2.- Si no hay tareas con esa categoria eliminar la categoria y todos 
         * los limites en la tabla limites categoria alumnos. 
         */
        if ($this->db->_error_message()) {
            $jsondata["success"] = False; // Or do whatever you gotta do here to raise an error
            $jsondata["mensaje"] = sprintf('Error en la base de datos.');
        } elseif ($this->db->affected_rows() > 0) {
            $jsondata["success"] = True;
            $jsondata["mensaje"] = sprintf("La categoria se elimino correctamente.");
        } else {
            $jsondata["success"] = false;
            $jsondata["mensaje"] = sprintf('No se pudo eliminar la categoria. Esta siendo usada por una tarea.');
        }
        echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }

    public function añadir_alumnos() {
        //...
    }

    public function curso() {
        $this->load->model('Curso_model');
        $data['title'] = 'Paginacion_ci';
        $pages = 5; //Número de registros mostrados por páginas
        $config['base_url'] = base_url() . 'admin/curso'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->Curso_model->filas(); //calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        $data["listas"] = $this->Curso_model->total_paginados($config['per_page'], $this->uri->segment(3));
        //cargamos la vista y el array data
        $this->load->view('head');
        $this->load->view('curso', $data);
    }

    /* public function configuracion() {



      $this->load->view('admin/configuracion', $data);
      } */

    public function nuevo_curso() {
        /*
         * 1.- Comprobar si hay una categoria con el mismo nombre.
         * Si no hay coincidencia, añadirla.
         */

        $this->load->model('Curso_model');
        $curso = new Curso_model();

        $nombre = $this->input->post('nombre');

        if ($nombre != FALSE) {
            $exito = $curso->insertar_curso($nombre);

            redirect('admin/curso');
        } else {
            redirect('admin/curso');
        }
    }

}
