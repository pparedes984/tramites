<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asuntoparametro extends MX_Controller {

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

            $this->load->model('AsuntoParametro_model', 'Model');
        }

    }

    public function index()
    {
    }
    public function getParametros()
    {
        if($this->input->post('asunto')!= 0)
            $result = $this->Model->get($this->input->post('asunto'));
        else
            $result = $this->Model->getAll();
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){//asigna asunto a un parametro

        $data =  json_decode($this->input->post('data'), TRUE);
        $data['ASU_CODIGO'] = $this->input->post('asunto');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->add($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
    public function delete()//borra la asignacion del asunto al parametro
    {
        $data = json_decode($this->input->post('data'), TRUE);
        $data['ASU_CODIGO'] = $this->input->post('asunto');
        $data['PRM_ID'] = $this->input->post('parametro');
        $result = $this->Model->delete($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }

}