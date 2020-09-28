<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioUnidadParametro_model extends CI_Model {

    public function get($usuario,$parametro)//devuelve las unidades de las que es jefe un usuario
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select (UNIDAD.UND_NOMBRE) as UND_PRM, USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID, UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE, UNIDAD_X_PARAMETRO.PRM_ID, PARAMETRO.PRM_NOMBRE
                                        FROM USUARIO_X_UNIDAD_X_PARAMETRO inner join UNIDAD_X_PARAMETRO 
                                        on UNIDAD_X_PARAMETRO.UND_PRM_ID = USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        inner join UNIDAD on UNIDAD.UND_CODIGO = UNIDAD_X_PARAMETRO.UND_CODIGO
                                        and UND_ACTIVO = 1
                                        inner join USUARIO on USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USR_ACTIVO = 1 inner join PARAMETRO on UNIDAD_X_PARAMETRO.PRM_ID = PARAMETRO.PRM_ID
                                        where USUARIO_X_UNIDAD_X_PARAMETRO.UUP_JEFE = 1 
										and UNIDAD_X_PARAMETRO.PRM_ID = $parametro
                                        and USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = '".$usuario."';");
        return $query->result_array();
    }

    //Get anterior
    /*public function get($usuario)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select concat(UNIDAD.UND_NOMBRE, ' (',PARAMETRO.PRM_NOMBRE,')')as UND_PRM, USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID, UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE, UNIDAD_X_PARAMETRO.PRM_ID, PARAMETRO.PRM_NOMBRE
                                        FROM USUARIO_X_UNIDAD_X_PARAMETRO inner join UNIDAD_X_PARAMETRO
                                        on UNIDAD_X_PARAMETRO.UND_PRM_ID = USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        inner join UNIDAD on UNIDAD.UND_CODIGO = UNIDAD_X_PARAMETRO.UND_CODIGO
                                        and UND_ACTIVO = 1
                                        inner join USUARIO on USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USR_ACTIVO = 1 inner join PARAMETRO on UNIDAD_X_PARAMETRO.PRM_ID = PARAMETRO.PRM_ID
                                        where USUARIO_X_UNIDAD_X_PARAMETRO.UUP_JEFE = 1
                                        and USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = '".$usuario."';");
        return $query->result_array();
    }*/

    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('USUARIO_X_UNIDAD_X_PARAMETRO', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('USUARIO_X_UNIDAD_X_PARAMETRO', $data);
        return $query;
    }
}