<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parametro_model extends CI_Model {

    public function get($usuario)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join USUARIO_X_PARAMETRO on PARAMETRO.PRM_ID = USUARIO_X_PARAMETRO.PRM_ID 
                                        and USUARIO_X_PARAMETRO.USR_USUARIO = '".$usuario."'
                                        inner join USUARIO on USUARIO_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1
                                        where PRM_ACTIVO = 1 order by PARAMETRO.PRM_NOMBRE asc;");
        return $query->result_array();
    }
    public function getParametros($usuario){//obtiene los parametros que le faltan a un usuario
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT distinct PARAMETRO.PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO left join(
                                        SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join USUARIO_X_PARAMETRO on PARAMETRO.PRM_ID = USUARIO_X_PARAMETRO.PRM_ID 
                                        and USUARIO_X_PARAMETRO.USR_USUARIO = '".$usuario."'
                                        inner join USUARIO on USUARIO_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1) as A
                                        on PARAMETRO.PRM_ID = A.PRM_ID
                                        where A.PRM_ID is null
                                        and PRM_ACTIVO = 1 order by PARAMETRO.PRM_NOMBRE asc;");
        return $query->result_array();
    }
    public function getParamUnidades($unidad){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT distinct PARAMETRO.PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO left join(
                                        SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join UNIDAD_X_PARAMETRO on PARAMETRO.PRM_ID = UNIDAD_X_PARAMETRO.PRM_ID 
                                        and UNIDAD_X_PARAMETRO.UND_CODIGO = ".$unidad.") as A
                                        on PARAMETRO.PRM_ID = A.PRM_ID
                                        where A.PRM_ID is null
                                        and PRM_ACTIVO = 1 order by PARAMETRO.PRM_NOMBRE asc;");
        return $query->result_array();
    }
    public function getParamAsuntos($asunto){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT distinct PARAMETRO.PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO left join(
                                        SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join ASUNTO_X_PARAMETRO on PARAMETRO.PRM_ID = ASUNTO_X_PARAMETRO.PRM_ID 
                                        and ASUNTO_X_PARAMETRO.ASU_CODIGO = ".$asunto.") as A
                                        on PARAMETRO.PRM_ID = A.PRM_ID
                                        where A.PRM_ID is null
                                        and PRM_ACTIVO = 1 order by PARAMETRO.PRM_NOMBRE asc;");
        return $query->result_array();
    }
    public function getAllParametros()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('PRM_NOMBRE, PRM_ID');
        $this->tramite->from('PARAMETRO');
        $this->tramite->where('PRM_ACTIVO', 1);
        $this->tramite->order_by('PRM_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAll()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('PRM_NOMBRE, PRM_ID, PRM_ACTIVO');
        $this->tramite->from('PARAMETRO');
        $this->tramite->order_by('PRM_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('PARAMETRO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

    function update($idParametro, $data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('PRM_ID', $idParametro);
        $resp = $this->tramite->update('PARAMETRO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

}