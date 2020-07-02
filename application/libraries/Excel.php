<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
  
require_once "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
  
class Excel extends Spreadsheet {
    public function __construct() {
        parent::__construct();
    }
}
?>