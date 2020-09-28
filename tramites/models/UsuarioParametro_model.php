<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioParametro_model extends CI_Model {

    public function get($usuario)//devuelve los parametros asignados
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        /*$this->mssqlSars->select('PRM_NOMBRE');
        $query = $this->mssqlSars->get('PARAMETRO');*/
        $query = $this->tramite->query("SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join USUARIO_X_PARAMETRO on PARAMETRO.PRM_ID = USUARIO_X_PARAMETRO.PRM_ID 
                                        and PRM_ACTIVO = 1
                                        and USUARIO_X_PARAMETRO.USR_USUARIO = '".$usuario."'
                                        inner join USUARIO on USUARIO_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1;");
        return $query->result_array();
    }
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('USUARIO_X_PARAMETRO', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('USUARIO_X_PARAMETRO', $data);
        return $query;
    }
}