<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));

        $this->load->model('Import_Model');
        $this->load->library('Excel');
    }
    function index()
    {
        $data = array(
            'mifarecodBarra' => $this->Import_Model->mostrarDatos()
        );
        
        $this->load->view('import', $data);
    }
    function verDatos()
    {
        $data = array(
            'mifarecodBarra' => $this->Import_Model->mostrarDatos()
        );
        $this->load->view('headers');
        $this->load->view('mostrarDatos', $data);
    }    
    /**
     * importFile recibe un archivo mediante post request y lo procesa.
     * 
     * @return json_encode
     */
    
    function importFile()
    {
            
        try {
            //recibir el request
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'xlsx|xls';
            $config['max_size']             = 200;
          
            $this->load->library('upload', $config);
            //validar request
            if ( ! $this->upload->do_upload('uploadFile'))
            {
                throw new Exception($this->upload->display_errors());
            }
            
            //procesar request
            $data = array('upload_data' => $this->upload->data());
            //var_dump($data);
            $inputFileName= $data["upload_data"]["full_path"];
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(true, true, true, true);
            $flag = true;
            $i = 0;
            
            foreach ($allDataInSheet as $value) {
                // if ($flag) {
                //     $flag = false;
                //     continue;
                // }
                #$inserdata = array();
                $qty = $this->Import_Model->numero_registro($value['A'], $value['B']);
                if($qty == 0)
                {
                    //var_dump($value);
                    $inserdata[$i]['cod_mifare'] = $value['A'];
                    $inserdata[$i]['codigo_barra'] = $value['B'];
                    $i++;
                }
            }
            $result=false;
            if(isset($inserdata)){
                $result = $this->Import_Model->importdata($inserdata);
            }
            //revisar esta logica
            if(!$result){
                throw new Exception("Proceso culminado satisfactoriamente, los registros ya existen en la base de datos");
            }
            
            //validar si el proceso fue correcto
            
            //retornar mensaje error
            echo json_encode(["status" => true, "message" => "Proceso culminado satisfactoriamente, se procesaron " .$i. " registros "]);
        } catch (Exception $e) {
            //logear el error

            //retornar el mensaje de error
            //echo $e->getMessage();
            echo json_encode(["status" => false, "message" => $e->getMessage()]);
        }
        
    }
    function getCardsTable(){
        $data = array(
            'mifarecodBarra' => $this->Import_Model->mostrarDatos()
        );
        echo $this->load->view('/partials/cards-table', $data, true);
    }
}
