<?php

namespace App\Http\Controllers;

use App\Models\ModeloUmFrete;
use App\Models\Uteis;
use Exception;
use Faker\Calculator\Ean;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class ModelFreteUmController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Modelo Um Frete', only: ['index']),
            new Middleware('permission:Criar Modelo Um Frete', only: ['create', 'store']),
            new Middleware('permission:Show Modelo Um Frete', only: ['show']),
            new Middleware('permission:Editar Modelo Um Frete', only: ['edit', 'update']),
            new Middleware('permission:Deletar Modelo Um Frete', only: ['destroy']),
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $Cidades = addslashes($request->Cidades);
            $cidadeModel = ModeloUmFrete::where('cidades', 'like', '%' . $Cidades . '%')->get();
            if ($cidadeModel->count() != 0) {
                throw new Exception('Essa área já existe no sistema');
            }
            $ValorUm = Uteis::validaNumero($request->ValorUm);
            $ValorDois = Uteis::validaNumero($request->ValorDois);
            $ValorTres = Uteis::validaNumero($request->ValorTres);
            $ValorQuatro = Uteis::validaNumero($request->ValorQuatro);
            $ValorCinco = Uteis::validaNumero($request->ValorCinco);
            $ValorSeis = Uteis::validaNumero($request->ValorSeis);
            $ValorSete = Uteis::validaNumero($request->ValorSete);
            $ValorOito = Uteis::validaNumero($request->ValorOito);
            $ValorNove = Uteis::validaNumero($request->ValorNove);
            $ValorDez = Uteis::validaNumero($request->ValorDez);

            $frete = new ModeloUmFrete();
            $frete->newId();
            $frete->area = 'Area' . rand(1, 100);
            $frete->cidades = $Cidades;
            $frete->um = $ValorUm;
            $frete->dois = $ValorDois;
            $frete->tres = $ValorTres;
            $frete->quatro = $ValorQuatro;
            $frete->cinco = $ValorCinco;
            $frete->seis = $ValorSeis;
            $frete->sete = $ValorSete;
            $frete->oito = $ValorOito;
            $frete->nove = $ValorNove;
            $frete->dez = $ValorDez;
            $frete->save();
            DB::commit();
            return response()->json(['status' => 200, 'msg' => 'Nova área de Frete Modelo Um cadastrado com sucesso']);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
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
        // return response()->json($request->input());
        $Cidades = addslashes($request->Cidades);
        $ValorUm = Uteis::validaNumero($request->ValorUm);
        $ValorDois = Uteis::validaNumero($request->ValorDois);
        $ValorTres = Uteis::validaNumero($request->ValorTres);
        $ValorQuatro = Uteis::validaNumero($request->ValorQuatro);
        $ValorCinco = Uteis::validaNumero($request->ValorCinco);
        $ValorSeis = Uteis::validaNumero($request->ValorSeis);
        $ValorSete = Uteis::validaNumero($request->ValorSete);
        $ValorOito = Uteis::validaNumero($request->ValorOito);
        $ValorNove = Uteis::validaNumero($request->ValorNove);
        $ValorDez = Uteis::validaNumero($request->ValorDez);
        $frete = ModeloUmFrete::find($id);
        $frete->cidades = $Cidades;
        $frete->um = $ValorUm;
        $frete->dois = $ValorDois;
        $frete->tres = $ValorTres;
        $frete->quatro = $ValorQuatro;
        $frete->cinco = $ValorCinco;
        $frete->seis = $ValorSeis;
        $frete->sete = $ValorSete;
        $frete->oito = $ValorOito;
        $frete->nove = $ValorNove;
        $frete->dez = $ValorDez;
        $frete->save();
        return response()->json(['status'=>200,'msg'=>$request->input()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
