<?php

class Persona_model extends CI_Model {

    public function getId($nick,$pass){
        $q=$this->db->query('SELECT id_persona FROM `persona` where nick="'.$nick.'" AND password="'.$pass.'"');
        if($q->num_rows()>0){
            return $q->row();
        }else{
            return false;
        }
    }
}