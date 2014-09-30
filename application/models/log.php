<?php
class Log extends CI_Model {
    public function __construct() {
		parent::__construct();
	}
        public function save($data){
            $this->db->insert('log',$data);
        }
}
