<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends MX_Controller {

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
            $this->load->model('Consulta_model', 'Model');
        }
    }

    public function index()
    {
    }
    public function consultas(){
        $usuario = $this->session->session_usuario_apps;
        if ($this->input->post('busqueda')==1)//Consulta de los tramites del usuario
            $result = $this->Model->getConsulta($usuario,$this->input->post('anulado'), $this->input->post('beneficiario'), $this->input->post('parametro'), $this->input->post('undgasto'),$this->input->post('proyecto'), $this->input->post('asunto'), $this->input->post('descripcion'), $this->input->post('noficio'),$this->input->post('codtramite'), $this->input->post('desde'),$this->input->post('hasta'));
        else if ($this->input->post('busqueda') ==2)//Obtiene todos los tramites que existen en la tabla
            $result = $this->Model->getAllTramites();
        else if ($this->input->post('busqueda') ==3)//Busqueda de todos los tramites en la tabla
            $result = $this->Model->getAllBusqueda($this->input->post('unidadsolicitante'),$this->input->post('anulado'), $this->input->post('beneficiario'), $this->input->post('parametro'), $this->input->post('undgasto'),$this->input->post('proyecto'), $this->input->post('asunto'), $this->input->post('descripcion'), $this->input->post('noficio'),$this->input->post('codtramite'), $this->input->post('desde'),$this->input->post('hasta') );
        else if ($this->input->post('busqueda') ==4)
            $result = $this->Model->getAllBusquedaLike($this->input->post('codtramite'));
        else if ($this->input->post('busqueda') ==5)
            $result = $this->Model->getConsultaLike($this->input->post('codtramite'));
        else//busqueda de todos los tramites del usuario
            $result = $this->Model->getTramitesUsuario($usuario,$this->input->post('parametro'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
}