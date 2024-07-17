<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EspecialidadeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar ...', only: ['index']),
            new Middleware('permission:Nova ...', only: ['create', 'store']),
            new Middleware('permission:Show ...', only: ['show']),
            new Middleware('permission:Editar ...', only: ['edit', 'update']),
            new Middleware('permission:Deletar ...', only: ['destroy']),
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
    public function show(Especialidade $especialidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidade $especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidade $especialidade)
    {
        //
    }
}
