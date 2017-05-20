<?php

class Alumno_model extends CI_Model {

    public function get_alumnos() {
        $query = $this->db->get('alumno');
        return $query->result();
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

}
