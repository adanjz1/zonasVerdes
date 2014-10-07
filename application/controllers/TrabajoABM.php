<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TrabajoABM extends CI_Controller {

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
            $data = $this->crud->getDataList('Trabajo',$this);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            $data['nombreJson'] = "Trabajo";
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('list', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function add($id=''){
            $this->load->library('crud');
            $data = $this->crud->getFormData('Trabajo',$this,$id);
            
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
                $this->crud_model->insert($_POST,'Trabajo');
                saveLog($this,'Trabajo nuevo. '.json_encode($_POST));
            }else{
                $this->load->model('crud_model');
                $this->crud_model->update($_POST,'Trabajo');
                saveLog($this,'Trabajo modificado. '.json_encode($_POST));
            }
            redirect('TrabajoABM/lista');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'Trabajo');
            saveLog($this,'Trabajo borrado. ID:'.json_encode($_POST));
            redirect('TrabajoABM/lista');
        }
}


