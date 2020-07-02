<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tarjeta_Model extends CI_Model
{
	   public function buscaMifare($query)
	{
		$this->db->like('cod_mifare', $query);
                $query= $this->db->get('mifare_codigobarra');
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
		    $this->db->like('codigo_barra', $query);
            $query= $this->db->get('mifare_codigobarra');
                if($query->num_rows()>0){
                    return $query;
                                 
                }
                else
                {
                    return FALSE;
                }
	}
}?>