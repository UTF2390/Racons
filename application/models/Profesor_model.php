<?php

class Profesor_model extends CI_Model {

    private $id_profesor;

    function getId_profesor() {
        return $this->id_profesor;
    }

    function setId_profesor($id_profesor) {
        $this->id_profesor = $id_profesor;
    }

}
