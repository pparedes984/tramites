<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asunto_model extends CI_Model {

    public function get($parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASUNTO.ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->join('ASUNTO_X_PARAMETRO', 'ASUNTO.ASU_CODIGO = ASUNTO_X_PARAMETRO.ASU_CODIGO', 'inner');
        $this->tramite->where('PRM_ID', $parametro);
        $this->tramite->where('ASU_ACTIVO', 1);
        $this->tramite->order_by("ASU_DESCRIPCION", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getFaltantes($parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASUNTO.ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->join('(SELECT ASU_CODIGO from ASUNTO_X_PARAMETRO where PRM_ID = '.$parametro.') as AsuParam', 'ASUNTO.ASU_CODIGO = AsuParam.ASU_CODIGO', 'left');
        $this->tramite->where('AsuParam.ASU_CODIGO', NULL);
        $this->tramite->where('ASU_ACTIVO', 1);
        $this->tramite->order_by("ASU_DESCRIPCION", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function busquedaAsunto($asunto){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->where('ASU_ACTIVO', 1);
        $this->tramite->like('ASU_DESCRIPCION', $asunto, 'both');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAllActivos()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->where('ASU_ACTIVO', 1);
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function getAll()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASU_CODIGO, ASU_DESCRIPCION, ASU_ACTIVO');
        $this->tramite->from('ASUNTO');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('ASUNTO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

    function update($idAsunto, $data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('ASU_CODIGO', $idAsunto);
        $resp = $this->tramite->update('ASUNTO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

    public function getFaltantesLike($parametro,$asunto)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASUNTO.ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->join('(SELECT ASU_CODIGO from ASUNTO_X_PARAMETRO where PRM_ID = '.$parametro.') as AsuParam', 'ASUNTO.ASU_CODIGO = AsuParam.ASU_CODIGO', 'left');
        $this->tramite->where('AsuParam.ASU_CODIGO', NULL);
        $this->tramite->where('ASU_ACTIVO', 1);
        $this->tramite->like('ASU_DESCRIPCION',$asunto,'after');
        $this->tramite->order_by("ASU_DESCRIPCION", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getAsignadosLike($parametro, $asunto)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ASUNTO.ASU_CODIGO, ASU_DESCRIPCION');
        $this->tramite->from('ASUNTO');
        $this->tramite->join('ASUNTO_X_PARAMETRO', 'ASUNTO.ASU_CODIGO = ASUNTO_X_PARAMETRO.ASU_CODIGO', 'inner');
        $this->tramite->where('PRM_ID', $parametro);
        $this->tramite->where('ASU_ACTIVO', 1);
        $this->tramite->like('ASU_DESCRIPCION',$asunto,'after');
        $this->tramite->order_by("ASU_DESCRIPCION", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }
}