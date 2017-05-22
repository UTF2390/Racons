<?php

class Taller_model extends CI_Model {

    public function taller_profesor($id_profesor) {

        $q = $this->db->query('SELECT c.nombre as nombre_categoria, id_taller, t.nombre, aforamiento, dia, hora_inicio, hora_fin, activo, id_profesor, c.id_categoria as c_id_categoria, participantes, descripcion, t.id_categoria 
           FROM categoria c, taller t
        WHERE id_profesor =' . $id_profesor . '
        AND c.id_categoria = t.id_categoria
        ORDER BY t.nombre, dia , hora_inicio');
        return $q->result_array();
    }

    public function get_taller($id_taller) {
        $id_profesor = $this->session->userdata('id_profesor');
        $q = $this->db->query('SELECT c.nombre as nombre_categoria, id_taller, t.nombre, aforamiento, dia, hora_inicio, hora_fin, activo, id_profesor, c.id_categoria as c_id_categoria, participantes, descripcion, t.id_categoria 
           FROM categoria c, taller t
        WHERE id_profesor =' . $id_profesor . ' and id_taller = ' . $id_taller . '
        AND c.id_categoria = t.id_categoria
        ORDER BY t.nombre, dia , hora_inicio');
        if ($q->num_rows() == 1) {
            $result = $q->result_array();
        } else {
            $result = FALSE;
        }
        return $result;
    }

    public function deshabilitar_taller($id_taller) {
        $data = array(
            'activo' => FALSE
        );
        $this->db->where('id_profesor', $this->session->userdata('id_profesor'));
        $this->db->where('id_taller', $id_taller);
        $this->db->update('taller', $data);

        if ($this->db->affected_rows() > 0) {
            $response = "ok";
        } else {
            $response = "404";
        }
        return $response;
    }

    public function habilitar_taller($id_taller, $dia, $hora_inicio, $hora_fin) {
        $id_profesor = $this->session->userdata('id_profesor');
        $this->db->query('UPDATE taller as t
            SET activo = not exists((SELECT 1 FROM (SELECT * FROM taller) as o
                    WHERE o.id_profesor = ' . $id_profesor . ' and o.id_taller != ' . $id_taller . ' and o.dia = ' . $dia . '  and 
                    (( o.hora_inicio >= "' . $hora_fin . '" and o.hora_inicio <= "' . $hora_inicio . '") or (o.hora_fin <= "' . $hora_inicio . '" or o.hora_fin >= "' . $hora_fin . '"))))
            WHERE t.id_taller = ' . $id_taller);

        if ($this->db->affected_rows() > 0) {
            $response = "ok";
        } else {
            $response = "404";
        }
        return $response;
    }

    public function update_taller($id_taller, $limite, $nombre, $descripcion, $id_categoria) {
        $data = array(
            'id_categoria' => $id_categoria,
            'limite' => $limite,
            'nombre' => $nombre,
        );
        $this->db->where('id_categoria', $id_categoria);
        $this->db->update('categoria', $data);
        if ($this->db->affected_rows() > 0) {
            $response = "ok";
        } else {
            $response = "404";
        }
        return $response;
    }

    //Existen talleres de la categoria con id == id_categoria?
    function existe_taller_historial($id_categoria) {
        $id_categoria = (int) $id_categoria;
        $q = $this->db->query('SELECT id_categoria from taller where id_categoria = ' . $id_categoria);
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Sepuede eliminar una categoria si no tiene talleres relacinados.
    function eliminar_categoria($id_categoria) {
        if ($this->existe_taller_categoria($id_categoria) == FALSE) {
            $this->db->where('id_categoria', $id_categoria);
            return $this->db->delete('categoria');
            if ($this->db->affected_rows() > 1) {
                $response = "0k";
            } else {
                $response = "404";
            }
        } else {
            return "No se puede eliminar la categoria porque pertenece a una taller.";
        }
    }

    function insertar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $activo, $aforamiento) {

        $data = array(
            'id_profesor' => $id_profesor,
            'nombre' => $nombre,
            'id_categoria' => $id_categoria,
            'descripcion' => $descripcion,
            'dia' => $dia,
            'hora_inicio' => "00:" + $hora_inicio_hh + ":" + $hora_inicio_mm,
            'hora_inicio' => "00:" + $hora_fin_hh + ":" + $hora_fin_mm,
            'activo' => $activo,
            'aforamiento' => $aforamiento
        );
        $this->db->insert('taller', $data);
        return $this->db->affected_rows() > 0;
    }

}
