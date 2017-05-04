<?php

class Usuario_model extends CI_Model {

        public $idUsuario;
        public $nombre;
        public $apellido1;
        public $apellido2;
        public $bd;    // <<==controlador de la base de datos !!!!Falta iniciar!!!!!

        public function login($password,$nick)
        {
            //not jet implemented
            //tengo que saber si soy profesor o alumno
            //una consulta sql tiene que recoger la info y meterla en sesion
        }

        public function Logout()
        {
            //not jet implemented
            //eliminar el objeto usuario de sesion

        }

        public function update_entry()
        {
        }
//            $this->title    = $_POST['title'];
//            $this->content  = $_POST['content'];
//            $this->date     = time();
//
//            $this->db->update('entries', $this, array('id' => $_POST['id']));

//                $this->title    = $_POST['title']; // please read the below note
//                $this->content  = $_POST['content'];
//                $this->date     = time();
//
//                $this->db->insert('entries', $this);
}