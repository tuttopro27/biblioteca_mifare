<?php
class Import_Model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
	public function mostrarDatos()
	{
		$query = $this->db->get('MIFARE_CODIGOBARRA');
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return false;
		}
	}
	public function importdata($data)
	{
		$res = $this->db->insert_batch('OTRAS_TARJETAS', $data);
		if ($res) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function num_post()
		{
			$number = $this->db->query("select count(*)as number from MIFARE_CODIGOBARRA")->row()->number;
			return intval($number);
		}
	public function get_pagination($number_per_page)
	{
		$this->db->get("MIFARE_CODIGOBARRA", $number_per_page, $this->uri->segment(3));
	}
	public function numero_registro($p_cod_mifare, $p_codigo_barra)
		{
			$registro_tabla = $this->db->query("select count(*) as number from MIFARE_CODIGOBARRA where cod_mifare='".$p_cod_mifare."' or codigo_barra='".$p_codigo_barra."'")->row()->number;
			return intval($registro_tabla);
		}
	}
?>
