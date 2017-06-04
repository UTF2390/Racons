<?php

class Taller_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('taller');
        return $consulta->num_rows();
    }

    function numero_filas_taller_alumno() {
        $consulta = $this->db->query('SELECT count(*) as count '
                . 'FROM taller as t, curso_taller as c'
                . ' where t.id_taller = c.id_taller '
                . ' and c.id_curso = ' . $this->session->userdata('id_curso')
                . ' and t.activo = 1'
                . ' ORDER BY t.nombre;');
        $data = $consulta->result_array();
        return $data[0]['count'];
    }

    function numero_filas_taller_profesor() {
        $consulta = $this->db->query('SELECT count(*) as count '
                . 'FROM taller as t'
                . ' where'
                . ' t.id_profesor = ' . $this->session->userdata('id_profesor'));
        $data = $consulta->result_array();
        return $data[0]['count'];
    }
    function numero_filas_taller_historial_alumno($id_alumno) {
        $consulta = $this->db->query('SELECT count(*) as count '
                . 'FROM alumno_taller as al'
                . ' where al.id_alumno = ' . $id_alumno);
        $data = $consulta->result_array();
        return $data[0]['count'];
    }

    function total_paginados_profesor($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT distinct * ,(select count(*) '
                    . ' from alumno_taller as al '
                    . ' where al.id_taller = t.id_taller '
                    . ' and al.fecha > curdate()) as participantes'
                    . ' FROM taller as t '
                    . ' where t.id_profesor = ' . $this->session->userdata('id_profesor')
                    . ' ORDER BY t.nombre'
                    . ' LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT distinct * ,(select count(*) '
                    . ' from alumno_taller as al '
                    . ' where al.id_taller = t.id_taller '
                    . ' and al.fecha > curdate()) as participantes'
                    . ' FROM taller as t'
                    . ' where t.id_profesor = ' . $this->session->userdata('id_profesor')
                    . ' ORDER BY t.nombre'
                    . ' LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            $data = $consulta->result_array();
            return $data;
        } else {
            return [[]];
        }
    }

    function total_paginados_historial($por_pagina, $star, $id_alumno) {
        if (!$star) {
            $consulta = $this->db->query('SELECT distinct * ,c.nombre as nombre_categoria, t.nombre as nombre_taller '
                    . ' FROM taller as t, alumno_taller as al, categoria as c'
                    . ' where t.id_categoria = c.id_categoria'
                    . ' and t.id_taller = al.id_taller'
                    . ' and id_alumno =  ' . $id_alumno
                    . ' ORDER BY al.fecha desc'
                    . ' LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT distinct * ,c.nombre as nombre_categoria, t.nombre as nombre_taller '
                    . ' FROM taller as t, alumno_taller as al, categoria as c'
                    . ' where t.id_categoria = c.id_categoria'
                    . ' and t.id_taller = al.id_taller'
                    . ' and id_alumno =  ' . $id_alumno
                    . ' ORDER BY al.fecha desc '
                    . ' LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            $data = $consulta->result_array();
            return $data;
        } else {
            return [];
        }
    }
    
    function total_paginados_alumno($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT distinct *, (select count(*) from alumno_taller as at
                                where t.id_taller = at.id_taller
                                and at.fecha > curdate() 
                                and at.id_alumno = ' . $this->session->userdata('id_alumno')
                    . ') as apuntado ,(select count(*) from alumno_taller as at
                                where t.id_taller = at.id_taller
                                and at.fecha > curdate()) as participantes '
                    . ' FROM taller as t, curso_taller as c'
                    . ' where t.id_taller = c.id_taller '
                    . ' and c.id_curso = ' . $this->session->userdata('id_curso')
                    . ' and t.activo = 1'
                    . ' ORDER BY t.nombre'
                    . ' LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT distinct *, (select count(*) from alumno_taller as at
                                where t.id_taller = at.id_taller
                                and at.fecha > curdate()
                                and at.id_alumno = ' . $this->session->userdata('id_alumno')
                    . ' ) as apuntado, (select count(*) from alumno_taller as at
                                where t.id_taller = at.id_taller
                                and at.fecha > curdate()) as participantes '
                    . ' FROM taller as t, curso_taller as c'
                    . ' where t.id_taller = c.id_taller'
                    . ' and c.id_curso = ' . $this->session->userdata('id_curso')
                    . ' and t.activo = 1'
                    . ' ORDER BY apuntado desc, t.nombre'
                    . ' LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result_array() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }

    public function getNumTaller() {
        $q = $this->db->get('taller');
        return $q->num_rows();
    }

    public function taller_profesor($id_profesor) {
        $q = $this->db->query('SELECT c.nombre as nombre_categoria, id_taller, t.nombre, aforamiento, dia, hora_inicio, hora_fin, activo, id_profesor, c.id_categoria as c_id_categoria, participantes, descripcion, t.id_categoria 
           FROM categoria c, taller t
        WHERE id_profesor =' . $id_profesor . '
        AND c.id_categoria = t.id_categoria
        ORDER BY t.nombre, dia , hora_inicio , id_taller');
        return $q->result_array();
    }

    public function modificar_taller($id_profesor, $nombre, $id_categoria, $descripcion, $id_cursos, $dia, $hora_inicio_hh, $hora_inicio_mm, $hora_fin_hh, $hora_fin_mm, $aforamiento) {
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

    public function habilitar_taller($id_taller, $id_profesor) {
        $q = $this->db->query('select habilitar_taller(' . $id_taller . ',' . $id_profesor . ') as habilitado');
        $data = $q->result_array();
        if ($data[0]['habilitado'] > 0) {
            $response = "ok";
        } else {
            $response = "Este taller se solapa con otro activo.";
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
            $this->db->query('delete from alumno_taller where id_taller = ' . $id_taller
                    . ' and fecha >curdate();');

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
            'hora_fin' => "00:" + $hora_fin_hh + ":" + $hora_fin_mm,
            'aforamiento' => $aforamiento
        );
        $this->db->insert('taller', $data);
        return $this->db->affected_rows() > 0;
    }

    public function taller_alumno_horario($id_alumno) {
        for ($i = 1; $i < 6; $i++) {
            $q = $this->db->query('select * from taller as t, alumno_taller as al 
         where al.fecha>curdate() and al.id_taller = t.id_taller 
         and al.id_alumno = ' . $id_alumno . ' 
         and  t.dia = ' . $i . ' 
         order by t.hora_inicio, t.nombre');
            $horario[$i] = $q->result_array();
        }
        return $horario;
    }

    public function taller_alumno($id_alumno) {

        $this->db->query('set @id_alumno = ' . $id_alumno . ';');
        $this->db->query('set @id_curso = (select id_curso from alumno where id_alumno = @id_alumno);');

        $q = $this->db->query('SELECT *, (select count(*) from alumno_taller as at
                                where t.id_taller = at.id_taller
                                and at.fecha > curdate() ) as apuntado
                                FROM taller as t, curso_taller as c
                                WHERE activo = 1
                                    and c.id_taller = t.id_taller
                                    and c.id_curso = @id_curso
                                ORDER BY t.hora_inicio, t . nombre;');
        $talleres = $q->result_array();
        return $talleres;
    }

    public function apuntar($id_taller, $id_alumno) {
        $q = $this->db->query('SELECT apuntar(' . $id_taller . ', ' . $id_alumno . ' ) as respuesta');
        $result = $q->result_array();
        return $result;
    }

    public function desapuntar($id_taller, $id_alumno) {
        $q = $this->db->query('DELETE FROM `racons`.`alumno_taller` WHERE `id_taller` = ' . $id_taller . ' and `id_alumno` = ' . $id_alumno . ' and `fecha` > curdate();');
        return TRUE;
    }

}
