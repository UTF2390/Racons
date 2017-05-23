<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Profesor.php';

class Admin extends Profesor {

    public function __construct() {
        parent::__construct();
        $this->is_loggedIn();
    }

    public function index() {
        $this->horario();
    }

    public function is_loggedIn() {
        $check_login = $this->session->userdata('admin');

        if ($check_login === FALSE) {
            redirect('http://localhost/Racons');
        }
    }

    public function modificar_categoria() {
        /*
         * 1.- Modifica la categoria con los parametros pasados por post y ajax.
         */
//modificar categoria
        $nombre = $this->input->post('nombre');
        $limite = $this->input->post('limite');
        $id_categoria = $this->input->post('id_categoria');

        if ($nombre != FALSE && $limite != FALSE && $id_categoria != FALSE) {
            $limite = (int) $limite;
            $this->load->model('Categoria_model');
            $categoria = new Categoria_model();

            $response = $categoria->update_categoria($id_categoria, $limite, $nombre);
        } else {
            $response = "Error en el Ajax.";
            echo $response;
        }
    }

    public function eliminar_categoria() {
        /*
         * 1.- Comprobar si hay tareas con esta categoria.
         * 
         * 2.- Si no hay tareas con esa categoria eliminar la categoria y todos 
         * los limites en la tabla limites categoria alumnos. 
         */
        $id_categoria = $this->input->post('id_categoria');
        if ($id_categoria != FALSE) {
            $this->load->model('Categoria_model');
            $categoria = new Categoria_model();

            $response = $categoria->delete_categoria($id_categoria);
        } else {
            $response = "No se ha especificado un identificador.";
        }
        echo $response;
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
            $this->configuracion();
        } else {
            $this->configuracion();
        }
    }

    public function eliminar_curso($id_curso) {
        /*
         * 1.- Comprobar si hay tareas con esta categoria.
         * 
         * 2.- Si no hay tareas con esa categoria eliminar la categoria y todos 
         * los limites en la tabla limites categoria alumnos. 
         */
        $this->load->model('Curso_model');
        $curso = new Curso_model();
        $delete = $curso->delete_curso($id_curso);
        if ($delete) {
            echo 'True';
        } else {
            echo 'No se pueden eliminar curso que tengan alumnos. ☻-☺¬.';
        }
        $this->configuracion();
    }

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

            $this->configuracion();
        } else {
            $this->configuracion();
        }
    }

    /*
     * Muestra la vista de configuracion del sistema.
     */

    public function configuracion() {
        $this->load->model('Curso_model');
        $curso = new Curso_model();

        $this->load->model('Categoria_model');
        $categoria = new Categoria_model();

        $data['categorias'] = $categoria->categorias();
        $data['cursos'] = $curso->cursos();
        /* Ahora data tiene toda la informacion de las tablas de curso y categoria.
         * para que el administrador pueda verlas en su vista y eliminarlas.
         */
        $this->load->view('admin/vista_configuracion', $data);
    }

    public function nuevo_alumno() {
        /*
         * 1.- Comprobar si hay una categoria con el mismo nombre.
         * Si no hay coincidencia, añadirla.
         */
        $nombre = $this->input->post('nombre');
        $apellido1 = $this->input->post('apellido1');
        $apellido2 = $this->input->post('apellido2');
        $id_curso = $this->input->post('id_curso');
        $id_curso = (int) $id_curso;
        if ($nombre != FALSE && $apellido1 != FALSE && $apellido2 != FALSE && $id_curso != FALSE) {
            $this->load->model('Alumno_model');
            $alumno = new Alumno_model();
            $exito = $alumno->insertar_Alumno($nombre, $apellido1, $apellido2, $id_curso);
            $this->configuracion();
        } else {
            $this->configuracion();
            echo 'Error en el form de nuevo_alumno.';
        }
    }

    public function nuevo_profesor() {
        /*
         * 1.- Inserta un nuevo profesor.
         */
        $nombre = $this->input->post('nombre');
        $apellido1 = $this->input->post('apellido1');
        $apellido2 = $this->input->post('apellido2');
        $administrador = $this->input->post('administrador');
        if ($nombre != FALSE && $apellido1 != FALSE && $apellido2 != FALSE) {
            $this->load->model('Profesor_model');
            $profesor = new Profesor_model();
            $administrador = (int) $administrador;
            $exito = $profesor->insertar_profesor($nombre, $apellido1, $apellido2, $administrador);
            $this->configuracion();
        } else {
            $this->configuracion();
            echo 'Error en el form de nuevo_profe.';
        }
    }

    public function añadir_alumnos_con_fichero() {
//...
    }

}
