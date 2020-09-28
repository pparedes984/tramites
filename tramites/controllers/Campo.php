<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Campo extends MX_Controller {

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
            $this->load->model('Campo_model', 'Model');
        }
    }

    public function index()
    {
    }
    public function getCampos(){//trae los campos del nuevo tramite
        $result = $this->Model->get_campos($this->input->post('asunto'));

        if(!empty($result))
        {
            $r = array("data"    => $result,
                "success" => "true");
        }
        else
        {
            $r = array("success" => "false");
        }
        echo json_encode($r);
    }
}