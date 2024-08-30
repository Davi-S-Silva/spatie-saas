<?php

namespace App\Models;

use Exception;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Nota extends Model
{
    use  Tenantable, HasRoles;


    public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
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
    public function getStatusId($status)
    {
        return Status::where('name', $status)->where('tipo', 7)->get()->first()->id;
    }
    public function getNotas($notas, $carga)
    {
        $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
        // return $carga;
        $pasta = getEnv('RAIZ') . Storage::disk('local')->url('app/public/' . $empresa . '/notas');
        $diretorio = dir($pasta);

        // return $this->formataTextNotas($notas);
        // $arrayNotas = explode('-', $this->formataTextNotas($notas));
        $arrayNotas = $notas;
        $encontradas = [];
        $jaCadastradas = '';

        while (($arquivo = $diretorio->read()) !== false) {
            if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'Autorizada' && $arquivo != 'Nao autorizada') {
                $file = $pasta . '/' . $arquivo;
                $xml = simplexml_load_file($file);
                for ($i = 0; $i < count($arrayNotas); $i++) {
                    if ((int)$xml->NFe->infNFe->ide->nNF == $arrayNotas[$i]) {
                        // throw new Exception($arrayNotas[$i]);
                        // $this->getDadosXmlNota($xml);
                        // $this->getDadosXmlNota($xml);
                        $encontradas[] = $arrayNotas[$i];

                        $notaBd = Nota::where('chave_acesso', str_replace('NFe', '', $xml->NFe->infNFe['Id']))->get();
                        // throw new Exception('contagem: '.$notaBd->count());
                        // if ($notaBd->count() != 0) {
                            // throw new Exception('Nota ' . $arrayNotas[$i] . ' já existe em nosso banco de dados');
                            // $jaCadastradas .= ($i<count($arrayNotas)-1)?$arrayNotas[$i].'-':$arrayNotas[$i];
                        // } else {
                        if ($notaBd->count() == 0) {
                            //verificar se ta cadastrado o destinatario
                            $destinatario = Destinatario::where('cpf_cnpj','')->get();
                            if($destinatario->count()!=0){
                                $destinatario->first()->cpf_cnpj = 12345678;
                                $destinatario->first()->save();
                            }
                            $destinatarioCpf = Destinatario::where('cpf_cnpj',$xml->NFe->infNFe->dest->CPF)->get();
                            $destinatarioCnpj = Destinatario::where('cpf_cnpj', $xml->NFe->infNFe->dest->CNPJ)->get();
                            // throw new Exception($destinatarioCpf. '-'.$xml->NFe->infNFe->dest->CPF);
                            // throw new Exception($destinatarioCnpj. '-'.$xml->NFe->infNFe->dest->CNPJ);
                            // throw new Exception($destinatario->count(). '-'.$xml->NFe->infNFe->dest->CNPJ. '-'.$xml->NFe->infNFe->dest->CPF);
                            if ($destinatarioCpf->count() == 0 && $destinatarioCnpj->count() == 0) {
                                $destinatario = new Destinatario();
                                $destinatario->newId();
                                $destinatario->nome_razao_social = $xml->NFe->infNFe->dest->xNome;
                                $destinatario->cpf_cnpj  = (isset($xml->NFe->infNFe->dest->CNPJ))? $xml->NFe->infNFe->dest->CNPJ : $xml->NFe->infNFe->dest->CPF;
                                $destinatario->ie  = $xml->NFe->infNFe->dest->IE;
                                $destinatario->usuario_id = Auth::user()->id;
                                // $tipoCpf =
                                // if(isset($xml->NFe->infNFe->dest->CNPJ)){
                                    $destinatario->tipo = (strlen($xml->NFe->infNFe->dest->CNPJ) == 14) ? 1 : 2; //cpf ou cnpj
                                // }
                                // throw new Exception($destinatario->cpf_cnpj.'--'.$xml->NFe->infNFe->dest->CNPJ);
                                $end = new Endereco();
                                $end->newId();


                                // throw new Exception('erro: '.$xml->NFe->infNFe->dest->enderDest->xLgr);
                                $end->endereco = $xml->NFe->infNFe->dest->enderDest->xLgr;
                                $end->numero = (int)$xml->NFe->infNFe->dest->enderDest->nro;
                                $end->bairro = $xml->NFe->infNFe->dest->enderDest->xBairro;
                                $end->cep = $xml->NFe->infNFe->dest->enderDest->CEP;
                                $end->cidade_id = Municipio::where('codigo', (int)$xml->NFe->infNFe->dest->enderDest->cMun)->get()->first()->id;
                                // return ['cMun'=>(int)$xml->NFe->infNFe->dest->enderDest->cMun,'cidade'=>Municipio::where('codigo',(int)$xml->NFe->infNFe->dest->enderDest->cMun)->get()->first()];
                                // return Estado::where('uf',$xml->NFe->infNFe->dest->enderDest->UF)->get()->first()->id;
                                $end->estado_id = Estado::where('uf', $xml->NFe->infNFe->dest->enderDest->UF)->get()->first()->id;
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
                            } else {
                                if($destinatarioCpf->count()!=0){
                                    $dest = $destinatarioCpf->first()->id;

                                }else if($destinatarioCnpj->count()!=0){
                                    $dest = $destinatarioCnpj->first()->id;
                                }
                            }

                            $nota = new Nota();
                            $nota->newId();
                            $nota->nota = (int)$xml->NFe->infNFe->ide->nNF;
                            $nota->chave_acesso = str_replace('NFe', '', $xml->NFe->infNFe['Id']);
                            $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
                            $nota->prestacao = 0;
                            $nota->pesoBruto = $xml->NFe->infNFe->transp->vol->pesoB;
                            $nota->pesoLiquido = $xml->NFe->infNFe->transp->vol->pesoL; // ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB) ? (float)$xml->NFe->infNFe->transp->vol->pesoL : (float)$xml->NFe->infNFe->transp->vol->pesoB;
                            $nota->indicacao_pagamento_id = IndicacaoPagamento::where('codigo', (int)$xml->NFe->infNFe->pag->detPag->indPag)->first()->id;
                            $nota->tipo_pagamento_id = TipoPagamento::where('codigo', (int)$xml->NFe->infNFe->pag->detPag->tPag)->get()->first()->id;
                            $nota->valor = (float)$xml->NFe->infNFe->pag->detPag->vPag;
                            $nota->cliente_id = $carga->cliente_id;

                            // throw new Exception ($carga);
                            $nota->filial_id = $carga->filial_id;
                            $nota->carga_id = $carga->id;
                            $pathStorageFile = Storage::put('app/public/' . $empresa . '/arquivos/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml', file_get_contents($file));
                            // throw new Exception($pathStorageFile);



                            $nota->path_xml = Storage::url(getenv('FILESYSTEM_DISK')) . '/app/public/' . $empresa . '/arquivos/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml';
                            // $nota->path_xml = Storage::disk('local')->put(strtolower(str_replace(' ', '', 'public/' . Cliente::find($carga->cliente_id)->name)) . '/' . str_replace(' ', '', strtolower(Filial::find($carga->filial_cliente_id)->razao_social)) . '/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml', file_get_contents($file));
                            $nota->usuario_id = Auth::user()->id;
                            $nota->status_id = $nota->getStatusId('Pendente');
                            $nota->destinatario_id = $dest;
                            $nota->save();
                            $notaBd = Nota::find($nota->id);

                            //SALVAR OS PRODUTOS DAS NOTAS
                            $Produtos = [];
                            foreach ($xml->NFe->infNFe->det as $produto) {
                                // $Produtos[]=(string)$produto->prod->xProd;
                                $newProd = new ProdutoNota();
                                $newProd->id = $newProd->newId();
                                $newProd->nome = (string)$produto->prod->xProd;
                                $newProd->ncm = (int)$produto->prod->NCM;
                                $newProd->quantidade = (int)$produto->prod->qCom;
                                $newProd->unidade = (string)$produto->prod->uCom;
                                $newProd->valor = (float)$produto->prod->vUnCom;
                                $newProd->save();
                                $nota->produtos()->attach($newProd);
                            }

                            // return $nota;
                            // throw new Exception($Produtos[0]);
                            //apagando o xml usado e movido
                            if ($notaBd->count() != 0) {
                                unlink($file);
                            } else {
                                unlink($nota->path_xml);
                            }
                            // return $arrayNotas[$i];
                        }
                    }
                }
            }
        }
        $diferenca = array_diff($arrayNotas, $encontradas);
        if (!is_null($diferenca)) {
            return $diferenca;
        }
        return true;

    }
    public function produtos()
    {
        return $this->belongsToMany(ProdutoNota::class);
    }
    private function getDadosXmlNota($xml)
    {
        $nota = new Nota();
        $nota->nota = (int)$xml->NFe->infNFe->ide->nNF;
        $nota->chave_acesso = str_replace('NFe', '', $xml->NFe->infNFe['Id']);
        $nota->volume = (int)$xml->NFe->infNFe->transp->vol->qVol;
        $nota->prestacao = 0;
        $nota->pesoBruto = $xml->NFe->infNFe->transp->vol->pesoB;
        $nota->pesoLiquido =$xml->NFe->infNFe->transp->vol->pesoL; // ($xml->NFe->infNFe->transp->vol->pesoL >= $xml->NFe->infNFe->transp->vol->pesoB) ? (float)$xml->NFe->infNFe->transp->vol->pesoL : (float)$xml->NFe->infNFe->transp->vol->pesoB;
        $nota->indicacao_pagamento = (int)$xml->NFe->infNFe->pag->detPag->indPag;
        $nota->tipo_pagamento_id = TipoPagamento::where('codigo', (int)$xml->NFe->infNFe->pag->detPag->tPag)->get()->first()->id;
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

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }


    public function status()
    {
        // return Status::find($this->status_id);
        return $this->belongsTo(Status::class);
    }
    public function setStatus($status)
    {
        $this->status_id = Status::where('name', $status)->where('tipo', 7)->get()->first()->id;
    }
    public static function GetAllStatus()
    {
        return Status::where('tipo', 7)->get();
    }

    public function usuarioConclusao()
    {
        return $this->belongsTo(User::class, 'usuario_conclusao_id');
    }

    public function observacoes()
    {
        return $this->belongsToMany(Observacao::class);
    }
    public function getProdutos(){

    }

    public function comprovantes()
    {
        return $this->hasMany(ComprovanteNota::class);
    }
    public function getComprovante($file, $download=false){
        if($download=='download'){
            return Storage::temporaryUrl(
                $file,
                now()->addHour(),
                ['ResponseContentDisposition' => 'attachment']
            );
        }else{
            return Storage::temporaryUrl(
                $file,
                now()->addHour()
            );
        }

    }
    public function getComprovanteNotaSemTaNoBd()
    {
        $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
        $directory = 'app/public/'.$empresa.'/arquivos/notas/comprovantes/';
        $files = Storage::files($directory);
        $paths = '';
        foreach ($files as $file) {
            if(str_contains($file, $this->nota)){
                $paths = Storage::temporaryUrl(
                    $file,
                    now()->addHour()
                );
            }
        }
        return $paths;
    }
}
