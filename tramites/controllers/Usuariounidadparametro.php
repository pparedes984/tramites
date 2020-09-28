<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariounidadparametro extends MX_Controller {

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

            $this->load->model('UsuarioUnidadParametro_model', 'Model');
        }

    }

    public function index()
    {
    }
    public function getUnidades()
    {
        $result = $this->Model->get($this->input->post('usuario'),$this->input->post('parametro'));//retorna las unidades de las que es jefe un usuario en un parametro
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){

        $data =  json_decode($this->input->post('data'), TRUE);
        unset($data['id']);
        unset($data['UND_NOMBRE']);
        unset($data['UND_CODIGO']);
        unset($data['UND_PRM']);
        unset($data['PRM_ID']);
        $data['USR_USUARIO'] = $this->input->post('usuario');
        $data['UND_PRM_ID'] = $this->input->post('ide');
        $data['UUP_JEFE'] = 1;
        $result = $this->Model->add($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
    public function delete()
    {
        $data = json_decode($this->input->post('data'), TRUE);
        unset($data['id']);
        unset($data['UND_CODIGO']);
        $data['USR_USUARIO'] = $this->input->post('usuario');
        $data['UND_PRM_ID'] = $this->input->post('unidad');
        $result = $this->Model->delete($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }

}