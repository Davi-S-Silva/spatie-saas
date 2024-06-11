<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Nota extends Model
{
    use HasFactory,HasRoles;


    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }
        else{
            $this->id = $this->all()->last()->id +=1;
        }
    }

    private function formataTextNotas($textNotas)
    {
        $array =  str_replace('_', '', str_replace('__', '-', $this->limpar_texto(str_replace('Número: ', '', $textNotas))));

        return $array;
    }

    private function limpar_texto($str){
        return preg_replace("/[^0-9]/", "_", $str);
    }

    public function getNotas($notas){
        $pasta = getEnv('RAIZ') . Storage::disk('local')->url('app/public/notas');
        $diretorio = dir($pasta);
        $arrayNotas = explode('-',$this->formataTextNotas($notas));

        while(($arquivo = $diretorio->read()) !== false){
            if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'Autorizada' && $arquivo != 'Nao autorizada') {
                $file = $pasta . '/' . $arquivo;
                $xml = simplexml_load_file($file);
                for($i = 0; $i < count($arrayNotas); $i++){
                    if ((int)$xml->NFe->infNFe->ide->nNF == $arrayNotas[$i]) {
                        // $this->getDadosXmlNota($xml);
                        // $this->getDadosXmlNota($xml);
                        $nota = new Nota();
                        $nota->nota = (int)$xml->NFe->infNFe->ide->nNF;
                        $nota->chave_acesso = str_replace('NFe','',$xml->NFe->infNFe['Id']);
                        $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
                        $nota->prestacao = 0;
                        $nota->peso = ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB)? (double)$xml->NFe->infNFe->transp->vol->pesoL:(double)$xml->NFe->infNFe->transp->vol->pesoB;
                        $nota->indicacao_pagamento = (int)$xml->NFe->infNFe->pag->detPag->indPag;
                        $nota->tipo_pagamento = (int)$xml->NFe->infNFe->pag->detPag->tPag;
                        $nota->valor = (double)$xml->NFe->infNFe->pag->detPag->vPag;


                        // return $arrayNotas[$i];
                    }
                }
            }
        }
    }
    private function getDadosXmlNota($xml)
    {
        $nota = new Nota();
        $nota->nota = (int)$xml->NFe->infNFe->ide->nNF;
        $nota->chave_acesso = str_replace('NFe','',$xml->NFe->infNFe['Id']);
        $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
        $nota->prestacao = 0;
        $nota->peso = ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB)? (double)$xml->NFe->infNFe->transp->vol->pesoL:(double)$xml->NFe->infNFe->transp->vol->pesoB;
        $nota->indicacao_pagamento = (int)$xml->NFe->infNFe->pag->detPag->indPag;
        $nota->tipo_pagamento = (int)$xml->NFe->infNFe->pag->detPag->tPag;
        $nota->valor = (double)$xml->NFe->infNFe->pag->detPag->vPag;
        // $nota->save();

        return $nota;
    }
}
