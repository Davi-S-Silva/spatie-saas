<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Filial;
use App\Models\Nota;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
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
        return view('carga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try{
            DB::beginTransaction();
            $carga = new Carga();
            $carga->newId();
            $carga->remessa= '';
            $carga->frete= '';
            $carga->os = '';
            $carga->data = '';
            $carga->cliente_id = Filial::find($request->Filial)->clientes()->first()->id;

            // $carga->save();

            // DB::commit();
            // return response()->json([$request->input(),(new Nota())->getNotas($request->Notas, $request->Filial, )]);
            return response()->json($carga);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json($ex->getMessage());
        }



        // return response()->json($request->input());
        // return response()->json($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(Carga $carga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carga $carga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carga $carga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carga $carga)
    {
        //
    }
}
