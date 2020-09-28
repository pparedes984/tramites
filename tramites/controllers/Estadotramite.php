<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estadotramite extends MX_Controller
{

    public function __construct()
    {

        parent::__construct();

        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit();
        }
        else
        {

            $this->load->model('EstadoTramite_model', 'Model');
        }
    }

    public function index()
    {
        $result = $this->Model->get($this->input->post('id'));
        $r = array("data"    => $result,
            "success" => "true");

        echo json_encode($r);
    }

    public function save()
    {
        $data = json_decode($this->input->post('data'), TRUE);
        $idEstado = $data['EST_CODIGO'];
        unset($data['EST_CODIGO']);
        unset($data['TIP_NOMBRE']);
        unset($data['UND_NOMBRE']);
        if($idEstado == 0)//si es nuevo
        {
            $data['TRA_CODIGO']= $this->input->post('idtramite');
            $data['TRA_PRM_ID']= $this->input->post('idparametro');
            date_default_timezone_set('America/Bogota');
            $data['EST_FECHARECIBIDO']= date("Y-m-d H:i:s");
            $data['EST_FECHAINICIO'] = $this->input->post('fechaInicio');
            $data['EST_ORIGEN'] = $this->input->post('origenest');
            $unidad = $this->input->post('unidad');
            $result = $this->Model->add($data,$unidad);
        }
        else//si es para actualizar
        {
            date_default_timezone_set('America/Bogota');
            $data['EST_FECHAFIN'] = date("Y-m-d H:i:s");
            $result = $this->Model->update($idEstado, $data);
        }

        if($result)
        {
            $r = array("success" => "true");
            //"newId"   => $result);
        }
        else
        {
            $r = array("failure" => "true");
        }

        echo json_encode($r);

    }

    public function delete()//anula el tramite
    {
        $id = $this->input->post('idEstado');
        $result = $this->Model->delete($id);

        if($result == 'TRUE')
        {
            $r = array("success" => $id);
        }
        else//Error
        {
            $r = array("failure" => "true",
                "message"=>"No se pudo anular");
        }
        echo json_encode($r);
    }
    public function verificaJefe(){//verifica la existencia del jefe
        $result = $this->Model->verificarJefe($this->input->post('usuario'), $this->input->post('unidad'));
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);

    }
    public function getEstados(){
        if($this->input->post('busqueda')== 1)//obtiene todos los destinos de un tramite (para la pantalla de direccionamiento)
            $result = $this->Model->get($this->input->post('idtramite'), $this->input->post('idparametro'));
        else if($this->input->post('busqueda')== 2) {
            /*obtiene un unico registro de destino que corresponde a una unidad de direccionamiento para
            que pueda tramitar su parte respecto a ese tramite, si esta finalizado ya no se muestra*/
            $result = $this->Model->getDestino($this->input->post('idtramite'), $this->input->post('idparametro'), $this->input->post('unidad'));
        }
        if($result <> 'FALSE')
        {
            //$r = array("success" => "true");
            $r = array("data"    => $result,
                "success" => "true");
        }
        else
        {
            $r = array("failure" => "true");
        }
        echo json_encode($r);
    }
}