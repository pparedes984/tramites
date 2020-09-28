<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EstadoTramite_model extends CI_Model {

    public function get($tramite, $parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);

        $query = $this->tramite->query("SELECT ESTADO.TIP_CODIGO,EST_DESCRIPCION as EST_OBSERVACION,TRA_CODIGO,ESTADO.UND_CODIGO, convert(varchar, EST_FECHAINICIO, 120) EST_FECHAINICIO
                                              ,convert(varchar, EST_FECHAFIN, 120) EST_FECHAFIN,EST_DESCRIPCION,convert(varchar, EST_FECHARECIBIDO, 120) EST_FECHARECIBIDO,EST_RECIBIDO
                                              ,TRA_PRM_ID,EST_CODIGO,convert(varchar, EST_FECHA_ASIGNADO, 120) EST_FECHA_ASIGNADO,EST_REVISAR
                                              ,EST_REVISADO_UNIDAD,EST_ORIGEN,EST_ASIGNADO_A
                                              ,EST_ANULADO,EST_FINALIZADO, TIPO_ESTADO.TIP_NOMBRE, UNIDAD.UND_NOMBRE
                                        FROM ESTADO inner join TIPO_ESTADO ON ESTADO.TIP_CODIGO = TIPO_ESTADO.TIP_CODIGO
                                        inner join UNIDAD ON UNIDAD.UND_CODIGO = ESTADO.UND_CODIGO and UND_ACTIVO = 1
                                        where TRA_CODIGO = ".$tramite."
                                        and TRA_PRM_ID = ".$parametro."
                                        and EST_ANULADO = 0;");

        return $query->result_array();
    }
    public function getDestino($tramite, $parametro, $unidad)
    {
        $this->tramite = $this->load->database('tramites', TRUE);

        $query = $this->tramite->query("SELECT ESTADO.TIP_CODIGO,EST_OBSERVACION,TRA_CODIGO,ESTADO.UND_CODIGO,convert(varchar, EST_FECHAINICIO, 120) EST_FECHAINICIO
                                              ,convert(varchar, EST_FECHAFIN, 120) EST_FECHAFIN,EST_DESCRIPCION,convert(varchar, EST_FECHARECIBIDO, 120) EST_FECHARECIBIDO,EST_RECIBIDO
                                              ,TRA_PRM_ID,EST_CODIGO,convert(varchar, EST_FECHA_ASIGNADO, 120) EST_FECHA_ASIGNADO,EST_REVISAR
                                              ,EST_REVISADO_UNIDAD,EST_ORIGEN,EST_ASIGNADO_A
                                              ,EST_ANULADO,EST_FINALIZADO, TIPO_ESTADO.TIP_NOMBRE, UNIDAD.UND_NOMBRE
                                        FROM ESTADO inner join TIPO_ESTADO ON ESTADO.TIP_CODIGO = TIPO_ESTADO.TIP_CODIGO
                                        inner join UNIDAD ON UNIDAD.UND_CODIGO = ESTADO.UND_CODIGO and UND_ACTIVO = 1
                                        where TRA_CODIGO = ".$tramite."
                                        and TRA_PRM_ID = ".$parametro."
                                        and EST_ANULADO = 0
                                        and ESTADO.UND_CODIGO = ".$unidad."
                                        and ESTADO.TIP_CODIGO = 1;");

        return $query->result_array();
    }

    public function verificarJefe($usuario, $unidad){
        $this->tramite = $this->load->database('tramites', TRUE);
        $query = $this->tramite->query("select UUP_JEFE, USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID 
                                        from USUARIO_X_UNIDAD_X_PARAMETRO
                                        inner join UNIDAD_X_PARAMETRO on UND_CODIGO = ".$unidad."
                                        and USUARIO_X_UNIDAD_X_PARAMETRO.UND_PRM_ID = UNIDAD_X_PARAMETRO.UND_PRM_ID
                                        inner join USUARIO on USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = USUARIO.USR_USUARIO
                                        and USUARIO.USR_ACTIVO = 1
                                        where USUARIO_X_UNIDAD_X_PARAMETRO.USR_USUARIO = '".$usuario."';");
        return $query->result_array();
    }

    function add($data,$unidad)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('ESTADO',$data);
        $CODIGO =$data['TRA_CODIGO'];
        $num = $this->tramite->query("select * from ESTADO
                                      where TRA_CODIGO = '$CODIGO'");
        $num = $num->num_rows();
        if($num >= 2) {//pone como finalizado al estado que se crea por secretaria
            $query = $this->tramite->query("select top(2) * from ESTADO
                                      where TRA_CODIGO = '$CODIGO'
                                      order by EST_CODIGO desc");
            $query = $query->result_array();
            if($query[1]['UND_CODIGO']==183) {
                date_default_timezone_set('America/Bogota');
                $date = date("Y-m-d H:i:s");
                $EST_CODIGO=$query[1]['EST_CODIGO'];
                $this->tramite->query("update ESTADO
                                   set TIP_CODIGO = '4'
                                   where TRA_CODIGO = '$CODIGO'
                                   and UND_CODIGO = '183'
                                   and EST_CODIGO = '$EST_CODIGO'");
                $this->tramite->query("update ESTADO
                                   set EST_FECHAFIN = '$date'
                                   where TRA_CODIGO = '$CODIGO'
                                   and UND_CODIGO = '183'
                                   and EST_CODIGO = '$EST_CODIGO'");
            }
        }
        if($resp)
        {
            if($unidad==183) {
                $this->tramite->select_max('EST_CODIGO');
                $this->tramite->from('ESTADO');
                $query2 = $this->tramite->get();
                $estcodigo = $query2->result_array();

                $this->tramite->set('EST_ORIGEN', 0);
                $this->tramite->where('TRA_PRM_ID', $data['TRA_PRM_ID']);
                $this->tramite->where('TRA_CODIGO', $data['TRA_CODIGO']);
                $this->tramite->where('EST_CODIGO', $estcodigo[0]['EST_CODIGO']);
                $this->tramite->update('ESTADO', $data);
            }
            /*
            else{
            }*/
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
        $this->tramite->select('EST_ASIGNADO_A');
        $this->tramite->where('EST_CODIGO', $idEstado);
        $asignado = $this->tramite->get('ESTADO');
        $asignado = $asignado->result_array();
        $asignado = $asignado[0]['EST_ASIGNADO_A'];

        if($asignado == NULL) {
            date_default_timezone_set('America/Bogota');
            $fechaAsignado = date("Y-m-d H:s:i");
            $this->tramite->set('EST_FECHA_ASIGNADO', $fechaAsignado);
        }
        /*if($asignado == NULL)
            $this->tramite->set('EST_FECHA_ASIGNADO', $fechaAsignado);*/
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
        $this->tramite->set('EST_ANULADO', 1);
        $this->tramite->where('EST_CODIGO', $id);
        $resp = $this->tramite->update('ESTADO');
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