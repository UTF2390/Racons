<?php

class Curso_model extends CI_Model {

    //terminado sin comprobar
    
    
    //Retorna la lista de cursos.
    public function cursos() {
        $this->db->select('id_curso, nombre');
        $q = $this->db->get('curso');
        return $q->result();
    }

    //Existen talleres de la categoria con id == id_categoria?
    function existe_alumnos_talleres_curso($id_curso) {
        $this->db->select('id_categoria');
        $this->db->from('categoria as ct, taller as t, curso as c');
        $this->db->where('ct.id_categoria = c.id_categoria');
        $this->db->where('t.id_categoria = c.id_taller');
        $this->db->where('id_categoria', $id_categoria);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Sepuede eliminar un curso si no tiene tallers ni alumnos relacinados.
    function delete_curso($id_curso) {
        if ($this->existe_alumnos_talleres_curso($id_curso)) {
            $this->db->where('id_curso', $id_ruso);
            return $this->db->delete('curso');
        } else {
            return FALSE;
        }
    }
    //Inserta nuevo curso.
    function insertar_curso($nombre) {
        $data = array(
            'curso' => $nombre,
        );

        $this->db->insert('curso', $data);
        return $this->db->affected_rows() > 0;
    }

}
