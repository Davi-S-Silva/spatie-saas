<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Nota extends Model
{
    use HasFactory, HasRoles;


    public function newId()
    {
        $count = $this->all();
        if ($count->count() == 0) {
            $this->id = 1;
        } else {
            $this->id = $this->all()->last()->id += 1;
        }
    }

    private function formataTextNotas($textNotas)
    {
        $array =  str_replace('_', '', str_replace('__', '-', $this->limpar_texto(str_replace('Número: ', '', $textNotas))));

        // return $textNotas['Notas'][0];
        return $array;
    }

    private function limpar_texto($str)
    {
        return preg_replace("/[^0-9]/", "_", $str);
    }

    public function getNotas($notas, $carga)
    {

        // return $carga;
        $pasta = getEnv('RAIZ') . Storage::disk('local')->url('app/public/notas');
        $diretorio = dir($pasta);

        // return $this->formataTextNotas($notas);
        $arrayNotas = explode('-', $this->formataTextNotas($notas));

        while (($arquivo = $diretorio->read()) !== false) {
            if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'Autorizada' && $arquivo != 'Nao autorizada') {
                $file = $pasta . '/' . $arquivo;
                $xml = simplexml_load_file($file);
                for ($i = 0; $i < count($arrayNotas); $i++) {
                    if ((int)$xml->NFe->infNFe->ide->nNF == $arrayNotas[$i]) {
                        // $this->getDadosXmlNota($xml);
                        // $this->getDadosXmlNota($xml);


                        $destinatario = Destinatario::where('cpf_cnpj', $xml->NFe->infNFe->dest->CNPJ)->get();

                        if ($destinatario->count() == 0) {
                            $destinatario = new Destinatario();
                            $destinatario->newId();
                            $destinatario->nome_razao_social = $xml->NFe->infNFe->dest->xNome;
                            $destinatario->cpf_cnpj  = $xml->NFe->infNFe->dest->CNPJ;
                            $destinatario->ie  = $xml->NFe->infNFe->dest->IE;
                            $destinatario->usuario_id = Auth::user()->id;
                            $destinatario->tipo = (strlen($xml->NFe->infNFe->dest->CNPJ) == 14) ? 1 : 2; //cpf ou cnpj

                            $end = new Endereco();
                            $end->newId();


                            // throw new Exception('erro: '.$xml->NFe->infNFe->dest->enderDest->xLgr);
                            $end->endereco = $xml->NFe->infNFe->dest->enderDest->xLgr;
                            $end->numero = (int)$xml->NFe->infNFe->dest->enderDest->nro;
                            $end->bairro = $xml->NFe->infNFe->dest->enderDest->xBairro;
                            $end->cep = $xml->NFe->infNFe->dest->enderDest->CEP;
                            $end->cidade_id = 1;
                            $end->estado_id = 1;
                            $end->save();

                            $destinatario->endereco_id  = $end->id;

                            $cont = new Contato();
                            $cont->newId();
                            $cont->telefone = '8134645060';
                            $cont->usuario_id = Auth::user()->id;
                            $cont->save();
                            $destinatario->contato_id = $cont->id;
                            $destinatario->save();

                            $dest = $destinatario->id;
                        }else{
                            $dest=$destinatario->first()->id;
                        }

                        $nota = new Nota();
                        $nota->newId();
                        $nota->nota = (int)$xml->NFe->infNFe->ide->nNF;
                        $nota->chave_acesso = str_replace('NFe', '', $xml->NFe->infNFe['Id']);
                        $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
                        $nota->prestacao = 0;
                        $nota->peso = ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB) ? (float)$xml->NFe->infNFe->transp->vol->pesoL : (float)$xml->NFe->infNFe->transp->vol->pesoB;
                        $nota->indicacao_pagamento_id = IndicacaoPagamento::where('codigo',(int)$xml->NFe->infNFe->pag->detPag->indPag)->first()->id;
                        $nota->tipo_pagamento = (int)$xml->NFe->infNFe->pag->detPag->tPag;
                        $nota->valor = (float)$xml->NFe->infNFe->pag->detPag->vPag;
                        $nota->cliente_id = $carga->cliente_id;
                        $nota->filial_cliente_id = $carga->filial_cliente_id;
                        $nota->carga_id = $carga->id;
                        $pathStorageFile =Storage::disk('local')->put('public/arquivos/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml', file_get_contents($file));
                        $nota->path_xml = Storage::url(getenv('FILESYSTEM_DISK')).'/public/arquivos/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml';
                        // $nota->path_xml = Storage::disk('local')->put(strtolower(str_replace(' ', '', 'public/' . Cliente::find($carga->cliente_id)->name)) . '/' . str_replace(' ', '', strtolower(Filial::find($carga->filial_cliente_id)->razao_social)) . '/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml', file_get_contents($file));
                        $nota->usuario_id = Auth::user()->id;
                        $nota->status_id = 1;
                        $nota->destinatario_id = $dest;

                        if($nota->save()){
                            unlink($file);
                        }else{
                            unlink($nota->path_xml);
                        }

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
        $nota->chave_acesso = str_replace('NFe', '', $xml->NFe->infNFe['Id']);
        $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
        $nota->prestacao = 0;
        $nota->peso = ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB) ? (float)$xml->NFe->infNFe->transp->vol->pesoL : (float)$xml->NFe->infNFe->transp->vol->pesoB;
        $nota->indicacao_pagamento = (int)$xml->NFe->infNFe->pag->detPag->indPag;
        $nota->tipo_pagamento = (int)$xml->NFe->infNFe->pag->detPag->tPag;
        $nota->valor = (float)$xml->NFe->infNFe->pag->detPag->vPag;
        // $nota->save();

        return $nota;
    }

    public function carga()
    {
        return $this->belongsTo(Carga::class);
    }

    public function destinatario()
    {
        return $this->belongsTo(Destinatario::class);
    }
}
