<?php

class Taller_model extends CI_Model {

    public function taller_profesor_activos($id_profesor) {

        $this->db->where(['id_profesor', $id_profesor]);
        $this->db->where(['activo', TRUE]);
        $this->db->order_by('dia', 'hora_inicio');
        $q = $this->db->get('taller');
        return $q->result_array();
    }

    public function taller_profesor_desactivados($id_profesor) {

        $this->db->where(['id_profesor', $id_profesor]);
        $this->db->where(['activo', FALSE]);
        $this->db->order_by('dia', 'hora_inicio');
        $q = $this->db->get('taller');
        return $q->result_array();
    }

    public function taller_profesor($id_profesor) {

        $q = $this->db->query('SELECT c.nombre as nombre_categoria, id_taller, t.nombre, aforamiento, dia, hora_inicio, hora_fin, activo, id_profesor, c.id_categoria as c_id_categoria, participantes, descripcion, t.id_categoria 
           FROM categoria c, taller t
        WHERE id_profesor =' . $id_profesor . '
        AND c.id_categoria = t.id_categoria
        ORDER BY t.nombre, dia , hora_inicio');
        return $q->result_array();
    }

    public function update_categoria($id_categoria, $limite, $nombre) {
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
