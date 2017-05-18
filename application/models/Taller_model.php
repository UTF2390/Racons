<?php

class Taller_model extends CI_Model {

    public function get_taller(){
      $query = $this->db->get('taller');
      return $query->result();
   }
   
    function setTaller($nombre,$aforamiento,$dia,$hora_inicio,$hora_fin) {
        $data = array(
                'nombre' => $nombre,
                'aforamiento' => $aforamiento,
                'dia' => $dia,
		'hora_inicio' => $hora_inicio,
		'hora_fin' => $hora_fin,
	);
        $this->db->insert('taller',$data);
    }
    
    function deleteProfesor($id){
        $this->db->where('id_taller',$id);
	return $this->db->delete('taller');
    }
    
    function updateAlumno($nombre,$aforamiento,$dia,$hora_inicio,$hora_fin){
        $data = array(
                'nombre' => $nombre,
                'aforamiento' => $aforamiento,
                'dia' => $dia,
		'hora_inicio' => $hora_inicio,
		'hora_fin' => $hora_fin,
	);
        $this->db->where('id_taller', $id);
        return $this->db->update('taller', $data);
    }

}
