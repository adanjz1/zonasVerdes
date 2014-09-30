<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
                $data['mensajeBienvenida'] = "Bienvenido";
		$this->load->library('parser');
                $this->parser->parse('widgets/header', $data);
                $this->parser->parse('login', $data);               
                $this->parser->parse('widgets/footer', $data);
	}
        public function login(){
            $this->load->model('usuarios_model');
            $usuario = $this->usuarios_model->login($_POST['username'],$_POST['password']);
            if(!empty($usuario)){
                $_SESSION['usuario'] = $usuario;
                redirect('/usuarios/menu');
            }
        }
        public function menu(){
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function lista(){
            $this->load->library('crud');
            $data = $this->crud->getDataList('usuarios',$this);
            
            $this->load->model('usuarios_model');
            $data['permisions'] = $this->usuarios_model->getPermissions($_SESSION['usuario']->id);
            
            $data['nombreJson'] = "usuarios";
            $this->load->library('parser');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            $this->parser->parse('list', $data);
            $this->parser->parse('widgets/footer', $data);
        }
        public function add($id=''){
            $this->load->library('crud');
            $data = $this->crud->getFormData('usuarios',$this,$id);
            
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
                $this->crud_model->insert($_POST,'usuarios');
                saveLog($this,'Nuevo usuario. '.json_encode($_POST));
            }else{
                $this->load->model('crud_model');
                $this->crud_model->update($_POST,'usuarios');
                saveLog($this,'Usuario modificado. '.json_encode($_POST));
            }
            redirect('usuarios/menu');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'usuarios');
            saveLog($this,'Usuario borrado. ID:'.$id);
            redirect('usuarios/menu');
        }
}

