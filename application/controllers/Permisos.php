<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Permisos
 *
 * @author MM
 */
class Permisos extends CI_Controller {
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
            $data = $this->crud->getDataList('Permisos',$this);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            $data['nombreJson'] = "Permisos";
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('list', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function add($id=''){
            $this->load->library('crud');
            $data = $this->crud->getFormData('Permisos',$this,$id);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('form', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function save(){
            if(empty($_POST['id'])){
                $this->load->model('crud_model');
                $this->crud_model->insert($_POST,'Permisos');
                saveLog($this,'Permiso nuevo. '.json_encode($_POST));
            }else{
                $this->load->model('crud_model');
                $this->crud_model->update($_POST,'Permisos');
                saveLog($this,'Permiso modificado. '.json_encode($_POST));
            }
            redirect('Permisos/lista');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'Permisos');
            saveLog($this,'Permiso borrado. '.$id);
            redirect('Permisos/lista');
        }
}
