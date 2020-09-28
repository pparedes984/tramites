<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Unidad_model extends CI_Model {



    public function getUnidad($usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT UND_NOMBRE, UNIDAD.UND_CODIGO
                                        from UNIDAD inner join USUARIO_X_UNIDAD
                                        on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO and UND_ACTIVO = 1
                                        inner join USUARIO on USUARIO.USR_USUARIO = USUARIO_X_UNIDAD.USR_USUARIO
                                        and USR_ACTIVO = 1
                                        where USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."' and UNIDAD.UND_CODIGO != 183
                                        order by UND_NOMBRE asc");

        return $query->result_array();

    }
    public function getUsuarioUnidad($usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT UNIDAD.UND_NOMBRE, UNIDAD.UND_CODIGO
                                        from UNIDAD left join(
                                        SELECT UND_NOMBRE, UNIDAD.UND_CODIGO
                                        from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO 
                                        and USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."'
                                        inner join USUARIO on USUARIO_X_UNIDAD.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1) as A
                                        on UNIDAD.UND_CODIGO = A.UND_CODIGO
                                        where A.UND_CODIGO is null
                                        and UND_ACTIVO = 1 order by UNIDAD.UND_NOMBRE asc;");
        return $query->result_array();
    }
    public function getActivos()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UND_CODIGO, UND_NOMBRE, UND_ACTIVO');
        $this->tramite->from('UNIDAD');
        $this->tramite->order_by('UND_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAll($unidireccion)
    {

        $this->tramite = $this->load->database('tramites', TRUE);
        //llama a las unidades de dirrecionamiento para el combobox de direccionamiento
        if ($unidireccion == 1){
            //$direc = $this->getUnidadesDireccion();
            $query = $this->tramite->query("select UNIDAD.UND_CODIGO, UND_NOMBRE
                                        from UNIDAD
                                        inner join UNIDAD_X_PARAMETRO ON UNIDAD.UND_CODIGO = UNIDAD_X_PARAMETRO.UND_CODIGO
                                        where UND_DIRECCIONAMIENTO = '1'
                                        and UNIDAD.UND_CODIGO <> '1201'                                       
                                        order by UNIDAD.UND_NOMBRE asc;");

        }
        elseif ($unidireccion == 2){
            //$direc = $this->getUnidadesDireccion();
            $query = $this->tramite->query("select UNIDAD.UND_CODIGO, UND_NOMBRE
                                        from UNIDAD
                                        inner join UNIDAD_X_PARAMETRO ON UNIDAD.UND_CODIGO = UNIDAD_X_PARAMETRO.UND_CODIGO
                                        where UNIDAD.UND_CODIGO = '1201';");
        }
        else{
            $query = $this->tramite->query("SELECT UND_CODIGO, UND_NOMBRE
                                          from UNIDAD
                                          where UND_DESTINO = 1
                                          and UND_ACTIVO = 1 order by UNIDAD.UND_NOMBRE asc;");
        }

        return $query->result_array();
    }

    public function getFaltantes($parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UNIDAD.UND_CODIGO, UND_NOMBRE');
        $this->tramite->from('UNIDAD');
        $this->tramite->join('(SELECT UND_CODIGO FROM UNIDAD_X_PARAMETRO where PRM_ID = '.$parametro.') as UndParam', 'UNIDAD.UND_CODIGO = UndParam.UND_CODIGO', 'left');
        $this->tramite->where('UndParam.UND_CODIGO', NULL);
        $this->tramite->where('UND_ACTIVO', 1);
        $this->tramite->order_by("UND_NOMBRE", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getUnidadesParametro($parametro){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UNIDAD.UND_CODIGO, UND_NOMBRE');
        $this->tramite->from('UNIDAD');
        $this->tramite->join('UNIDAD_X_PARAMETRO','UNIDAD_X_PARAMETRO.UND_CODIGO = UNIDAD.UND_CODIGO','inner');
        $this->tramite->where('PRM_ID',$parametro);
        $this->tramite->where('UND_ACTIVO = 1');
        $this->tramite->order_by('UND_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getUnidadBusqueda($unidad){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UND_CODIGO, UND_NOMBRE, UND_ACTIVO');
        $this->tramite->from('UNIDAD');
        $this->tramite->like('UND_NOMBRE', $unidad, 'both');
        $this->tramite->order_by('UND_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getDestinos($idTramite, $idParametro){

        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select UNIDAD.UND_CODIGO, UNIDAD.UND_NOMBRE
                                        from UNIDAD
                                        left join (SELECT ESTADO.UND_CODIGO,UNIDAD.UND_NOMBRE
                                        FROM ESTADO inner join UNIDAD ON UNIDAD.UND_CODIGO = ESTADO.UND_CODIGO
                                        and ESTADO.TIP_CODIGO = 1
                                        where TRA_CODIGO = ".$idTramite."
                                        and TRA_PRM_ID = ".$idParametro."
                                        and EST_ANULADO = 0) as A on UNIDAD.UND_CODIGO = A.UND_CODIGO 
                                        where UND_DESTINO = 1
                                        and A.UND_CODIGO IS NULL
                                        and UND_ACTIVO = 1
                                        order by UNIDAD.UND_NOMBRE asc;");

        return $query->result_array();
    }
    public function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('UNIDAD', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

    public function update($idParametro, $data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('UND_CODIGO', $idParametro);
        $resp = $this->tramite->update('UNIDAD', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }
    public function busquedaUnidad($unidadtxt){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UND_CODIGO,UND_NOMBRE');
        $this->tramite->from('UNIDAD');
        $this->tramite->like('UND_NOMBRE', $unidadtxt, 'both');
        $this->tramite->order_by('UND_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function verificarUndGasto($unidadgasto){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('UND_CODIGO,UND_NOMBRE');
        $this->tramite->from('UNIDAD');
        $this->tramite->where('UND_NOMBRE', $unidadgasto);
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getUnidadesDireccion(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select UND_NOMBRE
                                        from UNIDAD
                                        inner join UNIDAD_X_PARAMETRO ON UNIDAD.UND_CODIGO = UNIDAD_X_PARAMETRO.UND_CODIGO
                                        where UND_DIRECCIONAMIENTO = '1'                                        
                                        order by UNIDAD.UND_NOMBRE asc;");
        return $query->result_array();
    }
}