<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Formularioexterno extends MX_Controller {

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
            $this->load->model('FormularioExterno_model', 'Model');
        }
    }

    public function index()
    {
    }
    public function getFormularioExterno(){//trae informacion del formulario externo
        $result = $this->Model->get_formulario_ext($this->input->post('asunto'));

        if(!empty($result))
        {
            $r = array("data"    => $result,
                "success" => "true");
        }
        else
        {
            $r = array("failure" => "true");
        }
        echo json_encode($r);
    }
}