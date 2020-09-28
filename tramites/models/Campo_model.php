<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Campo_model extends CI_Model {

    function get_campos($asunto)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('CMP_NOMBRE');
        $this->tramite->from('CAMPO');
        $this->tramite->join('CAMPO_X_ASUNTO', 'CAMPO.CMP_ID = CAMPO_X_ASUNTO.CMP_ID', 'inner');
        $this->tramite->where('ASU_CODIGO', $asunto);//Arreglar
        $query = $this->tramite->get();
        return $query->result_array();
    }
}