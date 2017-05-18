<?php

class Profesor_model extends CI_Model {

    public function get_profesores(){
      $query = $this->db->get('profesor');
      return $query->result();
   }
   
    function setProfesor($usuario,$pass,$nombre,$apellido1,$apellido2,$administrador) {
        $data = array(
                'nick' => $usuario,
                'pass' => $pass,
                'nombre' => $nombre,
		'apellido1' => $apellido1,
		'apellido2' => $apellido2,
		'adminitrador' => $administrador,
	);
        $this->db->insert('profesor',$data);
    }
    
    function deleteProfesor($id){
        $this->db->where('id_profesor',$id);
	return $this->db->delete('profesor');
    }
    
    function updateAlumno($id,$usuario,$pass,$nombre,$apellido1,$apellido2,$administrador){
        $data = array(
                'nick' => $usuario,
                'pass' => $pass,
                'nombre' => $nombre,
		'apellido1' => $apellido1,
		'apellido2' => $apellido2,
		'administrador' => $administrador,
	);
        $this->db->where('id_profesor', $id);
        return $this->db->update('profesor', $data);
    }

}
