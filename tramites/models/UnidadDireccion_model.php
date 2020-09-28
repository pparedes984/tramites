<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadDireccion_model extends CI_Model {



    function get_menu_unidades($usuario, $parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select distinct UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE
                                        from UNIDAD_X_PARAMETRO inner join UNIDAD on UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO
                                        and UND_ACTIVO = 1
                                        inner join USUARIO_X_UNIDAD on USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."'
                                        and UNIDAD_X_PARAMETRO.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
                                        inner join USUARIO on USUARIO.USR_USUARIO = USUARIO_X_UNIDAD.USR_USUARIO
                                        and USR_ACTIVO = 1
                                        where UNIDAD_X_PARAMETRO.UND_DIRECCIONAMIENTO = 1 
                                        and UNIDAD_X_PARAMETRO.PRM_ID = ".$parametro.";");

        return $query->result_array();
    }
    public function get_unidades($usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select distinct UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE
                                        from UNIDAD_X_PARAMETRO inner join UNIDAD on UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO
                                        and UND_ACTIVO = 1
                                        inner join USUARIO_X_UNIDAD on USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."'
                                        and UNIDAD_X_PARAMETRO.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
                                        where UNIDAD_X_PARAMETRO.UND_DIRECCIONAMIENTO = 1;");

        return $query->result_array();
    }
    public function getUnidadesParametro($parametro){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("Select UNIDAD_X_PARAMETRO.PRM_ID, UNIDAD_X_PARAMETRO.UND_CODIGO, UNIDAD.UND_NOMBRE, UND_DIRECCIONAMIENTO, UND_PRM_ID, UNIDAD.UND_ACTIVO
                                        from UNIDAD_X_PARAMETRO
                                        inner join UNIDAD on UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO and UNIDAD.UND_ACTIVO = 1
                                        inner join PARAMETRO on UNIDAD_X_PARAMETRO.PRM_ID = PARAMETRO.PRM_ID and PARAMETRO.PRM_ACTIVO = 1
                                        where UNIDAD_X_PARAMETRO.PRM_ID = $parametro
                                        order by UND_DIRECCIONAMIENTO desc,
										UNIDAD.UND_NOMBRE asc");

        return $query->result_array();
    }
    public function update($idUndPrm, $direccionamiento)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->set('UND_DIRECCIONAMIENTO', $direccionamiento);
        $this->tramite->where('UND_PRM_ID', $idUndPrm);
        $resp = $this->tramite->update('UNIDAD_X_PARAMETRO');
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }
}