<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model {

    public function get_tramite_direccionar($parametro,$codigo,$asignado)//Obtiene los tramites enviados y no enviados de todos los usuarios y sus unidades
    {
        $this->tramite = $this->load->database('tramites', TRUE);

        $sql = " select TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, PARAMETRO.PRM_NOMBRE, TRA_POSICION
                                        from TRAMITE inner join UNIDAD on TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO
                                        inner join ASUNTO on TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO and ASU_ACTIVO = 1
                                        inner join PARAMETRO on TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        where TRA_ANULADO = 0
                                        and TRA_PRM_ID = $parametro  ";
        if($codigo != ''){
            $sql = $sql." and TRA_CODIGO like '$codigo%' ";
        }
        if($asignado != '')
        {
            $sql = $sql." and TRA_CODIGO in (select TRA_CODIGO from estado where EST_ASIGNADO_A like '$asignado%') ";
        }
        $sql = $sql."order by TRA_CODIGO desc;";
        $query = $this->tramite->query($sql);
        return $query->result_array();
    }

    public function get_tramite_busqueda_direccionar($tramite, $parametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, , PARAMETRO.PRM_NOMBRE');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO and UND_ACTIVO = 1', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO and ASU_ACTIVO = 1', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1', 'inner');
        if($tramite != 0)
            $this->tramite->where('TRA_CODIGO', $tramite);
        if($parametro != 0)
            $this->tramite->where('TRA_PRM_ID', $parametro);

        $this->tramite->where('TRA_ANULADO', 0);
        $query = $this->tramite->get();
        return $query->result_array();
    }
    public function get_tramite_busqueda_nuevo($tramite, $parametro,$usuario){
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO, TRAMITE.ASU_CODIGO, TRAMITE.USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, TRAMITE.TRA_GASTO, PARAMETRO.PRM_NOMBRE, TRA_POSICION, TRA_MONEDA');
        $this->tramite->from('TRAMITE');
        $this->tramite->join('UNIDAD', 'TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO and UND_ACTIVO = 1', 'inner');
        $this->tramite->join('ASUNTO', 'TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO and ASU_ACTIVO = 1', 'inner');
        $this->tramite->join('PARAMETRO', 'TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1', 'inner');
        $this->tramite->join('USUARIO', 'TRAMITE.USR_USUARIO = USUARIO.USR_USUARIO and USUARIO.USR_ACTIVO = 1', 'inner');
        //Subconsulta para unidades del usuario
        $this->tramite->join('(select UNIDAD.UND_CODIGO,UNIDAD.UND_NOMBRE
	     from UNIDAD inner join USUARIO_X_UNIDAD on UNIDAD.UND_CODIGO = USUARIO_X_UNIDAD.UND_CODIGO
	     where USUARIO_X_UNIDAD.USR_USUARIO = \''.$usuario.'\') AS UNIDADES', 'UNIDADES.UND_CODIGO = TRAMITE.UND_CODIGO', 'inner');

        if($tramite != 0)
            $this->tramite->where('TRA_CODIGO', $tramite);
        if($parametro != 0)
            $this->tramite->where('TRA_PRM_ID', $parametro);

        $this->tramite->where('TRA_RECIBIDO', 0);
        $this->tramite->where('TRA_ANULADO', 0);
        $this->tramite->order_by("tra_codigo", "desc");
        $query = $this->tramite->get();

        return $query->result_array();
    }

    public function get_tramite_unidad_dir($unidad, $parametro, $codigo,$asignado)//Obtiene los tramites recibidos fisicamente especificos de cada unidad a la que fue direccionada
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $sql = " select TRA_CODIGO, TRAMITE.ASU_CODIGO, USR_USUARIO, convert(varchar, TRA_FECHA, 120) TRA_FECHA, TRA_OFICIO, TRA_BENEFICIARIO1, TRA_BENEFICIARIO2, 
                                        TRA_CEDULA1, TRA_CEDULA2, TRA_PROYECTO, TRA_COMPROMISO, TRA_PERSONA_AUTORIZA, TRA_TELEFONO, TRA_VALOR,
                                        TRA_DETALLE_FACTURA, TRA_FECHA_VIAJE_VIATICO, TRA_DESTINO_VIATICO, TRA_RESPONSABLE_VIATICO, 
                                        TRA_PERSONAS_ADIC_VIATICO, TRA_OBSERV_VIAJE_VIATICO, convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO, TRA_RECIBIDO, TRAMITE.TRA_GASTO, TRAMITE.TRA_PRM_ID,
                                        TRAMITE.UND_CODIGO, TRA_DESCRIPCION, TRA_FECHA_VIAJE_FIN_VIATICO, TRA_ANULADO,
                                        UNIDAD.UND_NOMBRE, asunto.ASU_DESCRIPCION, PARAMETRO.PRM_NOMBRE
                                        from TRAMITE inner join UNIDAD on TRAMITE.UND_CODIGO = UNIDAD.UND_CODIGO and UND_ACTIVO = 1
                                        inner join ASUNTO on TRAMITE.ASU_CODIGO = ASUNTO.ASU_CODIGO and ASU_ACTIVO = 1
                                        inner join PARAMETRO on TRAMITE.TRA_PRM_ID = PARAMETRO.PRM_ID and PRM_ACTIVO = 1
                                        where TRA_ANULADO = 0
                                        and TRA_RECIBIDO = 1 ";
        if($codigo != ''){
            $sql = $sql." and TRA_CODIGO like '$codigo%' ";
        }
        if($asignado != '')
        {
            $sql = $sql." and TRA_CODIGO in (select TRA_CODIGO from ESTADO where UND_CODIGO = '$unidad' and
										 EST_ANULADO = 0 and TIP_CODIGO = 1 and EST_ASIGNADO_A like '$asignado%') ";
        }
        else{
            $sql = $sql." and TRA_CODIGO in (select TRA_CODIGO from ESTADO where UND_CODIGO = '$unidad' and EST_ANULADO = 0 and TIP_CODIGO = 1) ";
        }
        $sql = $sql." and TRA_PRM_ID = $parametro order by TRA_CODIGO desc;" ;
        $query = $this->tramite->query($sql);
        return $query->result_array();
    }
    function add($data)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $resp = $this->tramite->insert('TRAMITE', $data);
        if($data['UND_CODIGO'] == 1 && $resp) {
            $rev = $this->revisado($data);
            if($rev == 'TRUE')
                return $rev;
            else
                return 'Error';


        }
        else
            return $resp;

    }

    function revisado($data){
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d H:i:s");
        $this->tramite = $this->load->database('tramites', TRUE);
        /*if($aux == 0) {
            $tra_codigo = $this->tramite->query("SELECT max(tra_codigo) ultimo FROM [TRAMITES_V2018].[dbo].[TRAMITE]");
            $tra_codigo = $tra_codigo->result_array();
            $tra_codigo = $tra_codigo[0]['ultimo'];
        }
        else if($aux == 1)
        {*/
        $tra_codigo = $data['TRA_CODIGO'];
        /*}*/
        //Actualiza el tramite y lo recibe y genera los estados de secretaria y lo direciona a adquisiciones
        $this->tramite->query("update TRAMITE set TRA_FECHARECIBIDO = '$fecha', TRA_RECIBIDO = 1 where TRA_CODIGO = '$tra_codigo'");
        $und = $data['UND_CODIGO'];
        $tra_prm_id = $data['TRA_PRM_ID'];
        $this->tramite->query("insert into ESTADO (TIP_CODIGO,EST_OBSERVACION,TRA_CODIGO,UND_CODIGO,EST_FECHAINICIO,EST_FECHAFIN,EST_DESCRIPCION,EST_FECHARECIBIDO,EST_RECIBIDO,TRA_PRM_ID,EST_REVISAR,EST_REVISADO_UNIDAD,EST_ORIGEN,EST_ANULADO)
                                            values(4,NULL,$tra_codigo,183,'$fecha','$fecha',NULL,'$fecha',0,$tra_prm_id,0,0,0,0 )");
        $this->tramite->query("insert into ESTADO (TIP_CODIGO,EST_OBSERVACION,TRA_CODIGO,UND_CODIGO,EST_FECHAINICIO,EST_FECHAFIN,EST_DESCRIPCION,EST_FECHARECIBIDO,EST_RECIBIDO,TRA_PRM_ID,EST_REVISAR,EST_REVISADO_UNIDAD,EST_ORIGEN,EST_ANULADO)
                                            values(1,NULL,$tra_codigo,$und,'$fecha',NULL,NULL,'$fecha',NULL,$tra_prm_id,NULL,NULL,0,0 )");
        return 'TRUE';

    }

    function vaciar($idParametro, $data)
    {
        $idTramite = $data['TRA_CODIGO'];
        $this->tramite = $this->load->database('tramites', TRUE);
        $query =  $this->tramite->query("update tramite
                                        set tra_oficio=null,
                                        tra_beneficiario1=null,
                                        tra_beneficiario2=null,
                                        TRA_CEDULA1 = null,
                                        TRA_CEDULA2 = null,
                                        TRA_PROYECTO = null,
                                        TRA_COMPROMISO = null,
                                        TRA_PERSONA_AUTORIZA = null,
                                        TRA_TELEFONO = null,
                                        TRA_VALOR = null,
                                        TRA_DETALLE_FACTURA = null,
                                        TRA_FECHA_VIAJE_VIATICO = null,
                                        TRA_FECHA_VIAJE_FIN_VIATICO = null,
                                        TRA_DESTINO_VIATICO = null,
                                        TRA_RESPONSABLE_VIATICO = null,
                                        TRA_PERSONAS_ADIC_VIATICO = null,
                                        TRA_OBSERV_VIAJE_VIATICO = null,
                                        TRA_DESCRIPCION = null,
                                        TRA_GASTO = null,
                                        TRA_POSICION = null
                                        where tra_codigo = $idTramite
                                        and TRA_PRM_ID = $idParametro;
                                        ");
        if($query)
            return true;
        else
            return false;
    }

    function update($idParametro, $data)
    {
        $idTramite = $data['TRA_CODIGO'];
        unset($data['TRA_FECHA']);
        unset($data['TRA_CODIGO']);
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where('TRA_CODIGO', $idTramite);
        $this->tramite->where('TRA_PRM_ID', $idParametro);
        $resp = $this->tramite->update('TRAMITE', $data);
        if(isset($data['UND_CODIGO']))
        {

            if($data['UND_CODIGO'] == 1 && $resp)//si es de adquisiciones lo recibe y lo direcciona a la unidad
            {
                $data['TRA_CODIGO'] = $idTramite;
                $data['TRA_PRM_ID'] = $idParametro;
                $rev = $this->revisado($data);
                if($rev == 'TRUE')
                    return $resp;
            }
            else {
                return $resp;
            }
        }
        else {

            return $resp;
        }
    }

    function delete($idTramite, $idParametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->where_in('TRA_CODIGO', $idTramite);
        $this->tramite->where_in('TRA_PRM_ID', $idParametro);
        $this->tramite->set('TRA_ANULADO', 1);
        $r = $this->tramite->update('TRAMITE');
        if($r)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function recibido($idTramite, $idParametro)
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_RECIBIDO');
        $this->tramite->where('TRA_CODIGO', $idTramite);
        $this->tramite->where('TRA_PRM_ID', $idParametro);
        $r = $this->tramite->get('TRAMITE');
        if($r->result_array()[0]['TRA_RECIBIDO'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function reporteIngreso($tracodigo , $parametro)
    {
        //Se obtiene el tramite
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select('TRA_CODIGO,ASU_CODIGO,USR_USUARIO,convert(varchar, TRA_FECHA, 120) TRA_FECHA,TRA_OFICIO,TRA_BENEFICIARIO1,TRA_BENEFICIARIO2,TRA_CEDULA1
            ,TRA_CEDULA2,TRA_PROYECTO,TRA_COMPROMISO,TRA_PERSONA_AUTORIZA,TRA_TELEFONO,TRA_VALOR,TRA_DETALLE_FACTURA,TRA_FECHA_VIAJE_VIATICO
            ,TRA_FECHA_VIAJE_FIN_VIATICO,TRA_DESTINO_VIATICO,TRA_RESPONSABLE_VIATICO,TRA_PERSONAS_ADIC_VIATICO,TRA_OBSERV_VIAJE_VIATICO
            ,convert(varchar, TRA_FECHARECIBIDO, 120) TRA_FECHARECIBIDO,TRA_RECIBIDO,TRA_PRM_ID,UND_CODIGO,TRA_DESCRIPCION,TRA_ANULADO,TRA_GASTO,TRA_POSICION');
        $this->tramite->where('TRA_CODIGO', $tracodigo);
        $this->tramite->where('TRA_PRM_ID', $parametro);
        $query = $this->tramite->get('TRAMITE');

        $arreglo = $query->result_array();

        //Se obtiene el Nombre del parametro
        $this->tramite->select('PRM_NOMBRE');
        $this->tramite->where('PRM_ID', $parametro);
        $prmnombre = $this->tramite->get('PARAMETRO');
        $prmnombre = $prmnombre->result_array();

        $arreglo[0]['TRA_PRM_ID']=$prmnombre[0]['PRM_NOMBRE'];

        //Se obtiene el Nombre de la Unidad
        $this->tramite->select('UND_NOMBRE');
        $this->tramite->where('UND_CODIGO', $arreglo[0]['UND_CODIGO']);
        $undnombre = $this->tramite->get('UNIDAD');
        $undnombre = $undnombre->result_array();
        $arreglo[0]['UND_CODIGO']=$undnombre[0]['UND_NOMBRE'];

        //Se obtiene la descripcion del Asunto
        $this->tramite->select('ASU_DESCRIPCION');
        $this->tramite->where('ASU_CODIGO', $arreglo[0]['ASU_CODIGO']);
        $asudescripcion = $this->tramite->get('ASUNTO');
        $asudescripcion = $asudescripcion->result_array();
        $arreglo[0]['ASU_CODIGO']=$asudescripcion[0]['ASU_DESCRIPCION'];

        return $arreglo;
    }
    public function getUltimoTraCodigo($parametro)//trae el ultimo codigo de tramite y lo aumenta en uno o en aso de ser nulo lo manda como 1
    {
        $this->tramite = $this->load->database('tramites', TRUE);
        $this->tramite->select_max('TRA_CODIGO');
        $this->tramite->from('TRAMITE');
        $this->tramite->where('TRA_PRM_ID', $parametro);
        $query = $this->tramite->get();
        $tracodigo = $query->result_array();
        if($tracodigo[0]['TRA_CODIGO'] != null){
            $tracodigo[0]['TRA_CODIGO']++;
        }
        else
            $tracodigo[0]['TRA_CODIGO'] = 1;
        return $tracodigo[0]['TRA_CODIGO'];
    }
}