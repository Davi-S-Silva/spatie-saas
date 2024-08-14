<?php

namespace App\Http\Controllers;

use App\Models\CEP;
use Illuminate\Http\Request;

class CEPController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    public function getCoordenadaCep($cep)
    {
        $Coordenadas = new CEP();
        return $Coordenadas->getCoordenadaCep($cep);
    }
    public function getCepEndereco($uf,$cidade,$logradouro){
        $Coordenadas = new CEP();
        $dados = $Coordenadas->getCepEndereco($uf,$cidade,$logradouro);
        return response()->json($dados);
    }
}
