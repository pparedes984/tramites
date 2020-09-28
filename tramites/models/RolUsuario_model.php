<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RolUsuario_model extends CI_Model {

    public function get($usuario,$parametro)
    {
        if($parametro == null)
            $parametro =-1;
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select ROL.ROL_ID, ROL.ROL_NOMBRE
                                        from ROL inner join ROL_X_USUARIO
                                        on ROL_X_USUARIO.ROL_ID = ROL.ROL_ID
                                        and ROL_X_USUARIO.USR_USUARIO = '".$usuario."'
                                        and ROL_X_USUARIO.PRM_ID = ".$parametro."
                                        inner join USUARIO on USUARIO.USR_USUARIO = ROL_X_USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1;");
        return $query->result_array();
    }
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('ROL_X_USUARIO', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('ROL_X_USUARIO', $data);
        return $query;
    }
}