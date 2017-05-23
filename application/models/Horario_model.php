<?php

class Horario_model extends CI_Model {

    public function dias_semana() {
        for ($i = 1; $i < 8; $i++) {
            $q = $this->db->query("SELECT DATE_FORMAT((current_date() + INTERVAL " . $i . " DAY ), '%d') as dia_mes, DATE_FORMAT((current_date() + INTERVAL " . $i . " DAY ),'%a') as dia_semana;");
            $data = $q->result_array();
            $respuesta[$data[0]['dia_semana']] = [['dia_mes' => $data[0]['dia_mes'], 'distancia' => $i]];
        }
        return $respuesta;
    }

}
