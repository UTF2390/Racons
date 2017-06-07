<?php

class Curso_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('curso');
        return $consulta->num_rows();
    }

    function total_paginados($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT * FROM `curso` LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT * FROM `curso` LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }

    //terminado sin comprobar
    //Retorna la lista de cursos.

    public function cursos() {
        $q = $this->db->get('curso');
        return $q->result_array();
    }

    public function existe_curso($id_curso) {
        $q = $this->db->where('id_curso', $id_curso);
        $q = $this->db->get('curso');
        return $q->num_rows() == 1;
    }

    //Existen talleres de la categoria con id == id_categoria?
    function existe_alumnos_talleres_curso($id_curso) {
        $id_curso = (int) $id_curso;
        $q = $this->db->query('SELECT id_curso from alumno where id_curso = ' . $id_curso . ' UNION SELECT id_curso from curso_taller where id_curso = ' . $id_curso . '');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Sepuede eliminar un curso si no tiene talleres ni alumnos relacinados.
    function delete_curso($id_curso) {
        if ($this->existe_alumnos_talleres_curso($id_curso) == FALSE) {
            $this->db->where('id_curso', $id_curso);
            return $this->db->delete('curso');
        } else {
            return FALSE;
        }
    }

    //Inserta nuevo curso.
    function insertar_curso($nombre) {
        $data = array(
            'curso' => $nombre,
        );

        $this->db->insert('curso', $data);
        return $this->db->affected_rows() > 0;
    }

    public function curso($id_curso) {
        $q = $this->db->query('select * '
                . ' from curso '
                . ' where id_curso = ' . $id_curso);
        $curso = $q->result_array();
        return $curso[0];
    }

    public function curso_fila($id_curso) {
        $curso = $this->curso($id_curso);
//        var_dump($curso);
        if ($curso != false) {
            $result = '<tr id="tr_' . $curso['id_curso'] . '">'
                    . ' <td>' . $curso['id_curso'] . '</td>'
                    . '<td>' . $curso['curso'] . '</td>'
                    . '<td><a onclick="modificar_curso_modal(' . $curso['id_curso'] . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>'
                    . '<td><a onclick="eliminar_curso(this,' . $curso['id_curso'] . ')" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>'
                    . '</tr>';
        } else {
            $result = false;
        }
        return $result;
    }

    public function modificar_curso($id_curso, $curso) {
        $q = $this->db->query('update curso '
                . ' set curso = "' . $curso . '"'
                . ' where id_curso = ' . $id_curso);
        return TRUE;
    }

}
