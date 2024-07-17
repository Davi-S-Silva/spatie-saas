<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Colaborador;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AbastecimentoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Abastecimento', only: ['index']),
            new Middleware('permission:Criar Abastecimento', only: ['create', 'store']),
            new Middleware('permission:Show Abastecimento', only: ['show']),
            new Middleware('permission:Editar Abastecimento', only: ['edit', 'update']),
            new Middleware('permission:Deletar Abastecimento', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->roles()->first()->name== 'tenant-colaborador' || Auth::user()->roles()->first()->name== 'colaborador'){
            $abast = Abastecimento::where('colaborador_id',Auth::user()->colaborador->first()->id)->with('veiculo','colaborador')->orderBy('id','desc')->paginate(20);
        }else{
            $abast = Abastecimento::orderBy('id','desc')->with('veiculo','colaborador')->paginate(20);
        }
        // foreach(Abastecimento::all() as $abastecimento){
        //     if($abastecimento->colaborador->usuario()->withTrashed()->get()->count()!=0){
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario()->withTrashed()->first()->name . '<br />';
        //     }else{
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario->first()->name . '<br />';
        //     }
        // }

        // return response()->json(Abastecimento::all());
        return view('veiculo.abastecimento.index',['Abastecimentos'=>$abast]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('veiculo.abastecimento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->input());
        // echo '</pre>';
        // exit;

        $abastecimento = new Abastecimento();
        $abastecimento->cupom = $request->Cupom;
        $abastecimento->kmAtual = $request->Km;
        $abastecimento->litros = number_format((double)$request->Litro,2,'.','');
        $abastecimento->valor = number_format((double)$request->Valor,2,'.','');
        $abastecimento->combustivel_id = $request->Combustivel;

        if(count(Auth::user()->colaborador)!=0){
            // echo Auth::user()->colaborador->first()->id;
            $abastecimento->colaborador_id = Auth::user()->colaborador->first()->id;
            // echo '<br />';
            if(count(Auth::user()->colaborador->first()->veiculo)!=0){
                echo Auth::user()->colaborador->first()->veiculo->first()->placa;
                $abastecimento->veiculo_id = Auth::user()->colaborador->first()->veiculo->first()->id;
            }else{
                $abastecimento->veiculo_id = $request->veiculo;
            }
        }else{
            $abastecimento->veiculo_id = $request->veiculo;
            $abastecimento->colaborador_id = $request->colaborador;
            $abastecimento->tenant_id = Colaborador::find($request->colaborador)->tenant_id;
        }
        $kmAnterior = Abastecimento::where('veiculo_id',$abastecimento->veiculo_id)->get();
        $abastecimento->kmAnterior = ($kmAnterior->count()!=0)?$kmAnterior->last()->kmAtual:0;

        if($abastecimento->kmAnterior>=$abastecimento->kmAtual){
            return 'erro: O km anterior não pode ser menor ou igual ao km atual.';
        }

        $Veiculo = Veiculo::find($abastecimento->veiculo_id);
        $Veiculo->associaColaborador($abastecimento->colaborador_id);
        // $abastecimento->Fornecedor_id = 1;
// return $abastecimento->getAttributes();
        $abastecimento->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
