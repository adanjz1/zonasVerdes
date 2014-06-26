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
            return $query->result();   
        }
        public function select($campo,$valor){
            $this->db->from('Usuarios');
            $this->db->where($campo,$valor);
            $query = $this->db->get();
            //var_dump($this->db->last_query());
            return $query->result();   
        }
        function insert($data){
            $this->db->insert('Usuarios',$data);
            return $this->db->insert_id();
        }
}