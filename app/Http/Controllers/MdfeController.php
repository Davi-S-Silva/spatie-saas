<?php

namespace App\Http\Controllers;

use App\Models\Mdfe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MdfeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar MDFe', only: ['index']),
            new Middleware('permission:Criar MDFe', only: ['create', 'store']),
            new Middleware('permission:Show MDFe', only: ['show']),
            new Middleware('permission:Editar MDFe', only: ['edit', 'update']),
            new Middleware('permission:Deletar MDFe', only: ['destroy']),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mdfe $mdfe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mdfe $mdfe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mdfe $mdfe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mdfe $mdfe)
    {
        //
    }
}
