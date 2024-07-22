<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Colaborador;
use App\Models\Km;
use App\Models\Veiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $abast = Abastecimento::where('colaborador_id',Auth::user()->colaborador->first()->id)->with('veiculo','colaborador');
        }else{
            $abast = Abastecimento::with('veiculo','colaborador');
        }
        if((!empty($_GET['item']) && !empty($_GET['order']))){
            $abast->orderBy($_GET['item'],$_GET['order']);
            session(['order-by-items-item'=>$_GET['item'],'order-by-items-order'=>$_GET['order']]);
        }

        if(session()->has('order-by-items-item') && session()->has('order-by-items-order')){
            $abast->orderBy(session('order-by-items-item'),session('order-by-items-order'));
        }
        $paginate = 5;
        if(!empty($_GET['paginate'])){
            $paginate = $_GET['paginate'];
            session(['paginate-by-page'=>$paginate]);
        }
        $dados = $abast->paginate($paginate);
        if(session()->has('paginate-by-page')){
            $paginate = session('paginate-by-page');
            $dados->appends($paginate);
        }
        if(session()->has('order-by-items-item') && session()->has('order-by-items-order')){
            $item = session('order-by-items-item');
            $order = session('order-by-items-order');
            $dados->appends(['item'=>$item]);
            $dados->appends(['order'=>$order]);
            // dd(session('order-by-items-order'));
        }
        // dd(session('order-by-items-order'));

        $dados = $abast->paginate($paginate)->withQueryString();

        // foreach(Abastecimento::all() as $abastecimento){
        //     if($abastecimento->colaborador->usuario()->withTrashed()->get()->count()!=0){
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario()->withTrashed()->first()->name . '<br />';
        //     }else{
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario->first()->name . '<br />';
        //     }
        // }

        // return response()->json(Abastecimento::all());
        return view('veiculo.abastecimento.index',['Abastecimentos'=>$dados]);
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
        try{
            DB::beginTransaction();
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


            // return $abastecimento->veiculo->kms()->get()->last()->km;

            if(($abastecimento->kmAnterior>=$abastecimento->kmAtual) || ($abastecimento->veiculo->kms()->get()->last()->km > $abastecimento->kmAtual)){
                return 'erro: O km anterior não pode ser menor ou igual ao km atual. '.$abastecimento->kmAtual. ' --- '.$abastecimento->veiculo->kms()->get()->last()->km. ' ---- '.$abastecimento->kmAnterior;
            }

            $Veiculo = Veiculo::find($abastecimento->veiculo_id);
            $KmModel = new Km();
            $KmModel->setKm($Veiculo,$abastecimento->kmAtual);
            $KmModel->save();
            $Veiculo->associaColaborador($abastecimento->colaborador_id);
            // $abastecimento->Fornecedor_id = 1;
            // return $abastecimento->getAttributes();
            DB::commit();
            $abastecimento->save();
        }catch(Exception $ex){
            DB::rollback();
            return $ex->getMessage(). '-'.$ex->getFile().'-'.$ex->getLine();
        }
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
