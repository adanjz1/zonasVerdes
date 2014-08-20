<?php

class Crud {
        
        
        public function getDataList($file,$t){
            $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$file.'.json');
            $json = json_decode($json);
            $d = array();
            $d['title'] = $json->title;
            $d['module'] = $file;
            $sep = '';
            $d['rows'] = array();
            $select ='id,';
            foreach($json->fields as $f){
                if($f->showList){
                    $select .= $sep.$f->tableName.'.'.$f->fieldName;
                    $sep = ',';
                    $d['rows'][] = $f->fieldName;
                }
            }
            $t->load->model('crud_model');
            $d['table'] = $t->crud_model->select($select, $json->from,$json->where, '');
            return $d;
        }
        public function getFormData($file,$t,$id){
            $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$file.'.json');
            $json = json_decode($json);
            $d = array();
            $d['title'] = $json->titleA;
            $d['module'] = $file;
            $d['info'] = '';
            if(!empty($id)){
                
                $d['title'] = $json->titleM;
                $where  = 'id = '.$id;
                $t->load->model('crud_model');
                $info = $t->crud_model->select('', $file,$where, '');
                $d['info'] = (array)$info[0];
            }
            $d['form'] = (array)$json->fields;
            return $d;
        }
        public function getDataListJoin($file,$t){
            $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$file.'.json');
            $json = json_decode($json);
            $d = array();
            $d['title'] = $json->title;
            $d['module'] = $file;
            $sep = '';
            $d['rows'] = array();
            $select = $file.'.id , ';
            foreach($json->fields as $f){
                if($f->showList){
                    $select .= $sep.$f->tableName.'.'.$f->fieldName;
                    $sep = ',';
                    $d['rows'][] = $f->fieldName;
                }
            }
            $t->load->model('crud_model');
            $d['table'] = $t->crud_model->select($select, $json->from,$json->where,$file.'.idUsuario');
            return $d;
        }
        // =========Codigo de Usuario Permiso======
        public function getFormDataUS($file,$t,$id){
            $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$file.'.json');
            $json = json_decode($json);
            $d = array();
            $d['title'] = $json->titleA;
            $d['module'] = $file;
            $d['info'] = '';
            if(!empty($id)){
                $d['title'] = $json->titleM;
                $f=$json->fields;
                $where  = $file.'.id = '.$id. " AND usuarios.id = usuario_permiso.idUsuario";
                $t->load->model('crud_model');
                $select= $file.'.id,'.$file.'.idUsuario,'.$file.'.idPermiso,'." , usuarios.username";
                $info = $t->crud_model->select($select, $file.", usuarios",$where, '');
                $d['info'] = (array)$info[0];
            }
            $t->load->model('crud_model');
            $d['permisos']= $t->crud_model->select("id,nombre","permisos","", '');
            $d['usuarios']= $t->crud_model->select("id,username","usuarios","", '');
            $d['form'] = (array)$json->fields;
            return $d;
        }
}