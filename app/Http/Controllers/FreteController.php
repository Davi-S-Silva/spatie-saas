<?php

namespace App\Http\Controllers;

use App\Models\Frete;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\ModeloUmFrete;

class FreteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Frete', only: ['index']),
            new Middleware('permission:Criar Frete', only: ['create', 'store']),
            new Middleware('permission:Show Frete', only: ['show']),
            new Middleware('permission:Editar Frete', only: ['edit', 'update']),
            new Middleware('permission:Deletar Frete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fretes = Frete::all();
        return view('fretes.index',['fretes'=>$fretes]);
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
        return $request->input();
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
        $frete = Frete::find($id);
        $nameModel = str_replace(' ','',ucwords(str_replace('-',' ',$frete->name)));
        // echo $test = ucwords($model);
        $nameSpaceModel = '\\App\\Models\\'.$nameModel;
        // dd($model);
        $fretes = $nameSpaceModel::all();
        // dd($fretes);
        return view('fretes.'.$frete->name,['fretes'=>$fretes]);
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
