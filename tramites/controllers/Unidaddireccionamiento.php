<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Unidaddireccionamiento extends MX_Controller {

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

            $this->load->model('UnidadDireccion_model', 'Model');
        }
    }

    public function index()
    {
        $result = array();
        //$result = $this->obtener_menu();

        echo json_encode($result);
    }
    public function obtener_menu()//devuelve las unidades para el direcionamiento
    {
        $result = array(
            'text' => '.',
            'children' => array()
        );
        if($this->input->post('parametro')!= 0)
            $unidadesDir = $this->Model->get_menu_unidades($this->session->session_usuario_apps, $this->input->post('parametro'));
        else
            $unidadesDir = $this->Model->get_unidades($this->session->session_usuario_apps);
        foreach ($unidadesDir as $unidad) {
            $unidades = array(
                'text' => $unidad['UND_NOMBRE'],
                'leaf' => true,
                'id' => $unidad['UND_CODIGO'],
                'iconCls' => 'fa-file-text-o'
            );
            array_push($result['children'], $unidades);
        }
        echo json_encode($result);
    }

    public function getUnidadesDir()//trae todas las unidades de direccionamiento sin importar el parametro
    {
        $result = $this->Model->getUnidadesParametro($this->input->post('parametro'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }

    public function save(){//actualiza una unidad y la hace de direccionamiento

        $data = json_decode($this->input->post('data'), TRUE);
        $idUndParm = $data['UND_PRM_ID'];
        $direccionamiento = $data['UND_DIRECCIONAMIENTO'];
        unset($data['UND_PRM_ID']);

        $result = $this->Model->update($idUndParm,$direccionamiento);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");

        echo json_encode($r);
    }
}