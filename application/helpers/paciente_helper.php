<?php

if (!function_exists('criar_pasta')){
	
	function criar_pasta($pasta){
		
		if (!file_exists($pasta)){
			
			mkdir($pasta, 0777);
			
			$html = "<!DOCTYPE html>";
			$html .= "<html>";
			$html .= "<head>";
			$html .= "<title>403 Forbidden</title>";
			$html .= "</head>";
			$html .= "<body>";
			$html .= "<p>Directory access is forbidden.</p>";
			$html .= "</body>";
			$html .= "</html>";
			
			$fh = fopen($pasta.'index.html', 'w');
			
			fwrite($fh, $html."\n");
            fclose($fh);	
		}
	}
}

if (!function_exists('gerar_string_randomica')){
	
	function gerar_string_randomica($length=30){
 
		return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,$length);

	}
}

if (!function_exists('excluir_arquivo')) {
	
	function excluir_arquivo($obj){

		if (file_exists($obj)) unlink($obj);
	}
}

if (!function_exists('formata_data_db')) {
	
	function formata_data_db($date){
		
		if (strlen($date) == 10) {

			return implode("-",array_reverse(explode("/",$date)));
	
		} else {
			
			return null;
		}
	}
}

if (!function_exists('formata_data_br')) {
	
	function formata_data_br($date){
		
		if (strlen($date) == 10) {

			return implode("/",array_reverse(explode("-",$date)));
	
		} else {
			
			return null;
		}
	}
}

?>