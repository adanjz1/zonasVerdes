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
                $data['mensajeBienvenida'] = "Hola mariano, logueate";
		$this->load->library('parser');
                $this->parser->parse('login', $data);               
	}
        public function login(){
            $this->load->model('usuarios_model');
            $usuario = $this->usuarios_model->login($_POST['username'],$_POST['password']);
            if(empty($usuario)){
                $usuarioNew = array('username'=>$_POST['username'],'password'=>$_POST['password']);
                $this->usuarios_model->insert($usuarioNew); 
            }
            $data['datosUsuario']= $usuario;
            $this->load->library('parser');
            $this->parser->parse('login', $data);               
        }
}

