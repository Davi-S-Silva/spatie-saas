<?php

namespace App\Http\Controllers;

use App\Models\Filial;
use App\Models\LocalApoio;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('veiculo.index', ['veiculos'=>Veiculo::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('veiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo '<pre>';
        print_r($request->input());
        echo '</pre>';


        $veiculo = new Veiculo();
        $veiculo->placa = $request->Placa;
        $veiculo->empresa_id = LocalApoio::find($request->empresa_local_apoio_id)->empresa->first()->id;
        $veiculo->local_apoio_id = $request->empresa_local_apoio_id;
        $veiculo->usuario_id =Auth::user()->id;
        $veiculo->setStatus('Disponivel');
        $veiculo->proprietario_id = $request->proprietario_id;

        $veiculo->save();
        echo '<pre>';
        print_r($veiculo->getAttributes());
        echo '</pre>';


    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        dd($veiculo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        //
    }

    public function mudarVeiculoDeCliente($veiculo_id, $cliente_id)
    {
        $veiculo = DB::table('cliente_veiculo')->where('veiculo_id',$veiculo_id)->update(['cliente_id'=>$cliente_id]);

        print_r($veiculo);

        return;
    }
}
