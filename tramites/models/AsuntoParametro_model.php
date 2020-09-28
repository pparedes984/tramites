<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AsuntoParametro_model extends CI_Model {

    public function get($asunto)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join ASUNTO_X_PARAMETRO on PARAMETRO.PRM_ID = ASUNTO_X_PARAMETRO.PRM_ID
                                        and ASUNTO_X_PARAMETRO.ASU_CODIGO = ".$asunto."
                                        where PRM_ACTIVO = 1;");
        return $query->result_array();
    }
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('ASUNTO_X_PARAMETRO', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('ASUNTO_X_PARAMETRO', $data);
        return $query;
    }
    public function getAll(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->get('ASUNTO_X_PARAMETRO');
        return $query;
    }
}