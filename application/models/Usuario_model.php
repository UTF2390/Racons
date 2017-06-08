<?php

class Usuario_model extends CI_Model {

    public function login($password, $login) {
        $this->db->select('*');
        $this->db->where('nick', $login);
        $this->db->where('password', $password);
        $q = $this->db->get('persona');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function existe_nick($nick) {
        $this->db->select('*');
        $this->db->where('nick', $nick);
        $q = $this->db->get('persona');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function modificar_usuario($nick, $password) {
        $id_persona = $this->session->userdata('id_persona');
        $data = ['nick' => $nick, 'password' => $password];
        $this->db->where('id_persona', $id_persona);
        $this->db->update('persona', $data);
    }

    public function dame_datos_usuario($password, $nick) {
        $this->db->select('*');
        $this->db->where('nick', $nick);
        $this->db->where('password', $password);
        $q = $this->db->get('persona');
        if ($q->num_rows() > 0) {
            $aux = $q->result_array();
            $data = $aux[0];
            $data['login_ok'] = TRUE;
            $q = $this->db->query('select * from alumno where id_alumno = ' . $data['id_persona']);
            if ($q->num_rows() == 0) {
                $q = $this->db->query('select * from profesor where id_profesor = ' . $data['id_persona']);
                $aux = $q->result_array();
                $profesor = $aux[0];
                $data['admin'] = $profesor['administrador'];
                $data['id_profesor'] = $profesor['id_profesor'];
                if ($data['admin'] == TRUE) {
                    $data['rol'] = 'admin';
                } else {
                    $data['rol'] = 'profesor';
                }
            } else {
                $aux2 = $q->result_array();
                $profesor = $aux2[0];
                $data['rol'] = 'alumno';
                $data['id_curso'] = $profesor['id_curso'];
                $data['id_alumno'] = $profesor['id_alumno'];
            }
            return $data;
        } else {
            return false;
        }
    }

    public function get_data_user() {
        $this->db->select('*');
        $this->db->where('nick', $login);
        $this->db->where('password', $password);
        $result = $this->db->get('persona');
        return $result->result_array();
    }

    public function Tipo_cuenta($nick) {
        $query = $this->db->query("SELECT * FROM alumno WHERE id_alumno=(SELECT id_persona FROM persona WHERE nick='$nick');");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdministrador($nick) {
        $query = $this->db->query("SELECT * FROM profesor WHERE id_profesor=(SELECT id_persona FROM persona WHERE nick='$nick');");
        $row = $query->row();

        if (isset($row)) {
            return $row->administrador;
        }
    }

}
