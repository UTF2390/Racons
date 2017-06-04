<?php

class Categoria_model extends CI_Model {

    function filas(){
	$consulta = $this->db->get('categoria');
	return $consulta->num_rows() ;
    }
    
    function total_paginados($por_pagina,$star){
        if(!$star){
        $consulta = $this->db->query('SELECT * FROM `categoria` LIMIT '.$por_pagina);
        }else{
            $consulta = $this->db->query('SELECT * FROM `categoria` LIMIT '.$por_pagina. ' OFFSET '.$star);
        }
        if($consulta->num_rows()>0){
            foreach($consulta->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    //terminado sin comprobar
    public function categorias() {
        $q = $this->db->get('categoria');
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
    function existe_taller_categoria($id_categoria) {
        $id_categoria = (int) $id_categoria;
        $q = $this->db->query('SELECT id_categoria from taller where id_categoria = ' . $id_categoria);
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Sepuede eliminar una categoria si no tiene talleres relacinados.
    function delete_categoria($id_categoria) {
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

    function insertar_categoria($nombre, $limite) {
        $data = array(
            'nombre' => $nombre,
            'limite' => $limite
        );
        $this->db->insert('categoria', $data);
        return $this->db->affected_rows() > 0;
    }

}
