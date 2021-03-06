<?php

class Categoria_model extends CI_Model {

    function filas() {
        $consulta = $this->db->get('categoria');
        return $consulta->num_rows();
    }

    function total_paginados($por_pagina, $star) {
        if (!$star) {
            $consulta = $this->db->query('SELECT * FROM `categoria` LIMIT ' . $por_pagina);
        } else {
            $consulta = $this->db->query('SELECT * FROM `categoria` LIMIT ' . $por_pagina . ' OFFSET ' . $star);
        }
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
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

    public function categoria($id_categoria) {
        $q = $this->db->query('select * '
                . ' from categoria '
                . ' where id_categoria = ' . $id_categoria);
        $categoria = $q->result_array();
        return $categoria[0];
    }

    public function categoria_fila($id_categoria) {
        $categoria = $this->categoria($id_categoria);
        if ($categoria != false) {
            $result = '<tr id="id_categoria_' . $categoria['id_categoria'] . '">'
                    . ' <td>' . $categoria['id_categoria'] . '</td>'
                    . '<td>' . $categoria['nombre'] . '</td>'
                    . '<td>' . $categoria['limite'] . '</td>'
                    . '<td><a onclick="modificar_categoria_modal(' . $categoria['id_categoria'] . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>'
                    . '<td><a onclick="eliminar_categoria(this,' . $categoria['id_categoria'] . ')" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>'
                    . '</tr>';
        } else {
            $result = false;
        }
        return $result;
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
