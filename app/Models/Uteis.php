<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Uteis extends Model
{
    // use HasRoles;
    // protected $guarded = ['id'];

    // public function newId(){
    //     //contando excluindo o global scope
    //     $count = $this->withoutGlobalScopes()->get();
    //     if($count->count()==0){
    //         $this->id = 1;
    //     }else{
    //       $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
    //     }
    // }

    public static function limpar_texto($str){
        $text = preg_replace("/[^0-9-a-z-A-Z]/", "_", $str);
        $arrayLimpo = str_replace('_', '', str_replace('__', '-',$text));
        $explode = explode('-', $arrayLimpo);
        $limpaNumero = [];
        foreach($explode as $numero){
            $num = (int) preg_replace("/[^0-9]/", "", $numero);
            if($num!=0){
                $limpaNumero[] =$num;
            }
        }
        return $limpaNumero;
    }

    public static function validaNumero($numero){
        $virgulaPosicao = strpos($numero,',');
        $pontoPosicao = strpos($numero,'.');
        // echo '<br /> '.$numero . '<br />';
        $numeroLimpo=$numero;
        if(str_contains($numero,',')){
            // echo 'contem virgula';
            if(substr_count($numero,',')>1){
                $msg = 'Valor digitado incorreto, verifique o numero digitado! dica: o número não pode ter duas vírgulas.';
                throw new Exception($msg);
            }
            if($pontoPosicao>$virgulaPosicao && str_contains($numero,'.')){
                $msg = 'Valor digitado incorreto, verifique o numero digitado! dica: a vírgula não poder ser antes do ponto.';
                throw new Exception($msg);
            }
            $numeroLimpo = str_replace(',','.',str_replace('.','',$numero));
            // echo '<br />aqui virgula<hr />';
        }


        if(str_contains($numero,'.') && !str_contains($numero,',')){
            // echo 'contem '.substr_count($numero,'.').' ponto';
            // echo $numeroLimpo = str_replace(',','.',str_replace('.','',$numero));
            $pontoPosicao = strpos($numero,'.');
            // echo '<br />tamanho: ';
            $tamanho  = strlen($numero);
            // echo '<br />tamanho ate o ponto: '. $tamanho-3;
            // echo '<br />posicao do ponto: '. $pontoPosicao;
            if($pontoPosicao!=($tamanho-3)){
                $msg = 'erro: posição do ponto incorreta!';
                throw new Exception($msg);
            }
            if(substr_count($numero,'.')>1){
                $msg = 'Valor digitado incorreto, verifique o numero digitado! dica: o número não pode ter dois pontos.';
                throw new Exception($msg);
            }
            if($pontoPosicao>$virgulaPosicao && str_contains($numero,',')){
                $msg = 'Valor digitado incorreto, verifique o numero digitado! dica: a vírgula não poder ser antes do ponto.';
                throw new Exception($msg);
            }
            //$numeroCorreto = $numeroLimpo;
            // echo '<br />aqui ponto<hr />';
            $numeroLimpo=$numero;
        }
        return $numeroLimpo;
    }
}
