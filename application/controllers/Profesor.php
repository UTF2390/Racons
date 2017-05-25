<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Cargar el modelo
        //Es la bariable que se envia a la vista para mostrar
        //o ocultar las opciones adicionales del administrador.
    }

    public function index() {
//        $this->load->view('profesor/vista_profesor');
        redirect('Profesor/horario');
    }

    /*
     * Habilita taller.
     */

    public function habilitar_taller($id_taller, $dia, $hora_inicio, $hora_fin) {
        /*
         * 1.- Comrueba si la taller pertenece al profesosr.
         * 
         * 2.- Modifica el atributo activo de la taller.
         * 
         */
        $this->load->model('Taller_model');
        $taller = new Taller_model();
        $exito = $taller->habilitar_taller($id_taller, $dia, $hora_inicio, $hora_fin);
        $this->mis_talleres();
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
        $this->mis_talleres();
    }

    /*
     * Añade nueva taller.
     */

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
        $activo = $this->input->post('activo');
        $aforamiento = $this->input->post('aforamiento');
        $i = 0;
        $id_cursos = [];
        while ($this->input->post('id_curso' + $i) != FALSE) {
            $aux = $this->input->post('id_curso' + $i);
            array_push($id_cursos, $aux);
            $i++;
        }
        if ($nombre && $aforamiento != FALSE) {
            $this->load->model('Taller_model');
            $taller = new Taller_model();
            $id_profesor = $this->session->userdata('id_profesor');
            $exito = $taller->modificar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $aforamiento);
            if ($exito) {
                if ($id_cursos != [] && $id_taller != FALSE) {
                    $taller->insertar_curso_taller($id_cursos, $id_taller);
                }
                $this->mis_talleres();
            } else {
                $this->mis_talleres();
            }
        } else {
            $this->mis_talleres();
        }
    }

    /*
     * Inserta un dia a la taller.
     */

    public function modificar_taller($id_taller) {
        /*
         * 1.- Comprueba si existe la taller y si pertenece al profesor.
         * 
         * 2.- Comprueba si el dia y la hora se solapan con otro dia y hora 
         * de otro taller del mismo profesor.
         * 
         * 3.- Inserta en la tabla el dia y la hora a la taller.
         */
        if ($this->input->post('modificar_taller')) {
            $data['nombre'] = $this->input->post('nombre');
            $data['id_categoria'] = $this->input->post('id_categoria');
            $data['descripcion'] = $this->input->post('descripcion');
            $data['dia'] = $this->input->post('dia');
            $data['hora_inicio_hh'] = $this->input->post('hora_inicio_hh');
            $data['hora_inicio_mm'] = $this->input->post('hora_inicio_mm');
            $data['hora_fin_hh'] = $this->input->post('hora_fin_hh');
            $data['hora_fin_mm'] = $this->input->post('hora_fin_mm');
            $data['aforamiento'] = $this->input->post('aforamiento');
            $i = 0;
            $id_cursos = [];
            while ($this->input->post('id_curso' + $i) != FALSE) {
                $aux = $this->input->post('id_curso' + $i);
                array_push($id_cursos, $aux);
                $i++;
            }
            $data['id_profesor'] = $this->session->userdata('id_profesor');
            if ($data['dia'] >= 1 && $data['dia'] <= 5 && $data['id_categoria'] != FALSE && $data['id_profesor'] != FALSE) {
                $this->load->model('Taller_model');
                $taller = new Taller_model();

                $respuesta = $taller->modificar_taller($data['id_profesor'], $data['nombre'], $data['id_categoria'], $data['descripcion'], $id_cursos, $data['dia'], $data['hora_inicio_hh'], $data['hora_inicio_mm'], $data['hora_fin_hh'], $data['hora_fin_mm'], $data['aforamiento'], $id_taller);
//                echo 'hola☺☺☺';
                redirect('Profesor/mis_talleres');
            }
        } else {
            $this->load->model('Taller_model');
            $this->load->model('Categoria_model');
            $taller = new Taller_model();
            $categoria = new Categoria_model();

            $data['categorias'] = $categoria->categorias();
            $aux = $taller->get_taller($id_taller);
            if ($aux != FALSE && $data['categorias'] != FALSE) {
                $data['taller'] = $aux[0];
                $this->load->view('profesor/vista_modificar_taller', $data);
            } else {
                redirect('Profesor/mis_talleres');
            }
        }
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
        $this->load->model('Curso_model');
        $curso = new Curso_model();

        $data['talleres'] = $taller->taller_profesor($this->session->userdata('id_profesor'));
        $data['categorias'] = $categoria->categorias();
        $data['cursos'] = $curso->cursos();
        $this->load->view('profesor/vista_mis_talleres', $data);
    }

    public function horario() {
        $this->load->model('Taller_model');
        $this->load->model('Horario_model');

        $taller = new Taller_model();
        $horario = new Horario_model();
        $id_profesor = $taller->session->userdata('id_profesor');

        $data['horario'] = $taller->taller_profesor_horario($id_profesor);
        $data['numero_dias'] = $horario->dias_semana();

        $this->load->view('profesor/vista_horario', $data);
    }

}
