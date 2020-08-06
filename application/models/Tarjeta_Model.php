<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tarjeta_Model extends CI_Model
{
    function __construct()
	{
		$this->load->database();
	}

	   public function buscaMifare($query)
	{
		$this->db->like('COD_MIFARE', $query);
                $query= $this->db->get('MIFARE_CODIGOBARRA');
                if($query->num_rows()>0){
                    return $query;
                                 
                }
                else
                {
                    return FALSE;
                }
	}
          public function buscacodigo($query)
	{
		    $this->db->like('CODIGO_BARRA', $query);
            $query= $this->db->get('MIFARE_CODIGOBARRA');
                if($query->num_rows()>0){
                    return $query;
                                 
                }
                else
                {
                    return FALSE;
                }
    }
    public function importData($data)
	{
		$res = $this->db->insert_batch('OTRAS_TARJETAS', $data);
		if ($res) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
    public function findAll()
    {
         return $this->db->get('OTRAS_TARJETAS')->result_array();
        
    }
    public function findByCodMifare($cod_mifare){
        
        return $this->db->get_where('OTRAS_TARJETAS',['cod_mifare'=>$cod_mifare]);

    }

}
?>