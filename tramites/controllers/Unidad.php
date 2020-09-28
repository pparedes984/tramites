<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Unidad extends MX_Controller {

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

            $this->load->model('Unidad_model', 'Model');
        }
    }

    public function index()
    {


    }

    public function save(){
        $data = json_decode($this->input->post('data'), TRUE);
        $idUnidad = $data['UND_CODIGO'];
        unset($data['UND_CODIGO']);
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
    public function getUnidad()
    {
        if ($this->input->post('usuario') != '' && $this->input->post('destino') != 1 && $this->input->post('destino') != 0 && $this->input->post('und') != 1 && $this->input->post('todo') != 1 && $this->input->post('ac') != 1)
            $result = $this->Model->getUnidad($this->input->post('usuario'));//saca las unidades solicitantes de un usuario
        else if ($this->input->post('und') == 1)//saca las unidades que le faltan a un usuario
            $result = $this->Model->getUsuarioUnidad($this->input->post('txtusuario'));
        else if ($this->input->post('busqueda') == 1)
            $result = $this->Model->getUnidadBusqueda($this->input->post('txtunidad'));
        else if ($this->input->post('falta') == 1)
            $result = $this->Model->getFaltantes($this->input->post('parametro'));
        else if ($this->input->post('paramund') == 1)
            $result = $this->Model->busquedaUnidad($this->input->post('textounidad'));
        else if ($this->input->post('destino') == 1)
            $result = $this->Model->getDestinos($this->input->post('idtramite'), $this->input->post('idparametro'));//saca todos los destinos los destinos
        else if ($this->input->post('ac') == 1)//obtiene todas las unidades que sean activas o no activas (Administración general)
            $result = $this->Model->getActivos();
        else if ($this->input->post('destino') == 0 && $this->input->post('ac') != 1)
            $result = $this->Model->getAll($this->input->post('unidireccion'));
        else if ($this->input->post('todo') == 1)//obtiene todas las unidades que sean solo activas (Administración básica)
            $result = $this->Model->getUnidadesParametro($this->input->post('parametro'));
        /*else if ($this->input->post('unidireccion') == 1 && $this->input->post('destino') == 2)//obtiene las unidades de direccion
            $result = $this->Model->getUnidadesDireccion();*/

        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }

    public function verificarUnidadGasto()//verifica la existencia de la unidad
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