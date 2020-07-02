<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarjeta extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tarjeta_Model');
        //$this->load->view('buscaMifare');
    }

    public function index()
    {
        
        $this->load->view('home');
    }

    public function buscaMifare()
    {
        $data = array();
        $query = $this->input->post('query', true);
        if ($query) {
            $result = $this->Tarjeta_Model->buscaMifare(trim($query));
            if ($result != FALSE) {
                $data = array('result' => $result);
            } else {
                $data = array('result' => '');
            }
        }
        
        $this->load->view('buscaMifare', $data);
    }

    public function buscacodigo()
    {

        // $query=0;
        $data = array();
        $query = $this->input->post('query', true);
        
        
        if ($query) {
            $resultado = $this->Tarjeta_Model->buscacodigo(trim($query));
            if ($resultado != FALSE) {
                $data = array('resultado' => $resultado);
            } else {
                $data = array('resultado' => '');
            }
        }
        
        $this->load->view('buscaCodigo', $data);
        
    }
}
