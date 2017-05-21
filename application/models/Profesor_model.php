<?php

class Profesor_model extends CI_Model {

    public function get_profesores() {
        $query = $this->db->get('profesor');
        return $query->result();
    }

    function insertar_profesor($nombre, $apellido1, $apellido2, $administrador) {
        $persona = [
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2
        ];

        $this->db->insert('persona', $persona);
        $id_persona = $this->db->insert_id();

        $this->db->where('id_persona', $id_persona);
        $this->db->update('persona', ['nick' => $id_persona]);

        $profesor = ['administrador' => $administrador, 'id_profesor' => $id_persona];
        $this->db->insert('profesor', $profesor);

        return TRUE;
    }

    function deleteProfesor($id) {
        $this->db->where('id_profesor', $id);
        return $this->db->delete('profesor');
    }

    function updateAlumno($id, $usuario, $pass, $nombre, $apellido1, $apellido2, $administrador) {
        $data = array(
            'nick' => $usuario,
            'pass' => $pass,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'administrador' => $administrador,
        );
        $this->db->where('id_profesor', $id);
        return $this->db->update('profesor', $data);
    }

}
