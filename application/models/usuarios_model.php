<?php

class Usuarios_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
        public function login($user,$pass){
            $this->db->from('Usuarios');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();
            //var_dump($this->db->last_query());
            return $query->row();   
        }
        public function getPermissions($id){
            $this->db->from('usuario_permiso');
            $this->db->where('idUsuario',$id);
            $this->db->join('permisos','permisos.idPermiso = usuario_permiso.idPermiso');
            $query = $this->db->get();
            return $query->result();   
        }
        function insert($data){
            $this->db->insert('Usuarios',$data);
            return $this->db->insert_id();
        }
}