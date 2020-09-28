<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MX_Controller
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

        $this->load->model('Usuario_model', 'Model');
        }

    }

    public function index()
    {
        $result = $this->Model->getUnidad($this->input->post('usuario'));//retorna la unidad asociada al usuario
        $r = array("data" => $result,
            "success" => "true");

        echo json_encode($r);
    }
    public function unidades(){
        $result = $this->Model->getUnidad($this->input->post('usuario'));//retorna la unidad asociada al usuario
        $r = array("data" => $result,
            "success" => "true");

        echo json_encode($r);
    }
    public function save()//crea un nuevo usuario
    {
        $data =  json_decode($this->input->post('data'), TRUE);
        //$data['USR_USUARIO'] = $this->input->post('usuario');
        $result = $this->Model->add($data);
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }
    public function update(){
        $data =  json_decode($this->input->post('data'), TRUE);
        /*if(is_array($data[0])){
            $data = $data[0];
        }*/
        if($this->input->post('accion')== 1)
            $result = $this->Model->add($data);//crea usuario
        else if($this->input->post('accion')== 0)
            $result = $this->Model->update($data, $this->input->post('usuario'));//actualiza usuario
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }

    public function delete()//elimina usuario
    {
        $data = json_decode($this->input->post('data'), TRUE);
        unset($data['id']);
        $data['USR_ACTIVO'] = 0;
        $result = $this->Model->delete($data, $this->input->post('usuario'));
        if($result)
            $r = array("success" => "true");
        else
            $r = array("failure" => "true");
        echo json_encode($r);
    }

    public function get(){

        if($this->input->post('usr')== 1)
            $result = $this->Model->getUsuarios();//obtiene todos los usuarios
        else if($this->input->post('usr')==2)
            $result = $this->Model->getUsuariosxUnidad($this->input->post('unidad'));//obtiene todos los usuarios por unidad
        else if($this->input->post('usr')==3)
            $result = $this->Model->getUsuariosxParametro($this->input->post('parametro'));//obtiene todos los usuarios por parametro
        else if($this->input->post('usr')==4)
            $result = $this->Model->getFaltantes($this->input->post('parametro'));//obtiene todos los usuarios por parametro
        else
            $result = $this->Model->getUsuariosActivos();//obtiene solo los usuarios que estan activos
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
    public function getUsuarioBusqueda(){//presenta los usuario por medio de un like
        $result = $this->Model->busquedaUsuario($this->input->post('usuario'));
        $r = array("data"    => $result,
            "success" => "true");
        echo json_encode($r);
    }

    public function getRolUsuario(){//retorna el rol de un usuario en un parametro
        $result = $this->Model->revisa_rol_tramites($this->input->post('usuario'),$this->input->post('parametro'));
        if(!empty($result))
            $r = array("data"    => $result,
            "success" => "true");
        else
            $r = array("success" => "false");
        echo json_encode($r);
    }

    public function getBusquedaCedula(){
        $result = $this->Model->busquedaCedula($this->input->post('cedula'));
        $r = array("data" => $result,
            "success" => "true");
        echo json_encode($r);
    }
    public function roles()
    {
        $result = $this->Model->getRoles();
        $r = array("data"    => $result,
            "success" => "true");

        echo json_encode($r);
    }
    public function saveRolUsuario(){
        $this->Model->addRol($this->input->post('usuario'));
        $this->Model->updateRol($this->input->post('usuario'));
    }
    public function verifica(){
        $result = $this->Model->verifica_unidad($this->session->session_usuario_apps);
        if($result >= 0)
            $r = array("data"    => $result,
                "success" => "true");
        else
            $r = array("success" => "false");
        echo json_encode($r);
    }
}