<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Veiculo extends Model
{
    use Tenantable,HasRoles;

    protected $guarded = ['id'];

    public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }
    }

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
    public function getStatusId($status)
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
    public function associaReboque($semireboque)
    {
        $Veiculo = $this;
        //Colaborador com veiculo atribuido anteriormente
        $VeicReboqueAnt = DB::table('reboque_veiculo')->where('veiculo_id',$Veiculo->id)->get();
        $VeicReboqueAtual = DB::table('reboque_veiculo')->where('veiculo_id',$Veiculo->id)->where('reboque_id',$semireboque)->get();
        if($VeicReboqueAtual->count()!=0){
            return ['status'=>0,'msg'=>'Veiculo já está com esse reboque associado'];
        }
        // $Veiculo->reboque()->attach($semireboque);
        $response = $this->removeReboqueAssociado($semireboque);
        if($VeicReboqueAnt->count()==0){
            // $Veiculo = Veiculo::find($veiculo);
            $this->reboque()->attach($semireboque);
            // return response()->json(['status'=>'success','msg'=>$ColabVeicAnt]);
        }else{
            // $response = $this->removeColaboradorAssociado($colaborador);
            DB::table('reboque_veiculo')->where('veiculo_id',$Veiculo->id)->update(['reboque_id'=>$semireboque]);
        }
        return $response;
    }
    private function removeReboqueAssociado($semireboque){
        $ReboqueVeicAnt = DB::table('reboque_veiculo')->where('reboque_id',$semireboque)->get();
        $veiculoLimpo = 0;
        if($ReboqueVeicAnt->count()!=0){
            $veiculoLimpo = $ReboqueVeicAnt->first()->veiculo_id;
            DB::table('reboque_veiculo')->where('reboque_id',$semireboque)->update(['reboque_id'=>null]);
            // DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo)->update(['colaborador_id'=>$request->colaborador]);
        }
        return $veiculoLimpo;
    }

    public function kms()
    {
        return $this->hasMany(Km::class);
    }

    public static function getSemiReboques($status=null)
    {
        $veiculo = Veiculo::where('tipo_veiculo_id',40);
        if(!is_null($status)){
            $veiculo->where('status_id',$status);
        }
        // $veiculo;

        return $veiculo->get();
    }

    public function reboque()
    {
        // return $this->belongsToMany(Veiculo::class,'reboque_veiculo','veiculo_id','reboque_id');
        return $this->belongsToMany(Veiculo::class,'reboque_veiculo','veiculo_id','reboque_id');
        // $VeicReboqueAnt = DB::table('colaborador_veiculo')->where('veiculo_id',$veiculo->id)->get();
    }
}
