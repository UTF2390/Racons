<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Profesor.php';

class Admin extends Profesor {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->configuracion();
    }

    public function modificar_categoria($id_categoria) {
        /*
         * 1.- Modifica la categoria con los parametros pasados por post y ajax.
         */
        //modificar categoria
        $nombre = $this->input->post('nombre');
        $limite = $this->input->post('limite');
        $limite = (int) $limite;
        if ($nombre && $limite) {

            $nombre = $this->db->escape($nombre);
            $limite = $this->db->escape($limite);


            $this->load->model('Categoria');
            $categoria = new Categoria_model();

            $id_categoria = $this->input->post('id_categoria');
            $limite_categoria = $this->input->post('limite_categoria');
            $nombre = $this->input->post('nombre');
            //retorna true o false si se actualiza correctamente estaria bien que 
            //lo recoguiera el ajax.
            $categoria->update_categoria($id_categoria, $limite_categoria, $nombre);

            $this->configuracion();
        } else {
            
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

            /* los mensajes no se recogen por ajax asi que de momento no funcinan
              if ($this->db->_error_message()) {
              $jsondata["success"] = False; // Or do whatever you gotta do here to raise an error
              $jsondata["mensaje"] = sprintf('Error en la base de datos.');
              } elseif ($exito) {
              $jsondata["success"] = True;
              $jsondata["mensaje"] = sprintf("ok");
              } else {
              $jsondata["success"] = false;
              $jsondata["mensaje"] = sprintf('No se modifico la categoria.');
              }
             * 
             */
            $this->configuracion();
        } else {
            $this->configuracion();
            echo 'nada';
        }
    }

    public function eliminar_categoria($id_categoria) {
        /*
         * 1.- Comprobar si hay tareas con esta categoria.
         * 
         * 2.- Si no hay tareas con esa categoria eliminar la categoria y todos 
         * los limites en la tabla limites categoria alumnos. 
         */
        $this->load->model('Categoria_model');
        $categoria = new Categoria_model();

        $categoria->delete_categoria($id_categoria);
        /* ♥♥♥♥♥OPCIONAL♥♥♥♥♥
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
         */
        $this->configuracion();
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
        $this->load->view('admin/configuracion', $data);
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
        var_dump($_POST);
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
