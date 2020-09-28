<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadGasto_model extends CI_Model {

    public function getUnidadGasto()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('UNIDAD_GASTO');
        $this->tramite->order_by('GST_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getUnidadGastoActiva()
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('UNIDAD_GASTO');
        $this->tramite->where('GST_ACTIVO',1);
        $this->tramite->order_by('GST_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function getBusquedaUnidadGasto($unidadtxt){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('UNIDAD_GASTO');
        $this->tramite->like('GST_NOMBRE', $unidadtxt, 'both');
        $this->tramite->order_by('GST_NOMBRE', 'asc');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('UNIDAD_GASTO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }

    public function update($idParametro, $data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('GST_ID', $idParametro);
        $resp = $this->tramite->update('UNIDAD_GASTO', $data);
        if($resp)
            return 'TRUE';
        else
            return 'FALSE';
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('ROL_X_USUARIO', $data);
        return $query;
    }

    public function verificarUndGasto($unidadgasto){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('UNIDAD_GASTO');
        $this->tramite->where('GST_NOMBRE', $unidadgasto);
        $query = $this->tramite->get();
        return $query->result_array();
    }
}