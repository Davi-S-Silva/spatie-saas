<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\LocalApoio;
use App\Models\LocalMovimentacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LocalApoioController extends Controller
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
        return view('empresa.apoio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string|min:6|max:50',
                'description' => 'required|string|min:20|max:100',
                'empresa_id' => 'required',
            ]);

            // print_r($request->input());

            // LocalApoio::create($request->all());
            $localApoio = new LocalApoio();
            $localApoio->name = $request->name;
            $localApoio->description = $request->description;
            $localApoio->empresa_id = $request->empresa_id;
            $localApoio->usuario_id = Auth::user()->id;
            $localApoio->save();
            $localMov = new LocalMovimentacao();
            $localMov->title = $localApoio->name;
            $localMov->descricao = $localApoio->name . ' local de apoio da ' . Empresa::find($localApoio->empresa_id)->nome;
            $localMov->status_id = 1;
            $localMov->usuario_id = Auth::user()->id;
            $localMov->save();
            $localMov->tentants()->attach(Auth::user()->tenant_id);
            $localApoio->locaismovimetacoes()->attach($localMov->id);

            DB::commit();
            return redirect()->route('empresa.show', ['empresa' => $request->empresa_id])->with('message', ['status' => 'success', 'msg' => 'Local de apoio adicionado com sucesso!']);
        } catch (Exception $ex) {
            DB::rollback();
            // echo json_encode(['status' => 'danger', 'msg' => $ex->getMessage()]);
            session()->flash('message', ['status' => 'danger', 'msg' => $ex->getMessage()]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalApoio $localApoio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocalApoio $localApoio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocalApoio $localApoio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalApoio $localApoio)
    {
        //
    }
}
