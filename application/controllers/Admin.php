<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Profesor.php';

class Admin extends Profesor {

//    private $admin = TRUE;

    public function __construct() {
        parent::__construct();
        //Cargar el modelo
        $this->load->model('Admin_model');
//        $data['admin'] = TRUE;
    }

    public function index() {
//        $this->load->view('profesor/vista_profesor', $data);
        $data['admin'] = TRUE;
        $this->load->view('profesor/vista_profesor', $data);
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

    public function nueva_categoria() {
        /*
         * 1.- Comprobar si hay una categoria con el mismo nombre.
         * Si no hay coincidencia, añadirla.
         */
        $nombre = $this->db->escape($_POST['nombre']);
        $limite = $this->db->escape($_POST['limite']);
        //INSERTAAAAAA!!!!! 
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

    public function configuracion() {
        
        
        
        $this->load->view('admin/configuracion', $data);
    }

}
