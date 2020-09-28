<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioUnidad_model extends CI_Model {

    public function get($usuario)//devuelve las unidades asociadas a un usuario
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT UND_NOMBRE, UNIDAD.UND_CODIGO
                                        from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
                                        and UND_ACTIVO = 1 
                                        and USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."'
                                        inner join USUARIO on USUARIO_X_UNIDAD.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1 order by UNIDAD.UND_NOMBRE;");
        return $query->result_array();
    }
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('usuario_x_unidad', $data);
        return $query;
    }
    public function delete($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->delete('usuario_x_unidad', $data);
        return $query;
    }
}