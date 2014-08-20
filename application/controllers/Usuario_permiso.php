<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_permiso
 *
 * @author MM
 */
class Usuario_permiso extends CI_Controller {
        public function index()
	{
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function lista(){
            $this->load->library('crud');
            $data = $this->crud->getDataListJoin('usuario_permiso',$this);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            $data['usuarios'] = "";
            
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('ListUsuarioPermisos', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function add($id=''){
            $this->load->library('crud');
            $data = $this->crud->getFormDataUS('usuario_permiso',$this,$id);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('formUsuarioPermiso', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function save(){
            if(empty($_POST['id'])){
                $this->load->model('crud_model');
                $this->crud_model->insert($_POST,'usuario_permiso');
            }else{
                $this->load->model('crud_model');
                $this->crud_model->update($_POST,'usuario_permiso');
            }
            redirect('usuario_permiso/lista');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'usuario_permiso');
            redirect('usuario_permiso/lista');
        }
}