<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarjeta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tarjeta_Model');
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
            $cards = $this->Tarjeta_Model->buscaMifare(trim($query));
            if ($cards != FALSE) {
                $data = array('cards' => $cards);
            } else {
                $data = array('cards' => '');
            }
        }
        $this->load->view('buscaMifare', $data);
    }
    public function buscacodigo()
    {
        $data = array();
        $query = $this->input->post('query', true);
        if ($query) {
            $cards = $this->Tarjeta_Model->buscacodigo(trim($query));
            if ($cards != FALSE) {
                $data = array('cards' => $cards);
            } else {
                $data = array('cards' => '');
            }
        }
        $this->load->view('buscaCodigo', $data);
    }
}
