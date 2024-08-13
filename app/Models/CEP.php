<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CEP extends Model
{
    use HasRoles, Tenantable;
    protected $guarded = ['id'];

    // public function newId(){
    //     //contando excluindo o global scope
    //     $count = $this->withoutGlobalScopes()->get();
    //     if($count->count()==0){
    //         $this->id = 1;
    //     }else{
    //       $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
    //     }
    // }

 public static function getCoordenadaCep($cep){
    $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        // $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "https://cep.awesomeapi.com.br/json/".$cep);
        // curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        // echo    '<pre>';
        // print_r($obj);
        // echo '</pre>';
        // return response()->json($obj);
        return $obj;
 }
}
