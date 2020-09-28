<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadParametro_model extends CI_Model {

    public function get($unidad)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join UNIDAD_X_PARAMETRO on PARAMETRO.PRM_ID = UNIDAD_X_PARAMETRO.PRM_ID
                                        and PRM_ACTIVO = 1 
                                        and UNIDAD_X_PARAMETRO.UND_CODIGO = ".$unidad.";");
        return $query->result_array();
    }
    public function getAll(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT distinct PRM_NOMBRE, PARAMETRO.PRM_ID
                                        from PARAMETRO inner join UNIDAD_X_PARAMETRO on PARAMETRO.PRM_ID = UNIDAD_X_PARAMETRO.PRM_ID
                                        and PRM_ACTIVO = 1;");
        return $query->result_array();
    }
    public function getDirecciones($usuario,$parametro){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select distinct (UNIDAD.UND_NOMBRE)as UND_PRM, B.UND_PRM_ID
                                        from UNIDAD inner join UNIDAD_X_PARAMETRO as B
                                        on UNIDAD.UND_CODIGO = B.UND_CODIGO and UND_ACTIVO = 1
                                        inner join PARAMETRO on B.PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        left join (select distinct concat(UNIDAD.UND_NOMBRE, ' (',PARAMETRO.PRM_NOMBRE,')')as UND_PRM, UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE, UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        from USUARIO_X_UNIDAD_X_PARAMETRO inner join UNIDAD_X_PARAMETRO 
                                        on USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID = UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        inner join UNIDAD on UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO and UND_ACTIVO = 1
                                        inner join PARAMETRO on UNIDAD_X_PARAMETRO.PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        inner join USUARIO on USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USR_ACTIVO = 1
                                        where USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = '".$usuario."') as A on B.UND_PRM_ID = A.UND_PRM_ID
                                        where A.UND_PRM_ID is null
                                        and PARAMETRO.PRM_ID = $parametro
                                        and UNIDAD.UND_CODIGO != 183
                                        and UND_DIRECCIONAMIENTO = 1;");
        return $query->result_array();
    }
    //Anterior getDirecciones
    /*
         public function getDirecciones($usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select distinct concat(UNIDAD.UND_NOMBRE, ' (',PARAMETRO.PRM_NOMBRE,')')as UND_PRM, B.UND_PRM_ID
                                        from UNIDAD inner join UNIDAD_X_PARAMETRO as B
                                        on UNIDAD.UND_CODIGO = B.UND_CODIGO and UND_ACTIVO = 1
                                        inner join PARAMETRO on B.PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        left join (select distinct concat(UNIDAD.UND_NOMBRE, ' (',PARAMETRO.PRM_NOMBRE,')')as UND_PRM, UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE, UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        from USUARIO_X_UNIDAD_X_PARAMETRO inner join UNIDAD_X_PARAMETRO
                                        on USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID = UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        inner join UNIDAD on UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO and UND_ACTIVO = 1
                                        inner join PARAMETRO on UNIDAD_X_PARAMETRO.PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        inner join USUARIO on USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USR_ACTIVO = 1
                                        where USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = '".$usuario."') as A on B.UND_PRM_ID = A.UND_PRM_ID
                                        where A.UND_PRM_ID is null
                                        and UNIDAD.UND_CODIGO != 183
                                        and UND_DIRECCIONAMIENTO = 1;");
        return $query->result_array();
    }
     */
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('UNIDAD_X_PARAMETRO', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('UNIDAD_X_PARAMETRO', $data);
        return $query;
    }
}