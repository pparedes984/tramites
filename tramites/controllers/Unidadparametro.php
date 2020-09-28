<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Unidadparametro extends MX_Controller {

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

            $this->load->model('UnidadParametro_model', 'Model');
        }

    }

    public function index()
    {
    }
    public function getParametros()
    {
        if($this->input->post('unidad')!= 0 && $this->input->post('dir')!=1)
            $result = $this->Model->get($this->input->post('unidad'));//devuelve el parametro de la unidad
        else if($this->input->post('dir')==1)
            $result = $this->Model->getDirecciones($this->input->post('usuario'),$this->input->post('parametro'));//devuelve las unidades de direccionamiento disponibles para el usuario para la asignacion de jefe
        else
            $result = $this->Model->getAll();//todos los parametros que tengan asignado unidades
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){//crea un nuevo parametro

        $data =  json_decode($this->input->post('data'), TRUE);
        $data['UND_CODIGO'] = $this->input->post('unidad');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->add($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
    public function delete()//borra el parametro
    {
        $data = json_decode($this->input->post('data'), TRUE);
        $data['UND_CODIGO'] = $this->input->post('unidad');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->delete($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
}