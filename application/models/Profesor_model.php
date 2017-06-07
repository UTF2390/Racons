<?php

class Profesor_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('profesor');
        return $consulta->num_rows();
    }

    function total_paginados($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT * FROM `persona`, `profesor` WHERE id_persona=id_profesor LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT * FROM `persona`, `profesor` WHERE id_persona=id_profesor LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }

    function insertar_Profesor($nick, $password, $nombre, $apellido1, $apellido2, $administrador) {
        $persona = [
            'nombre' => $nombre,
            'password' => $password,
            'apellido1' => $apellido1,
            '$nick' => $nick,
            'apellido2' => $apellido2];

        $this->db->insert('persona', $persona);
        $id_persona = $this->db->insert_id();

        $prfesor = ['administrador' => $administrador, 'id_profesor' => $id_persona];
        $this->db->insert('profesor', $prfesor);
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

    public function get($id) {
        $q = $this->db->query('SELECT * FROM `administrador` where id_profesor="' . $id . '" AND password="' . $pass . '"');
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return false;
        }
    }

    public function getNumAdmin() {
        $q = $this->db->query('SELECT * FROM `profesor` where administrador=1');

        return $q->num_rows();
    }

}
