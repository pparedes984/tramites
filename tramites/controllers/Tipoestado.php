<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipoestado extends MX_Controller
{

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

            $this->load->model('TipoEstado_model', 'Model');
        }
    }

    public function index()//trae los tipos de estado
    {

        $result = $this->Model->get($this->input->post('id'));
        $r = array("data"    => $result,
            "success" => "true");

        echo json_encode($r);
    }

    public function save()
    {
        $data = json_decode($this->input->post('data'), TRUE);
        $idEstado = $data['EST_CODIGO'];
        unset($data['EST_CODIGO']);
        if($idEstado == 0)//guarda un estado
        {
            $data['TRA_CODIGO']= $this->input->post('idtramite');
            $data['TRA_PRM_ID']= $this->input->post('idparametro');
            date_default_timezone_set('America/Bogota');
            $data['EST_FECHARECIBIDO']= date("Y-m-d");
            $data['EST_FECHAINICIO'] = $this->input->post('fechaInicio');
            $result = $this->Model->add($data);

        }
        else//actualiza un estado
        {
            $result = $this->Model->update($idEstado, $data);
        }

        if($result)
        {
            $r = array("success" => "true");
            //"newId"   => $result);
        }
        else
        {
            $r = array("failure" => "true");
        }

        echo json_encode($r);

    }

    public function delete()//borra un estado
    {
        $data = $this->input->post('data');
        $id = $data['EST_CODIGO'];
        unset($data['EST_CODIGO']);
        $result = $this->Model->delete($id);
        if($result <> 'TRUE')
            echo json_encode(array("failure" => TRUE));
        else
            echo json_encode(array("success" => TRUE));

    }

    public function getTipoEstados(){//trae los tipos de estado
        $result = $this->Model->get();
        if($result <> 'FALSE')
        {
            //$r = array("success" => "true");
            $r = array("data"    => $result,
                "success" => "true");
        }
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
}