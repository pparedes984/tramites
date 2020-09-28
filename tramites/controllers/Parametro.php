<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parametro extends MX_Controller {

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

            $this->load->model('Parametro_model', 'Model');
        }

    }

    public function index()
    {

       /* $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);*/
    }
    public function getParametros(){
        if($this->input->post('param') == 1)
            $result = $this->Model->getParametros($this->input->post('usuario'));//para saber los parametros que le faltan al usuario
        else if($this->input->post('param') == 2)
            $result = $this->Model->getAllParametros();//Obtiene todos los parametros activos
        else if($this->input->post('asu') == 1)//Obtiene los parametros que faltan para ser agregados.
            $result = $this->Model->getParamAsuntos($this->input->post('asunto'));
        else if($this->input->post('und') == 1)
            $result = $this->Model->getParamUnidades($this->input->post('unidad'));
        else if($this->input->post('todo') == 1)
            $result = $this->Model->getAll();
        else
            $result = $this->Model->get($this->input->post('usuario'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){
        $data = json_decode($this->input->post('data'), TRUE);
        $idParametro = $data['PRM_ID'];
        unset($data['PRM_ID']);
        if($idParametro == 0)//si es nuevo
            $result = $this->Model->add($data);
        else//si es para actualizar
            $result = $this->Model->update($idParametro, $data);

        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");

        echo json_encode($r);
    }
}