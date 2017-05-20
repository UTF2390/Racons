<?php

class Categoria_model extends CI_Model {

    //terminado sin comprobar
    public function categorias() {
        $q = $this->db->get('categoria');
        return $q->result_array();
    }

    public function update_categoria($id_categoria, $limite_categoria, $nombre) {
        $data = array(
            'id_categoria' => $id_categoria,
            'limite_categoria' => $limite_categoria,
            'nombre' => $nombre,
        );
        $this->db->were('id_categoria', $id_categoria);
        $this->db->update('categoria', $data);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Existen talleres de la categoria con id == id_categoria?
    function existe_taller_categoria($id_categoria) {
        $this->db->select('id_categoria');
        $this->db->where('id_categoria', $id_categoria);
        $q = $this->db->get('taller');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Sepuede eliminar una categoria si no tiene tallers relacinados.
    function delete_categoria($id_categoria) {
        if ($this->existe_taller_categoria($id_categoria)) {
            $this->db->where('id_categoria', $id_categoria);
            return $this->db->delete('categoria');
        } else {
            return FALSE;
        }
    }

    function insertar_categoria($nombre, $limite) {
        $data = array(
            'nombre' => $nombre,
            'limite' => $limite
        );

        $this->db->insert('categoria', $data);
        return $this->db->affected_rows() > 0;
    }

}
