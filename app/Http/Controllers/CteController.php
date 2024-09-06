<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cte;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
    public function create(Carga $carga)
    {
        // dump($carga);
        return view('fiscal.cte.create');
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
