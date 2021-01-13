<?php

class MY_Form_validation extends CI_Form_validation
{

	public $CI;

	public function __construct(){

		$this->CI =& get_instance();

	}

	/**
	 * Verifica se o CPF informado é valido
	 * @param     string
	 * @return     bool
	 */
	public function validate_cpf($cpf)
	{
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);

		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 ||
				$cpf == '00000000000' ||
				$cpf == '11111111111' ||
				$cpf == '22222222222' ||
				$cpf == '33333333333' ||
				$cpf == '44444444444' ||
				$cpf == '55555555555' ||
				$cpf == '66666666666' ||
				$cpf == '77777777777' ||
				$cpf == '88888888888' ||
				$cpf == '99999999999') {
					return FALSE;
				} else {
					// Calcula os números para verificar se o CPF é verdadeiro
					for ($t = 9; $t < 11; $t++) {
						for ($d = 0, $c = 0; $c < $t; $c++) {
							$d += $cpf{$c} * (($t + 1) - $c);
						}

						$d = ((10 * $d) % 11) % 10;
						if ($cpf{$c} != $d) {
							return FALSE;
						}
					}
					return TRUE;
				}
    }
    
	/**
	 * Verifica se o campo informado já esta cadastrado no banco de dados
	 * @param     string $value
     * @param     string $params
	 * @return     bool
	 */
    function is_unique_field($value, $params){

		$CI =& get_instance();

		list($table, $field, $primary_key, $current_id) = explode(".", $params);

		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

		if ($query->row() && $query->row()->{$primary_key} != $current_id)
		{
			return FALSE;
		} else {
			return TRUE;
        }
	}
    
    /**
	 * Verifica se o CNS (Cartão Nacional de Saúde) informado é valido
	 * @param     string $value
     * @param     string $params
	 * @return     bool
	 */
    public function validate_cns($value,$attribute): bool
    {

        $cns = preg_replace('/[^\d]/', '', $value);

        // CNSs definitivos começam em 1 ou 2 / CNSs provisórios em 7, 8 ou 9
        if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $cns) || preg_match("/[7-9][0-9]{14}/", $cns)) {
            return $this->soma_ponderada_cns($cns) % 11 == 0;
        }

        return false;
    }

    private function soma_ponderada_cns($value): int
    {
        $soma = 0;

        for ($i = 0; $i < mb_strlen($value); $i++) {
            $soma += $value[$i] * (15 - $i);
        }

        return $soma;
    }
    
}