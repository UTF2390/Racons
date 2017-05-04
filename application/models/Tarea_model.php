<?php

class Tarea_model extends CI_Model {

    private $idTarea;
    private $nombre;
    private $categoria;
    private $numero_maximo;
    private $libre_de_limites;
    private $descripcion;

    function getIdTarea() {
        return $this->idTarea;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getNumero_maximo() {
        return $this->numero_maximo;
    }

    function getLibre_de_limites() {
        return $this->libre_de_limites;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdTarea($idTarea) {
        $this->idTarea = $idTarea;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setNumero_maximo($numero_maximo) {
        $this->numero_maximo = $numero_maximo;
    }

    function setLibre_de_limites($libre_de_limites) {
        $this->libre_de_limites = $libre_de_limites;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

}
