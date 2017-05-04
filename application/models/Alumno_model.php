<?php

class Alumno_model extends CI_Model {

    private $id_alumno;
    private $curso;

    function getId_alumno() {
        return $this->id_alumno;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCurso() {
        return $this->curso;
    }

    function setId_alumno($id_alumno) {
        $this->id_alumno = $id_alumno;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

}
