<?php

class Usuario_model extends CI_Model {

    public function login($password, $login) {
        $this->db->select('id_persona, login, nombre, apellido1, apellido2');
        $this->db->where('nick', $login);
        $this->db->where('password', $password);
        $q = $this->db->get('personas');
        if ($q->num_rows() > 0) {
            $profesor = $this->get_profesor($id_persona);
            if ($profesor['encontrado'] == TRUE) {
                if ($profesor['datos']['admin'] == TRUE) {
                    return ['admin' => $profesor['datos'], 'encontrado' => TRUE]; //caso 1 soy admin
                } else {
                    return ['profesor' => $profesor['datos'], 'encontrado' => TRUE];
                }
            } else {
                $alumno = $this->get_alumno($id_persona);
                if ($alumno['encontrado'] == TRUE) {
                    return ['alumno' => $alumno['datos'], 'encontrado' => TRUE];
                } else {
                    return ['encontrado' => TRUE];
                }
            }

            return ['usuario' => $q->result_array(), 'encontrado' => TRUE];
        } else {
            return ['encontrado' => FALSE];
        }
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

    public function get_profesor($id_persona) {
        $this->db->select('admin');
        $this->db->where('id_profesor', $id_persona);
        $q = $this->db->get('profesor');
        if ($q->num_rows() > 0) {
            return ['datos' => $q->result_array(), 'encontrado' => TRUE];
        } else {
            return ['encontrado' => FALSE];
        }
    }

    public function get_alumno($id_persona) {
        $this->db->select('id_alumnos, login, id_curso');
        $this->db->where('id_profesor', $id_persona);
        $q = $this->db->get('alumno');
        if ($q->num_rows() > 0) {
            return ['datos' => $q->result_array(), 'encontrado' => TRUE];
        } else {
            return ['encontrado' => FALSE];
        }
    }

    public function Logout() {
        $this->session->sess_destroy();
    }

    public function update_entry() {
        
    }

//            $this->title    = $_POST['title'];
//            $this->content  = $_POST['content'];
//            $this->date     = time();
//
//            $this->db->update('entries', $this, array('id' => $_POST['id']));
//                $this->title    = $_POST['title']; // please read the below note
//                $this->content  = $_POST['content'];
//                $this->date     = time();
//
//                $this->db->insert('entries', $this);
}
