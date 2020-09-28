<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asunto extends MX_Controller {

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
            $this->load->model('Asunto_model', 'Model');
        }
    }

    public function index()
    {


    }
    public function getAsunto(){
        if($this->input->post('parametro')!= 0 && $this->input->post('falta')==1)
            $result = $this->Model->getFaltantes($this->input->post('parametro'));
        else if($this->input->post('todo')== 1)
            $result = $this->Model->getAll();
        else if ($this->input->post('parametro')!= 0)//Obtiene los asuntos que pertenecen al parametro
            $result = $this->Model->get($this->input->post('parametro'));
        else
            $result = $this->Model->getAllActivos();

        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function getAsuntoBusqueda(){//obtiene los asuntos con keyup
        $result = $this->Model->busquedaAsunto($this->input->post('asunto'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function save(){
        $data = json_decode($this->input->post('data'), TRUE);
        $idAsunto = $data['ASU_CODIGO'];
        unset($data['ASU_CODIGO']);
        if($idAsunto == 0)//si es nuevo
            $result = $this->Model->add($data);
        else//si es para actualizar
            $result = $this->Model->update($idAsunto, $data);

        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");

        echo json_encode($r);
    }
    public function getFaltantes(){
        $result = $this->Model->getFaltantesLike($this->input->post('parametro'),$this->input->post('asunto'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }

    public function getAsignados(){
        $result = $this->Model->getAsignadosLike($this->input->post('parametro'),$this->input->post('asunto'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }
}