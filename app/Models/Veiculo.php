<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Veiculo extends Model
{
    use Tenantable,HasRoles;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }

    public function movimentacaos()
    {
        return $this->hasMany(MovimentacaoVeiculo::class);
    }
    public function status($status)
    {
        return Status::where('name',$status)->where('tipo',2)->get()->first()->id;
    }

    public function getStatus(){
        return Status::find($this->status_id);
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',2)->get()->first()->id;
    }

    public function colaborador()
    {
        return $this->belongsToMany(Colaborador::class);
    }

    public function abastecimentos()
    {
        return $this->hasMany(Abastecimento::class);
    }

    public function associaColaborador($colaborador)
    {
        $veiculo = $this;
        //Colaborador com veiculo atribuido anteriormente
        $VeicColabAnt = DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo->id)->get();
        // $veiculoLimpo =0;
        $VeicColabAtual = DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo->id)->where('colaborador_id',$colaborador)->get();

        if($VeicColabAtual->count()!=0){
            return ['status'=>0,'msg'=>'Veiculo já está com esse colaborador associado'];
        }
        $response = $this->removeColaboradorAssociado($colaborador);
        if($VeicColabAnt->count()==0){
            // $Veiculo = Veiculo::find($veiculo);
            $this->colaborador()->attach($colaborador);
            // return response()->json(['status'=>'success','msg'=>$ColabVeicAnt]);
        }else{
            // $response = $this->removeColaboradorAssociado($colaborador);
            DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo->id)->update(['colaborador_id'=>$colaborador]);
        }
        return $response;
    }
    private function removeColaboradorAssociado($colaborador){
        $ColabVeicAnt = DB::table('colaborador_veiculo')->where('colaborador_id',$colaborador)->get();
        $veiculoLimpo = 0;
        if($ColabVeicAnt->count()!=0){
            $veiculoLimpo = $ColabVeicAnt->first()->veiculo_id;
            DB::table('colaborador_veiculo')->where('colaborador_id',$colaborador)->update(['colaborador_id'=>null]);
            // DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo)->update(['colaborador_id'=>$request->colaborador]);
        }
        return $veiculoLimpo;
    }
}
