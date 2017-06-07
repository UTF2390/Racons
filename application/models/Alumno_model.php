<?php

class Alumno_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('alumno');
        return $consulta->num_rows();
    }

    function delete_alumno($id_alumno) {
        $this->db->where('id_persona', $id_alumno);
        return $this->db->delete('persona');
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

    function insertar_Alumno($nick, $password, $nombre, $apellido1, $apellido2, $id_curso) {
        $persona = [
            'nombre' => $nombre,
            'password' => $password,
            'apellido1' => $apellido1,
            '$nick' => $nick,
            'apellido2' => $apellido2];

        $this->db->insert('persona', $persona);
        $id_persona = $this->db->insert_id();

        $alumno = ['id_curso' => $id_curso, 'id_alumno' => $id_persona];
        $this->db->insert('alumno', $alumno);

        return TRUE;
    }
    

    function deleteAlumno($id) {
        $this->db->where('id_alumno', $id);
        return $this->db->delete('alumno');
    }

    function modificar_alumno($id_alumno, $usuario, $password, $nombre, $apellido1, $apellido2, $id_curso) {
        $data = array(
            'nick' => $usuario,
            'password' => $password,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2
        );
        $this->db->where('id_persona', $id_alumno);
        $this->db->update('persona', $data);
        $data = array(
            'id_curso' => $id_curso,
        );
        $this->db->where('id_alumno', $id_alumno);
        $this->db->update('alumno', $data);
        if ($this->db->affected_rows() > 0) {
            $result = true;
        } else {
            $result = true;
        }
        return $result;
    }

    public function alumno_fila($id_alumno) {
        $alumno = $this->alumno($id_alumno);
        var_dump($alumno);
        if ($alumno != false) {
            $result = '<tr id="id_alumno_' . $alumno['id_alumno'] . '">'
                    . '<td class="id_curso" style="display: none;">' . $alumno['id_curso'] . '</td>'
                    . '<td class="id_persona" >' . $alumno['id_persona'] . '</td>'
                    . '<td class="nombre" >' . $alumno['nombre'] . '</td>'
                    . '<td class="apellido1" >' . $alumno['apellido1'] . '</td>'
                    . '<td class="apellido2" >' . $alumno['apellido2'] . '</td>'
                    . '<td class="curso" >' . $alumno['curso'] . '</td>'
                    . '<td><a href="' . base_url() . 'profesor/historial_alumno/' . $alumno['id_alumno'] . '" class="btn glyphicon glyphicon-eye-open"></a></td>';
            if ($this->session->userdata('rol') == "admin") {
                $result .= '<td><a onclick="modificar_alumno_modal(' . $alumno['id_alumno'] . ')" href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>'
                        . '<td><a onclick="eliminar_alumno(' . $alumno['id_alumno'] . ')" href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
            }
            $result .= '</tr>';
        } else {
            $result = 'false';
        }
//        var_dump($result);

        return $result;
    }

    public function alumno($id_alumno) {
        $q = $this->db->query('select *, c.id_curso as curso_id_curso from alumno as a, persona as p, curso as c '
                . ' where a.id_alumno = p.id_persona'
                . ' and a.id_curso = c.id_curso'
                . ' and a.id_alumno = ' . $id_alumno);
        $result = $q->result_array();
//                var_dump($result);

        return $result[0];
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
