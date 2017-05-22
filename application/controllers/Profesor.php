<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Cargar el modelo
        //Es la bariable que se envia a la vista para mostrar
        //o ocultar las opciones adicionales del administrador.
        $this->load->model('Profesor_model');
//        $data['admin'] = FALSE;
    }

    public function index() {
        $this->load->view('profesor/vista_profesor');
//        $this->talleres();
    }

    public function desactivar_taller() {
        /*
         * 1.- Comprueba si la taller pertenece al profesor.
         * 
         * 2.- Cambia el atributo activo de taller y elimina en el 
         * historial los alumnos que estaban apuntados a esta.
         * 
         * 3.-Respuesta recogida por Ajax. El javascrip informara al profesor y
         * modifica el html para marcar como desactivado la taller. O, sin Ajax,:-( cargar la 
         * vista vista_mis_talleres.
         */
    }

    public function activar_taller($id_taller) {
        /*
         * 1.- Comrueba si la taller pertenece al profesosr.
         * 
         * 2.- Modifica el atributo activo de la taller.
         * 
         * 3.- Con Ajax si todo salio bien, modificar la vista.
         */
    }

    /*
     * Añade nueva taller.
     */

    public function nuevo_taller() {
        /*
         * 1.-Recoger los datos por post.
         * 
         * 2.-El profesor puede añadir la taller a un grupo existente o crear uno
         * nuevo. Comprobar si por post hay id_grupo =! null. En tal caso
         * crea el grupo. Sino coger el id del grupo por post.
         * 
         * 3.-Comprobar si existe la presentación y el grupo.
         *
         * 4.-Comprobar si el profesor tiene otras talleres a la misma hora y dia.
         * Insertar nueva taller
         * 
         * 5.-Ir a la vista mis talleres. O usar Ajax ☺-☻¬.
         * 
         */
        $nombre = $this->input->post('nombre');
        $id_categoria = $this->input->post('id_categoria');
        $descripcion = $this->input->post('descripcion');
        $dia = $this->input->post('dia');
        $hora_inicio_hh = $this->input->post('hora_inicio_hh');
        $hora_inicio_mm = $this->input->post('hora_inicio_mm');
        $hora_fin_hh = $this->input->post('hora_fin_hh');
        $hora_fin_mm = $this->input->post('hora_fin_mm');
        $activo = $this->input->post('activo');
        $aforamiento = $this->input->post('aforamiento');
        $i = 0;
        $id_cursos = [];
        var_dump($_POST);
        while ($this->input->post('id_curso' + $i) != FALSE) {
            $aux = $this->input->post('id_curso' + $i);
            $aux = (int) $aux;
            array_push($id_cursos, $aux);
            $i++;
        }
        if (TRUE) {
            $this->load->model('Taller_model');
            $taller = new Taller_model();
            $this->session->userdata('id_profesor');
            $exito = $taller->insertar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $activo, $aforamiento);
            echo $exito;
            echo '☺☻☺☻';
//            $this->configuracion();
        } else {
//            $this->configuracion();
        }
        echo 'oooooooo';
    }

    /*
     * Inserta un dia a la taller.
     */

    public function modificar_taller() {
        /*
         * 1.- Comprueba si existe la taller y si pertenece al profesor.
         * 
         * 2.- Comprueba si el dia y la hora se solapan con otro dia y hora 
         * de otro taller del mismo profesor.
         * 
         * 3.- Inserta en la tabla el dia y la hora a la taller.
         */
    }

    /*
     * Muestra las talleres creadas por el profesor.
     */

    public function mis_talleres() {
        $this->load->model('Curso_model');
        $curso = new Curso_model();

        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $this->load->model('Categoria_model');
        $categoria = new Categoria_model();

//        $data['talleres_activas'] = $taller->talleres_activas();
//        $data['talleres_desactivadas'] = $taller->talleres_desactivadas();
        $data['talleres'] = $taller->taller_profesor($this->session->userdata('id_profesor'));
        $data['categorias'] = $categoria->categorias();
//        var_dump($data);
        $this->load->view('profesor/vista_mis_talleres', $data);
    }

}
