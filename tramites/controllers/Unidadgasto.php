<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Unidadgasto extends MX_Controller {

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
            $this->load->model('UnidadGasto_model', 'Model');
        }
    }

    public function index()
    {
    }

    /*public function getUnidadBusqueda(){
        $result = $this->Model->getUnidadBusqueda($this->input->post('txtunidad'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }*/
    public function save(){
        $data = json_decode($this->input->post('data'), TRUE);
        $idUnidad = $data['GST_ID'];
        unset($data['GST_ID']);
        if($idUnidad == 0)//si es nuevo
            $result = $this->Model->add($data);
        else//si es para actualizar
            $result = $this->Model->update($idUnidad, $data);

        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");

        echo json_encode($r);
    }
    public function read()
    {
        if($this->input->post('busqueda')==1)
            $result = $this->Model->getBusquedaUnidadGasto($this->input->post('textounidad'));//unidades de gasto por busqueda
        else if($this->input->post('busqueda')==2)
            $result = $this->Model->getUnidadGastoActiva(/*$this->input->post('textounidad')*/);//unidades de gasto activas
        else
            $result = $this->Model->getUnidadGasto(/*$this->input->post('textounidad')*/);//todas las unidades de gasto

        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }

    public function verificarUnidadGasto()//verifica existencia de la unidad de gasto
    {
        $result = $this->Model->verificarUndGasto($this->input->post('undGasto'));
        if(!empty($result))
        {
            $r = array("success" => "true");
        }
        else
        {
            $r = array("failure" => "true");
        }
        echo json_encode($r);
    }
}