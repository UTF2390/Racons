<?php

class Taller_model extends CI_Model {

    public function taller_profesor($id_profesor) {
        $q = $this->db->query('SELECT c.nombre as nombre_categoria, id_taller, t.nombre, aforamiento, dia, hora_inicio, hora_fin, activo, id_profesor, c.id_categoria as c_id_categoria, participantes, descripcion, t.id_categoria 
           FROM categoria c, taller t
        WHERE id_profesor =' . $id_profesor . '
        AND c.id_categoria = t.id_categoria
        ORDER BY t.nombre, dia , hora_inicio , id_taller');
        return $q->result_array();
    }

    public function modificar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $aforamiento, $id_taller) {
        $data = array(
            'id_profesor' => $id_profesor,
            'nombre' => $nombre,
            'id_categoria' => $id_categoria,
            'descripcion' => $descripcion,
            'dia' => $dia,
            'hora_inicio' => "00:" . $hora_inicio_hh . ":" . $hora_inicio_mm,
            'hora_fin' => "00:" . $hora_fin_hh . ":" . $hora_fin_mm,
            'aforamiento' => $aforamiento
        );
        var_dump($hora_inicio_hh);
        var_dump($hora_inicio_mm);
        var_dump($hora_fin_hh);
        var_dump($hora_fin_mm);
        $this->db->where('id_taller', $id_taller);
        $this->db->update('taller', $data);
        $this->insertar_curso_taller($id_cursos, $id_taller);
        return $this->db->affected_rows() > 0;
    }

    public function insertar_curso_taller($id_cursos, $id_taller) {
        $this->db->delete('curso_taller', array('id_taller' => $id_taller));
        foreach ($id_cursos as $id_curso) {
            $this->db->insert('curso_taller', ['id_curso' => $id_curso, 'id_taller' => $id_taller]);
        }
        return $this->db->affected_rows() > 0;
    }

    public function taller_profesor_horario($id_profesor) {
        for ($i = 1; $i < 6; $i++) {
            $q = $this->db->query('SELECT *
            FROM  taller 
            WHERE id_profesor =' . $id_profesor . '
            AND dia = ' . $i . ' AND activo = 1
            ORDER BY hora_inicio, nombre');
            $horario[$i] = $q->result_array();
        }
        return $horario;
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

    public function habilitar_taller($id_taller, $dia, $hora_inicio, $hora_fin) {
        $id_profesor = $this->session->userdata('id_profesor');
        $this->db->query('
            UPDATE taller as t 
            SET activo = (SELECT IF (0 = (SELECT COUNT(*) FROM (SELECT * FROM taller) as o,
    (SELECT * FROM taller where id_taller = ' . $id_taller . ') as b
WHERE o.id_profesor = ' . $id_profesor . ' and o.id_taller != ' . $id_taller . ' and o.dia = b.dia  and o.activo = 1 and
                    (( o.hora_inicio > b.hora_fin and o.hora_inicio < b.hora_inicio) or 
                    (o.hora_fin < b.hora_inicio and o.hora_fin > b.hora_fin) or
                    (b.hora_inicio < o.ap_hora_inicio and b.hora_fin > o.ap_hora_fin)))
                        ,true
                        ,false))
                WHERE t.id_taller = ' . $id_taller);

        if ($this->db->affected_rows() > 0) {
            $response = "ok";
        } else {
            $response = "404";
        }
        return $response;
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

    function insertar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $aforamiento) {

        $data = array(
            'id_profesor' => $id_profesor,
            'nombre' => $nombre,
            'id_categoria' => $id_categoria,
            'descripcion' => $descripcion,
            'dia' => $dia,
            'hora_inicio' => "00:" + $hora_inicio_hh + ":" + $hora_inicio_mm,
            'hora_inicio' => "00:" + $hora_fin_hh + ":" + $hora_fin_mm,
            'aforamiento' => $aforamiento
        );
        $this->db->insert('taller', $data);
        $id_taller = $this->db->insert_id();

        $this->insertar_curso_taller($id_cursos, $id_taller);
        return $this->db->affected_rows() > 0;
    }

}
