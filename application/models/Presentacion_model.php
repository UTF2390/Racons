<?php

class Presentacion_model extends CI_Model {

        private $id_presentacion;
        private $nombre;
        private $dia;
        private $hora_inicio;
        private $hora_fin;
        
        function getId_presentacion() {
            return $this->id_presentacion;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getDia() {
            return $this->dia;
        }

        function getHora_inicio() {
            return $this->hora_inicio;
        }

        function getHora_fin() {
            return $this->hora_fin;
        }

        function getDescripcion() {
            return $this->descripcion;
        }

        function setId_presentacion($id_presentacion) {
            $this->id_presentacion = $id_presentacion;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setDia($dia) {
            $this->dia = $dia;
        }

        function setHora_inicio($hora_inicio) {
            $this->hora_inicio = $hora_inicio;
        }

        function setHora_fin($hora_fin) {
            $this->hora_fin = $hora_fin;
        }

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }       

}