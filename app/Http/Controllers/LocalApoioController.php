<?php

namespace App\Http\Controllers;

use App\Models\LocalApoio;
use Exception;
use Illuminate\Http\Request;
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
        // try{
        $request->validate([
            'name'=>'required|string|min:6|max:50',
            'description'=>'required|string|min:20|max:100',
            'empresa_id'=>'required',
        ]);

        // print_r($request->input());

        LocalApoio::create($request->all());

        return redirect()->route('empresa.show',['empresa'=>$request->empresa_id])->with('message', ['status' => 'success', 'msg' => 'Local de apoio adicionado com sucesso!']);

    // } catch (Exception $ex) {
    //     // echo json_encode(['status' => 'danger', 'msg' => $ex->getMessage()]);
    //     // session()->flash('message', ['status' => 'danger', 'msg' => $ex->getMessage()]);
    //     return back()->withInput();
    // }
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
