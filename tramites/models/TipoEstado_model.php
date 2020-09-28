<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TipoEstado_model extends CI_Model {

    public function get()//trae los tipos de estados con 'en proceso' como primero
    {
        $this->tramite = $this->load->database('tramites', TRUE);

        $query = $this->tramite->query("SELECT *
                                          FROM [TRAMITES_V2018].[dbo].[TIPO_ESTADO]
                                          --where TIP_CODIGO != 2 --ocultar al devuelto original
                                          order BY CASE WHEN TIP_NOMBRE = 'En proceso'
                                                    THEN 0 -- last
                                                    ELSE 1 -- first
                                                END ASC
                                             , TIP_NOMBRE ASC");

        return $query->result_array();
    }

    function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('ESTADO', $data);
        if($resp)
        {
            //return $id;
            return 'TRUE';
        }
        else
        {
            return 'FALSE';
        }
    }

    function update($idEstado, $data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('EST_CODIGO', $idEstado);
        $resp = $this->tramite->update('ESTADO', $data);
        if($resp)
        {
            return 'TRUE';
        }
        else
        {
            return 'FALSE';
        }
    }

    function delete($id)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('EST_CODIGO', $id);
        $resp = $this->tramite->delete('ESTADO');
        if($resp)
        {
            return 'TRUE';
        }
        else
        {
            return 'FALSE';
        }
    }
}