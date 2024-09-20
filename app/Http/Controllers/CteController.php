<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cfop;
use App\Models\Cst;
use App\Models\Cte;
use App\Models\Municipio;
use App\Models\TipoCte;
use App\Models\TipoEmissaoCte;
use App\Models\TipoServicoCte;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class CteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar CTe', only: ['index']),
            new Middleware('permission:Criar CTe', only: ['create', 'store']),
            new Middleware('permission:Show CTe', only: ['show']),
            new Middleware('permission:Editar CTe', only: ['edit', 'update']),
            new Middleware('permission:Deletar CTe', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctes = Cte::all();
        return view('fiscal.cte.index',['ctes'=>$ctes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($carga)
    {
        // dump($carga);
        $tiposCte = TipoCte::all();
        $TipoEmissaoCte = TipoEmissaoCte::all();
        $tipoServicoCte = TipoServicoCte::all();
        $cidades = Municipio::orderBy('nome', 'asc');
        // $cidades = DB::table('municipios');
        // $ufs = ['PE','PB','AL','RN'];
        // $ufs = ['26','25','27','43'];
        // $cidades->whereIn('estado_id', $ufs);
        $cidadesGet = $cidades->with('estado')->get();
        $cfop = Cfop::all();
        $cst = Cst::all();
        $Carga = Carga::where('id',$carga)->with('filial')->get()->first();
        $notas = $Carga->notas()->with('destinatario','destinatario.endereco','destinatario.endereco.estado','destinatario.endereco.cidade')->get();
        // dump($Carga->distanceLastNote());
        // dd($Carga);
        return view('fiscal.cte.create',['tiposCte'=>$tiposCte,'tipoServicoCte'=>$tipoServicoCte,
        'TipoEmissaoCte'=>$TipoEmissaoCte,'cfop'=>$cfop,'cidades'=>$cidadesGet,'UltimaNotaDistancia'=>$Carga->distanceLastNote(),'notas'=>$notas,'cst'=>$cst,'carga'=>$Carga]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cte $cte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cte $cte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cte $cte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cte $cte)
    {
        //
    }
}
