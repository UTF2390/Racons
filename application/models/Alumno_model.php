<?php

class Alumno_model extends CI_Model {

    public function get_alumnos() {
        $query = $this->db->get('alumno');
        return $query->result();
    }

    function setAlumno($usuario, $pass, $nombre, $apellido1, $apellido2, $curso) {
        $data = array(
            'nick' => $usuario,
            'pass' => $pass,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'curso' => $curso
        );
        if ($this->existe_nick($nick)) {
            return ['nick_libre' => TRUE];
        } else {
            $this->db->insert('alumno', $data);
            return ['nick_libre' => FALSE];
        }
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

}
