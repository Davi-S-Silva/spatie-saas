<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Filial;
use App\Models\LocalApoio;
use App\Models\Nota;
use App\Models\Uteis;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carga = Carga::with('veiculo','notas','notas.filial','notas.status','notas.destinatario','notas.destinatario.endereco')->get();
        return view('carga.index', ['cargas' => $carga]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $disabled = ($clientes->count()==0)?'disabled':'';

        return view('carga.create',['clientes'=>$clientes,'disabled'=>$disabled,'link'=>'clientes.create','text'=>'Não há clientes cadastrados']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $carga = new Carga();
            $carga->newId();
            $carga->area = $request->area;
            $carga->peso = $request->peso;
            $carga->entregas = $request->entregas;
            $carga->motorista_id = $request->colaborador;
            $carga->remessa = $request->remessa;
            $carga->veiculo_id = $request->veiculo;
            $carga->frete = $request->frete;
            $carga->os = $request->os;
            $carga->data = $request->data;
            $carga->cliente_id = Filial::find($request->Filial)->clientes()->first()->id;
            $carga->filial_id = $request->Filial;
            $carga->empresa_id = LocalApoio::find($request->empresa_local_apoio_id)->empresa->id;
            $carga->local_apoio_id = $request->empresa_local_apoio_id;
            $carga->usuario_id = Auth::user()->id;
            $carga->setStatus('Pendente');//carga pendente

            $carga->save();

            // $carga->setNotas($request->Notas);



            // $carga->save();

            DB::commit();
            // return response()->json([$request->input(),(new Nota())->getNotas($request->Notas, $request->Filial, )]);
            return response()->json([$carga, $request->input()]);
        } catch (Exception $ex) {
            DB::rollback();
            // return response()->json([$ex->getMessage(),$ex->getLine()]);
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
        return view('carga.show',['carga'=>$carga]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carga $carga)
    {
        return view('carga.edit', ['carga' => $carga]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carga $carga)
    {
        return response()->json($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carga $carga)
    {
        //
    }

    public function setNotas(Request $request, $carga)
    {
        try {
            DB::beginTransaction();
            $Carga = Carga::find($carga);
            if(is_null($request->Notas)){
                throw new Exception('Digite as notas a serem inseridas');
            }
            // $request->validate([
            //     'Notas'=>'required|alpha_dash'
            // ]);
            // $array =   Uteis::limpar_texto(str_replace('Número: ', '', $request->Notas));
            $array =   Uteis::limpar_texto($request->Notas);
            $response = $Carga->setNotas($array);

            if(is_null($response)){
                throw new Exception('Verifique as informações digitadas');
            }

            // sleep(5);
            if(count($response)!=0){
                return response()->json(['status'=>0,'msg'=>'notas nao encontradas','notas'=>$response]);
            }
            // return response()->json(['status'=>200,'msg'=>$request->Notas]);
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Notas Cadastradas com sucesso!']);
        } catch (Exception $ex) {
            DB::rollback();
            return ['status'=>0,'msg' => $ex->getMessage(), 'linha' => $ex->getCode().' - file '.$ex->getFile().' - line '.$ex->getLine()];
        }
    }


    public function getCargasDisponiveis($filial)
    {
        try {


            $Filial = Filial::where('link', $filial)->get();

            if ($Filial->count() == 0) {
                throw new Exception('Cargas não encontradas para cliente '. $filial);
            }
            $cargas = $Filial->first()->cargas;
            // return response()->json(['Cliente'=>$filial->clientes()->first()->name]);
            $Dados = [];
            foreach ($cargas as $carga) {
                if ($carga->status_id == 1) {
                    $Dados[] = [
                        'id' => $carga->id,
                        'area' => $carga->area,
                        'remessa' => $carga->remessa,
                        'os' => $carga->os,
                        'motorista' => $carga->motorista->name
                    ];
                }
            }

            // $cargas = $filial->with('cargas')->get();

            // dd($Dados);
            return response()->json(['status' => 200, 'cargas' => $Dados,'cliente'=>$Filial->first()->nome_fantasia]);
        } catch (Exception $ex) {
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }
}
