<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calles extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
            $data = $this->crud->getDataList('Calles',$this);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            $data['nombreJson'] = "Calles";
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('list', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function add($id=''){
            $this->load->library('crud');
            $data = $this->crud->getFormData('Calles',$this,$id);
            
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
                $this->crud_model->insert($_POST,'Calles');
                saveLog($this,'Categoria nueva. '.json_encode($_POST));
            }else{
                $this->load->model('crud_model');
                $this->crud_model->update($_POST,'Calles');
                saveLog($this,'Categoria modificada. '.json_encode($_POST));
            }
            redirect('Calles/lista');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'Calles');
            saveLog($this,'Categoria borrada. ID: '.$id);
            redirect('Calles/lista');
        }
}


