<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_model extends CI_Model {



    public function getConsulta($usuario,$anulado,$beneficiario,$parametro,$undgasto,$proyecto,$asunto,$descripcion,$noficio,$codtramite, $desde, $hasta){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION,PARAMETRO.PRM_NOMBRE');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');
        //subconsulta unidades del usuario
        $this->tramite->join('(select UNIDAD.UND_CODIGO,UNIDAD.UND_NOMBRE
	     from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
	     where USUARIO_X_UNIDAD.USR_USUARIO = \''.$usuario.'\') AS UNIDADES', 'UNIDADES.UND_CODIGO = TRAMITE.UND_CODIGO', 'inner');
        //$this->tramite->where('TRA_FINALIZADO', $finalizado);
        //Añade a la consulta mas parametros
        if($anulado != null){
            $this->tramite->where('TRA_ANULADO', $anulado);
        }
        if($beneficiario != null){
            $this->tramite->like('TRA_BENEFICIARIO1', $beneficiario, 'both');
        }
        if($parametro != null)
            $this->tramite->where('TRA_PRM_ID', $parametro);
        if($undgasto != null)
            $this->tramite->like('TRA_GASTO', $undgasto);
        if($proyecto != null)
            $this->tramite->like('TRA_PROYECTO', $proyecto, 'both');
        if($asunto != null)
            $this->tramite->where('TRAMITE.ASU_CODIGO', $asunto);
        if($descripcion != null)
            $this->tramite->like('TRA_DESCRIPCION', $descripcion, 'both');
        if($noficio != null)
            $this->tramite->like('TRA_OFICIO', $noficio);
        if($codtramite != null)
            $this->tramite->where('TRA_CODIGO', $codtramite);
        if ($desde !=null )
            $this->tramite->where('TRA_FECHA >=', $desde);
        if ($hasta !=null )
            $this->tramite->where('TRA_FECHA <=', $hasta);
        $this->tramite->order_by("tra_codigo", "desc");
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getTramitesUsuario($usuario,$parametro){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO,convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, PARAMETRO.PRM_NOMBRE, TRA_POSICION');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');
        $this->tramite->join('(select UNIDAD.UND_CODIGO,UNIDAD.UND_NOMBRE
	     from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
	     where USUARIO_X_UNIDAD.USR_USUARIO = \''.$usuario.'\') AS UNIDADES', 'UNIDADES.UND_CODIGO = TRAMITE.UND_CODIGO', 'inner');
        $this->tramite->where('TRA_PRM_ID',$parametro);
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAllTramites(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO,convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, PARAMETRO.PRM_NOMBRE');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');

        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAllBusqueda($unidadSol,$anulado,$beneficiario,$parametro,$undgasto,$proyecto,$asunto,$descripcion,$noficio,$codtramite, $desde, $hasta){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO,convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION,PARAMETRO.PRM_NOMBRE,TRA_POSICION');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');
        if($unidadSol != null){//añade parametros variables
            $this->tramite->where('TRAMITE.UND_CODIGO', $unidadSol);
        }
        if($anulado != null){
            $this->tramite->where('TRA_ANULADO', $anulado);
        }
        if($beneficiario != null){
            $this->tramite->like('TRA_BENEFICIARIO1', $beneficiario, 'both');
        }
        if($parametro != null)
            $this->tramite->where('TRA_PRM_ID', $parametro);
        if($undgasto != null)
            $this->tramite->like('TRA_GASTO', $undgasto);
        if($proyecto != null)
            $this->tramite->like('TRA_PROYECTO', $proyecto, 'both');
        if($asunto != null)
            $this->tramite->where('TRAMITE.ASU_CODIGO', $asunto);
        if($descripcion != null)
            $this->tramite->like('TRA_DESCRIPCION', $descripcion, 'both');
        if($noficio != null)
            $this->tramite->like('TRA_OFICIO', $noficio);
        if($codtramite != null)
            $this->tramite->where('TRA_CODIGO', $codtramite);
        if ($desde !=null )
            $this->tramite->where('TRA_FECHA >=', $desde);
        if ($hasta !=null )
            $this->tramite->where('TRA_FECHA <=', $hasta);
        $this->tramite->order_by("tra_codigo", "desc");
        $query = $this->tramite->get();


        return $query->result_array();
    }

    public function getAllBusquedaLike($codtramite){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO,convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION,PARAMETRO.PRM_NOMBRE,TRA_POSICION');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');
        if($codtramite != null)
            $this->tramite->like('TRA_CODIGO', $codtramite, 'after');
        $this->tramite->order_by("tra_codigo", "desc");
        $query = $this->tramite->get();


        return $query->result_array();
    }

    public function getConsultaLike($codtramite){
        $usuario = $this->session->session_usuario_apps;
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION,PARAMETRO.PRM_NOMBRE');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID', 'inner');
        //subconsulta unidades del usuario
        $this->tramite->join('(select UNIDAD.UND_CODIGO,UNIDAD.UND_NOMBRE
	     from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
	     where USUARIO_X_UNIDAD.USR_USUARIO = \''.$usuario.'\') AS UNIDADES', 'UNIDADES.UND_CODIGO = TRAMITE.UND_CODIGO', 'inner');
        //$this->tramite->where('TRA_FINALIZADO', $finalizado);
        //Añade a la consulta mas parametros
        if($codtramite != null)
            $this->tramite->like('TRA_CODIGO', $codtramite, 'after');
        $this->tramite->order_by("tra_codigo", "desc");
        $query = $this->tramite->get();
        return $query->result_array();
    }
}