<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Frete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class FreteClienteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Frete Cliente', only: ['index']),
            new Middleware('permission:Criar Frete Cliente', only: ['create', 'store']),
            new Middleware('permission:Show Frete Cliente', only: ['show']),
            new Middleware('permission:Editar Frete Cliente', only: ['edit', 'update']),
            new Middleware('permission:Deletar Frete Cliente', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $fretes = Frete::all();
        // return view('fretes.frete-cliente',['fretes'=>$fretes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            // $FreteCliente = DB::select('select * from users where active = ?', [1]);


            $cliente = Cliente::find($request->cliente);
            if(!isset($cliente->id)){
                throw new Exception('Cliente não encontrado');
            }
            $FreteCliente = DB::table('cliente_frete')->where('cliente_id',$cliente->id)->get();
            $frete = Frete::find($request->FreteCliente);
            if(!isset($frete->id)){
                throw new Exception('Frete não encontrado');
            }
            if($FreteCliente->count()!=0){
                if($FreteCliente->first()->frete_id == $frete->id){
                    throw new Exception('Cliente utiliza esse modelo de frete atualmente');
                }
                DB::table('cliente_frete')->where('cliente_id',$cliente)->update(['frete_id'=>$frete->id]);
            }else{
                $cliente->frete()->attach($frete->id);
            }

            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Modelo de Frete do cliente salvo com sucesso']);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
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
