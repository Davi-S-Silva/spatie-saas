<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Entrega;
use App\Models\Veiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrega = Entrega::with('cargas','ajudantes','colaborador','veiculo')->paginate(5);
        return view('entrega.index',['entregas'=>$entrega]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('entrega.create');

        return view('entrega.create',['clientes'=>Cliente::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $entrega = new Entrega();
            $entrega->newId();
            $Carga = Carga::find($request->Cargas[0]);
            $entrega->cliente_id =$Carga->cliente_id;
            $entrega->filial_id =$Carga->filial_id;
            $Veiculo = Veiculo::find($request->veiculo);
            if($Veiculo->status_id==1){
                $entrega->veiculo_id =$request->veiculo;
            }else{
                throw new Exception('Veiculo está indisponivel');
            }
            $entrega->empresa_id =$Carga->empresa_id;
            $entrega->local_apoio_id =$Carga->local_apoio_id;

            $Motorista = Colaborador::find($request->colaborador);
            if($Motorista->status_id==1){
                $entrega->colaborador_id =$request->colaborador;
            }else{
                throw new Exception('Motorista está indisponivel');
            }
            $entrega->status_id = 1;
            $entrega->usuario_id =Auth::user()->id;
            $entrega->save();
            // return response()->json($request->input());
            foreach($request->Cargas as $carga){
                $Carga = Carga::find($carga);
                if($Carga->status_id==1){
                    $entrega->cargas()->attach($Carga);
                    $Carga->status_id=2;
                    $Carga->save();
                }else{
                    throw new Exception('Um ou mais carga está indisponivel');
                }
            }
            if(count($request->ajudante)>0 && $request->ajudante[0]!=null){
                foreach($request->ajudante as $ajudante){
                    $Ajudante = Colaborador::find($ajudante);
                    if($Ajudante->status_id==1){
                        $entrega->ajudantes()->attach($Ajudante);
                        $Ajudante->status_id = 2;
                        $Ajudante->save();
                    }else{
                        throw new Exception('Um ou mais ajudante está indisponivel');
                    }
                }
            }
            DB::commit();
            return response()->json($entrega);
            // return response()->json($request->input());
        }catch(Exception $ex){
            DB::rollback();
            return response()->json($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        //
    }
}
