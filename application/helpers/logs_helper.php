<?php
    function saveLog($th,$message){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $data = array(
            'mensaje'=>$message,
            'ip'=>$ip,
            'usuario'=>$_SESSION['usuario']->id
        );
        $th->load->model('log');
        $th->log->save($data);
    }
