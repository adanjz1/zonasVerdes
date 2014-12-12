<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trabajo extends CI_Controller {

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
            $this->load->helper('form');
            $this->parser->parse('widgets/header', $data);
            $this->parser->parse('widgets/menu', $data);
            //$this->parser->parse('widgets/fileuploader', $data);
            $this->parser->parse('listAlta', $data);
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
            redirect('Trabajo/lista');
        }
        public function delete($id){
            $this->load->model('crud_model');
            $this->crud_model->delete($id,'Trabajo');
            saveLog($this,'Trabajo borrado. ID:'.json_encode($_POST));
            redirect('Trabajo/lista');
        }
        public function altaTrabajos(){
            	$this->load->helper('form');
        	//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = 'application/uploads/';
                // set the filter image types
		$config['allowed_types'] = 'xls';
//		$config['file_name'] = 'paapas.csv';
		//$config['file_ext'] = 'csv';
		//load the upload library
		$this->load->library('upload', $config);
                
//                $this->upload->set_filename();
                $this->upload->initialize($config);
                
                $this->upload->set_allowed_types('*');
                

		$data['upload_data'] = '';
    
		//if not successful, set the error message
		if (!$this->upload->do_upload('userfile')) {
			$data = array('msg' => $this->upload->display_errors());
                        die($data);
		} else { //else, set the success message
                        $data = $this->upload->data();
                        $d = (file_get_contents($data['full_path']));
                        $filas = (explode("\n",$d));
                        foreach($filas as $f){
                            $casillas = explode("\t",$f);
                            var_dump($casillas);
                            var_dump('--------------------------------');
                            echo '<br>';
                            if(!empty($casillas[0]) && !empty($casillas[26])){
                                $arrayDatos = array(
                                    'Observacion'=>$casillas[10],
                                    'comuna'=> getComunafromValue(str_replace("C","",$casillas[22])),
                                    'Calle'=>getCalleFrom($casillas[1]),
                                    'Altura'=>getAlturaFrom($casillas[1]),
                                    'ResolucionLegal'=> '',//ver cual es
                                    'Especie'=>'',//cual es?
                                );
                            }
                        }
                }
                        
                        //$var = array('filename'=>$data['full_path'],'user'=>$_SESSION['user'],'platform'=>$_POST['platform'],'appname'=>$_POST['appname']);
                        //$lastId = $this->report->saveReport($var);
        }
}


