<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {


    public function existeUsuario($usuario)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('USR_USUARIO', $usuario);
        $this->tramite->where('USR_ACTIVO', 1);
        $query = $this->tramite->get('USUARIO');
        $num = $query->num_rows();
        if ($num > 0) {
            return true;
        }
        else{
            return false;
        }
    }
    public function add($data){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->insert('USUARIO', $data);
        return $query;
    }
    public function delete($data, $usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('USR_USUARIO', $usuario);
        $query = $this->tramite->update('USUARIO', $data);
        return $query;
    }
    public function update($data, $usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('USR_USUARIO', $usuario);
        $query = $this->tramite->update('USUARIO', $data);

        return $query;
    }

    public function getUsuariosxParametro($parametro){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USUARIO.USR_USUARIO, USR_CEDULA');
        $this->tramite->from('USUARIO');
        $this->tramite->join('USUARIO_X_PARAMETRO', 'USUARIO.USR_USUARIO = USUARIO_X_PARAMETRO.USR_USUARIO', 'inner');
        $this->tramite->where('PRM_ID', $parametro);
        $this->tramite->where('USR_ACTIVO', 1);
        $this->tramite->order_by("USUARIO.USR_USUARIO", "asc");
        $query = $this->tramite->get()->result_array();
        return $query;
    }

    public function getFaltantes($parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USUARIO.USR_USUARIO, USR_CEDULA');
        $this->tramite->from('USUARIO');
        $this->tramite->join('(SELECT USR_USUARIO FROM USUARIO_X_PARAMETRO where PRM_ID = '.$parametro.') as UsrParam', 'USUARIO.USR_USUARIO = UsrParam.USR_USUARIO', 'left');
        $this->tramite->where('UsrParam.USR_USUARIO', NULL);
        $this->tramite->where('USR_ACTIVO', 1);
        $this->tramite->order_by("USUARIO.USR_USUARIO", "asc");
        $query = $this->tramite->get();
        return $query->result_array();
    }

    public function revisa_rol_tramites($usuario,$parametro)
    {
        $idusuario = $this->getIdUsuario($usuario);
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('ROL_ID');
        $this->tramite->from('ROL_X_USUARIO');
        $this->tramite->join('USUARIO', 'USUARIO.USR_USUARIO = ROL_X_USUARIO.USR_USUARIO and USR_ACTIVO = 1', 'inner');
        $this->tramite->where('PRM_ID', $parametro);
        $this->tramite->where('ROL_X_USUARIO.USR_USUARIO', $idusuario);
        $query = $this->tramite->get()->result_array();

        $v = array();

        foreach($query as $q){
            $v[] = $q['ROL_ID'];
        }

        return $v;
    }
    public function getParametro($usuario){

        $idusuario = $this->getIdUsuario($usuario);
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('*');
        $this->tramite->from('USUARIO_X_PARAMETRO');
        $this->tramite->join('USUARIO', 'USUARIO.USR_USUARIO = USUARIO_X_PARAMETRO.USR_USUARIO and USR_ACTIVO = 1', 'inner');
        $this->tramite->where('USUARIO_X_PARAMETRO.USR_USUARIO', $idusuario);
        $query = $this->tramite->get()->result_array();
        return $query[0]['PRM_ID'];
    }

    public function getUnidad($usuario){
        $v = [];
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT UND_NOMBRE
                                        from UNIDAD inner join USUARIO_X_UNIDAD
                                        on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
                                        inner join USUARIO on USUARIO.USR_USUARIO = USUARIO_X_UNIDAD.USR_USUARIO
                                        and USR_ACTIVO =1
                                        where USUARIO_X_UNIDAD.USR_USUARIO = '".$usuario."';")->result_array();
        foreach($query as $q){
            $v[] = $q['UND_NOMBRE'];
        }
        return $v;
    }

    public function getUsuarios(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USR_USUARIO, USR_CEDULA, USR_NOMBRE, USR_APELLIDO, USR_ACTIVO');
        $query = $this->tramite->get('USUARIO')->result_array();
        return $query;
    }

    public function getUsuariosxUnidad($unidad){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USUARIO.USR_USUARIO');
        $this->tramite->from('USUARIO');
        $this->tramite->join('Usuario_x_unidad','USUARIO.USR_USUARIO = USUARIO_X_UNIDAD.USR_USUARIO and USR_ACTIVO = 1', 'inner');
        $this->tramite->where(' USUARIO_X_UNIDAD.UND_CODIGO',$unidad);
        $query = $this->tramite->get()->result_array();
        return $query;
    }

    public function getUsuariosActivos(){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USR_USUARIO, USR_CEDULA, USR_NOMBRE, USR_APELLIDO, USR_ACTIVO');
        $this->tramite->where('USR_ACTIVO', 1);
        $query = $this->tramite->get('USUARIO')->result_array();
        return $query;
    }
    public function busquedaUsuario($txtUsuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USR_USUARIO, USR_CEDULA, USR_NOMBRE, USR_APELLIDO, USR_ACTIVO');
        $this->tramite->from('USUARIO');
        $this->tramite->where('USR_ACTIVO', 1);
        $this->tramite->like('USR_USUARIO', $txtUsuario, 'both');
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function busquedaCedula($txtUsuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('USR_USUARIO, USR_CEDULA, USR_NOMBRE, USR_APELLIDO');
        $this->tramite->from('USUARIO');
        $this->tramite->where('USR_ACTIVO', 1);
        $this->tramite->like('USR_CEDULA', $txtUsuario, 'both');
        $query = $this->tramite->get();
        return $query->result_array();
    }

    private function getIdUsuario($usuario)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('USR_USUARIO', $usuario);
        $this->tramite->where('USR_ACTIVO', 1);
        $query = $this->tramite->get('USUARIO')->result_array();
        return $query[0]['USR_USUARIO'];
    }
    public function verifica_unidad($usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("SELECT USR_USUARIO 
                                        FROM USUARIO_X_UNIDAD
                                        WHERE USR_USUARIO = '$usuario'");

        $num = $query->num_rows();
        return $num;
    }

}