<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class generalsController extends Controller
{

    //========================================================================================
    // GERAR SENHA ALFANUMERICA DE 8 DIGITOS
    public static function getRandomCode()
    {
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $valor = '';
        for($m=0; $m<8; $m++)
        {
            $index = rand(0, strlen($an));
            $valor.= substr($an,$index,1);
        }
        return $valor;
    }
    //========================================================================================
    // RETIRAR PARENTESES E TRAÇOS DO TELEFONE
    public static function phoneWithoutPoints($num)
    {
        $num = str_replace("(" , "" , $num); // Primeiro tira os parenteses
        $num = str_replace(")" , "" , $num); // Primeiro tira os parenteses
        $num = str_replace(" " , "" , $num); // Primeiro tira os parenteses
        $num = str_replace("-" , "" , $num); // Primeiro tira os traços
        return $num;
    }
    //========================================================================================
    // VALORES MONETÁRIOS NO PADRÃO SQL
    public static function numberWithoutPoints($number)
    {
        $valor = str_replace("." , "" , $number); // Primeiro tira os pontos
        $valor = str_replace("," , "." , $valor); // Agora tira as virgulas
        return $valor;
    }
    //========================================================================================
    // VALORES MONETÁRIOS NO PADRÃO BRASILEIRO
    public static function numberBrazilianModel($num)
    {
        return number_format($num, 2, ',', '.'); // retorna R$100.000,50
    }
    //========================================================================================
    // RETIRAR BARRAS DA DATA
    public static function dateWithoutslash($date)
    {
        $valor = str_replace("/" , "" , $date); // Retirar as barras
        return $valor;
    }
    //========================================================================================
    // RETIRAR PONTOS E TRAÇO DO CPF
    public static function cpfWithoutslash($data)
    {
        $valor = str_replace("-" , "" , $data); // Retirar as barras
        $valor = str_replace("." , "" , $valor); // Retirar as barras
        return $valor;
    }
    //========================================================================================
    // RETIRAR PONTOS E TRAÇO DO CNPJ
    public static function cnpjWithoutslash($data)
    {
        $valor = str_replace("-" , "" , $data); // Retirar traços
        $valor = str_replace("/" , "" , $valor); // Retirar as barras
        $valor = str_replace("." , "" , $valor); // Retirar os pontos
        return $valor;
    }
    //========================================================================================
    // SUBSTITUIR BARRAS POR TRAÇOS NA DATA
    public static function dateSubstituteslash($date)
    {
        return implode("-",array_reverse(explode("/",$date)));
    }
    public static function dateBrazilian($date)
    {
        return implode("/",array_reverse(explode("-",$date)));
    }
    //========================================================================================
    // FUNÇÃO PARA CRIAR MASCARAS
    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            }
            else
            {
                if(isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
    //========================================================================================
    // FUNÇÃO TRANSFORMAR TIMESTAMP EM DATA BRASILEIRA
    public static function timeStampDataBrasil($param)
    {
        $data = substr($param,0,10);
        return implode("/",array_reverse(explode("-",$data)));
    }
    public function timestampToBrazilDate($date)
    {
        return $data = explode(' '. $date);
    }


    //========================================================================================
    // FUNÇÃO VERIFICAR CPF
    public static function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    //========================================================================================
    // FUNÇÃO VERIFICAR CNPJ

    public static function validarCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if($cnpj[13] == ($resto < 2 ? 0 : 11 - $resto));
        return true;
    }


    //========================================================================================
    // FUNÇÃO VERIFICAR CNPJ
    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

    //========================================================================================
    // FUNÇÃO FORMATAR MES/ANO
    public static function formatarMesAno($data){

        $ano = substr($data,0,4);
        $mes = substr($data,5,7);

        return $mes.'/'.$ano;
    }


}
