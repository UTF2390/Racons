<?php

class Alumno_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('alumno');
        return $consulta->num_rows();
    }

    function total_paginados($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT * '
                    . ' FROM persona as p, alumno as a, curso as c'
                    . ' WHERE c.id_curso=a.id_curso '
                    . ' and p.id_persona=a.id_alumno '
                    . ' LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT * '
                    . ' FROM persona as p, alumno as a, curso as c'
                    . ' WHERE c.id_curso=a.id_curso '
                    . ' and p.id_persona=a.id_alumno '
                    . ' LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }

    function insertar_Alumno($nombre, $apellido1, $apellido2, $id_curso) {
        $persona = [
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2];

        $this->db->insert('persona', $persona);
        $id_persona = $this->db->insert_id();

        $this->db->where('id_persona', $id_persona);
        $this->db->update('persona', ['nick' => $id_persona]);
        $alumno = ['id_curso' => $id_curso, 'id_alumno' => $id_persona];
        $this->db->insert('alumno', $alumno);

        return TRUE;
    }

    function deleteAlumno($id) {
        $this->db->where('id_alumno', $id);
        return $this->db->delete('alumno');
    }

    function updateAlumno($id, $usuario, $pass, $nombre, $apellido1, $apellido2, $foto, $curso) {
        $data = array(
            'nick' => $usuario,
            'pass' => $pass,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'foto' => $foto,
            'curso' => $curso,
        );
        $this->db->where('id_alumno', $id);
        return $this->db->update('alumno', $data);
    }

    public function existe_nick($nick) {
        $this->db->select('nick');
        $this->db->where('nick', $nick);
        $q = $this->db->get('personas');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getId_curso($nick) {
        $this->db->select('id_persona');
        $this->db->from('persona');
        $this->db->where('nick', $nick);
        $persona = $this->db->get();
        $persona = $persona->result_array();

        $this->db->select('id_curso');
        $this->db->from('alumno');
        $this->db->where('id_alumno', $persona[0]['id_persona']);
        $id_curso = $this->db->get();

        if ($id_curso->num_rows() > 0) {
            return $id_curso->result_array();
        } else {
            return false;
        }
    }

}
