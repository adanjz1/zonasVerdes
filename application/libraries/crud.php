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
            $select =$json->from.'.id,';
            $join= array();
            foreach($json->fields as $f){
                if($json->from != $f->tableName){
                    $join[0] = $f->tableName;
                    $join[1] = $f->join;
                }
                if($f->showList){
                    $select .= $sep.$f->tableName.'.'.$f->fieldName;
                    $sep = ',';
                    $d['rows'][] = $f->fieldName;
                }
            }
            $t->load->model('crud_model');
            $d['table'] = $t->crud_model->select($select, $json->from,$json->where, '',$join);
            return $d;
        }
        public function getFormData($file,$t,$id){
            $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$file.'.json');
            $json = json_decode($json);
            $d = array();
            $d['title'] = $json->titleA;
            $d['module'] = $file;
            $d['info'] = '';
            $t->load->model('crud_model');
            if(!empty($id)){
                $d['title'] = $json->titleM;
                $where  = 'id = '.$id;
                
                $info = $t->crud_model->select('', $file,$where, '');
                $d['info'] = (array)$info[0];
            }
            $json->fields = (array)$json->fields;
            foreach($json->fields as $key=>$field){
                if($field->formInput == 'select'){
                    $json->fields[$key]->selectData = $t->crud_model->select('id,'.$field->formOption.' as value', $field->tableName,$field->where, $field->formOption,array());
                }
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
                $where  = "IdUsuario = (select ".$file.".IdUsuario from ".$file." where ".$file.".id=".$id.")";
                $t->load->model('crud_model');
                $select= $file.'.idPermiso,'.$file.'.IdUsuario' ;
                $info = $t->crud_model->select($select, $file,$where, '');
                $d['info'] = (array)$info;
            }

           // $usucp= $t->crud_model->selectDis("usuario_permiso.idUsuario",$file);
           // $d['usuariocp']=(array)$usucp;
            
            $t->load->model('crud_model');
            $d['permisos']= $t->crud_model->select("id,nombre","permisos","", '');
            $d['usuarios']= $t->crud_model->select("id,username","usuarios","", '');
            $d['form'] = (array)$json->fields;
            return $d;
        }
}