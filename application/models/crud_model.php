<?php
class Crud_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
        public function select($select,$from,$where,$orderby,$join=array()){
            if(!empty($select))
                $this->db->select($select);
            //$this->db->from($from);
            if(!empty($where))
                $this->db->where($where);
            //$this->db->join($join);
            if(!empty($orderby))
                $this->db->order_by($orderby,"desc");
            if(!empty($join))
                $this->db->join($join[0],$join[1]);
            $query = $this->db->get($from);
            return $query->result();   
        }
        public function selectDis($select,$from){
            if(!empty($select)){
                $this->db->distinct();
                $this->db->select($select);
            }
            $query= $this->db->get($from);
            return $query->result();
        }
        function insert($data,$table){
            $this->db->insert($table,$data);
            return $this->db->insert_id();
        }
        function update($data,$table){
            $this->db->where('id',$data['id']);
            $this->db->update($table,$data);
        }
        function delete($id,$table){
            $this->db->where('id',$id);
            $this->db->delete($table);
        }
}