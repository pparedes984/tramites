<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends MX_Controller {

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

            $this->load->model('Registro_model', 'Model');
        }
    }

    public function index()
    {
    }
    public function update(){

            $data = json_decode($this->input->post('data'), true);

            $idParametro = $this->input->post('idParametro');
            $data['TRA_FECHARECIBIDO'] = $this->input->post('fechaRecibido');
            //unset($data['id']);

            $data['USR_USUARIO'] = $this->session->session_usuario_apps;
            $tracodigo = $data['TRA_CODIGO'];

            $verificar = $this->Model->recibido($tracodigo, $idParametro);//Verifica si el registro ha sido recibido antes
            if ($verificar)
                $result = false;
            else {
                $this->Model->vaciar($idParametro, $data);//pone todos los valores en NULL
                $result = $this->Model->update($idParametro, $data);//actualiza los nuevos valores
            }
            if ($result) {
                $r = array("success" => "true");
                //"newId"   => $result);
            } else//Error
            {
                if ($verificar == true)//Error si el tramite ya ha sido recibido
                    $r = array("success" => "false",
                        "message" => "El tramite ya fue recepcionado, no se puede editar");
                else
                    $r = array("success" => "false",
                        "message" => "No se pudo editar");
            }
            echo json_encode($r);
    }
    public function save()
    {
        $data =  json_decode($this->input->post('data'), TRUE);

        $data['TRA_CODIGO'] = $this->Model->getUltimoTraCodigo($this->input->post('idParametro'));//trae el ultimo codigo de un tramite ingresado
        $data['USR_USUARIO'] = $this->session->session_usuario_apps;
        $data['TRA_PRM_ID'] = $this->input->post('idParametro');
        $result = $this->Model->add($data);//agrega un nuevo tramite

        if($result)
        {
            $r = array("success" => "true");
        }
        else
        {
            $r = array("success" => "false",
                "message"=>'Error');
        }

        echo json_encode($r);
    }
    public function get_tramite(){
        $data['USR_USUARIO'] = $this->session->session_usuario_apps;
        $usuario = $data['USR_USUARIO'];
        if($this->input->post('busqueda')== 1)//Busqueda para trámites
            $result = $this->Model->get_tramite_busqueda_direccionar($this->input->post('tramite'), $this->input->post('parametro'));
        else if($this->input->post('busqueda')== 2)//Trámites sin anular de todos los usuarios
            $result = $this->Model->get_tramite_direccionar($this->input->post('parametro'),$this->input->post('codigo'),$this->input->post('asignado'));
        else if($this->input->post('busqueda')==3 )
            $result = $this->Model->get_tramite_unidad_dir($this->input->post('unidad'), $this->input->post('parametro'),$this->input->post('codigo'),$this->input->post('asignado'));
        else if($this->input->post('busqueda')== 4){//Busqued general para el panel nuevo tramite
            $result = $this->Model->get_tramite_busqueda_nuevo($this->input->post('tramite'), $this->input->post('parametro'),$usuario);
        }

        if(!empty($result))
        {
            $r = array("data"    => $result,
                "success" => "true");
        }
        else
        {
            $r = array("success" => "false");
        }

        echo json_encode($r);
    }

    public function delete()
    {
        $verificar = $this->Model->recibido($this->input->post('idTramite'), $this->input->post('idParametro'));//Verifica si el registro ha sido recibido antes
        if ($verificar)
            $result = false;
        else
            $result = $this->Model->delete($this->input->post('idTramite'), $this->input->post('idParametro'));//elimina el registro

        if($result)
        {
            $r = array("success" => "true");
        }
        else//Error
        {
            if($verificar == true)//Error si el tramite ya ha sido recibido
                $r = array("failure" => "true",
                    "message"=>"El tramite ya fue recepcionado, no se puede anular");
            else
                $r = array("failure" => "true",
                    "message"=>"No se pudo anular");
        }
        echo json_encode($r);
    }

    public function getReporte()//Imprimir
    {
        $tracodigo = $this->input->post('tracodigo');
        $parametro = $this->input->post('parametro');
        $result = $this->Model->reporteIngreso($tracodigo, $parametro);
        $data['resultados'] = $result;
        $html = $this->load->view('ReporteTramiteView', $data, TRUE);
        $pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
        $pdf->SetTitle('Reporte de tramite');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(40);
        $pdf->SetMargins(25, 20, 20, TRUE);
        $pdf->SetAutoPageBreak(TRUE);
        $pdf->SetAuthor('Pontificia Universidad Católica del Ecuador');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(FALSE);
        $pdf->setPrintFooter(FALSE);
        $pdf->AddPage();
        $pdf->writeHTML($html, TRUE, 0, TRUE, 0);
        $filename = $this->config->item('upload_dir_tramite') . 'tramiteReporte.pdf';

        $pdf->Output($filename, 'F');
        echo('../documentos/tramites/tramiteReporte.pdf');
    }
}