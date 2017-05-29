<?php

class Persona_model extends CI_Model {

    public function modificar($password, $nick) {
        $id_profesor = $this->session->userdata('');
        $this->db->where('id_persona',$id_profesor);
        $this->db->update('persona');
    }

}
