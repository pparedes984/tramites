<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rol extends MX_Controller {

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

            $this->load->model('Rol_model', 'Model');
        }

    }

    public function index()
    {


    }
    public function getRoles(){//trae los roles del usuario
        $result = $this->Model->getRoles($this->input->post('usuario'),$this->input->post('parametro'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
}