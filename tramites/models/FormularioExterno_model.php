<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FormularioExterno_model extends CI_Model {

    function get_formulario_ext($asunto)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('FORMULARIO_EXTERNO');
        $this->tramite->where('ASU_CODIGO', $asunto);
        $query = $this->tramite->get();
        return $query->result_array();
    }
}