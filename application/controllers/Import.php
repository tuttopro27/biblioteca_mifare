
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
    *Uso de la libreria PhpSpreadsheet
    *
*/

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Tarjeta_Model');
        $this->load->library('Excel');
    }
    function index()
    {
        $tarjetas = $this->Tarjeta_Model->findAll();
        $data['tarjetas'] = $tarjetas;
        $this->load->view('import', $data);
    }
    function verDatos()
    {
        $tarjetas = $this->Tarjeta_Model->findAll();
        $data['tarjetas'] = $tarjetas;
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
            $config['allowed_types']        = 'xlsx|xls|ods';
            $config['max_size']             = 200;
            $this->load->library('upload', $config);
            //validar request
            
            if (!$this->upload->do_upload('uploadFile')) {
                throw new Exception($this->upload->display_errors());
            }
            //procesar request
            $data = array('upload_data' => $this->upload->data());
            $inputFileName = $data["upload_data"]["full_path"];
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPhpOffice = $objReader->load($inputFileName);
            $allDataInSheet = $objPhpOffice->getActiveSheet()->toArray(true, true, true, true);
            $i = 0;
            $cod_mifare_prev = $allDataInSheet[1]['A'];
            $registersNoInsert = [];
            foreach ($allDataInSheet as $value) {
                $cod_mifare = $value['A'];
                $cod_barra = $value['B'];
                if (!preg_match('/^[0-9A-Za-z]{8}$/', $cod_mifare)) {
                    $registersNoInsert[] = ["codigo" => $cod_mifare, "description" => "Codigo Mifare no es valido, debe ser de 8 caracteres"];
                    continue;
                }
                if ($i > 0) {
                    if ($cod_mifare == $cod_mifare_prev) {
                        $registersNoInsert[] = ["codigo" => $cod_mifare, "description" => "Codigo Mifare duplicado en el archivo"];
                        continue;
                    }
                    $cod_mifare_prev = $cod_mifare;
                }
                $qty = $this->Tarjeta_Model->findByCodMifare($cod_mifare)->num_rows();
                if ($qty == 0) {
                    $inserdata[$i]['cod_mifare'] = $cod_mifare;
                    $inserdata[$i]['codigo_barra'] = $cod_barra;
                    
                    $i++;
                } else {
                    $registersNoInsert[] = ["codigo" => $cod_mifare, "description" => "Codigo Mifare ya existe en la base de datos"];
                }                         
            }
            $result = false;
            if (isset($inserdata)) {
                $result = $this->Tarjeta_Model->importData($inserdata);
            }
            //revisar esta logica
            if (!$result) {
                throw new Exception("Proceso culminado satisfactoriamente, los registros ya existen en la base de datos");
            }
            echo json_encode(["status" => true, "message" => "Proceso culminado satisfactoriamente, se procesaron " . $i . " registros ", "No_Insertados" => $registersNoInsert]);
        } catch (Exception $e) {
            echo json_encode(["status" => false, "message" => $e->getMessage(), "No_Insertados" => $registersNoInsert]);
        }
    }
    function getCardsTable()
    {
        $tarjetas = $this->Tarjeta_Model->findAll();
        $data['tarjetas'] = $tarjetas;
        echo $this->load->view('/partials/cards-table', $data, true);
    }
}