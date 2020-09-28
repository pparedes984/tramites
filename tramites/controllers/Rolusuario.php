<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rolusuario extends MX_Controller {

    public function __construct()
    {

        parent::__construct();

        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit();
        }
        else
        {

            $this->load->model('RolUsuario_model', 'Model');
        }

    }

    public function index()
    {


    }
    public function getRoles(){//trae los roles de un usuario
        $result = $this->Model->get($this->input->post('usuario'),$this->input->post('parametro'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){//asigna un rol al usuario
        $data =  json_decode($this->input->post('data'), TRUE);
        unset($data['id']);

        $data['USR_USUARIO'] = $this->input->post('usuario');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->add($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
    public function delete()//borra la asignacion de rol al usuario
    {
        $data = json_decode($this->input->post('data'), TRUE);
        unset($data['id']);
        $data['USR_USUARIO'] = $this->input->post('usuario');
        $data['ROL_ID'] = $this->input->post('rol');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->delete($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
}